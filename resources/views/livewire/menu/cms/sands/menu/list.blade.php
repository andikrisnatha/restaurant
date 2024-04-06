<div class="">
    @if ($isModalOpen)
    @include('livewire.menu.cms.sands.menu.create')
    @endif
    <div>
        <div class="flex justify-end mx-6 gap-4">
            @if (Auth::check() && Auth::user()->email === 'marcom@anvaya.com')
            <button wire:click.prevent='openModal' type="button" class="h-11 px-6 font-semibold rounded-md border border-slate-200 text-slate-900 hover:text-white hover:bg-slate-900">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                </svg>
            </button>
            @endif
            <div class="group relative">
                <svg width="20" height="20" fill="currentColor" class="absolute left-3 top-1/2 -mt-2.5 text-slate-400 pointer-events-none group-focus-within:text-blue-500" aria-hidden="true">
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" />
                </svg>
                <input wire:model.debounce.200ms='search' class="focus:ring-2 focus:ring-blue-500 focus:outline-none appearance-none w-full text-sm leading-6 text-slate-900 placeholder-slate-400 rounded-md py-2 pl-10 ring-1 ring-slate-200 shadow-sm" type="text" aria-label="Filter projects" placeholder="Filter Menu...">
            </div>
        </div>
        <div class="-mt-3">
            @foreach ($menus as $menu)
            <div class="overflow-hidden rounded-lg border border-gray-200 shadow-md m-5">
                <div class="flex font-sans">
                    <div class="flex-none w-48 relative">
                        <img
                        src="@if ($menu->image) {{ asset('storage/menu/' . $menu->image) }} @else https://source.unsplash.com/featured/?food @endif"
                        alt="{{ $menu->main_title }}"
                        class="absolute inset-0 w-full h-full object-cover {{ $menu->status == 1 ? '' : 'grayscale blur-sm' }} {{ $menu->image ? '' : 'blur-lg' }}" loading="lazy" />
                    </div>
                    <div class="flex-auto p-6">
                        <div class="flex flex-wrap">
                            <div class="flex flex-auto justify-between">
                                <div>
                                    <h1 class="flex-start text-lg font-semibold text-slate-900 truncate">
                                        {{ Str::limit($menu->main_title, 20) }}
                                    </h1>
                                    <div class="w-full flex-none text-sm font-medium text-slate-700 mt-2">
                                        @if ($menu->status == 1)
                                        <span class="inline-flex items-center gap-1 rounded-full bg-green-50 px-2 py-1 text-xs font-semibold text-green-600">
                                            <span class="h-1.5 w-1.5 rounded-full bg-green-600"></span>
                                            Available
                                        </span>
                                        @else
                                        <span class="inline-flex items-center gap-1 rounded-full bg-red-50 px-2 py-1 text-xs font-semibold text-red-600">
                                            <span class="h-1.5 w-1.5 rounded-full bg-red-600"></span>
                                            not-available
                                        </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="flex">
                                @if (!$menu->title_1)
                                <div class="text-lg font-semibold text-slate-500">
                                    {{ number_format($menu->price_1 / 1000, 0, '.', ',') }}K
                                </div>
                                @else
                                <div class="text-sm text-slate-500 text-right">
                                    <ul class="list-none">
                                        <li>{{ Str::limit($menu->title_1, 10) }} > {{ number_format($menu->price_1 / 1000, 0, '.', ',')  }}K</li>
                                        @if ($menu->title_2)
                                        <li>{{ Str::limit($menu->title_2, 10) }} > {{ number_format($menu->price_2 / 1000, 0, '.', ',')  }}K</li>
                                        @endif
                                        @if ($menu->title_3)
                                        <li>{{ Str::limit($menu->title_3, 10) }} > {{ number_format($menu->price_3 / 1000, 0, '.', ',')  }}K</li>
                                        @endif
                                        @if ($menu->title_4)
                                        <li>{{ Str::limit($menu->title_4, 10) }} > {{ number_format($menu->price_4 / 1000, 0, '.', ',')  }}K</li>
                                        @endif
                                    </ul>
                                </div>
                                @endif
                            </div>
                        </div>
                        <div class="flex items-baseline mt-4 mb-6 pb-6 border-b border-slate-200">
                            <div class="space-x-2 flex text-sm">
                                <ul class="list-none flex gap-2">
                                    <li>TAGS: </li>
                                    @foreach ($menu->tags as $tag)
                                    <li class="w-20 truncate text-xs bg-slate-600 text-white py-1 px-2 rounded">{{ $tag->title }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        <div class="flex space-x-4 mb-6 text-sm font-medium">
                            @if (Auth::check() && Auth::user()->email === 'marcom@anvaya.com')
                            <div class="flex-auto flex space-x-4">
                                <button wire:click.prevent='edit({{ $menu->id }})' class="h-10 px-6 font-semibold rounded-md border border-slate-200 text-slate-900 hover:text-white hover:bg-slate-900" type="button">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5">
                                        <path d="M2.695 14.763l-1.262 3.154a.5.5 0 00.65.65l3.155-1.262a4 4 0 001.343-.885L17.5 5.5a2.121 2.121 0 00-3-3L3.58 13.42a4 4 0 00-.885 1.343z" />
                                    </svg>
                                </button>
                                {{-- <button wire:click.prevent='delete({{ $menu->id }})' class="h-10 px-6 font-semibold rounded-md border border-slate-200 text-slate-900 hover:text-white hover:bg-slate-900" type="button">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5">
                                        <path fill-rule="evenodd" d="M8.75 1A2.75 2.75 0 006 3.75v.443c-.795.077-1.584.176-2.365.298a.75.75 0 10.23 1.482l.149-.022.841 10.518A2.75 2.75 0 007.596 19h4.807a2.75 2.75 0 002.742-2.53l.841-10.52.149.023a.75.75 0 00.23-1.482A41.03 41.03 0 0014 4.193V3.75A2.75 2.75 0 0011.25 1h-2.5zM10 4c.84 0 1.673.025 2.5.075V3.75c0-.69-.56-1.25-1.25-1.25h-2.5c-.69 0-1.25.56-1.25 1.25v.325C8.327 4.025 9.16 4 10 4zM8.58 7.72a.75.75 0 00-1.5.06l.3 7.5a.75.75 0 101.5-.06l-.3-7.5zm4.34.06a.75.75 0 10-1.5-.06l-.3 7.5a.75.75 0 101.5.06l.3-7.5z" clip-rule="evenodd" />
                                    </svg>
                                </button> --}}
                            </div>
                            @endif

                            <div class="relative inline-block w-10 mr-9 align-middle select-none transition duration-200 ease-in">
                                <input {{ $menu->status == 1 ? 'checked' : '' }} wire:change='updateSelectedMenuStatus({{ $menu->id }})' type="checkbox" name="toggle" id="toggle" class="toggle-checkbox absolute block w-6 h-6 rounded-full bg-white border-4 appearance-none cursor-pointer"/>
                                <label for="toggle" class="toggle-label block overflow-hidden h-6 rounded-full bg-gray-300 cursor-pointer"></label>
                            </div>
                        </div>
                        <p class="text-sm text-slate-700">
                            {{ $menu->description }}
                        </p>
                    </div>
                </div>
            </div>
            @endforeach
            <div class="m-5">{{ $menus->links() }}</div>
        </div>
    </div>
</div>
