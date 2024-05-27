<x-layout.main activeMenu="invoices">
    <div class="flex flex-row items-center justify-between px-10 mt-5">
        <h1 class="text-2xl text-gray-700 font-bold">Invoices</h1>
        {{-- <a href="{{route('invoices.create')}}" class="bg-blue-500 px-3 py-3 text-white rounded-md">
            Create Invoices
        </a> --}}
        <div class="relative">
            <input type="text" id="search" placeholder="Search Invoice..." class="border border-gray-300 rounded-md px-3 py-1 lg:mr-20 focus:outline-none focus:ring focus:border-blue-500">
            <button id="searchBtn" class="absolute inset-y-0 right-0 px-4 py-1 bg-blue-500 text-white rounded-r-md hover:bg-blue-600 focus:outline-none focus:bg-blue-600">Search</button>
        </div>
    </div>


    <div class="max-sm:w-screen flex flex-col gap-3 md:px-10 px-0 mt-10 mb-20">
        <div class="w-full table-shadow rounded-none md:rounded-2xl overflow-hidden max-sm:overflow-scroll">
            <table class="w-full h-auto">
                <!-- Table header -->
                <thead class="bg-[#f8f9fa]">
                    <tr>
                        <th class="text-left font-semibold text-gray-500 px-7 py-4">Invoice NO</th>
                        @if(Auth::user()->role == 'admin')
                        <th class="text-left font-semibold text-gray-500 px-7 py-4 ">User</th>
                        @endif
                        <th class="text-left font-semibold text-gray-500 px-7 py-4 ">Total</th>
                        <th class="text-left font-semibold text-gray-500 px-7 py-4 ">Discount</th>
                        <th class="text-left font-semibold text-gray-500 px-7 py-4 ">Grand Total</th>
                        <th class="text-left font-semibold text-gray-500 px-7 py-4">Time</th>
                        <th class="text-center font-semibold text-gray-500 px-7 py-4 w-40">Action</th>
                    </tr>
                </thead>
                <!-- Table body -->
                <tbody class="text-sm">
                    @foreach ($invoices as $index => $invoice)
                        <tr class="{{ $index % 2 == 0 ? 'bg-white' : 'bg-[#f8f9fa]' }} border border-b-1 border-gray-200">
                            <td class="text-gray-700 px-7 py-3">{{ $invoice->invoice_number }}</td>
                            @if(Auth::user()->role == 'admin')
                                <td class="text-gray-700 px-7 py-3">
                                    {{$invoice->user->name}}
                                </td>
                            @endif
                            <td class="text-gray-700 px-7 py-3">
                                {{ $invoice->total_price}}
                            </td>
                            <td class="text-gray-700 px-7 py-3">
                                @if ($invoice->is_fixed == true)
                                    {{ $invoice->discount}} Ks
                                @else
                                    {{ $invoice->discount}} Percent(%)
                                @endif
                            </td>
                            <td class="text-gray-700 px-7 py-3 ">{{ $invoice->grand_total}}</td>
                            <td class="text-gray-700 px-7 py-3">{{ $invoice->created_at->format('F j, Y h:i A')}}</td>
                            <td class="flex flex-row items-center justify-center px-7 py-3 w-40">
                                <a href="{{route('invoice.print',$invoice->id)}}" target="_blank">
                                    <div class="px-3 py-2">
                                        <i class="fa-solid fa-print text-lg text-green-500"></i>
                                    </div>
                                </a>

                                <a href="{{ route('invoices.show', $invoice->id) }}">
                                    <div class="px-3 py-2">
                                        <i class="fa-solid fa-eye text-lg text-blue-500"></i>
                                    </div>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    <!-- Pagination -->
    <div class="mt-5">
        {{ $invoices->links() }}
    </div>
    </div>
    <script>
        document.getElementById('searchBtn').addEventListener('click', function() {
            var query = document.getElementById('search').value.trim();
            window.location.href = '/invoices?query=' + encodeURIComponent(query);
        });
    </script>

</x-layout.main>
