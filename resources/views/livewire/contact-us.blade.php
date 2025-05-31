{{-- contact-us Livewire Component --}}
<div class="bg-gray-100">
<div class="container mx-auto px-4 py-8">
    <div class="flex flex-col md:flex-row gap-8">
        <!-- Contact Information Section -->
        <div class="w-full md:w-1/2 bg-white p-6 rounded-lg shadow-sm">
            <div class="mb-8">
                <h2 class="text-2xl font-bold mb-6">Hubungi Kami</h2>
                
                <!-- Address Section -->
                <div class="flex items-start mb-4">
                    <div class="text-blue-600 mr-3">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                    </div>
                    <div>
                        <h3 class="font-semibold">Address</h3>
                        <p class="text-gray-700">Jl. Gandekan No.84, Pringgokusuman, Gedong Tengen, Kota Yogyakarta, Daerah Istimewa Yogyakarta 55272</p>
                    </div>
                </div>
                
                <!-- Phone Section -->
                <div class="flex items-start mb-4">
                    <div class="text-blue-600 mr-3">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                        </svg>
                    </div>
                    <div>
                        <h3 class="font-semibold">Phone</h3>
                        <p class="text-gray-700">125-711-811 | 125-668-886</p>
                    </div>
                </div>
                
                <!-- Support Section -->
                <div class="flex items-start mb-4">
                    <div class="text-blue-600 mr-3">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z" />
                        </svg>
                    </div>
                    <div>
                        <h3 class="font-semibold">Support</h3>
                        <p class="text-gray-700">Support.photography@gmail.com</p>
                    </div>
                </div>
            </div>

            <!-- Send Message Form -->
            <div>
                <h2 class="text-2xl font-bold mb-4">Kirim Pesan</h2>
                
                <!-- Success Message -->
                @if($successMessage)
                    <div class="mb-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded-lg" 
                         x-data="{ show: true }" 
                         x-show="show" 
                         x-transition
                         x-init="setTimeout(() => show = false, 5000)">
                        <div class="flex items-center">
                            <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                            </svg>
                            {{ $successMessage }}
                        </div>
                    </div>
                @endif

                <!-- Error Message -->
                @if($errorMessage)
                    <div class="mb-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded-lg">
                        <div class="flex items-center">
                            <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                            </svg>
                            {{ $errorMessage }}
                        </div>
                    </div>
                @endif

                <form wire:submit.prevent="sendMessage" class="bg-white">
                    <div class="mb-4">
                        <input type="text" 
                               wire:model.live="name" 
                               class="w-full border @error('name') border-red-500 @else border-blue-300 @enderror rounded p-3" 
                               placeholder="Nama">
                        @error('name')
                            <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                        @enderror
                    </div>
                    
                    <div class="mb-4">
                        <input type="email" 
                               wire:model.live="email" 
                               class="w-full border @error('email') border-red-500 @else border-blue-300 @enderror rounded p-3" 
                               placeholder="Email">
                        @error('email')
                            <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                        @enderror
                    </div>
                    
                    <div class="mb-4">
                        <textarea wire:model.live="message" 
                                  rows="4" 
                                  class="w-full border @error('message') border-red-500 @else border-blue-300 @enderror rounded p-3" 
                                  placeholder="Pesan"></textarea>
                        @error('message')
                            <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                        @enderror
                    </div>
                    
                    <button type="submit" 
                            wire:loading.attr="disabled"
                            class="bg-blue-600 hover:bg-blue-700 disabled:bg-blue-400 text-white py-2 px-4 rounded font-semibold transition-colors duration-200 flex items-center">
                        <span wire:loading.remove>Kirim Pesan</span>
                        <span wire:loading class="flex items-center">
                            <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                            </svg>
                            Mengirim...
                        </span>
                    </button>
                </form>
            </div>
        </div>

        <!-- Map Section -->
        <div class="w-full md:w-1/2">
            <div class="h-full bg-white p-6 rounded-lg shadow-sm">
                <!-- Embedded Google Maps iframe -->
                <iframe
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3953.144752493113!2d110.35976347628225!3d-7.790797974161504!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e7a59a1f8a3b7a9%3A0x1a7a3a1b1b1b1b1b!2sJl.%20Gandekan%20No.84,%20Pringgokusuman,%20Gedong%20Tengen,%20Kota%20Yogyakarta,%20Daerah%20Istimewa%20Yogyakarta%2055272!5e0!3m2!1sen!2sid!4v1714624357186&z=19&ll=-7.79080,110.35976"
                    class="w-full h-full min-h-[500px] rounded border-0"
                    style="border:0;"
                    allowfullscreen=""
                    loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade"
                    title="Lokasi Jl. Gandekan No.84">
                </iframe>
            </div>
        </div>
    </div>
</div>
</div>