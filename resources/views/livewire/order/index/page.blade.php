<div class="flex flex-col gap-8">
    <div class="grid grid-cols-2 gap-2">
        <div class="relative text-sm text-gray-800">
            <div class="absolute pl-2 left-0 top-0 bottom-0 flex items-center pointer-events-none text-gray-500">
                <x-icon.magnifying-glass />
            </div>

            <input wire:model.live.debounce="search" type="text" placeholder="Search email or order #"
                class="block w-full rounded-lg border-0 py-1.5 pl-10 text-gray-900 ring-1 ring-inset ring-gray-200 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
        </div>
    </div>
    <div>
        <div class="relative">
            <table class="min-w-full table-fixed divide-y divide-gray-300 text-gray-800">
                <thead>
                    <tr>

                        <th class="p-3 text-left text-sm font-semibold text-gray-900">
                            <x-order.index.sortable column="number" :$sortCol :$sortAsc>
                                <div>Order #</div>
                            </x-order.index.sortable>
                        </th>
                        <th class="p-3 text-left text-sm font-semibold text-gray-900">
                            <x-order.index.sortable column="status" :$sortCol :$sortAsc>
                            <div>Status</div>
                            </x-order.index.sortable>
                        </th>
                        <th class="p-3 text-left text-sm font-semibold text-gray-900">
                            <div>Customer</div>
                        </th>
                        <th class="p-3 text-left text-sm font-semibold text-gray-900">
                            <x-order.index.sortable column="date" :$sortCol :$sortAsc>
                            <div>Date</div>
                            </x-order.index.sortable>
                        </th>
                        <th class="p-3 text-left text-sm font-semibold text-gray-900">
                            <x-order.index.sortable column="amount" :$sortCol :$sortAsc class="flex-row-reverse">
                            <div>Amount</div>
                            </x-order.index.sortable>
                        </th>
                        <th>
                            {{-- drop down menu --}}
                        </th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 bg-white text-gray-700">
                    @foreach ($orders as $order)
                        <tr wire:key="{{ $order->id }}">
                            {{-- <td class="whitespace-nowrap p-3 text-sm">
                                <div class="flex items-center">
                                    <input wire:model="selectedOrderIds" value="{{ $order->id }}" type="checkbox"
                                        class="rounded border-gray-300 shadow">
                                </div>
                            </td> --}}

                            <td class="whitespace-nowrap p-3 text-sm">
                                <div class="flex gap-1">
                                    <span class="text-gray-300">#</span>

                                    {{ $order->number }}
                                </div>
                            </td>

                            <td class="whitespace-nowrap p-3 text-sm">
                                <div
                                    class="rounded-full py-0.5 pl-2 pr-1 inline-flex font-medium items-center gap-1 text-{{ $order->status->color() }}-600 text-xs bg-{{ $order->status->color() }}-100 opacity-75">
                                    <div>{{ $order->status->label() }}</div>

                                    <x-dynamic-component :component="$order->status->icon()" />
                                </div>
                            </td>

                            <td class="whitespace-nowrap p-3 text-sm">
                                <div class="flex items-center gap-2">
                                    <div class="w-5 h-5 rounded-full overflow-hidden">
                                        <img src="{{ $order->avatar }}" alt="Customer avatar">
                                    </div>

                                    <div>{{ $order->email }}</div>
                                </div>
                            </td>

                            <td class="whitespace-nowrap p-3 text-sm">
                                {{ $order->dateForHumans() }}
                            </td>

                            <td class="w-auto whitespace-nowrap p-3 text-sm text-gray-800 font-semibold text-right">
                                {{ $order->amountForHumans() }}
                            </td>

                            <td class="whitespace-nowrap p-3 text-sm">
                                <div class="flex items-center justify-end">

                                {{-- <x-order.index.row-dropdown :$order /> --}}
                                <x-menu>
                                    <x-menu.button class="rounded hover:bg-gray-100">
                                        <x-icon.ellipsis-horizontal />
                                    </x-menu.button>
                                    <x-menu.items>
                                        <x-menu.item>
                                            some items
                                        </x-menu.item>
                                        <x-menu.item>
                                            some more
                                        </x-menu.item>
                                    </x-menu.items>
                                </x-menu>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div wire:loading.flex class="flex justify-center items-center absolute inset-0 ">
                <x-icon.spinner size="10" class="text-gray-500" />
            </div>
        </div>

        <div class="pt-4 flex justify-between items-center">
            <div class="text-gray-700 text-sm">
                Results: {{ \Illuminate\Support\Number::format($orders->total()) }}
            </div>

            {{ $orders->links('livewire.order.index.pagination') }}
        </div>
    </div>
</div>
</div>