<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Brand;
use App\Models\Product;
use Filament\Forms\Set;
use App\Models\Category;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Illuminate\Support\Str;
use Filament\Resources\Resource;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Section;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms\Components\MarkdownEditor;
use App\Filament\Resources\ProductResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\ProductResource\RelationManagers;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static ?string $navigationIcon = 'heroicon-o-squares-2x2';

    protected static ?string $recordTitleAttribute = 'name';

    protected static ?int $navigationSort = 4;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Group::make()->schema([
                    Section::make('Product Information')->schema([
                        TextInput::make('name')
                            ->required()
                            ->maxLength(255)
                            ->live(onBlur: true)
                            ->afterStateUpdated(function(string $operation, $state, Set $set, $get){
                                if ($operation !== 'create') {
                                    return;
                                }
                                $set('slug', Str::slug($state));
                                
                                // Generate SKU otomatis
                                $categoryId = $get('category_id');
                                $brandId = $get('brand_id');
                                
                                if ($categoryId && $brandId) {
                                    $category = Category::find($categoryId);
                                    $brand = Brand::find($brandId);
                                    
                                    if ($category && $brand) {
                                        $sku = Product::generateSKU($category->name, $brand->name);
                                        $set('sku', $sku);
                                    }
                                }
                            }),

                        TextInput::make('slug')
                            ->required()
                            ->disabled()
                            ->dehydrated()
                            ->unique(Product::class, 'slug', ignoreRecord: true)
                            ->maxLength(255),

                        TextInput::make('sku')
                            
                            ->required()
                            ->unique(Product::class, 'sku', ignoreRecord: true)
                            ->maxLength(255)
                            ->helperText('SKU akan tergenerate otomatis berdasarkan kategori dan brand'),
                       
                        MarkdownEditor::make('description')
                            ->columnSpanFull()
                            ->fileAttachmentsDirectory('products'),
                    ])->columns(2),

                    Section::make('Product Details')->schema([
                        TextInput::make('color')
                            ->maxLength(255)
                            ->placeholder('Contoh: Merah, Biru, Hijau'),

                        TextInput::make('size')
                            ->maxLength(255)
                            ->placeholder('Contoh: S, M, L, XL'),

                        TextInput::make('material')
                            ->maxLength(255)
                            ->placeholder('Contoh: Katun, Sutra, Rayon'),

                        TextInput::make('pattern')
                            ->label('Pattern')
                            ->maxLength(255)
                            ->placeholder('Contoh: Parang, Mega Mendung, Kawung'),

                        TextInput::make('weight')
                            ->label('Weight (gram)')
                            ->numeric()
                            ->step(0.01)
                            ->placeholder('100'),

                        TextInput::make('warranty')
                            ->label('Warranty')
                            ->maxLength(255)
                            ->placeholder('Contoh: 1 Tahun, 6 Bulan'),
                    ])->columns(2),

                    Section::make('Images')->schema([
                        FileUpload::make('images')
                            ->multiple()
                            ->directory('products')
                            ->maxFiles(5)
                            ->reorderable()
                    ])
                ])->columnSpan(2),

                Group::make()->schema([
                    Section::make('Price')->schema([
                        TextInput::make('price')
                            ->required()
                            ->prefix('Rp')
                            ->numeric()
                    ]),
                   
                    Section::make('Associations')->schema([
                        Select::make('category_id')
                            ->relationship('category', 'name')
                            ->required()
                            ->searchable()
                            ->preload()
                            ->live()
                            ->afterStateUpdated(function($state, Set $set, $get) {
                                // Update SKU ketika kategori berubah
                                $brandId = $get('brand_id');
                                if ($state && $brandId) {
                                    $category = Category::find($state);
                                    $brand = Brand::find($brandId);
                                    
                                    if ($category && $brand) {
                                        $sku = Product::generateSKU($category->name, $brand->name);
                                        $set('sku', $sku);
                                    }
                                }
                            }),
                       
                        Select::make('brand_id')
                            ->relationship('brand', 'name')
                            ->required()
                            ->searchable()
                            ->preload()
                            ->live()
                            ->afterStateUpdated(function($state, Set $set, $get) {
                                // Update SKU ketika brand berubah
                                $categoryId = $get('category_id');
                                if ($state && $categoryId) {
                                    $category = Category::find($categoryId);
                                    $brand = Brand::find($state);
                                    
                                    if ($category && $brand) {
                                        $sku = Product::generateSKU($category->name, $brand->name);
                                        $set('sku', $sku);
                                    }
                                }
                            }),
                    ]),

                    Section::make('Status')->schema([
                        Toggle::make('in_stock')
                            ->required()
                            ->default(true),
                       
                        Toggle::make('is_active')
                            ->required()
                            ->default(true),

                        Toggle::make('is_new')
                            ->label('New Product')
                            ->required(),

                        Toggle::make('on_sale')
                            ->required(),
                            
                            
                    ])
                ])->columnSpan(1)
            ])->columns(3);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->searchable(),

                TextColumn::make('sku')
                    ->searchable()
                    ->copyable(),

                TextColumn::make('category.name')
                    ->sortable(),

                TextColumn::make('brand.name')
                    ->sortable(),

                TextColumn::make('price')
                    ->label('Harga')
                    ->sortable()
                    ->formatStateUsing(function ($state) {
                        return 'Rp ' . number_format($state, 0, ',', '.');
                    }),

                TextColumn::make('color')
                    ->toggleable(),

                TextColumn::make('size')
                    ->toggleable(),

                IconColumn::make('is_new')
                    ->boolean()
                    ->label('New'),

                IconColumn::make('on_sale')
                    ->boolean(),

                IconColumn::make('in_stock')
                    ->boolean(),

                IconColumn::make('is_active')
                    ->boolean(),
               
                TextColumn::make('created_at')
                    ->dateTime()
                    ->toggleable(isToggledHiddenByDefault:true)
                    ->sortable(),

                TextColumn::make('updated_at')
                    ->dateTime()
                    ->toggleable(isToggledHiddenByDefault:true)
                    ->sortable(),
            ])
            ->filters([
                SelectFilter::make('category')
                    ->relationship('category', 'name'),
                
                SelectFilter::make('brand')
                    ->relationship('brand', 'name'),
                    
                SelectFilter::make('is_new')
                    ->options([
                        1 => 'New Products',
                        0 => 'Regular Products',
                    ])
                    ->label('Product Type'),    


            ])
            ->actions([
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\ViewAction::make(),
                    Tables\Actions\EditAction::make(),
                    Tables\Actions\DeleteAction::make(),
                ]),
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
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/create'),
            'edit' => Pages\EditProduct::route('/{record}/edit'),
        ];
    }
}
