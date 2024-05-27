<x-layout.main activeMenu="sizes">

    <div class="flex flex-row items-center justify-between px-10 mt-5">
        <a href="{{route('sizes.index')}}" class="bg-gray-200 hover:bg-gray-300 px-5 py-3 text-gray-700 rounded-md">
            Cancel
        </a>
    </div>

    <div class="container mx-auto px-10 mt-5">
        <div class="flex justify-center bg-white max-w-[600px] rounded-md py-10 px-10">
            <div class="w-full">
                <h1 class="text-2xl text-gray-500 font-bold mb-4">Edit Size</h1>
                <form action="{{ route('sizes.update', $size->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-5">
                        <label for="name" class="block mb-2 text-sm">Size</label>
                        <input type="text" placeholder="size" name="name" id="name" class="w-full p-2 h-12 border rounded-md text-sm" value="{{ $size->name }}">
                        @error('name')
                            <p class="text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="flex flex-row items-center gap-3">
                        <a href="{{route('sizes.index')}}" class="w-1/3">
                            <div class="bg-gray-200 text-gray-700 rounded-md h-12 flex items-center justify-center hover:bg-gray-300">
                                <span>Cancel</span>
                            </div>
                        </a>
                        <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white h-12 w-2/3 rounded-md">
                            Update
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-layout.main>