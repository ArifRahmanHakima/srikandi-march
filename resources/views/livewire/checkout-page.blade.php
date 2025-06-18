<div class="w-full max-w-[85rem] py-10 px-4 sm:px-6 lg:px-8 mx-auto">
	<h1 class="text-2xl font-bold text-gray-800 grey:text-white mb-4">
		Checkout
	</h1>
	<form wire:submit.prevent="placeOrder">
		<div class="grid grid-cols-12 gap-4">
		<div class="md:col-span-12 lg:col-span-8 col-span-12">
			<!-- Card -->
			<div class="bg-white rounded-xl shadow p-4 sm:p-7 white:bg-slate-900">
				<!-- Shipping Address -->
				<div class="mb-6">
					<h2 class="text-xl font-bold underline text-gray-700 grey:text-white mb-2">
						Alamat Pengiriman
					</h2>
					<!-- <div class="grid grid-cols-2 gap-4"> -->
					<div class="mt-4">
						<div>
							<label class="block text-gray-700 grey:text-white mb-1" for="full_name">
								Nama Lengkap
							</label>
							<input wire:model="full_name" class="w-full rounded-lg border py-2 px-3 grey:bg-gray-700 grey:text-white grey:border-none border-gray-400 @error('full_name') border-red-500 @enderror" id="full_name" type="text">
							</input>
							@error('full_name')
							<div class="text-red-500 text-sm">{{ $message }}</div>
							@enderror
						</div>
					</div>
					<div class="mt-4">
						<label class="block text-gray-700 grey:text-white mb-1" for="phone">
						Nomor Telepon
						</label>
						<input wire:model="phone" class="w-full rounded-lg border py-2 px-3 grey:bg-gray-700 grey:text-white grey:border-none border-gray-400 @error('phone') border-red-500 @enderror" id="phone" type="text">
						</input>
						@error('phone')
						<div class="text-red-500 text-sm">{{ $message }}</div>
						@enderror
					</div>
					<div class="grid grid-cols-2 gap-4 mt-4">
						<div>
							<label class="block text-gray-700 grey:text-white mb-1" for="province">
								Provinsi
							</label>
							<input wire:model="province" class="w-full rounded-lg border py-2 px-3 grey:bg-gray-700 grey:text-white grey:border-none border-gray-400 @error('province') border-red-500 @enderror" id="province" type="text">
							</input>
							@error('province')
							<div class="text-red-500 text-sm">{{ $message }}</div>
							@enderror
						</div>
						<div>
							<label class="block text-gray-700 grey:text-white mb-1" for="city">
								Kabupaten/Kota
							</label>
							<input wire:model="city" class="w-full rounded-lg border py-2 px-3 grey:bg-gray-700 grey:text-white grey:border-none border-gray-400 @error('city') border-red-500 @enderror" id="city" type="text">
							</input>
							@error('city')
							<div class="text-red-500 text-sm">{{ $message }}</div>
							@enderror
						</div>
					</div>
					<div class="grid grid-cols-2 gap-4 mt-4">
						<div>
							<label class="block text-gray-700 grey:text-white mb-1" for="subdistrict">
								Kecamatan
							</label>
							<input wire:model="subdistrict" class="w-full rounded-lg border py-2 px-3 grey:bg-gray-700 grey:text-white grey:border-none border-gray-400 @error('subdistrict') border-red-500 @enderror" id="subdistrict" type="text">
							</input>
							@error('subdistrict')
							<div class="text-red-500 text-sm">{{ $message }}</div>
							@enderror
						</div>
						<div>
							<label class="block text-gray-700 grey:text-white mb-1" for="zip">
								Kode pos
							</label>
							<input wire:model="zip_code" class="w-full rounded-lg border py-2 px-3 grey:bg-gray-700 grey:text-white grey:border-none border-gray-400 @error('zip_code') border-red-500 @enderror" id="zip" type="text">
							</input>
							@error('zip_code')
							<div class="text-red-500 text-sm">{{ $message }}</div>
							@enderror
						</div>
					</div>
					<div class="mt-4">
						<label class="block text-gray-700 grey:text-white mb-1" for="address">
							Alamat Lengkap
						</label>
						<input wire:model="street_address" class="w-full rounded-lg border py-2 px-3 grey:bg-gray-700 grey:text-white grey:border-none border-gray-400 @error('street_address') border-red-500 @enderror" id="address" type="text">
						</input>
						@error('street_address')
							<div class="text-red-500 text-sm">{{ $message }}</div>
						@enderror
					</div>

				<div class="text-xl font-bold underline text-gray-700 grey:text-white mt-6 mb-2">
					Pilih Metode Pembayaran
				</div>

				<div class="grid grid-cols-2 gap-4 mb-4">
					<!-- E-Wallet -->
					<div>
						<p class="font-semibold text-gray-600 mb-2">E-Wallet</p>
						<div class="space-y-3">

						<!-- DANA -->
						<label class="payment-option flex items-center justify-between w-full p-4 border rounded-lg cursor-pointer hover:bg-gray-100" data-group="payment">
							<input type="radio" wire:model="payment_method" name="payment_method" value="dana" class="hidden" />
							<img src="https://upload.wikimedia.org/wikipedia/commons/thumb/7/72/Logo_dana_blue.svg/1280px-Logo_dana_blue.svg.png" alt="DANA" class="h-7">
							<span class="ml-2 font-semibold text-gray-700">DANA</span>
						</label>

						<!-- GOPAY -->
						<label class="payment-option flex items-center justify-between w-full p-4 border rounded-lg cursor-pointer hover:bg-gray-100" data-group="payment">
							<input type="radio" wire:model="payment_method" name="payment_method" value="gopay" class="hidden" />
							<img src="https://vectorez.biz.id/wp-content/uploads/2023/10/Logo-Gopay.png" alt="GoPay" class="h-6">
							<span class="ml-2 font-semibold text-gray-700">GOPAY</span>
						</label>
						</div>
					</div>

					<!-- Transfer Bank -->
					<div>
						<p class="font-semibold text-gray-600 mb-2">Transfer Bank</p>
						<div class="space-y-3">
							 <!-- BRI -->
						<label class="payment-option flex items-center justify-between w-full p-4 border rounded-lg cursor-pointer hover:bg-gray-100" data-group="payment">
							<input type="radio" wire:model="payment_method" name="payment_method" value="bri" class="hidden" />
							<img src="https://www.ir-bri.com/bbri_assets/vendor/img/bri-logo.png" alt="BRI" class="h-6">
							<span class="ml-2 font-semibold text-gray-700">BRI</span>
						</label>

							<!-- BNI -->
						<label class="payment-option flex items-center justify-between w-full p-4 border rounded-lg cursor-pointer hover:bg-gray-100" data-group="payment">
							<input type="radio" wire:model="payment_method" name="payment_method" value="bni" class="hidden" />
							<img src="https://jasalogocepat.com/wp-content/uploads/2023/12/Logo-Bank-BNI-PNG.png" alt="BNI" class="h-6">
							<span class="ml-2 font-semibold text-gray-700">BNI</span>
						</label>
					</div>
				</div>
			</div>
				@error('payment_method')
					<div class="text-red-500 text-sm">{{ $message }}</div>
				@enderror

				<!-- Metode Pengiriman -->
				<div class="text-xl font-bold underline text-gray-700 grey:text-white mt-6 mb-2">
					Pilih Metode Pengiriman
				</div>
					<div class="grid grid-cols-2 gap-4">
						<!-- J&T -->
						<label class="shipping-option flex items-center justify-between w-full p-4 border rounded-lg cursor-pointer hover:bg-gray-100" data-group="shipping">
							<input type="radio" wire:model="shipping_method" name="shipping_method" value="jnt" class="hidden" />
							<img src="https://upload.wikimedia.org/wikipedia/commons/thumb/0/01/J%26T_Express_logo.svg/2560px-J%26T_Express_logo.svg.png" alt="J&T" class="h-6">
							<span class="ml-2 font-semibold text-gray-700">J&T</span>
						</label>

						<!-- JNE -->
						<label class="shipping-option flex items-center justify-between w-full p-4 border rounded-lg cursor-pointer hover:bg-gray-100" data-group="shipping">
							<input type="radio" wire:model="shipping_method" name="shipping_method" value="jne" class="hidden" />
							<img src="https://upload.wikimedia.org/wikipedia/commons/9/92/New_Logo_JNE.png" alt="JNE" class="h-6">
							<span class="ml-2 font-semibold text-gray-700">JNE</span>
						</label>
					</div>
				</div>
				<style>
							.selected {
							border: 2px solid #2563eb; /* Tailwind blue-600 */
							background-color: #eff6ff; /* Tailwind blue-50 */
						}
						</style>
						<script>
							document.querySelectorAll('label[data-group]').forEach(label => {
								label.addEventListener('click', () => {
								const group = label.dataset.group;
								// Reset semua dalam grup yang sama
								document.querySelectorAll(`label[data-group="${group}"]`).forEach(el => el.classList.remove('selected'));
								label.classList.add('selected');
								});
							});
						</script>
			<!-- End Card -->
			</div>
		</div>
		<div class="md:col-span-12 lg:col-span-4 col-span-12">
			<div class="bg-white rounded-xl shadow p-4 sm:p-7 white:bg-slate-900">
				<div class="text-xl font-bold underline text-gray-700 grey:text-white mb-2">
					Rincian Pesanan
				</div>
				<ul class="divide-y divide-gray-200 grey:divide-gray-700" role="list">
					@foreach($cart_items as $ci)
					<li class="py-3 sm:py-4" wire:key="{{ $ci['product_id'] }}">
						<div class="flex items-center">
							<div class="flex-shrink-0">
								<img alt="{{ $ci['name'] }}" class="w-12 h-12 rounded-full object-cover object-top object-center" src="{{ url('storage/', $ci['image']) }}">
								</img>
							</div>
							<div class="flex-1 min-w-0 ms-4">
								<p class="text-sm font-medium text-gray-900 truncate grey:text-white">
									{{ $ci['name'] }}
								</p>
								<p class="text-sm text-gray-500 truncate grey:text-gray-400">
									Jumlah	: {{ $ci['quantity'] }}
								</p>
								@if(isset($ci['size']))
									<p class="text-sm text-gray-500 truncate grey:text-gray-400">
										Ukuran: {{ $ci['size'] }}
									</p>
								@endif
								@if(isset($ci['color']))
									<p class="text-sm text-gray-500 truncate grey:text-gray-400">
										Warna: {{ $ci['color'] }}
									</p>
								@endif
							</div>
							<div class="inline-flex items-center text-base font-semibold text-gray-900 grey:text-white">
								{{ 'Rp ' . number_format($ci['total_amount'], 0, ',', '.') }}
							</div>
						</div>
					</li>
					@endforeach
				</ul>
				<hr class="bg-slate-400 my-4 h-1 rounded">
				<div class="flex justify-between mb-2 font-bold">
					<span>
						Total
					</span>
					<span>
						{{ 'Rp ' . number_format($grand_total, 0, ',', '.') }}
					</span>
				</div>
				</hr>
			</div>
			<button type="submit" class="bg-gradient-to-r from-blue-600 to-blue-900 mt-4 w-full p-3 rounded-lg text-lg text-white hover:bg-gray-600">
				<span wire:loading.remove>Buat Pesanan</span>
				<span wire:loading>Sedang Diproses...</span>
			</button>		
			</div>
		</div>
	</div>
	</form>
</div>