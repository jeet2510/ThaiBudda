<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Card Details') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __('Add card details. Guaranteed safe & secure checkout.') }}
        </p>
    </header>

    <form method="POST" action="{{ route('card.add') }}" class="mt-6 space-y-6">
        @csrf
        <div>
            <x-input-label for="card_number" :value="__('Card Number')" />
            <x-text-input id="card_number" name="card_number" type="text" class="mt-1 block w-full"
                autocomplete="card_number" placeholder="xxxx xxxx xxxx xxxx" required/>
            <x-input-error :messages="$errors->updatePassword->get('card_number')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="expiry_date" :value="__('Expiry Date')" />
            <x-text-input id="expiry_date" name="expiry_date" type="text" class="mt-1 block w-full"
                autocomplete="expiry_date" placeholder="MM/YY" required />
            <x-input-error :messages="$errors->updatePassword->get('expiry_date')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="cvv" :value="__('CVV')" />
            <x-text-input id="cvv" name="cvv" type="password" class="mt-1 block w-full" autocomplete="cvv"
                placeholder="3 digits, back of your card" maxlength="3" required/>
            <x-input-error :messages="$errors->updatePassword->get('cvv')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="zip_code" :value="__('Zip Code')" />
            <x-text-input id="zip_code" name="zip_code" type="text" class="mt-1 block w-full"
                autocomplete="zip_code" placeholder="xxxxxx" maxlength="6" required/>
            <x-input-error :messages="$errors->updatePassword->get('zip_code')" class="mt-2" />
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>

            @if (session('status') === 'password-updated')
                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600 dark:text-gray-400">{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"
    integrity="sha512-pHVGpX7F/27yZ0ISY+VVjyULApbDlD0/X0rgGbTqCE7WFW5MezNTWG/dnhtbBuICzsd0WQPgpE4REBLv+UqChw=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.min.js"></script>

<script>
    $('#card_number').mask('0000 0000 0000 0000');
    $('#expiry_date').mask('00/00');
</script>
