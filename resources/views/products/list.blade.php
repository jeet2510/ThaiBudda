<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Products') }}
        </h2>
    </x-slot>

    <div class="py-12">

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="justify-end flex pb-3">
                <a href="{{ route('items.add') }}">
                    <x-secondary-button>
                        Add Product
                    </x-secondary-button>
                </a>
            </div>
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <table class="table-auto w-full">
                    <thead>
                        <tr>
                            <th class="py-2">Image</th>
                            <th class="py-2">Name</th>
                            <th class="py-2">Price</th>
                            <th class="py-2">Status</th>
                            <th class="py-2">Action</th>
                        </tr>
                    </thead>
                    <tbody class="text-center">
                        @if (count($items) > 0)
                            @foreach ($items as $item)
                                <tr class="">
                                    <td class="py-2"><img class="flex mx-auto w-20" src="{{ $item->image }}"
                                            alt="" onerror="this.onerror=null;this.src='/images/event-1.jpg'">
                                    </td>
                                    <td class="py-2">{{ $item->name }}</td>
                                    <td class="py-2">${{ number_format($item->price, 2) }}</td>
                                    <td class="py-2">{{ $item->status }}</td>
                                    <td class="py-2">
                                        <div class="flex justify-center items-center gap-2">

                                            <a href="/edit-product/{{ $item->id }}"><button
                                                    class="border p-1.5 rounded-lg hover:bg-indigo-200"><img
                                                        src="Icons/edit.svg" alt=""></button></a>
                                            <a href="{{ route('items.destroy', $item->id) }}">
                                                <button class="w-10 border p-1.5 rounded-lg hover:bg-red-400/40"
                                                    onclick="deleteProduct({{ $item->id }})"><img
                                                        src="Icons/delete.svg" alt="" /></button>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="7" class="pb-3">No Products Added.</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
