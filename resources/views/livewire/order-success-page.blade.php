
    <div class="flex-grow flex flex-col items-center justify-center px-4 py-16 text-center">
        <div class="bg-white shadow-lg rounded-xl p-10 max-w-md w-full transition-all duration-300 hover:shadow-xl">
            <!-- Animated Checkmark -->
            <div class="flex justify-center mb-6">
                <div class="relative">
                    <!-- Circle background with pulse animation -->
                    <div class="absolute inset-0 bg-green-100 rounded-full animate-ping opacity-75"></div>
                    <!-- Main circle -->
                    <div class="relative bg-green-100 p-4 rounded-full animate-checkmark">
                        <!-- Checkmark with draw animation -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path 
                                stroke-linecap="round" 
                                stroke-linejoin="round" 
                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"
                                class="animate-draw"
                            />
                        </svg>
                    </div>
                </div>
            </div>
            
            <!-- Success Message -->
            <h2 class="text-2xl font-bold text-gray-800 mb-2 animate-fade-in">Pembayaran Berhasil!</h2>
            <p class="text-gray-600 mb-6 animate-fade-in" style="animation-delay: 0.2s;">
                Terima kasih telah melakukan pemesanan di <span class="font-semibold text-blue-600">Srikandi Merch</span>. 
                <span class="block mt-1">Pesananmu sedang diproses.</span>
            </p>
            
            <!-- Buttons -->
            <div class="flex flex-col gap-3 animate-fade-in" style="animation-delay: 0.4s;">
                <a href="/my-orders" class="inline-flex items-center justify-center px-4 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition transform hover:-translate-y-0.5 hover:shadow-md">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                    </svg>
                    Lihat Status Pesanan Saya
                </a>
                <a href="/products" class="inline-flex items-center justify-center px-4 py-3 border border-blue-600 text-blue-600 rounded-lg hover:bg-blue-50 transition transform hover:-translate-y-0.5 hover:shadow-md">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                    </svg>
                    Belanja Lagi
                </a>
            </div>
        </div>
    </div>

@push('styles')
<style>
    @keyframes draw {
        to {
            stroke-dashoffset: 0;
        }
    }
    
    @keyframes fade-in {
        from {
            opacity: 0;
            transform: translateY(10px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    .animate-draw {
        stroke-dasharray: 100;
        stroke-dashoffset: 100;
        animation: draw 1s ease-out forwards;
        animation-delay: 0.3s;
    }
    
    .animate-fade-in {
        animation: fade-in 0.6s ease-out forwards;
        opacity: 0;
    }
    
    .animate-checkmark {
        animation: bounce 0.5s ease;
    }
    
    @keyframes bounce {
        0%, 100% {
            transform: scale(1);
        }
        50% {
            transform: scale(1.1);
        }
    }
</style>
@endpush