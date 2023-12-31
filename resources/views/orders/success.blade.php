<x-app-layout>
    <div class="pt-16">

        <p class="text-5xl text-center text-fuchsia-600 flex items-center justify-center">
            <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="100" height="100" viewBox="0 0 64 64">
                <linearGradient id="npWyVMH_SNRmaD~1Sft4Ca_44031_gr1" x1="32" x2="32" y1="7"
                    y2="55.84" gradientUnits="userSpaceOnUse" spreadMethod="reflect">
                    <stop offset="0" stop-color="#1a6dff"></stop>
                    <stop offset="1" stop-color="#c822ff"></stop>
                </linearGradient>
                <path fill="url(#npWyVMH_SNRmaD~1Sft4Ca_44031_gr1)"
                    d="M54.996,37.446c-0.974-1.03-2.112-1.836-3.351-2.414C51.879,33.706,52,32.355,52,31 C52,18.317,41.683,8,29,8S6,18.317,6,31s10.317,23,23,23c3.32,0,6.504-0.692,9.485-2.047C40.504,54.421,43.57,56,47,56 c6.065,0,11-4.935,11-11C58,42.18,56.934,39.497,54.996,37.446z M29,52C17.421,52,8,42.579,8,31s9.421-21,21-21s21,9.421,21,21 c0,1.126-0.095,2.247-0.272,3.352C48.848,34.128,47.936,34,47,34c-6.065,0-11,4.935-11,11c0,1.91,0.491,3.706,1.35,5.273 C34.719,51.418,31.916,52,29,52z M47,54c-4.963,0-9-4.037-9-9s4.037-9,9-9c2.5,0,4.824,1.001,6.543,2.819 C55.127,40.498,56,42.692,56,45C56,49.963,51.963,54,47,54z">
                </path>
                <linearGradient id="npWyVMH_SNRmaD~1Sft4Cb_44031_gr2" x1="48.5" x2="48.5" y1="7"
                    y2="55.84" gradientUnits="userSpaceOnUse" spreadMethod="reflect">
                    <stop offset="0" stop-color="#1a6dff"></stop>
                    <stop offset="1" stop-color="#c822ff"></stop>
                </linearGradient>
                <path fill="url(#npWyVMH_SNRmaD~1Sft4Cb_44031_gr2)"
                    d="M52.793 41.793L47 47.586 44.207 44.793 42.793 46.207 47 50.414 54.207 43.207z"></path>
                <linearGradient id="npWyVMH_SNRmaD~1Sft4Cc_44031_gr3" x1="20.041" x2="20.041" y1="7"
                    y2="55.84" gradientUnits="userSpaceOnUse" spreadMethod="reflect">
                    <stop offset="0" stop-color="#1a6dff"></stop>
                    <stop offset="1" stop-color="#c822ff"></stop>
                </linearGradient>
                <path fill="url(#npWyVMH_SNRmaD~1Sft4Cc_44031_gr3)"
                    d="M11.082,24.667l1.885,0.666c1.695-4.796,5.57-8.671,10.367-10.366 C25.15,14.325,27.057,14,29,14v-2c-2.171,0-4.302,0.364-6.332,1.082C17.307,14.976,12.976,19.307,11.082,24.667z">
                </path>
                <linearGradient id="npWyVMH_SNRmaD~1Sft4Cd_44031_gr4" x1="20" x2="20" y1="24.25"
                    y2="34.27" gradientUnits="userSpaceOnUse" spreadMethod="reflect">
                    <stop offset="0" stop-color="#6dc7ff"></stop>
                    <stop offset="1" stop-color="#e6abff"></stop>
                </linearGradient>
                <path fill="url(#npWyVMH_SNRmaD~1Sft4Cd_44031_gr4)" d="M20 25A4 4 0 1 0 20 33A4 4 0 1 0 20 25Z"></path>
                <linearGradient id="npWyVMH_SNRmaD~1Sft4Ce_44031_gr5" x1="38" x2="38" y1="24.25"
                    y2="34.27" gradientUnits="userSpaceOnUse" spreadMethod="reflect">
                    <stop offset="0" stop-color="#6dc7ff"></stop>
                    <stop offset="1" stop-color="#e6abff"></stop>
                </linearGradient>
                <path fill="url(#npWyVMH_SNRmaD~1Sft4Ce_44031_gr5)" d="M38 25A4 4 0 1 0 38 33A4 4 0 1 0 38 25Z"></path>
                <linearGradient id="npWyVMH_SNRmaD~1Sft4Cf_44031_gr6" x1="29" x2="29" y1="34.875"
                    y2="45.128" gradientUnits="userSpaceOnUse" spreadMethod="reflect">
                    <stop offset="0" stop-color="#6dc7ff"></stop>
                    <stop offset="1" stop-color="#e6abff"></stop>
                </linearGradient>
                <path fill="url(#npWyVMH_SNRmaD~1Sft4Cf_44031_gr6)"
                    d="M34,36H24c-0.552,0-1,0.448-1,1v1c0,3.314,2.686,6,6,6s6-2.686,6-6v-1 C35,36.448,34.552,36,34,36z">
                </path>
            </svg>
            Order Placed
        </p>
        <p class="pt-4 text-center font-semibold py-2">Your order has been placed!<br /> Thank You!</p>

        <a class="text-center pt-5 flex justify-center font-semibold" href="{{ route('user-orders', auth()->user()->id ) }}">
            <button class="bg-fuchsia-600 text-white py-2 rounded px-3 flex items-center"><span class="pr-2">View All Orders</span><svg viewBox="0 0 24 24" width="20px" height="20px" fill="none" xmlns="http://www.w3.org/2000/svg" stroke="#fff" stroke-width="0.24000000000000005"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path fill-rule="evenodd" clip-rule="evenodd" d="M12.2929 4.29289C12.6834 3.90237 13.3166 3.90237 13.7071 4.29289L20.7071 11.2929C21.0976 11.6834 21.0976 12.3166 20.7071 12.7071L13.7071 19.7071C13.3166 20.0976 12.6834 20.0976 12.2929 19.7071C11.9024 19.3166 11.9024 18.6834 12.2929 18.2929L17.5858 13H4C3.44772 13 3 12.5523 3 12C3 11.4477 3.44772 11 4 11H17.5858L12.2929 5.70711C11.9024 5.31658 11.9024 4.68342 12.2929 4.29289Z" fill="#fff"></path> </g></svg></button>
        </a>
    </div>
</x-app-layout>
