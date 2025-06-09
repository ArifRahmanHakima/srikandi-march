<!-- Update the existing profile-page blade file to support LiveWire properly -->
<div class="w-full max-w-[85rem] py-10 px-4 sm:px-6 lg:px-8 mx-auto">
    <div class="mb-8">
        <h1 class="text-2xl font-semibold text-gray-700">My Profile</h1>
    </div>

    <section class="py-10 bg-white font-poppins rounded-lg p-4">
        <!-- Profile Summary Card -->
        <div class="bg-white rounded-lg shadow-sm border border-blue-500 p-6 mb-8">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-4">
                    <div class="h-40 w-40 rounded-full overflow-hidden">
                        @if($user->profile_photo_path)
                            <img src="{{ Storage::url($user->profile_photo_path) }}" alt="{{ $user->name }}" class="h-full w-full object-cover" wire:key="profile-photo-{{ rand() }}">
                        @else
                            <div class="h-full w-full bg-gray-300 flex items-center justify-center text-gray-500">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                            </div>
                        @endif
                    </div>
                    <div>
                        <h2 class="text-xl font-medium text-gray-800">{{ $user->name }}</h2>
                        <p class="text-gray-500">{{ $user->bio }}</p>
                        <p class="text-gray-500">{{ $citysubdistrict }}, {{ $province }}</p>
                    </div>
                </div>
                <button type="button" class="px-6 py-2 text-sm font-medium text-white bg-blue-600 rounded-md hover:bg-blue-700 transition flex items-center" wire:click="$refresh">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                    </svg>
                    Refresh
                </button>
            </div>
        </div>

        <!-- Personal Information Section -->
        <div class="bg-white rounded-lg shadow-sm border border-blue-500 p-6 mb-8">
            <div class="flex items-center justify-between mb-6">
                <h3 class="text-lg font-medium text-gray-800">Informasi Pribadi</h3>
                <button class="px-6 py-2 text-sm font-medium text-white bg-blue-600 rounded-md hover:bg-blue-700 transition flex items-center" onclick="togglePersonalInfoForm()">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                    </svg>
                    Edit
                </button>
            </div>

            <!-- Personal Info Display -->
            <div id="personalInfoDisplay">
                <div class="grid grid-cols-2 gap-6">
                    <div>
                        <p class="text-sm text-gray-500 mb-1">Nama</p>
                        <p class="text-gray-700">{{ $name }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500 mb-1">Alamat Email</p>
                        <p class="text-gray-700">{{ $email }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500 mb-1">Nomor HP</p>
                        <p class="text-gray-700">{{ $phone }}</p>
                    </div>
                    <div class="col-span-2">
                        <p class="text-sm text-gray-500 mb-1">Bio</p>
                        <p class="text-gray-700">{{ $bio }}</p>
                    </div>
                </div>
            </div>

            <!-- Personal Info Edit Form -->
            <div id="personalInfoForm" class="hidden">
                <form wire:submit.prevent="updatePersonalInfo">
                    <div class="grid grid-cols-2 gap-6">
                        <div>
                            <label for="name" class="block text-sm text-gray-500 mb-1">Nama</label>
                            <input type="text" id="name" wire:model="name" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-blue-500">
                            @error('name') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label for="email" class="block text-sm text-gray-500 mb-1">Alamat Email</label>
                            <input type="email" id="email" wire:model="email" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-blue-500">
                            @error('email') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label for="phone" class="block text-sm text-gray-500 mb-1">Nomor HP</label>
                            <input type="text" id="phone" wire:model="phone" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-blue-500">
                            @error('phone') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label for="newProfilePhoto" class="block text-sm text-gray-500 mb-1">Foto Profil</label>
                            <input type="file" id="newProfilePhoto" wire:model="newProfilePhoto" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-blue-500">
                            @error('newProfilePhoto') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                            <div wire:loading wire:target="newProfilePhoto" class="text-xs text-blue-500 mt-1">Uploading...</div>
                            @if ($newProfilePhoto)
                                <div class="mt-2">
                                    <img src="{{ $newProfilePhoto->temporaryUrl() }}" class="h-16 w-16 object-cover rounded-full">
                                </div>
                            @endif
                        </div>
                        <div class="col-span-2">
                            <label for="bio" class="block text-sm text-gray-500 mb-1">Bio</label>
                            <textarea id="bio" wire:model="bio" rows="3" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-blue-500"></textarea>
                            @error('bio') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>
                    </div>
                    <div class="mt-4 flex justify-end">
                        <button type="button" onclick="togglePersonalInfoForm()" class="px-4 py-2 mr-2 border border-gray-300 rounded-md text-gray-700 hover:bg-gray-50">Batal</button>
                        <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600">Simpan</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Address Section -->
        <div class="bg-white rounded-lg shadow-sm border border-blue-500 p-6">
            <div class="flex items-center justify-between mb-6">
                <h3 class="text-lg font-medium text-gray-800">Alamat Pribadi</h3>
                <button class="px-6 py-2 text-sm font-medium text-white bg-blue-600 rounded-md hover:bg-blue-700 transition flex items-center" onclick="toggleAddressForm()">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                    </svg>
                    Edit
                </button>
            </div>

            <!-- Address Display -->
            <div id="addressDisplay">
                <div class="grid grid-cols-2 gap-6">
                    <div>
                        <p class="text-sm text-gray-500 mb-1">Provinsi</p>
                        <p class="text-gray-700">{{ $province }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500 mb-1">Kabupaten/Kota</p>
                        <p class="text-gray-700">{{ $city }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500 mb-1">Kecamatan</p>
                        <p class="text-gray-700">{{ $subdistrict }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500 mb-1">Kode Pos</p>
                        <p class="text-gray-700">{{ $postal_code }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500 mb-1">Alamat</p>
                        <p class="text-gray-700">{{ $street_address }}</p>
                    </div>
                </div>
            </div>

            <!-- Address Edit Form -->
            <div id="addressForm" class="hidden">
                <form wire:submit.prevent="updateAddress">
                    <div class="grid grid-cols-2 gap-6">
                        <div>
                            <label for="province" class="block text-sm text-gray-500 mb-1">Provinsi</label>
                            <input type="text" id="province" wire:model="province" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-blue-500">
                            @error('province') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>
                        <div class="grid grid-cols-2 gap-2">
                            <div>
                                <label for="city" class="block text-sm text-gray-500 mb-1">Kabupaten/Kota</label>
                                <input type="text" id="city" wire:model="city" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-blue-500">
                                @error('city') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                            </div>
                            <div>
                                <label for="subdistrict" class="block text-sm text-gray-500 mb-1">Kecamatan</label>
                                <input type="text" id="subdistrict" wire:model="subdistrict" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-blue-500">
                                @error('subdistrict') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div>
                            <label for="postal_code" class="block text-sm text-gray-500 mb-1">Postal Code</label>
                            <input type="text" id="postal_code" wire:model="postal_code" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-blue-500">
                            @error('postal_code') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label for="street_address" class="block text-sm text-gray-500 mb-1">Alamat</label>
                            <input type="text" id="street_address" wire:model="street_address" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-blue-500">
                            @error('street_address') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>
                    </div>
                    <div class="mt-4 flex justify-end">
                        <button type="button" onclick="toggleAddressForm()" class="px-4 py-2 mr-2 border border-gray-300 rounded-md text-gray-700 hover:bg-gray-50">Cancel</button>
                        <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>

        @if (session()->has('message'))
            <div class="mt-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                <span class="block sm:inline">{{ session('message') }}</span>
                <span class="absolute top-0 bottom-0 right-0 px-4 py-3" onclick="this.parentElement.style.display='none'">
                    <svg class="fill-current h-6 w-6 text-green-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                        <title>Close</title>
                        <path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z" />
                    </svg>
                </span>
            </div>
        @endif

    </section>
</div>

<script>
    function togglePersonalInfoForm() {
        document.getElementById('personalInfoDisplay').classList.toggle('hidden');
        document.getElementById('personalInfoForm').classList.toggle('hidden');
    }

    function toggleAddressForm() {
        document.getElementById('addressDisplay').classList.toggle('hidden');
        document.getElementById('addressForm').classList.toggle('hidden');
    }
</script>