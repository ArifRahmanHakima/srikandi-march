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
                <form method="POST" action="#" class="bg-white">
                    @csrf
                    <div class="mb-4">
                        <input type="text" name="name" class="w-full border border-blue-300 rounded p-3" placeholder="Nama">
                    </div>
                    <div class="mb-4">
                        <input type="email" name="email" class="w-full border border-blue-300 rounded p-3" placeholder="Email">
                    </div>
                    <div class="mb-4">
                        <input type="text" name="website" class="w-full border border-blue-300 rounded p-3" placeholder="Website">
                    </div>
                    <div class="mb-4">
                        <textarea name="message" rows="4" class="w-full border border-blue-300 rounded p-3" placeholder="Pesan"></textarea>
                    </div>
                    <button type="submit" class="bg-blue-600 text-white py-2 px-4 rounded sentencecase font-semibold">Kirim Pesan</button>
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