<x-layout.main activeMenu="brands">

    <div class="flex flex-row items-center justify-between px-10 mt-5">
        <a href="{{route('brands.index')}}" class="bg-gray-200 hover:bg-gray-300 px-5 py-3 text-gray-700 rounded-md">
            Cancel
        </a>
    </div>

    <div class="container mx-auto px-10 mt-5">
        <div class="flex justify-center bg-white w-full rounded-md py-10 px-10">
            <div class="w-full">
                <h1 class="text-2xl text-gray-500 font-bold mb-4">Edit Brand</h1>
                <form action="{{ route('brands.update', $brand->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="flex flex-row gap-6">
                        <div class="w-1/2">
                            <div class="mb-5">
                                <label for="name" class="block mb-2 text-sm">Brand Name</label>
                                <input type="text" placeholder="brand name" name="name" id="name" class="w-full p-2 h-12 border rounded-md text-sm" value="{{ old('name', $brand->name) }}">
                                @error('name')
                                    <p class="text-red-500">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="mb-5">
                                <label for="description" class="block mb-2 text-sm">Description (optional)</label>
                                <textarea name="description" placeholder="brand description" id="description" class="w-full p-2 border rounded-md text-sm h-40">{{ old('description', $brand->description) }}</textarea>
                                @error('description')
                                    <p class="text-red-500">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="flex flex-row items-center gap-3">
                                <a href="{{route('brands.index')}}" class="w-1/3">
                                    <div class="bg-gray-200 text-gray-700 rounded-md h-12 flex items-center justify-center hover:bg-gray-300">
                                        <span>Cancel</span>
                                    </div>
                                </a>
                                <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white h-12 w-2/3 rounded-md">
                                    Update
                                </button>
                            </div>
                        </div>
                        <div class="w-1/2">


                            <div class="mb-5">
                                <label for="image" class="block mb-2 text-sm">Brand Logo</label>
                                <div class="w-20 h-20 overflow-hidden rounded-lg">
                                    <img src="{{ $brand->getFirstMediaUrl('brand-logo')}}" alt="" class="object-cover w-full h-full">
                                </div>
                            </div>

                            <div class="mb-5">
                                <label for="image" class="block mb-2 text-sm">Update Logo (optional)</label>
                                <input hidden type="file" name="image" id="image" accept="image/*">
                                <div class="w-full border border-dashed rounded-lg border-gray-300 flex items-center p-5">
                                    <div id="image-selector" class="cursor-pointer bg-gray-200 hover:opacity-85 w-32 h-32 rounded-lg flex flex-col items-center justify-center gap-2">
                                        <i class="fa-solid fa-image text-2xl text-gray-400"></i>
                                        <span class="text-sm text-gray-700">Select Image</span>
                                    </div>
                                    <img id="image-preview" src="#" alt="Preview" class="hidden w-auto h-32 rounded-lg cursor-pointer shadow-normal">
                                </div>
                                @error('image')
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
