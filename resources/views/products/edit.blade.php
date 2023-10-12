<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Product') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <form action="{{ route('items.update', $item->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="mb-4">
                        <label for="name" class="block text-gray-700 text-sm font-bold mb-2">Name</label>
                        <input type="text" class="form-input rounded-md w-full" id="name" name="name" value="{{ $item->name }}">
                    </div>
                    
                    <div class="mb-4">
                        <label for="price" class="block text-gray-700 text-sm font-bold mb-2">Price</label>
                        <input type="text" class="form-input rounded-md w-full" id="price" name="price" value="{{ $item->price }}">
                    </div>
                    
                    <div class="mb-4">
                        <label for="status" class="block text-gray-700 text-sm font-bold mb-2">Status</label>
                        <select class="form-select rounded-md w-full" id="status" name="status">
                            <option value="1" {{ $item->status == 1 ? 'selected' : '' }}>Active</option>
                            <option value="0" {{ $item->status == 0 ? 'selected' : '' }}>Inactive</option>
                        </select>
                    </div>
                    
                    <div class="mb-4">
                        <label for="description" class="block text-gray-700 text-sm font-bold mb-2">Description</label>
                        <textarea class="form-input rounded-md w-full" id="description" name="description">{{ $item->description }}</textarea>
                    </div>
                    
                    <div class="mb-4">
                        <label for="image" class="block text-gray-700 text-sm font-bold mb-2">Image URL</label>
                        <input type="text" class="form-input rounded-md w-full" id="image" name="image" value="{{ $item->image }}">
                    </div>
                    
                    <div class="mb-4">
                        <label for="tag" class="block text-gray-700 text-sm font-bold mb-2">Tag</label>
                        <input type="text" class="form-input rounded-md w-full" id="tag" name="tag" value="{{ $item->tag }}">
                    </div>
                    
                    <div class="mb-4">
                        <label for="on_homepage" class="block text-gray-700 text-sm font-bold mb-2">On Homepage</label>
                        <select class="form-select rounded-md w-full" id="on_homepage" name="on_homepage">
                            <option value="1" {{ $item->on_homepage == 1 ? 'selected' : '' }}>Active</option>
                            <option value="0" {{ $item->on_homepage == 0 ? 'selected' : '' }}>Inactive</option>
                        </select>
                    </div>
                    <div class="mt-4">
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
