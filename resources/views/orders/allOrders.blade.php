<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Order List') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h1 class="text-2xl font-bold mb-4">Order List</h1>
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Order ID
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Order Status
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                User ID
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Payment ID
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Service Detail
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Item Name
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Payment Amount
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Payment Status
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($orders as $order)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    {{ $order->id }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <form action="{{ route('order.status', $order->id) }}" method="POST">
                                        @csrf
                                        <select onchange="this.form.submit()" id="orderStatus"
                                            name="orderStatus">
                                            <option value="Placed" @if ($order->order_status == "Placed") selected @endif>Placed
                                            </option>
                                            <option value="Dispatched" @if ($order->order_status == "Dispatched") selected @endif>Dispatched
                                            </option>
                                            <option value="Delivered" @if ($order->order_status == "Delivered") selected @endif>Delivered</option>
                                        </select>
                                    </form>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    {{ $order->user_id }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    {{ $order->payment_id }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    {{ $order->service_detail }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    {{ $order->item_name }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    ${{ $order->payment_amount }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    {{ $order->payment_status }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>

<script>
    function changeStatus(id, value) {
        this.form.submit();
    }
</script>
