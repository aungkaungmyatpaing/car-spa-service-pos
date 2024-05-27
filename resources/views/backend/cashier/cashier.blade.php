<x-layout.main activeMenu='cashier'>
    <form action="{{ route('carts.store') }}" method="POST">
        @csrf
        <div class="flex flex-row items-center justify-between px-10 mt-5">
            <input required type="text" placeholder="Scan Barcode" name="barcode" id="barcode" class="w-full px-3 py-2 h-12 border rounded-md text-sm">
        </div>
    </form>

    @if($carts->count()>0)
        <div class="max-sm:w-screen flex flex-col gap-3 px-10 mt-10 mb-20">
            <div class="w-full table-shadow rounded-2xl overflow-hidden max-sm:overflow-scroll">
                <table class="w-full h-auto">
                    <!-- Table header -->
                    <thead class="bg-[#f8f9fa]">
                        <tr>
                            <th class="text-left font-semibold text-gray-500 px-7 py-4">No</th>
                            <th class="text-left font-semibold text-gray-500 px-7 py-4">Name</th>
                            <th class="text-left font-semibold text-gray-500 px-7 py-4">Size</th>
                            <th class="text-left font-semibold text-gray-500 px-7 py-4">Duration</th>
                            <th class="text-left font-semibold text-gray-500 px-7 py-4">Price</th>
                            <th class="text-center font-semibold text-gray-500 px-7 py-4">Quantity</th>
                            <th class="text-left font-semibold text-gray-500 px-7 py-4">Total Pirce</th>
                            <th class="text-center font-semibold text-gray-500 px-7 py-4 w-20">Action</th>
                        </tr>
                    </thead>
                    <!-- Table body -->
                    <tbody class="text-sm">
                        @foreach ($carts as $index => $cart)
                            <tr class="{{ $index % 2 == 0 ? 'bg-white' : 'bg-[#f8f9fa]' }} border border-b-1 border-gray-200">
                                <td class="text-gray-400 font-bold px-7 py-3 w-20">{{ $index+1 }}</td>
                                <td class="text-gray-700 px-7 py-3 flex flex-col">
                                    <span class="text-md font-bold text-gray-600">{{ $cart->service->name }}</span>
                                    <span class="text-gray-400">
                                        {{ optional($cart->service->category)->category }}
                                        @if($cart->service->subCategory)
                                            | {{ $cart->service->subCategory->name }}
                                        @endif

                                    </span>
                                </td>
                                <td class="text-gray-700 px-7 py-3">{{ $cart->service->size->name }}</td>
                                <td class="text-gray-700 px-7 py-3">{{ $cart->service->duration->name }}</td>
                                <td class="text-gray-700 px-7 py-3">{{ $cart->service->price }}</td>
                                <td class="text-gray-700 px-7 py-3 text-center">
                                    <input class="w-14 text-center px-3 py-2 h-12 border rounded-md text-sm" type="number" min="1" id="product_{{ $cart->service->id }}_quantity"
                                        onkeyup="updatePrice({{ $cart->service->id}}, {{ $cart->service->price }}, {{ $cart->id }})"
                                        value="{{ $cart->quantity }}" />
                                </td>
                                <td id="product_{{$cart->service->id}}_total_price" class="text-gray-700 px-7 py-3 text-left">
                                    {{ $cart->service->price * $cart->quantity }}
                                </td>

                                <td class="text-center px-7 py-3 w-20">
                                    <form action="{{ route('carts.destroy', $cart->id) }}" method="POST" class="inline">
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




            <form action="{{ route('cart.checkout') }}" class="flex flex-row max-sm:flex-col w-full gap-5 items-start" method="POST">
                @csrf
                <div class="bg-white rounded-lg flex flex-col gap-5 flex-1 py-5 px-5">
                    <div class="flex flex-row justify-between items-center">
                        <div class="text-bold text-gray-500">
                            Discount Type :
                        </div>
                        <div class="ml-10" id="discount_type">
                            <label for="amount" class="inline-flex items-center">
                                <input checked type="radio" id="amount" name="discount_type" value="1" class="form-radio h-5 w-5 text-blue-500">
                                <span class="ml-2">Amount</span>
                            </label>
                            <label for="percent" class="inline-flex items-center ml-5">
                                <input type="radio" id="percent" name="discount_type" value="0" class="form-radio h-5 w-5 text-blue-500">
                                <span class="ml-2">Percent(%)</span>
                            </label>
                        </div>
                        <span id="discount_type_value" class="hidden text-md font-bold text-gray-500">
                            Amount
                        </span>
                    </div>

                    <div class="flex flex-row justify-between items-center">
                        <div id="discount_label" class="text-bold text-gray-500">
                            Discount Amount :
                        </div>
                        <input required type="number" placeholder="discount" name="discount" id="discount" class="w-[120px] p-2 h-12 border rounded-md text-sm ml-10" value="0">
                    </div>
                </div>

            <div class="bg-white rounded-lg flex flex-col gap-3 flex-1 py-5 px-5">

                    <div class="flex flex-row justify-between items-center">
                        <span class="text-bold text-gray-500">
                            Net Total :
                        </span>
                        <span id="net_total" class="ml-10 text-md text-gray-500">
                            {{ number_format($totalPrice) }} Ks
                        </span>
                    </div>

                    <div class="flex flex-row justify-between items-center">
                        <span class="text-bold text-xl font-bold text-gray-500">
                            Grand Price :
                        </span>
                        <span id="grand_total" class="ml-10 text-xl font-bold text-blue-500">
                            {{ number_format($totalPrice) }} Ks
                        </span>
                    </div>

                    <div id='payment_section' class="hidden flex-col  border-t-2 mt-5 pt-3 gap-5">
                        <div class="flex flex-row justify-between items-center">
                            <div class="text-bold text-md text-gray-500">
                                Paid :
                            </div>
                            <div class="flex flex-row items-center gap-3">
                                <input required type="text" placeholder="paid" name="paid" id="paid" class="w-[120px] p-2 h-12  border rounded-md text-lg font-bold ml-10" value="0">
                                <span class="text-lg font-bold text-gray-500">
                                    Ks
                                </span>
                            </div>
                        </div>

                        <div class="flex flex-row justify-between items-center">
                            <span class="text-bold text-md text-gray-500">
                                Change :
                            </span>
                            <span id="change" class="ml-10 text-lg font-bold text-gray-500">
                                Input Payment Amount
                            </span>
                        </div>
                        <button disabled type="submit" id="checkout" class="bg-blue-300 text-white h-12 rounded-md w-full mt-10">
                                Complete Checkout
                        </button>
                        <div id="edit" class="bg-gray-200 hover:bg-gray-300 text-gray-800 h-12
                            rounded-md w-full flex items-center justify-center cursor-pointer">
                                Edit
                        </div>
                    </div>

                    <div id="continue" class="bg-blue-500 hover:bg-blue-600 text-white h-12
                        rounded-md w-full mt-10 flex items-center justify-center cursor-pointer">
                            <span>Continue</span>
                    </div>
            </div>
            </form>
        </div>
    @else
        <div class="flex h-full flex-col items-center justify-center">
            <span class="text-gray-500">No product in cart , scan barcode to add products</span>
        </div>
    @endif


    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.27.2/axios.min.js"
        integrity="sha512-odNmoc1XJy5x1TMVMdC7EMs3IVdItLPlCeL5vSUPN2llYKMJ2eByTTAIiiuqLg+GdNr9hF6z81p27DArRFKT7A=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        let discount = 0;
        let discount_type = 1;
        let total_price = 0;
        let grand_total = 0;

        window.onload = function() {
            document.getElementById("barcode").focus();
            axios.get('/cart/total-price').then(response => {
                total_price = response.data.total_price;
                grand_total = response.data.total_price;
            });
        };

        //On Update Price
        async function updatePrice(productId, productPrice, cartId) {
            let newQuantity = document.querySelector(`#product_${productId}_quantity`).value;
            let url = `/cart/${cartId}/update-quantity`;
            try {
                if (newQuantity >= 1) {
                    axios.put(url, {
                        'quantity': newQuantity,
                    }).then(response => {
                        if (response.data.success == true) {
                            console.log('Updated');
                            axios.get('/cart/total-price').then(response => {
                                buildNetTotal(response.data.total_price);
                                total_price = response.data.total_price;

                                let discountedPrice = calculateDiscountedPrice(total_price, discount, discount_type);
                                buildGrandTotal(discountedPrice);
                            });
                        }else{
                            alert(response.data.message);
                            location.reload();
                        }
                    });

                    let totalPriceElement = document.querySelector(`#product_${productId}_total_price`);
                    totalPriceElement.innerHTML = productPrice * newQuantity;
                }

                // axios.get('/cart/total-price').then(response => {
                //     buildNetTotal(response.data.total_price);
                //     total_price = response.data.total_price;

                //     let discountedPrice = calculateDiscountedPrice(total_price, discount, discount_type);
                //     buildGrandTotal(discountedPrice);
                // });
            } catch (err) {
                throw err;
            }
        }

        // On Change Discount
        document.getElementById('discount').addEventListener('keyup', function() {
            if (discount_type == 0 && this.value > 100) this.value = 0;
            if (discount_type == 1 && this.value > total_price) this.value = 0

            discount = this.value;

            console.log(discount);

            let discountedPrice = calculateDiscountedPrice(total_price, discount, discount_type);
            buildGrandTotal(discountedPrice);
        });

        // On Change Discount Type
        document.querySelectorAll('input[name="discount_type"]').forEach((element) => {
            element.addEventListener('change', function() {
                discount_type = this.value;
                document.getElementById('discount').value = 0;
                buildGrandTotal(total_price);
                buildDiscountLabel();
            });
        });

        // Update Discount Label UI
        function buildDiscountLabel(){
            let discountLabel = document.getElementById('discount_label');
            let discountTypeValue = document.getElementById('discount_type_value');
            if(discount_type == 1){
                discountLabel.innerHTML = 'Discount Amount :';
                discountTypeValue.innerHTML = 'Amount';
            }else{
                discountLabel.innerHTML = 'Discount Percent (%) :';
                discountTypeValue.innerHTML = 'Percent (%)';
            }
        }

        // Update Grand Total UI
        function buildGrandTotal(total){
            grand_total = total;
            document.querySelector('#grand_total').innerHTML = Math.round(total).toLocaleString() + ' Ks';
        }

        // Update Net Total UI
        function buildNetTotal(total){
            document.querySelector('#net_total').innerHTML = Math.round(total).toLocaleString() + ' Ks';
        }

        // Calculate Discounted Price
        function calculateDiscountedPrice(totalPrice, discount, discountType) {
            let discountedPrice = 0;
            if (discountType == 1) {
                discountedPrice = totalPrice - discount;
            } else {
                discountedPrice = totalPrice - (totalPrice * discount / 100);
            }
            return discountedPrice;
        }

        // Continue Checkout to Next Step
        document.getElementById('continue').addEventListener('click', function() {
            this.classList.add('hidden');
            document.getElementById('payment_section').classList.remove('hidden');
            document.getElementById('payment_section').classList.add('flex');
            //disable edit all input
            document.querySelectorAll('input:not(#paid)').forEach((element) => {
                element.setAttribute('readonly', true);
                document.getElementById('discount_type').classList.add('hidden');
                document.getElementById('discount_type_value').classList.remove('hidden');
            });
        });

        // Edit Payment
        document.getElementById('edit').addEventListener('click', function() {
            document.getElementById('continue').classList.remove('hidden');
            document.getElementById('payment_section').classList.add('hidden');
            document.getElementById('payment_section').classList.remove('flex');
            //enable edit all input
            document.querySelectorAll('input').forEach((element) => {
                element.removeAttribute('readonly');
                document.getElementById('discount_type').classList.remove('hidden');
                document.getElementById('discount_type_value').classList.add('hidden');
            });
        });

        // On Update Paid
        document.getElementById('paid').addEventListener('keyup', function() {
            var checkout = document.getElementById('checkout');
            if(this.value >= Math.round(grand_total)){
                let change = this.value - Math.round(grand_total);
                document.getElementById('change').innerHTML = Math.round(change).toLocaleString() + ' Ks';

                checkout.removeAttribute('disabled');
                checkout.classList.remove('bg-blue-300');
                checkout.classList.add('bg-blue-500');
                checkout.classList.add('hover:bg-blue-600');
            }else{
                document.getElementById('change').innerHTML = 'Not Enough Payment';

                checkout.setAttribute('disabled', true);
                checkout.classList.remove('bg-blue-500');
                checkout.classList.remove('hover:bg-blue-600');
                checkout.classList.add('bg-blue-300');
            }

        });





        // document.addEventListener('contextmenu', event => event.preventDefault());

        // window.onbeforeunload = function(e) {
        //     if (!confirm("Are you sure you want to leave the form? Your changes may not be saved.")) {
        //         e.preventDefault();
        //         e.returnValue = "";
        //     }
        // };

    </script>

</x-layout.main>
