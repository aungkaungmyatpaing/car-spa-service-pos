<x-layout.main activeMenu="services">

    <div class="flex flex-row items-center justify-between px-10 mt-5">
        <a href="{{route('services.index')}}" class="bg-gray-200 hover:bg-gray-300 px-5 py-3 text-gray-700 rounded-md">
            Cancel
        </a>
    </div>

    <div class="container mx-auto px-10 mt-5">
        <div class="flex justify-center bg-white w-full rounded-md py-10 px-10 mb-20">
            <div class="w-full">
                <h1 class="text-2xl text-gray-500 font-bold mb-4">Edit Service</h1>
                <form action="{{ route('services.update', $service->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="flex flex-row gap-6">
                        <div class="w-1/2">

                            {{-- Name --}}
                            <div class="mb-5">
                                <label for="name" class="block mb-2 text-sm">Service Name</label>
                                <input type="text" placeholder="service name" name="name" id="name" class="w-full p-2 h-12 border rounded-md text-sm" value="{{ $service->name }}">
                                @error('name')
                                    <p class="text-red-500">{{ $message }}</p>
                                @enderror
                            </div>

                            {{-- Price --}}
                            <div class="mb-5">
                                <label for="price" class="block mb-2 text-sm">Price</label>
                                <input type="number" placeholder="price" name="price" id="price" class="w-full p-2 h-12 border rounded-md text-sm" value="{{ $service->price }}">
                                @error('price')
                                    <p class="text-red-500">{{ $message }}</p>
                                @enderror
                            </div>

                            {{-- Note --}}
                            <div class="mb-5">
                                <label for="note" class="block mb-2 text-sm">Note</label>
                                <input type="text" placeholder="note" name="note" id="note" class="w-full p-2 h-12 border rounded-md text-sm" value="{{ $service->note }}">
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
                                    Update
                                </button>
                            </div>
                        </div>
                        <div class="w-1/2">

                            {{-- Size --}}
                            <div class="mb-5">
                                <label for="size_id" class="block mb-2 text-sm">Size</label>
                                <select name="size_id" id="size_id" class="w-full p-2 h-12 border rounded-md text-sm">
                                    <option value="">Select a size</option>
                                    @foreach($sizes as $size)
                                        <option value="{{$size->id}}" {{ $service->size_id == $size->id ? 'selected' : '' }}>{{$size->name}}</option>
                                    @endforeach
                                </select>
                                @error('size_id')
                                    <p class="text-red-500">{{ $message }}</p>
                                @enderror
                            </div>

                            {{-- Duration --}}
                            <div class="mb-5">
                                <label for="duration_id" class="block mb-2 text-sm">Duration</label>
                                <select name="duration_id" id="duration_id" class="w-full p-2 h-12 border rounded-md text-sm">
                                    <option value="">Select a duration</option>
                                    @foreach($durations as $duration)
                                        <option value="{{$duration->id}}" {{ $service->duration_id == $duration->id ? 'selected' : '' }}>{{$duration->name}}</option>
                                    @endforeach
                                </select>
                                @error('duration_id')
                                    <p class="text-red-500">{{ $message }}</p>
                                @enderror
                            </div>

                            {{-- Category --}}
                            <div class="mb-5">
                                <label for="category_id" class="block mb-2 text-sm">Category</label>
                                <select name="category_id" id="category_id" class="w-full p-2 h-12 border rounded-md text-sm">
                                    <option value="">Select a category</option>
                                    @foreach($categories as $category)
                                        <option value="{{$category->id}}" data-subcategories="{{ json_encode($category->subCategories) }}" {{ $service->category_id == $category->id ? 'selected' : '' }}>{{$category->category}}</option>
                                    @endforeach
                                </select>
                                @error('category_id')
                                    <p class="text-red-500">{{ $message }}</p>
                                @enderror
                            </div>

                       {{-- Sub-Category --}}
                        <div class="mb-5" id="sub_category_container" style="{{ $service->category->subCategories->isNotEmpty() ? 'display:block' : 'display:none' }}">
                            <label for="sub_category_id" class="block mb-2 text-sm">Sub-Category</label>
                            <select name="sub_category_id" id="sub_category_id" class="w-full p-2 h-12 border rounded-md text-sm">
                                {{-- Loop through sub-categories and select the appropriate one --}}
                                @foreach($service->category->subCategories as $subCategory)
                                    <option value="{{ $subCategory->id }}" {{ $service->sub_category_id == $subCategory->id ? 'selected' : '' }}>{{ $subCategory->name }}</option>
                                @endforeach
                            </select>
                            @error('sub_category_id')
                                <p class="text-red-500">{{ $message }}</p>
                            @enderror
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
            var subCategoryId = "{{ $service->sub_category_id }}";
            var CategoryId = "{{ $service->category_id }}";

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
                            var option = $('<option>', {
                                value: subCategory.id,
                                text: subCategory.name
                            });

                            // Check if the current subCategory matches the selected subCategoryId and CategoryId
                            if (subCategory.id == subCategoryId && subCategory.category_id == CategoryId) {
                                option.prop('selected', true); // Set the 'selected' attribute
                            }

                            subCategorySelect.append(option);
                        });
                    } else {
                        subCategoryContainer.hide();
                    }
                } else {
                    subCategoryContainer.hide();
                }
            });

            // Trigger change event to populate sub-category select when page loads
            $('#category_id').trigger('change');
        });
    </script>

</x-layout.main>
