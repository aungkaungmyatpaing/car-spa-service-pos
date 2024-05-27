<x-layout.main activeMenu="products">
    <div class="flex flex-row items-center justify-between px-10 mt-5">
        <form class="flex flex-row items-center justify-end gap-5">
            <div class="flex items-center gap-3">
                <label for="startDate" class="text-sm text-gray-500 font-normal">From:</label>
                <input type="date" id="startDate" name="startDate" class="w-40 p-2 border rounded-md text-sm" value="{{ request('startDate') }}">
            </div>
            <div class="flex items-center gap-3">
                <label for="endDate" class="text-sm text-gray-500 font-normal">To:</label>
                <input type="date" id="endDate" name="endDate" class="w-40 p-2 border rounded-md text-sm" value="{{ request('endDate') }}">
            </div>
            <button class="bg-blue-500 text-white px-5 py-2 rounded-md text-sm">Filter Sold</button>
        </form>

        <a href="{{route('products.create')}}" class="bg-blue-500 px-3 py-3 text-white rounded-md">
            Create Product
        </a>
    </div>

    <div class="flex flex-row items-center justify-between px-10 mt-5">
        <form class="flex flex-row items-center justify-start gap-5 w-full">
            <input type="text" placeholder="Search" name="q" id="q" class="p-2 h-12 border rounded-md text-sm w-60" value="{{ old('q',$q) }}">

            <select name="category_id" id="category_id" class="w-60 p-2 h-12 border rounded-md text-sm">
                <option value="">Select a category</option>
                @foreach($categories as $category)
                    <option value="{{$category->id}}">{{$category->category}}</option>
                @endforeach
            </select>

            <select name="brand_id" id="brand_id" class="p-2 w-60 h-12 border rounded-md text-sm">
                <option value="">Select a brand</option>
                @foreach($brands as $brand)
                    <option value="{{$brand->id}}">{{$brand->name}}</option>
                @endforeach
            </select>

            <button class="bg-blue-500 text-white px-5 py-2 rounded-md text-sm">Search</button>
        </form>
    </div>


    <div class="flex flex-col gap-3 md:px-10 px-0 mt-10 mb-20">
        <div class="w-full table-shadow rounded-none md:rounded-2xl overflow-hidden">
            <table class="w-full h-auto">
                <!-- Table header -->
                <thead class="bg-[#f8f9fa]">
                    <tr>
                        <th class="text-left font-semibold text-gray-500 px-7 py-4 lg:w-20 w-10">Image</th>
                        <th class="text-left font-semibold text-gray-500 px-7 py-4">Name</th>
                        <th class="text-left font-semibold text-gray-500 px-7 py-4 hidden lg:table-cell">
                            <div id="soldTitle" class="flex flex-row items-center justify-start gap-3 cursor-pointer">
                                <span>Sold</span>
                                @if (request('tableSortColumn') === 'sold')
                                    @if (request('tableSortDirection') === 'asc')
                                        <i class="fa-solid fa-arrow-up text-md text-gray-400"></i>
                                    @else
                                        <i class="fa-solid fa-arrow-down text-md text-gray-400"></i>
                                    @endif
                                @else
                                    <i class="fa-solid fa-arrows-up-down text-md text-gray-400"></i>
                                @endif
                            </div>
                        </th>
                        <th class="text-left font-semibold text-gray-500 px-7 py-4 hidden sm:table-cell">
                            <div id="stockTitle" class="flex flex-row items-center justify-start gap-3 cursor-pointer">
                                <span>Stock</span>
                                @if (request('tableSortColumn') === 'stock')
                                    @if (request('tableSortDirection') === 'asc')
                                        <i class="fa-solid fa-arrow-up text-md text-gray-400"></i>
                                    @else
                                        <i class="fa-solid fa-arrow-down text-md text-gray-400"></i>
                                    @endif
                                @else
                                    <i class="fa-solid fa-arrows-up-down text-md text-gray-400"></i>
                                @endif
                            </div>
                        </th>
                        <th class="text-left font-semibold text-gray-500 px-7 py-4">
                            <div id="priceTitle" class="flex flex-row items-center justify-start gap-3 cursor-pointer">
                                <span>Price</span>
                                @if (request('tableSortColumn') === 'price')
                                    @if (request('tableSortDirection') === 'asc')
                                        <i class="fa-solid fa-arrow-up text-md text-gray-400"></i>
                                    @else
                                        <i class="fa-solid fa-arrow-down text-md text-gray-400"></i>
                                    @endif
                                @else
                                    <i class="fa-solid fa-arrows-up-down text-md text-gray-400"></i>
                                @endif
                            </div>
                        </th>
                        <th class="text-left font-semibold text-gray-500 px-7 py-4 hidden xl:table-cell">Barcode</th>
                        <th class="text-center font-semibold text-gray-500 px-7 py-4 w-40">Action</th>
                    </tr>
                </thead>
                <!-- Table body -->
                <tbody class="text-sm">
                    @foreach ($products as $index => $product)
                        <tr class="{{ $index % 2 == 0 ? 'bg-white' : 'bg-[#f8f9fa]' }} border border-b-1 border-gray-200">
                            <td class="text-gray-700 px-7 py-3 lg:w-20 w-10">
                                <div class="lg:size-14 size-10 overflow-hidden rounded-lg">
                                    <img src="{{ $product->getFirstMediaUrl('product-image')}}" alt="" class="object-cover w-full h-full">
                                </div>
                            </td>
                            <td class="text-gray-700 px-7 py-3 flex flex-col">
                                <span class="text-md font-bold text-gray-600">{{ $product->name }}</span>
                                <span class="text-gray-400">
                                    {{ optional($product->category)->category }} |
                                    {{ optional($product->brand)->name }}

                                </span>
                            </td>
                            <td class="text-gray-700 px-7 py-3 hidden lg:table-cell">{{ $product->total_sale_count }}</td>
                            <td class="{{$product->stock < $product->stock_limit ? 'text-red-500 font-bold':'text-gray-700'}} px-7 py-3">
                                {{ $product->stock }}
                            </td>
                            <td class="text-green-500 font-bold px-7 py-3 hidden sm:table-cell">
                                <div class="flex flex-col">
                                    <span>{{ $product->price }} Ks</span>
                                </div>
                            </td>
                            <td class="text-gray-700 px-7 py-3 hidden xl:table-cell">
                                <div class="flex flex-col">
                                    <img class="w-24" src="data:image/png;base64,{{$product->barcode_base64}}" alt="">
                                    <span>{{ $product->barcode }}</span>
                                </div>
                            </td>
                            <td class="flex flex-row items-center justify-center px-7 py-3 w-40">
                                <a href="{{ route('barcode.print', $product->id) }}" target="_blank">
                                    <div class="px-3 py-2">
                                        <i class="fa-solid fa-print text-lg text-green-500"></i>
                                    </div>
                                </a>

                                <a href="{{ route('products.edit', $product->id) }}">
                                    <div class="px-3 py-2">
                                        <i class="fa-solid fa-pen-to-square text-lg text-blue-500"></i>
                                    </div>
                                </a>

                                <form action="{{ route('products.destroy', $product->id) }}" method="POST" class="inline">
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
            {{ $products->links() }}
        </div>
    </div>

    <script>
        const sortTable = (column) => {
            const urlParams = new URLSearchParams(window.location.search);
            const tableSortDirection = urlParams.get('tableSortDirection');

            urlParams.delete('tableSortColumn');
            urlParams.delete('tableSortDirection');

            urlParams.set('tableSortColumn', column);
            if (tableSortDirection === 'asc') {
                urlParams.set('tableSortDirection', 'desc');
            } else {
                urlParams.set('tableSortDirection', 'asc');
            }

            window.location.href = window.location.pathname + '?' + urlParams.toString();
        };

        const stockTitle = document.getElementById('stockTitle');
        const priceTitle = document.getElementById('priceTitle');
        const soldTitle = document.getElementById('soldTitle');

        soldTitle.addEventListener('click', () => {
            sortTable('sold');
        });

        stockTitle.addEventListener('click', () => {
            sortTable('stock');
        });

        priceTitle.addEventListener('click', () => {
            sortTable('price');
        });
    </script>

</x-layout.main>
