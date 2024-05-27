<x-layout.main activeMenu="brands">
    <div class="flex flex-row items-center justify-between px-10 mt-5">
        <h1 class="text-2xl text-gray-700 font-bold">Brands</h1>
        <a href="{{route('brands.create')}}" class="bg-blue-500 px-3 py-3 text-white rounded-md">
            Create Brand
        </a>
    </div>


    <div class="flex flex-col gap-3 md:px-10 px-0 mt-10 mb-20">
        <div class="w-full table-shadow rounded-none md:rounded-2xl overflow-hidden">
            <table class="w-full h-auto">
                <!-- Table header -->
                <thead class="bg-[#f8f9fa]">
                    <tr>
                        <th class="text-left font-semibold text-gray-500 px-7 py-4">Logo</th>
                        <th class="text-left font-semibold text-gray-500 px-7 py-4">Name</th>
                        <th class="text-left font-semibold text-gray-500 px-7 py-4 md:table-cell hidden">Description</th>
                        <th class="text-center font-semibold text-gray-500 px-7 py-4 w-40">Action</th>
                    </tr>
                </thead>
                <!-- Table body -->
                <tbody class="text-sm">
                    @foreach ($brands as $index => $brand)
                        <tr class="{{ $index % 2 == 0 ? 'bg-white' : 'bg-[#f8f9fa]' }} border border-b-1 border-gray-200">
                            <td class="text-gray-700 px-7 py-3 w-20">
                                <div class="w-14 h-14 overflow-hidden rounded-lg">
                                    <img src="{{ $brand->getFirstMediaUrl('brand-logo')}}" alt="" class="object-cover w-full h-full">
                                </div>
                            </td>
                            <td class="text-gray-700 px-7 py-3">{{ $brand->name }}</td>
                            <td class="text-gray-700 px-7 py-3 md:table-cell hidden">{{ Str::limit($brand->description, 50) }}</td>
                            <td class="flex flex-row items-center justify-center px-7 py-3 w-40">
                                <a href="{{ route('brands.edit', $brand->id) }}">
                                    <div class="px-3 py-2">
                                        <i class="fa-solid fa-pen-to-square text-lg text-blue-500"></i>
                                    </div>
                                </a>

                                <form action="{{ route('brands.destroy', $brand->id) }}" method="POST" class="inline">
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
        {{ $brands->links() }}
    </div>
    </div>
</x-layout.main>
