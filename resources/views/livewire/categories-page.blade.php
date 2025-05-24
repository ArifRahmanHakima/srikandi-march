<div class="w-full max-w-[85rem] py-10 px-4 sm:px-6 lg:px-8 mx-auto">
  <div class="max-w-[85rem] px-4 py-10 sm:px-6 lg:px-8 lg:py-14 mx-auto">
    <div class="grid sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-4 sm:gap-6">

      @foreach ($categories as $category)
      <div class="relative group bg-gray-200 h-[400px] shadow-lg rounded-2xl overflow-hidden" href="/products?selected_categories[0]={{$category->id}}" wire:key="{{ $category->id }}">
        <img class="w-full h-full group-hover:h-64 object-cover rounded-2xl transition-all delay-150 duration-300 ease" src="{{url('storage', $category->image) }}" alt="{{ $category->name }}" />
        <div class="bg-gray-100 w-full h-40 absolute left-0 bottom-0 -mb-44 group-hover:mb-0 rounded-b-2xl transition-all delay-150 duration-300 ease dark:bg-gray-400">
          <div class="p-6">
            <div class="capitalize flex items-center justify-between gap-4">
              <div>
                <h2 class="text-white text-lg font-bold">{{ $category->name }}</h2>
              </div>
            </div>
            <div class="block mt-4">
              <a href="/products?selected_categories[0]={{$category->id}}" class="group mt-auto flex w-48 items-center justify-between rounded-lg bg-gradient-to-r from-blue-600 to-blue-900 px-6 py-3 text-white shadow-md transition-all duration-300 hover:from-blue-700 hover:to-blue-900 hover:shadow-lg">
                  <span class="font-medium">Lihat Koleksi</span>
                  <svg class="h-5 w-5 transition-transform duration-300 group-hover:translate-x-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                  </svg>
              </a>
            </div>
          </div>
        </div>
      </div>
      @endforeach

    </div>
  </div>
</div>
