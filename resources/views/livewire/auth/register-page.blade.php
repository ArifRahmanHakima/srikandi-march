<div class="w-full max-w-[85rem] py-10 px-4 sm:px-6 lg:px-8 mx-auto">
  <div class="flex h-full items-center">
    <main class="w-full max-w-md mx-auto p-6">
      <div class="bg-white border border-gray-200 rounded-xl shadow-sm dark:bg-white-800 dark:border-gray-300">
        <div class="p-4 sm:p-7">
          <div class="text-center">
            <h1 class="block text-2xl font-bold text-gray-800 dark:text-grey">Daftar</h1>
              @if (session('success'))
                  <div class="mb-4 text-green-600">
                      {{ session('success') }}
                  </div>
              @endif
            <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">
              Sudah punya akun?
              <a class="text-blue-600 decoration-2 hover:underline font-medium dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600" href="/login">
                Login disini
              </a>
            </p>
          </div>
          <hr class="my-5 border-slate-300">

          <!-- Form -->
          <form wire:submit.prevent="save" x-data="{ showPassword: false }">
            <div class="grid gap-y-4">
              <!-- Nama -->
              <div>
                <label for="name" class="block text-sm mb-2 dark:text-grey">Nama</label>
                <div class="relative">
                  <input type="text" id="name" wire:model="name" class="py-3 px-4 block w-full border border-white-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none white:bg-slate-900 dark:border-gray-300 dark:text-gray-400 dark:focus:ring-gray-600" aria-describedby="name-error">
                  @error('name') 
                  <div class="absolute inset-y-0 end-0 flex items-center pointer-events-none pe-3">
                    <svg class="h-5 w-5 text-red-500" width="16" height="16" fill="currentColor" viewBox="0 0 16 16" aria-hidden="true">
                      <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8 4a.905.905 0 0 0-.9.995l.35 3.507a.552.552 0 0 0 1.1 0l.35-3.507A.905.905 0 0 0 8 4zm.002 6a1 1 0 1 0 0 2 1 1 0 0 0 0-2z" />
                    </svg>
                  </div> 
                  @enderror
                </div>
                @error('name')
                <p class="text-xs text-red-600 mt-2" id="name-error">Tolong Masukkan Nama Anda!!!</p>
                @enderror
              </div>

              <!-- Email -->
              <div>
                <label for="email" class="block text-sm mb-2 dark:text-grey">Alamat Email</label>
                <div class="relative">
                  <input type="email" id="email" wire:model="email" class="py-3 px-4 block w-full border border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none white:bg-slate-900 dark:border-gray-300 dark:text-gray-400 dark:focus:ring-gray-600" aria-describedby="email-error">
                  @error('email')
                  <div class="absolute inset-y-0 end-0 flex items-center pointer-events-none pe-3">
                    <svg class="h-5 w-5 text-red-500" width="16" height="16" fill="currentColor" viewBox="0 0 16 16" aria-hidden="true">
                      <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8 4a.905.905 0 0 0-.9.995l.35 3.507a.552.552 0 0 0 1.1 0l.35-3.507A.905.905 0 0 0 8 4zm.002 6a1 1 0 1 0 0 2 1 1 0 0 0 0-2z" />
                    </svg>
                  </div>
                  @enderror
                </div>
                @error('email')
                <p class="text-xs text-red-600 mt-2" id="email-error">Tolong Masukkan Email Anda!!!</p>
                @enderror
              </div>

              <!-- Password -->
              <div>
                <div class="flex justify-between items-center">
                  <label for="password" class="block text-sm mb-2 dark:text-grey">Password</label>
                </div>
                <div class="relative">
                  <input :type="showPassword ? 'text' : 'password'" id="password" wire:model="password" class="py-3 border px-4 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none white:bg-slate-900 dark:border-gray-300 dark:text-gray-400 dark:focus:ring-gray-600" aria-describedby="password-error">
                  
                  <!-- Button Show/Hide -->
                  <button type="button" @click="showPassword = !showPassword" class="absolute inset-y-0 end-0 flex items-center px-3 text-gray-600">
                    <template x-if="!showPassword">
                      <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-.171.54-.38 1.055-.624 1.541" />
                      </svg>
                    </template>
                    <template x-if="showPassword">
                      <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.477 0-8.268-2.943-9.542-7a9.973 9.973 0 012.07-3.327m3.536-2.07A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.542 7a9.973 9.973 0 01-1.272 2.465M3 3l18 18" />
                      </svg>
                    </template>
                  </button>
                  @error('password')
                  <div class="absolute inset-y-0 end-0 flex items-center pointer-events-none pe-3">
                    <svg class="h-5 w-5 text-red-500" width="16" height="16" fill="currentColor" viewBox="0 0 16 16" aria-hidden="true">
                      <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8 4a.905.905 0 0 0-.9.995l.35 3.507a.552.552 0 0 0 1.1 0l.35-3.507A.905.905 0 0 0 8 4zm.002 6a1 1 0 1 0 0 2 1 1 0 0 0 0-2z" />
                    </svg>
                  </div>
                  @enderror
                </div>
                @error('password')
                <p class="text-xs text-red-600 mt-2" id="password-error">Tolong Masukkan Password Anda!!!</p>
                @enderror
              </div>

              <!-- Submit Button -->
              <button type="submit" class="w-full py-3 px-4 inline-flex justify-center items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-1 transition-all">
                Daftar
              </button>
            </div>
          </form>
          <!-- End Form -->
        </div>
      </div>
    </main>
  </div>
</div>