<x-layout.main activeMenu='dashboard'>

    <div class="lg:px-10 max-sm:px-2 py-10 flex flex-col gap-5 max-sm:w-screen">

        @if($has_stock_alert)
            <div class="w-full bg-red-100 flex flex-row items-center justify-between py-3 px-5">
                <div class="flex flex-row items-center gap-3">
                    <i class="fa-solid fa-exclamation-triangle text-red-600 text-xl"></i>
                    <h3 class="text-md text-red-600">Products are almost out of stock</h3>
                </div>
                <a href="/products?tableSortColumn=stock&tableSortDirection=asc" class="bg-red-400 px-3 py-2 text-sm text-white rounded-md">
                    View Products
                </a>
            </div>
        @endif


        <div class="flex flex-row items-center justify-start gap-3">
            <i class="fa-solid fa-chart-simple text-gray-600 text-xl"></i>
            <h3 class="text-lg font-bold text-gray-600">Financial Reports</h3>
        </div>
        <div class="flex lg:flex-row md:flex-row flex-col items-center justify-between gap-5 py-3 rounded-md">
            <select name="reportFor" id="reportFor" class="w-40 p-2 border rounded-md text-sm lg:mr-0 md:mr-0 mr-60">
                @if(!request()->has('reportFor'))
                    <option value="today">Today</option>
                    <option value="week">Week</option>
                    <option value="month">Month</option>
                    <option value="year">Year</option>
                @else
                    <option value="today" {{ request('reportFor') === 'today' ? 'selected' : '' }}>Today</option>
                    <option value="week" {{ request('reportFor') === 'week' ? 'selected' : '' }}>Week</option>
                    <option value="month" {{ request('reportFor') === 'month' ? 'selected' : '' }}>Month</option>
                    <option value="year" {{ request('reportFor') === 'year' ? 'selected' : '' }}>Year</option>
                @endif
            </select>
            <form class="flex flex-row items-center justify-end lg:gap-5 md:gap-5 gap-1">
                <div class="flex lg:flex-row md:flex-row flex-col items-center gap-3">
                    <label for="startDate" class="text-sm text-gray-500 font-normal">From:</label>
                    <input type="date" id="startDate" name="startDate" class="w-40 p-2 border rounded-md text-sm" value="{{ request('startDate') }}">
                </div>
                <div class="flex lg:flex-row md:flex-row flex-col items-center gap-3">
                    <label for="endDate" class="text-sm text-gray-500 font-normal">To:</label>
                    <input type="date" id="endDate" name="endDate" class="w-40 p-2 border rounded-md text-sm" value="{{ request('endDate') }}">
                </div>
                <button class="bg-blue-500 text-white px-5 py-2 rounded-md lg:mt-0 md:mt-0 mt-7">Filter</button>
            </form>
        </div>

        <div class="flex gap-5 flex-wrap">

            <x-overview-card
                to="/invoiceHistories"
                title="Total Income"
                value="Ks {{$total_sale}}"
                footer_text="Ks {{round($total_discount)}} discount applied"
                footer_icon="fas fa-gift"
                icon="fas fa-basket-shopping"
                color="blue"
            />


            <x-overview-card
                to="/invoiceHistories"
                title="Total Discount"
                value="Ks {{$total_profit}}"
                footer_text="{{$profit_percentage}}% of total sale"
                footer_icon="{{$profit_percentage > 0 ? 'fas fa-arrow-up' : 'fas fa-arrow-down'}}"
                icon="{{$profit_percentage > 0 ? 'fas fa-money-bill-trend-up' : 'fas fa-solid fa-arrow-trend-down'}}"
                color="{{$profit_percentage > 0 ? 'green' : 'red'}}"
            />
        </div>

        {{-- <hr class="my-5">
        <div class="flex flex-row items-center justify-start gap-3">
            <i class="fa-solid fa-chart-simple text-gray-600 text-xl"></i>
            <h3 class="text-lg font-bold text-gray-600">Stock And Sale Reports</h3>
        </div>

        <div class="flex flex-row gap-5 w-full">
            <div class="w-full table-shadow rounded-none md:rounded-2xl overflow-hidden bg-white">
                <div class="flex flex-row items-center justify-between mx-5 py-3">
                    <div class="flex items-center gap-3">
                        <span class="text-lg text-green-500 font-normal">Best Sellers</span>
                        <i class="fa-solid fa-arrow-trend-up text-md text-green-500"></i>
                    </div>

                    <a href="/products?tableSortColumn=sold&tableSortDirection=desc" class="bg-blue-500 px-3 py-2 text-sm text-white rounded-md">
                        Details
                    </a>
                </div>
                <table class="w-full h-auto">
                    <thead class="bg-white border-t">
                        <tr>
                            <th class="text-left font-semibold text-sm text-gray-500 px-7 py-4">Product</th>
                            <th class="text-left font-normal text-sm text-gray-500 px-7 py-4">Stock</th>
                            <th class="text-left font-normal text-sm text-gray-500 px-7 py-4">Sales Count</th>
                        </tr>
                    </thead>
                    <tbody class="text-sm">
                        @foreach ($top_products as $index => $product)
                            <tr class="{{ $index % 2 == 0 ? 'bg-white' : 'bg-[#f8f9fa]' }} border border-b-1 border-gray-200">
                                <td class="text-gray-700 px-7 py-3">{{ $product->name }}</td>
                                <td class="text-gray-700 px-7 py-3">{{ $product->stock }}</td>
                                <td class="text-gray-700 px-7 py-3">{{ $product->sales_count }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="w-full table-shadow rounded-none md:rounded-2xl overflow-hidden bg-white">
                <div class="flex flex-row items-center justify-between mx-5 py-3">
                    <div class="flex items-center gap-3">
                        <span class="text-lg text-red-400 font-normalpy-4">Worst Sellers</span>
                        <i class="fa-solid fa-arrow-trend-down text-md text-red-400"></i>
                    </div>

                    <a href="/products?tableSortColumn=sold&tableSortDirection=asc" class="bg-blue-500 px-3 py-2 text-sm text-white rounded-md">
                        Details
                    </a>
                </div>
                <table class="w-full h-auto">
                    <thead class="bg-white border-t">
                        <tr>
                            <th class="text-left font-semibold text-sm text-gray-500 px-7 py-4">Product</th>
                            <th class="text-left font-normal text-sm text-gray-500 px-7 py-4">Stock</th>
                            <th class="text-left font-normal text-sm text-gray-500 px-7 py-4">Sales Count</th>
                        </tr>
                    </thead>
                    <tbody class="text-sm">
                        @foreach ($least_sale_products as $index => $product)
                            <tr class="{{ $index % 2 == 0 ? 'bg-white' : 'bg-[#f8f9fa]' }} border border-b-1 border-gray-200">
                                <td class="text-gray-700 px-7 py-3">{{ $product->name }}</td>
                                <td class="text-gray-700 px-7 py-3">{{ $product->stock }}</td>
                                <td class="text-gray-700 px-7 py-3">{{ $product->sales_count }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div> --}}
    </div>

    <script>
        const reportFor = document.getElementById('reportFor');

        reportFor.addEventListener('change', function() {
            const urlParams = new URLSearchParams();
            urlParams.set('reportFor', this.value);
            window.location.href = window.location.pathname + '?' + urlParams.toString();
        });

        // topSaleFor.addEventListener('change', function() {
        //     const urlParams = new URLSearchParams(window.location.search);
        //     urlParams.delete('topSaleFor');
        //     urlParams.set('topSaleFor', this.value);
        //     window.location.href = window.location.pathname + '?' + urlParams.toString();
        // });
    </script>
</x-layout.main>
