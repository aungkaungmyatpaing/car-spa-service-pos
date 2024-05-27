<x-layout.main activeMenu="sub-categories">

    <div class="flex flex-row items-center justify-between px-10 mt-5">
        <a href="{{route('sub_categories.index')}}" class="bg-gray-200 hover:bg-gray-300 px-5 py-3 text-gray-700 rounded-md">
            Cancel
        </a>
    </div>

    <div class="container mx-auto px-10 mt-5">
        <div class="flex justify-center bg-white max-w-[600px] rounded-md py-10 px-10">
            <div class="w-full">
                <h1 class="text-2xl text-gray-500 font-bold mb-4">Edit Sub Category</h1>
                <form action="{{ route('sub_categories.update', $subCategory->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-5">
                        <label for="category_id" class="block mb-2 text-sm">Category</label>
                        <select name="category_id" id="category_id" class="w-full p-2 h-12 border rounded-md text-sm">
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ $subCategory->category_id == $category->id ? 'selected' : '' }}>{{ $category->category }}</option>
                            @endforeach
                        </select>
                        @error('category_id')
                            <p class="text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mb-5">
                        <label for="name" class="block mb-2 text-sm">Name</label>
                        <input type="text" placeholder="name" name="name" id="name" class="w-full p-2 h-12 border rounded-md text-sm" value="{{ old('name', $subCategory->name) }}">
                        @error('name')
                            <p class="text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex flex-row items-center gap-3">
                        <a href="{{route('sub_categories.index')}}" class="w-1/3">
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
