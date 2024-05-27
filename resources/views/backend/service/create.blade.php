<x-layout.main activeMenu="services">

    <div class="flex flex-row items-center justify-between px-10 mt-5">
        <a href="{{route('services.index')}}" class="bg-gray-200 hover:bg-gray-300 px-5 py-3 text-gray-700 rounded-md">
            Cancel
        </a>
    </div>

    <div class="container mx-auto px-10 mt-5">
        <div class="flex justify-center bg-white w-full rounded-md py-10 px-10 mb-20">
            <div class="w-full">
                <h1 class="text-2xl text-gray-500 font-bold mb-4">Create Service</h1>
                <form action="{{ route('services.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="flex flex-row gap-6">
                        <div class="w-1/2">

                            {{-- Name --}}
                            <div class="mb-5">
                                <label for="name" class="block mb-2 text-sm">Service Name</label>
                                <input type="text" placeholder="service name" name="name" id="name" class="w-full p-2 h-12 border rounded-md text-sm" value="{{ old('name') }}">
                                @error('name')
                                    <p class="text-red-500">{{ $message }}</p>
                                @enderror
                            </div>

                            {{-- Price --}}
                            <div class="mb-5">
                                <label for="price" class="block mb-2 text-sm">Price</label>
                                <input type="number" placeholder="price" name="price" id="price" class="w-full p-2 h-12 border rounded-md text-sm" value="{{ old('price') }}">
                                @error('price')
                                    <p class="text-red-500">{{ $message }}</p>
                                @enderror
                            </div>

                            {{-- Note --}}
                            <div class="mb-5">
                                <label for="note" class="block mb-2 text-sm">Note</label>
                                <input type="text" placeholder="note" name="note" id="note" class="w-full p-2 h-12 border rounded-md text-sm" value="{{ old('note') }}">
                                @error('note')
                                    <p class="text-red-500">{{ $message }}</p>
                                @enderror
                            </div>


                            <div class="flex flex-row items-center gap-3">
                                <a href="{{route('services.index')}}" class="w-1/3">
                                    <div class="bg-gray-200 text-gray-700 rounded-md h-12 flex items-center justify-center hover:bg-gray-300">
                                        <span class="mx-5">Back</span>
                                    </div>
                                </a>
                                <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white h-12 w-2/3 rounded-md">
                                    Create
                                </button>
                            </div>
                        </div>
                        <div class="w-1/2">

                            {{-- Size --}}
                            <div class="mb-5">
                                <label for="size_id" class="block mb-2 text-sm">Size</label>
                                <select name="size_id" id="size_id" class="w-full p-2 h-12 border rounded-md text-sm" >
                                    <option value="">Select a size</option>
                                    @foreach($sizes as $size)
                                        <option value="{{$size->id}}">{{$size->name}}</option>
                                    @endforeach
                                </select>
                                @error('size_id')
                                    <p class="text-red-500">{{ $message }}</p>
                                @enderror
                            </div>

                            {{-- Duration --}}
                            <div class="mb-5">
                                <label for="duration_id" class="block mb-2 text-sm">Duration</label>
                                <select name="duration_id" id="duration_id" class="w-full p-2 h-12 border rounded-md text-sm" >
                                    <option value="">Select a duration</option>
                                    @foreach($durations as $duration)
                                        <option value="{{$duration->id}}">{{$duration->name}}</option>
                                    @endforeach
                                </select>
                                @error('duration_id')
                                    <p class="text-red-500">{{ $message }}</p>
                                @enderror
                            </div>

                            {{-- Category --}}
                            <div class="mb-5">
                                <label for="category_id" class="block mb-2 text-sm">Category</label>
                                <select name="category_id" id="category_id" class="w-full p-2 h-12 border rounded-md text-sm" >
                                    <option value="">Select a category</option>
                                    @foreach($categories as $category)
                                        <option value="{{$category->id}}" data-subcategories="{{ json_encode($category->subCategories) }}">{{$category->category}}</option>
                                    @endforeach
                                </select>
                                @error('category_id')
                                    <p class="text-red-500">{{ $message }}</p>
                                @enderror
                            </div>

                            {{-- Sub-Category --}}
                            <div class="mb-5" id="sub_category_container" style="display: none;">
                                <label for="sub_category_id" class="block mb-2 text-sm">Sub-Category</label>
                                <select name="sub_category_id" id="sub_category_id" class="w-full p-2 h-12 border rounded-md text-sm">
                                    <option value="">Select a sub-category</option>
                                </select>
                            </div>


                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#category_id').change(function() {
                var selectedCategory = $(this).find('option:selected');
                var subCategoryContainer = $('#sub_category_container');
                var subCategorySelect = $('#sub_category_id');

                // Clear existing sub-categories
                subCategorySelect.empty().append('<option value="">Select a sub-category</option>');

                // Show/hide sub-category select based on selection
                if (selectedCategory.data('subcategories')) {
                    var subCategories = selectedCategory.data('subcategories');

                    console.log(subCategories);
                    if (subCategories.length > 0) {
                        subCategoryContainer.show();

                        // Populate sub-category select
                        $.each(subCategories, function(index, subCategory) {
                            subCategorySelect.append($('<option>', {
                                value: subCategory.id,
                                text: subCategory.name
                            }));
                        });
                    } else {
                        subCategoryContainer.hide();
                    }
                } else {
                    subCategoryContainer.hide();
                }
            });
        });
    </script>


</x-layout.main>
