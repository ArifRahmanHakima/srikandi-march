<div class="w-full max-w-[85rem] py-10 px-4 sm:px-6 lg:px-8 mx-auto">
  <div class="max-w-[85rem] px-4 py-10 sm:px-6 lg:px-8 lg:py-14 mx-auto">
    <div class="grid sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-4 sm:gap-6">

      @foreach ($categories as $category)
      <a class="group flex flex-col bg-white border border-gray-300 shadow-sm rounded-xl hover:shadow-md transition" href="/products?selected_categories[0]={{$category->id}}" wire:key="{{ $category->id }}">
        <div class="p-4 md:p-5">
          <div class="flex justify-between items-center">
            <div class="flex items-center">
              <img class="h-[5rem] w-[5rem]" src="{{url('storage', $category->image) }}" alt="{{ $category->name }}" />
              <div class="ms-3">
                <h3 class="text-2xl font-semibold text-gray-800">
                  {{ $category->name }}
                </h3>

              </div>
            </div>
            <div class="ps-3">
              <button class="px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-md hover:bg-blue-700 transition">
                Lihat Detail
              </button>
            </div>
          </div>
        </div>
      </a>
      @endforeach

    </div>
  </div>
</div>
