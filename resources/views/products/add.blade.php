<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Add Product') }}
        </h2>
    </x-slot>

    <div class="flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">
        <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
            <form method="POST" action="{{ route('items.store') }}"  enctype="multipart/form-data">
                @csrf
                <!-- Name -->
                <div>
                    <x-input-label for="name" :value="__('Name')" />
                    <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')"
                        required autofocus autocomplete="name" />
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>

                <!-- Email Address -->
                <div class="mt-4">
                    <x-input-label for="image" :value="__('Image')" />
                    <x-text-input id="image" class="block mt-1 w-full" type="file" name="image"
                        :value="old('image')" required autocomplete="image" />
                    <x-input-error :messages="$errors->get('image')" class="mt-2" />
                </div>

                <div class="mt-4">
                    <x-input-label for="category" :value="__('Category')" />

                    <select id="category" class="block mt-1 w-full" name="category" required
                        autocomplete="new-password">
                        @if (count($categories) > 0)
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        @else
                            <option disabled selected>
                                No categories added
                            </option>
                        @endif
                    </select>

                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <!-- Confirm Password -->
                <div class="mt-4">
                    <x-input-label for="price" :value="__('Price')" />

                    <x-text-input id="price" class="block mt-1 w-full" type="text" name="price" required
                        autocomplete="price" />

                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                </div>
                <div class="mt-4">
                    <x-input-label for="tag" :value="__('Tag')" />

                    <x-text-input id="tag" class="block mt-1 w-full" type="text" name="tag" required
                        autocomplete="tag" />

                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                </div>


                <div class="mt-4">
                    <x-input-label for="description" :value="__('Description')" />

                    <textarea id="description" class="block mt-1 w-full" type="text" name="description" required
                        autocomplete="description"></textarea>

                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <div class="mt-4">
                    <x-input-label for="on_homepage" :value="__('On Homepage')" />

                    <select id="on_homepage" class="block mt-1 w-full" name="on_homepage" required autocomplete="on_homepage">
                        <option value="0">Inactive</option>
                        <option value="1">Active</option>
                    </select>

                    <x-input-error :messages="$errors->get('on_homepage')" class="mt-2" />
                </div>

                <div class="flex items-center justify-end mt-4">
                    <x-primary-button class="ml-4">
                        {{ __('Submit') }}
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
