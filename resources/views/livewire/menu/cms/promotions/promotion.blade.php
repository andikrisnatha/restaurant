<div class="py-12">
    @if ($isModalOpen)
    @include('livewire.menu.cms.promotions.createpromotion')
    @endif
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
            <div class="overflow-hidden rounded-lg border border-gray-200 shadow-md m-5">
                <div class="m-5 flex flex-row-reverse space-x-2">
                    <div>
                        <input wire:model.debounce.200ms='search' type="text" class="mx-3 border border-slate-400 rounded-lg text-gray-600 focus:ring-slate-500" placeholder="search...">
                        <button wire:click.prevent="openModal" class="bg-slate-500 hover:bg-slate-700 text-white font-bold py-2 px-4 rounded-lg">
                            New Item
                        </button>
                    </div>
                </div>
                <table class="w-full border-collapse bg-white text-left text-sm text-gray-500">
                    <thead class="bg-gray-50 uppercase">
                        <tr>
                            <th scope="col" class="px-6 py-4 font-medium text-gray-900">No</th>
                            <th scope="col" class="px-6 py-4 font-medium text-gray-900">title</th>
                            <th scope="col" class="px-6 py-4 font-medium text-gray-900">Price</th>
                            <th scope="col" class="px-6 py-4 font-medium text-gray-900">Status</th>
                            <th scope="col" class="px-6 py-4 font-medium text-gray-900"></th>
                            <th scope="col" class="px-6 py-4 font-medium text-gray-900">Action</th>
                            <th scope="col" class="px-6 py-4 font-medium text-gray-900"></th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 border-t border-gray-100">
                        @foreach ($promotions as $promotion)
                        <td class="px-6 py-4">{{ $loop->iteration }}</
                            <tr class="hover:bg-gray-50">
                                <th class="flex gap-3 px-6 py-4 font-normal text-gray-900">
                                    <div class="relative h-10 w-10">
                                        <img class="h-full w-full rounded-full object-cover object-center" src="{{ asset('storage/menu/promotion/' . $promotion->image) }}" alt="" />
                                        <span class="absolute right-0 bottom-0 h-2 w-2 rounded-full {{ $promotion->status == 1 ? 'bg-green-400' : 'bg-red-400' }} ring ring-white"></span>
                                    </div>
                                    <div class="text-sm">
                                        <div class="font-medium text-gray-700">{{ Str::limit($promotion->title, 30, '...') }}</div>
                                        <div class="text-gray-400">{{ Str::limit($promotion->description, 25, '...') }}</div>
                                    </div>
                                </th>
                                <td class="px-6 py-4">
                                    <p>{{ $promotion->price }}</p>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex gap-2">
                                        @if ($promotion->status == 1)
                                        <span class="inline-flex items-center gap-1 rounded-full bg-green-50 px-2 py-1 text-xs font-semibold text-green-600">
                                            <span class="h-1.5 w-1.5 rounded-full bg-green-600"></span>
                                            Running
                                        </span>
                                        @else
                                        <span class="inline-flex items-center gap-1 rounded-full bg-yellow-50 px-2 py-1 text-xs font-semibold text-yellow-600">
                                            <span class="h-1.5 w-1.5 rounded-full bg-yellow-600"></span>
                                            Paused
                                        </span>
                                        @endif
                                    </div>
                                </td>
                                <td>
                                    <div class="relative inline-block w-10 mr-2 align-middle select-none transition duration-200 ease-in">
                                        <input {{ $promotion->status == 1 ? 'checked' : '' }} wire:change='updateSelectedPromotionStatus({{ $promotion->id }})' type="checkbox" name="toggle" id="toggle" class="toggle-checkbox absolute block w-6 h-6 rounded-full bg-white border-4 appearance-none cursor-pointer"/>
                                        <label for="toggle" class="toggle-label block overflow-hidden h-6 rounded-full bg-gray-300 cursor-pointer"></label>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex justify-end gap-4">
                                        <a wire:click.prevent='delete({{ $promotion->id }})' x-data="" href="">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-6 w-6" x-tooltip="tooltip">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0"/>
                                            </svg>
                                        </a>
                                        <a wire:click.prevent='edit({{ $promotion->id }})' x-data="" href="">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-6 w-6" x-tooltip="tooltip">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L6.832 19.82a4.5 4.5 0 01-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 011.13-1.897L16.863 4.487zm0 0L19.5 7.125"/>
                                            </svg>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                        {{ $promotions->links() }}
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>


