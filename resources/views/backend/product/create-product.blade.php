<x-layout.main activeMenu="products">

    <div class="flex flex-row items-center justify-between px-10 mt-5">
        <a href="{{route('products.index')}}" class="bg-gray-200 hover:bg-gray-300 px-5 py-3 text-gray-700 rounded-md">
            Cancel
        </a>
    </div>

    <div class="container mx-auto px-10 mt-5">
        <div class="flex justify-center bg-white w-full rounded-md py-10 px-10 mb-20">
            <div class="w-full">
                <h1 class="text-2xl text-gray-500 font-bold mb-4">Create Product</h1>
                <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="flex flex-row gap-6">
                        <div class="w-1/2">

                            {{-- Name --}}
                            <div class="mb-5">
                                <label for="name" class="block mb-2 text-sm">Product Name</label>
                                <input required type="text" placeholder="product name" name="name" id="name" class="w-full p-2 h-12 border rounded-md text-sm" value="{{ old('name') }}">
                                @error('name')
                                    <p class="text-red-500">{{ $message }}</p>
                                @enderror
                            </div>

                            {{-- Description --}}
                            <div class="mb-5">
                                <label for="description" class="block mb-2 text-sm">Description (optional)</label>
                                <textarea name="description" placeholder="product description" id="description" class="w-full p-2 border rounded-md text-sm h-40" value="{{ old('description') }}"></textarea>
                                @error('description')
                                    <p class="text-red-500">{{ $message }}</p>
                                @enderror
                            </div>

                            {{-- Price --}}
                            <div class="mb-5">
                                <label for="price" class="block mb-2 text-sm">Price</label>
                                <input required type="text" placeholder="product price" name="price" id="price" class="w-full p-2 h-12 border rounded-md text-sm" value="{{ old('price') }}">
                                @error('price')
                                    <p class="text-red-500">{{ $message }}</p>
                                @enderror
                            </div>

                            {{-- Purchase Price --}}
                            <div class="mb-5">
                                <label for="purchase_price" class="block mb-2 text-sm">Purchase Price</label>
                                <input required type="text" placeholder="product purchase price" name="purchase_price" id="purchase_price" class="w-full p-2 h-12 border rounded-md text-sm" value="{{ old('purchase_price') }}">
                                @error('purchase_price')
                                    <p class="text-red-500">{{ $message }}</p>
                                @enderror
                            </div>

                            {{-- Stock --}}
                            <div class="mb-5">
                                <label for="stock" class="block mb-2 text-sm">Stock</label>
                                <input required type="number" placeholder="product stock" name="stock" id="stock" class="w-full p-2 h-12 border rounded-md text-sm" value="{{ old('stock') }}">
                                @error('stock')
                                    <p class="text-red-500">{{ $message }}</p>
                                @enderror
                            </div>

                            {{-- Stock Alert --}}
                            <div class="mb-5">
                                <label for="stock_limit" class="block mb-2 text-sm">Stock Alert Limit</label>
                                <input required type="number" placeholder="product stock alert limit" name="stock_limit" id="stock_limit" class="w-full p-2 h-12 border rounded-md text-sm" value="{{ old('stock_limit') }}">
                                @error('stock_limit')
                                    <p class="text-red-500">{{ $message }}</p>
                                @enderror
                            </div>


                            <div class="flex flex-row items-center gap-3">
                                <a href="{{route('products.index')}}" class="w-1/3">
                                    <div class="bg-gray-200 text-gray-700 rounded-md h-12 flex items-center justify-center hover:bg-gray-300">
                                        <span>Cancel</span>
                                    </div>
                                </a>
                                <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white h-12 w-2/3 rounded-md">
                                    Create
                                </button>
                            </div>
                        </div>
                        <div class="w-1/2">

                            {{-- Category --}}
                            <div class="mb-5">
                                <label for="category_id" class="block mb-2 text-sm">Category</label>
                                <select name="category_id" id="category_id" class="w-full p-2 h-12 border rounded-md text-sm" required>
                                    <option value="">Select a category</option>
                                    @foreach($categories as $category)
                                        <option value="{{$category->id}}">{{$category->category}}</option>
                                    @endforeach
                                </select>
                                @error('category_id')
                                    <p class="text-red-500">{{ $message }}</p>
                                @enderror
                            </div>

                            {{-- Brand --}}
                            <div class="mb-5">
                                <label for="brand_id" class="block mb-2 text-sm">Brand</label>
                                <select name="brand_id" id="brand_id" class="w-full p-2 h-12 border rounded-md text-sm" required>
                                    <option value="">Select a brand</option>
                                    @foreach($brands as $brand)
                                        <option value="{{$brand->id}}">{{$brand->name}}</option>
                                    @endforeach
                                </select>
                                @error('brand_id')
                                    <p class="text-red-500">{{ $message }}</p>
                                @enderror
                            </div>

                            {{-- Design --}}
                            <div class="mb-5">
                                <label for="design" class="block mb-2 text-sm">Design</label>
                                <input required type="text" placeholder="product design" name="design" id="design" class="w-full p-2 h-12 border rounded-md text-sm" value="{{ old('design') }}">
                                @error('design')
                                    <p class="text-red-500">{{ $message }}</p>
                                @enderror
                            </div>

                            {{-- Model --}}
                            <div class="mb-5">
                                <label for="model" class="block mb-2 text-sm">Model</label>
                                <input required type="text" placeholder="product model" name="model" id="model" class="w-full p-2 h-12 border rounded-md text-sm" value="{{ old('model') }}">
                                @error('model')
                                    <p class="text-red-500">{{ $message }}</p>
                                @enderror
                            </div>

                            {{-- Color Select --}}
                            {{-- <div class="mb-5">
                                <label for="color_id" class="block mb-2 text-sm">Color</label>
                                <select name="color_id" id="color_id" class="w-full p-2 h-12 border rounded-md text-sm" required>
                                    <option value="">Select a color</option>
                                    @foreach($colors as $color)
                                        <option value="{{$color->id}}">
                                            {{$color->color_name}}
                                        </option>
                                    @endforeach
                                </select>
                                @error('color_id')
                                    <p class="text-red-500">{{ $message }}</p>
                                @enderror
                            </div> --}}

                            {{-- Size Select --}}
                            {{-- <div class="mb-5">
                                <label for="size_id" class="block mb-2 text-sm">Size</label>
                                <select name="size_id" id="size_id" class="w-full p-2 h-12 border rounded-md text-sm" required>
                                    <option value="">Select a size</option>
                                    @foreach($sizes as $size)
                                        <option value="{{$size->id}}">{{$size->size}}</option>
                                    @endforeach
                                </select>
                                @error('size_id')
                                    <p class="text-red-500">{{ $message }}</p>
                                @enderror
                            </div> --}}


                            <div class="mb-5">
                                <label for="image" class="block mb-2 text-sm">Product Image</label>
                                <input hidden type="file" name="image" id="image" accept="image/*">
                                <div class="w-full border border-dashed rounded-lg border-gray-300 flex items-center p-5">
                                    <div id="image-selector" class="cursor-pointer bg-gray-200 hover:opacity-85 w-32 h-32 rounded-lg flex flex-col items-center justify-center gap-2">
                                        <i class="fa-solid fa-image text-2xl text-gray-400"></i>
                                        <span class="text-sm text-gray-700">Select Image</span>
                                    </div>
                                    <img id="image-preview" src="#" alt="Preview" class="hidden w-auto h-32 rounded-lg cursor-pointer shadow-normal">
                                </div>
                            </div>

                            @error('image')
                                <p class="text-red-500">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            // Preview image on file input change
            $('#image').change(function() {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#image-preview').attr('src', e.target.result).show();
                }
                reader.readAsDataURL(this.files[0]);
                $('#image-selector').hide();
            });

            // Open file input on image click
            $('#image-preview').click(function() {
                $('#image').click();
            });

            $('#image-selector').click(function() {
                $('#image').click();
            });
        });
    </script>


</x-layout.main>
