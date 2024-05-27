<x-layout.main activeMenu="invoices">
    <div class="flex flex-row items-center justify-between px-10 mt-5">
        <a href="{{route('invoices.index')}}" class="bg-gray-200 hover:bg-gray-300 px-5 py-3 text-gray-700 rounded-md">
            Back
        </a>

        <a href="{{route('invoice.print',$invoice->id)}}" target="_blank" class="bg-blue-500 hover:opacity-95 px-5 py-3 text-white rounded-md flex flex-row items-center justify-center gap-3">
            <i class="fa-solid fa-print"></i>
            <span>
                Print
            </span>
        </a>
    </div>


    <div class="max-sm:w-screen flex items-center justify-center px-10 mt-10 mb-20">
        <div class="w-full table-shadow rounded-lg overflow-hidden max-sm:overflow-scroll bg-white">
            <div class="flex flex-row justify-between px-10 py-5">
                <span class="text-gray-500 font-bold text-lg">
                    #{{$invoice->invoice_number}}
                </span>
                <div class="flex flex-col items-end text-gray-500">
                    <span>
                        {{$invoice->created_at->format('d M Y')}}
                    </span>
                    <span>
                        {{$invoice->created_at->format('h:i A')}}
                    </span>
                </div>
            </div>
            <table class="w-full h-auto">
                <!-- Table header -->
                <thead class="border-b border-t">
                    <tr class="">
                        <th class="text-left font-semibold text-gray-500 px-7 py-4">Product</th>
                        <th class="text-right font-semibold text-gray-500 px-7 py-4">Unit Price</th>
                        <th class="text-right font-semibold text-gray-500 px-7 py-4">Quantity</th>
                        <th class="text-right font-semibold text-gray-500 px-7 py-4">Total</th>
                    </tr>
                </thead>
                <!-- Table body -->
                <tbody class="text-sm">
                    @foreach ($invoice->invoiceItems as $index => $product)
                        <tr class="">
                            <td class="text-left text-gray-700 px-7 py-5">{{ $product->service->name ?? ' -- Deleted Service !! --' }}</td>
                            <td class="text-right text-gray-700 px-7 py-5">Ks {{ $product->price }}</td>
                            <td class="text-right text-gray-700 px-7 py-5">{{ $product->quantity }}</td>
                            <td class="text-right text-gray-700 px-7 py-3">Ks {{ $product->total_price }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <hr>
            <div class="flex lg:flex-row flex-col justify-between">
                <div class="flex flex-row justify-end">
                    <div class="flex flex-col gap-3 lg:items-start items-end px-10 py-5">
                        <span class="text-gray-500 text-md">
                            Paid
                        </span>
                        <span class="text-gray-500 text-md">
                            Change
                        </span>
                    </div>
                    <div class="flex flex-col gap-3 lg:items-start items-end px-10 py-5">
                        <span class="text-gray-500 font-bold text-md">
                            Ks {{ $invoice->paid }}
                        </span>
                        <span class="text-gray-500 font-bold text-md">
                            Ks {{ $invoice->change }}
                        </span>
                    </div>
                </div>
                <hr class="lg:hidden">
                <div class="flex flex-row justify-end">
                    <div class="flex flex-col gap-3 items-end px-10 py-5">
                        <span class="text-gray-500 text-md">
                            Total
                        </span>
                        <span class="text-gray-500 text-md">
                            Discount
                        </span>
                        <span class="text-gray-500 text-md">
                            Grand Total
                        </span>
                    </div>
                    <div class="flex flex-col gap-3 items-end px-10 py-5">
                        <span class="text-gray-500 font-bold text-md">
                            Ks {{ $invoice->total_price }}
                        </span>
                        <span class="text-gray-500 font-bold text-md">
                            @if($invoice->is_fixed == '1')
                                Ks {{ $invoice->discount }}
                            @else
                                % {{$invoice->discount}}
                            @endif
                        </span>
                        <span class="text-gray-500 font-bold text-md">
                            Ks {{ $invoice->grand_total }}
                        </span>
                    </div>
                </div>
            </div>
        </div>


</x-layout.main>
