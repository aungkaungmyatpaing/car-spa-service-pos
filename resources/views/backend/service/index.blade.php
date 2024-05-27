<x-layout.main activeMenu="services">
    <div class="flex flex-row items-center justify-between px-10 mt-5">
        <a href="{{route('services.create')}}" class="bg-blue-500 px-3 py-3 text-white rounded-md">
            Create Product
        </a>
    </div>

    <div class="flex flex-row items-center justify-between px-10 mt-5">
        <form class=" flex flex-row items-center justify-start gap-5 w-full">

            {{-- <select name="category_id" id="category_id" class="w-60 p-2 h-12 border rounded-md text-sm">
                <option value="">Select a category</option>
                @foreach($categories as $category)
                    <option value="{{$category->id}}">{{$category->category}}</option>
                @endforeach
            </select>

            <select name="sub_category_id" id="sub_category_id" class="p-2 w-60 h-12 border rounded-md text-sm">
                <option value="">Select a sub category</option>
                @foreach($subCategories as $subCategory)
                    <option value="{{$subCategory->id}}">{{$subCategory->name}}</option>
                @endforeach
            </select> --}}

            <select name="category_id" id="category_id" class="w-60 p-2 h-12 border rounded-md text-sm" onchange="showSubCategories()">
                <option value="">Select a category</option>
                @foreach($categories as $category)
                    <option value="{{$category->id}}">{{$category->category}}</option>
                @endforeach
            </select>

            <select name="sub_category_id" id="sub_category_id" class="p-2 w-60 h-12 border rounded-md text-sm" style="display: none;">
                <option value="">Select a sub category</option>
                @foreach($subCategories as $subCategory)
                    <option value="{{$subCategory->id}}">{{$subCategory->name}}</option>
                @endforeach
            </select>

            <button class="bg-blue-500 text-white px-5 py-2 rounded-md text-sm">Search</button>
        </form>
    </div>


    <div class="max-sm:w-screen flex flex-col gap-3 md:px-10 px-0 mt-10 mb-20">
        <div class="w-full table-shadow rounded-none md:rounded-2xl overflow-hidden max-sm:overflow-scroll">
            <table class="w-full h-auto">
                <!-- Table header -->
                <thead class="bg-[#f8f9fa]">
                    <tr>
                        <th class="text-left font-semibold text-gray-500 px-7 py-4 lg:w-20 w-10">No</th>
                        <th class="text-left font-semibold text-gray-500 px-7 py-4">Name</th>
                        <th class="text-left font-semibold text-gray-500 px-7 py-4">Size</th>
                        <th class="text-left font-semibold text-gray-500 px-7 py-4">Duration</th>
                        <th class="text-left font-semibold text-gray-500 px-7 py-4">Price</th>
                        <th class="text-left font-semibold text-gray-500 px-7 py-4">Barcode</th>
                        <th class="text-center font-semibold text-gray-500 px-7 py-4 w-40">Action</th>
                    </tr>
                </thead>
                <!-- Table body -->
                <tbody class="text-sm">
                    @foreach ($services as $index => $service)
                        <tr class="{{ $index % 2 == 0 ? 'bg-white' : 'bg-[#f8f9fa]' }} border border-b-1 border-gray-200">
                            <td class="text-gray-700 px-7 py-3 lg:w-20 w-10">
                                {{$index + 1}}
                            </td>
                            <td class="text-gray-700 px-7 py-3 flex flex-col">
                                <span class="text-md font-bold text-gray-600">{{ $service->name }}</span>
                                <span class="text-gray-400">
                                    {{ optional($service->category)->category }}
                                    @if($service->subCategory) <!-- Check if subcategory exists -->
                                        | {{ $service->subCategory->name }} <!-- If subcategory exists, show the pipe and subcategory name -->
                                    @endif

                                </span>
                            </td>

                            <td class="text-green-500 font-bold px-7 py-3">
                                <div class="flex flex-col">
                                    <span>{{ $service->size->name }}</span>
                                </div>
                            </td>
                            <td class="text-green-500 font-bold px-7 py-3">
                                <div class="flex flex-col">
                                    <span>{{ $service->duration->name }} </span>
                                </div>
                            </td>
                            <td class="text-green-500 font-bold px-7 py-3 ">
                                <div class="flex flex-col">
                                    <span>{{ $service->price }} Ks</span>
                                </div>
                            </td>
                            <td class="text-gray-700 px-7 py-3">
                                <div class="flex flex-col">
                                    <img class="w-24" src="data:image/png;base64,{{$service->barcode_base64}}" alt="">
                                    <span>{{ $service->barcode }}</span>
                                </div>
                            </td>
                            <td class="flex flex-row items-center justify-center px-7 py-3 w-40">
                                <a href="{{ route('service.barcode.print', $service->id) }}" target="_blank">
                                    <div class="px-3 py-2">
                                        <i class="fa-solid fa-print text-lg text-green-500"></i>
                                    </div>
                                </a>

                                <a href="{{ route('services.edit', $service->id) }}">
                                    <div class="px-3 py-2">
                                        <i class="fa-solid fa-pen-to-square text-lg text-blue-500"></i>
                                    </div>
                                </a>

                                <form action="{{ route('services.destroy', $service->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class=" px-3 py-2 ">
                                        <i class="fa-solid fa-trash text-red-500 text-lg"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="mt-5">
            {{ $services->links() }}
        </div>
    </div>

    <script>
        function showSubCategories() {
            var categoryId = document.getElementById("category_id").value;
            var subCategorySelect = document.getElementById("sub_category_id");

            // Hide the sub-category select by default
            subCategorySelect.style.display = "none";

            // If a category is selected and it has sub-categories, show the sub-category select
            if (categoryId !== "" && checkSubCategories(categoryId)) {
                subCategorySelect.style.display = "block";
            }
        }

        function checkSubCategories(categoryId) {
            // Assuming $subCategories is a JavaScript array of objects containing category IDs
            // Check if the selected category has any associated sub-categories
            return <?php echo json_encode($subCategories->pluck('category_id')->toArray()); ?>.includes(parseInt(categoryId));
        }
    </script>
</x-layout.main>
