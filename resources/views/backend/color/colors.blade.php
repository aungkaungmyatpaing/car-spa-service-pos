<x-layout.main activeMenu="colors">
    <div class="flex flex-row items-center justify-between px-10 mt-5">
        <h1 class="text-2xl text-gray-700 font-bold">Colors</h1>
        <a href="{{route('colors.create')}}" class="bg-blue-500 px-3 py-3 text-white rounded-md">
            Create Color
        </a>
    </div>

    <div class="flex flex-col gap-3 md:px-10 px-0 mt-10 mb-20">
        <div class="w-full table-shadow rounded-none md:rounded-2xl overflow-hidden">
            <table class="w-full h-auto">
                <!-- Table header -->
                <thead class="bg-[#f8f9fa]">
                    <tr>
                        <th class="text-left font-semibold text-gray-500 px-7 py-4">No</th>
                        <th class="text-left font-semibold text-gray-500 px-7 py-4">Color Name</th>
                        <th class="text-left font-semibold text-gray-500 px-7 py-4">Color</th>
                        <th class="text-center font-semibold text-gray-500 px-7 py-4 w-40">Action</th>
                    </tr>
                </thead>
                <!-- Table body -->
                <tbody class="text-sm">
                    @foreach ($colors as $index => $color)
                        <tr class="{{ $index % 2 == 0 ? 'bg-white' : 'bg-[#f8f9fa]' }} border border-b-1 border-gray-200">
                            <td class="text-gray-400 font-bold px-7 py-3 w-20">{{ $index+1 }}</td>
                            <td class="text-gray-700 px-7 py-3">{{ $color->color_name }}</td>
                            <td class="text-gray-700 px-7 py-3">
                                <div class="w-10 h-10 rounded-full border-2 border-gray-200" style="background-color:{{ $color->color_code }}">
                                </div>
                            </td>
                            <td class="flex flex-row items-center justify-center px-7 py-3 w-40">
                                <a href="{{ route('colors.edit', $color->id) }}">
                                    <div class="px-3 py-2">
                                        <i class="fa-solid fa-pen-to-square text-lg text-blue-500"></i>
                                    </div>
                                </a>

                                <form action="{{ route('colors.destroy', $color->id) }}" method="POST" class="inline">
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
        {{ $colors->links() }}
    </div>
    </div>
</x-layout.main>
