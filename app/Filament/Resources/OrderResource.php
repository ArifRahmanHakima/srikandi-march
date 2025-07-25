<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use Pages\ViewOrder;
use App\Models\Order;
use App\Models\Product;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Illuminate\Support\Number;
use Filament\Resources\Resource;
use Filament\Forms\Components\View;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Actions\Action;
use Filament\Forms\Components\Actions;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Columns\SelectColumn;
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\ToggleButtons;
use App\Filament\Resources\OrderResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\OrderResource\RelationManagers;
use App\Filament\Resources\OrderResource\RelationManagers\AddressRelationManager;
use Dom\Text;
use Filament\Notifications\Notification;

class OrderResource extends Resource
{
    protected static ?string $model = Order::class;

    protected static ?string $navigationIcon = 'heroicon-o-shopping-bag';

    protected static ?int $navigationSort = 5;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Group::make()->schema([
                    Section::make('Order Information')->schema([
                        Select::make('user_id')
                            ->label('Pengguna')
                            ->relationship('user', 'name')
                            ->searchable()
                            ->preload()
                            ->required(),

                        Select::make('payment_method')
                            ->label('Metode Pembayaran')
                            ->options([
                                'dana' => 'DANA',
                                'gopay' => 'GOPAY',
                                'bri' => 'BRI',
                                'bni' => 'BNI',
                            ])
                            ->required(),

                        Select::make('payment_status')
                            ->label('Status Pembayaran')
                            ->options([
                                'pending' => 'Tertunda',
                                'paid' => 'Dibayar',
                                'failed' => 'Gagal',
                            ])
                            ->default('pending')
                            ->required(),

                        ToggleButtons::make('status')
                            ->inline()
                            ->default('new')
                            ->required()
                            ->options([
                                'new' => 'Baru',
                                'processing' => 'Diproses',
                                'shipped' => 'Dikirim',
                                'delivered' => 'Diterima',
                            ])
                            ->colors([
                                'new' => 'info',
                                'processing' => 'warning',
                                'shipped' => 'success',
                                'delivered' => 'success',
                            ])
                            ->icons([
                                'new' => 'heroicon-m-sparkles',
                                'processing' => 'heroicon-m-arrow-path',
                                'shipped' => 'heroicon-m-truck',
                                'delivered' => 'heroicon-m-check-circle',
                            ]),   

                        TextInput::make('shipping_amount')
                            ->label('Biaya Pengiriman')
                            ->numeric()
                            ->default(0),

                        TextInput::make('no_resi')
                            ->label('Nomor Resi')
                            ->maxLength(255),

                        Textarea::make('notes')
                            ->columnSpanFull(),                       

                        ToggleButtons::make('shipping_method')
                            ->label('Metode Pengiriman')
                            ->inline()
                            ->required()
                            ->options([
                                'jne' => 'JNE',
                                'jnt' => 'J&T Express',
                            ])
                            ->colors([
                                'jne' => 'info',
                                'jnt' => 'danger',
                            ]),

                        Actions::make([
                            Action::make('lihat_bukti_pembayaran')
                                ->label('Lihat Bukti Pembayaran')
                                ->icon('heroicon-m-eye')
                                ->url(fn ($record) => $record && $record->bukti_pembayaran
                                    ? asset('storage/' . $record->bukti_pembayaran)
                                    : null
                                )
                                ->openUrlInNewTab()
                                ->color(fn ($record) => $record && $record->bukti_pembayaran ? 'success' : 'gray')
                                ->disabled(fn ($record) => !$record)
                                ->action(function ($record) {
                                    if (!$record || !$record->bukti_pembayaran) {
                                        Notification::make()
                                            ->title('Bukti pembayaran belum tersedia')
                                            ->body('Pelanggan belum mengunggah bukti pembayaran.')
                                            ->danger()
                                            ->send();
                                    }
                                })
                        ]),

                        Actions::make([                          
                            Action::make('Kunjungi Website Kurir')
                                ->label('Cek Website Kurir')
                                ->url(fn (callable $get) => match ($get('shipping_method')) {
                                    'jne' => 'https://www.jne.co.id/id',
                                    'jnt' => 'https://www.jet.co.id/',
                                    default => '#',
                                })
                                ->color('primary')
                                ->openUrlInNewTab(),
                        ]),
                    ])->columns(2),

                    Section::make('Order Items')->schema([
                        Repeater::make('items')
                            ->relationship()
                            ->schema([
                                Select::make('product_id')
                                    ->relationship('product', 'name')
                                    ->label('Produk')
                                    ->searchable()
                                    ->preload()
                                    ->required()
                                    ->columnSpan(4)
                                    ->reactive()
                                    ->afterStateUpdated(fn ($state, Set $set) => $set('unit_amount', Product::find($state)?->price ?? 0))
                                    ->afterStateUpdated(fn ($state, Set $set) => $set('total_amount', Product::find($state)?->price ?? 0)),

                                TextInput::make('quantity')
                                    ->label('Jumlah')
                                    ->numeric()
                                    ->required()
                                    ->default(1)
                                    ->minValue(1)
                                    ->columnSpan(2)
                                    ->reactive()
                                    ->afterStateUpdated(fn ($state, Set $set, Get $get) => $set('total_amount', $state * $get ('unit_amount'))),

                                TextInput::make('unit_amount')
                                    ->label('Harga Satuan')
                                    ->numeric()
                                    ->required()
                                    ->disabled()
                                    ->dehydrated()
                                    ->columnSpan(3),

                                TextInput::make('total_amount')
                                    ->label('Total Harga')
                                    ->numeric()
                                    ->required()
                                    ->dehydrated()
                                    ->columnSpan(3),
                                    
                            ])->columns(12),
                        
                        Placeholder::make('grand_total_placeholder')
                            ->label('Grand Total')
                            ->content(function (Get $get, Set $set) {
                                $total = 0;
                                if(!$repeaters = $get('items')) {
                                    return $total;
                                }

                                foreach($repeaters as $key => $repeater) {
                                    $total += $get("items.{$key}.total_amount");
                                }

                                $total += $get('shipping_amount');

                                $set('grand_total', $total);
                                return 'Rp ' . number_format($total, 0, ',', '.');
                            }),

                            Hidden::make('grand_total')
                                ->default(0)
                    ])
                ])->columnSpanFull()
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('user.name')
                    ->label('Pelanggan')    
                    ->sortable()
                    ->searchable(),

                TextColumn::make('grand_total')
                    ->label('Total Pembayaran')
                    ->numeric()
                    ->sortable()
                    ->formatStateUsing(fn ($state) => 'Rp ' . number_format($state, 0, ',', '.')),
                    
                TextColumn::make('payment_method')
                    ->label('Metode Pembayaran')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('shipping_method')
                    ->label('Metode Pengiriman')
                    ->sortable()
                    ->searchable(),

                SelectColumn::make('status')
                    ->label('Status Pesanan')
                    ->options([
                        'new' => 'Baru',
                        'processing' => 'Diproses',
                        'shipped' => 'Dikirim',
                        'delivered' => 'Diterima',
                    ])
                    ->searchable()
                    ->sortable(),

                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                ActionGroup::make([
                    ViewAction::make(),
                    EditAction::make(),
                    DeleteAction::make(),
                ])
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            AddressRelationManager::class
        ];
    }

    public static function getNavigationBadge(): ?string {
        return static::getModel()::count();
    }

    public static function getNavigationBadgeColor(): string|array|null {
        return static::getModel()::count() > 10 ? 'success' : 'danger';
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListOrders::route('/'),
            'create' => Pages\CreateOrder::route('/create'),
            'view' => Pages\ViewOrder::route('/{record}'),
            'edit' => Pages\EditOrder::route('/{record}/edit'),
        ];
    }
}
