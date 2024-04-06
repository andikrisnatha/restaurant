<div class="mx-6 theme-{{ $theme }}">
    {{-- nav --}}
    <nav class="bg-white border-gray-200 sticky top-0 z-50">
        <div class="max-w-screen-xl flex flex-wrap items-center justify-between p-4">
                <div class="flex gap-4 w-full sm:w-auto">
                    <img src="{{ asset('img/logo/' . $logo . '.svg') }}" class="h-8">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                        <span class="sr-only">Search icon</span>
                    </div>
                    <input wire:model.debounce.200ms='search' type="text" class="block w-full text-sm text-slate-800 border border-gray-300 rounded-lg bg-gray-50 focus:ring-brand-border focus:border-brand-border dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" placeholder="try: low calories...">
                </div>
        </div>
    </nav>

    @include('livewire.menu.component.slider')

    {{-- Category Tab section --}}
    @if (!$search)
    <div class="flex flex-wrap max-w-md mx-auto justify-center" aria-label="Tabs" role="tablist">
        @foreach ($categories as $category)
        <button  type="button" class="border m-1 border-brand-border hover:bg-brand-background hover:text-brand-text active:bg-brand-background active:text-brand-text  rounded-full text-sm px-4 py-1 inline-block" id="menu-item-{{ $category->id }}" data-hs-tab="#menu-{{ $category->id }}" aria-controls="menu-{{ $category->id }}" role="tab">
            {{ $category->description }}
        </button>
        @endforeach
    </div>
    @endif
    @if ($search)
    <div class="flex flex-col max-w-md mx-auto justify-center" aria-label="Tabs" role="tablist">
        <em class="text-gray-500 ml-3">Showing result for:</em>
        <button  type="button" class="flex justify-between border m-1 border-brand-border hover:bg-brand-background hover:text-brand-text active:bg-brand-background active:text-brand-text  rounded-full text-sm px-4 py-1 mb-4">
            <span>{{$search}}</span>
            <span><a wire:click.prevent='clearSearch' class="text-gray-300">X</a></span>
        </button>
    </div>
    @endif

    {{-- menus --}}
    <div class="mt-3">
        @foreach ($categories as $category)
        <div id="menu-{{ $category->id }}" role="tabpanel" aria-labelledby="menu-item-{{ $category->id }}">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10 mt-12">
                @foreach ($category->menus as $menu)
                <div class="mx-3 bg-white border border-gray-100 transition transform duration-700 hover:shadow-xl hover:shadow-brand-background/30 hover:scale-105 p-4 rounded-lg relative">
                    <div class="absolute top-0 left-0">
                        <div class="flex gap-2 p-4">
                            @foreach ($menu->tags as $tag)
                            @if ($tag->title == 'top-pick')
                            <img src="{{ asset('img/logo/top_pick.svg') }}" alt="" class="w-10">
                            @endif
                            @endforeach
                        </div>
                    </div>
                    <img class="{{ $menu->image == true ? 'w-64 h-64 object-cover rounded-full' : 'w-32 h-32 object-contain rounded-lg' }} mx-auto transform transition duration-300 hover:scale-105"
                    src="
                    @if($menu->image)
                    {{ asset('storage/menu/' . $menu->image) }}
                    @else

                        @if (Route::currentRouteName() == 'sands.frontend')
                        {{ asset('img/logo/sands.svg') }}
                        @endif
                        @if (Route::currentRouteName() == 'kunyit.frontend')
                        {{ asset('img/logo/kunyit.svg') }}
                        @endif

                    @endif "
                    alt="{{ $menu->main_title }}" />
                    <div class="flex flex-col items-center my-3 space-y-2">
                        <div class="space-y-1">
                            <h1 class="text-gray-900 poppins text-lg font-semibold">{{ $menu->main_title }}</h1>
                            <div class="flex justify-center mx-auto">
                                @foreach ($menu->tags as $tag)
                                @if ($tag->title == 'pork')
                                <img src="{{ asset('img/logo/pork.svg') }}" alt="" class="w-8">
                                @endif
                                @if ($tag->title == 'vegetarian')
                                <img src="{{ asset('img/logo/vegetarian.svg') }}" alt="" class="w-8">
                                @endif
                                @if ($tag->title == 'gluten-free')
                                <img src="{{ asset('img/logo/glutten_free.svg') }}" alt="" class="w-8">
                                @endif
                                @if ($tag->title == 'spicy')
                                <img src="{{ asset('img/logo/Icons_Spicy.svg') }}" alt="" class="w-8">
                                @endif
                                @endforeach
                            </div>
                        </div>
                        <p class="text-gray-500 poppins text-sm text-center">{{ $menu->description }}</p>
                        @if (!$menu->title_1)
                        <div class="text-gray-900 poppins text-sm font-semibold">
                            IDR {{ number_format($menu->price_1, 0, '.', ',') }}
                        </div>
                        @else
                        <div class="text-sm text-slate-900 font-semibold text-center">
                            <ul class="list-none">
                                <li>{{ $menu->title_1 }} at IDR {{ number_format($menu->price_1, 0, '.', ',')  }}</li>
                                @if ($menu->title_2)
                                <li>{{ $menu->title_2 }} at IDR {{ number_format($menu->price_2, 0, '.', ',')  }}</li>
                                @endif
                                @if ($menu->title_3)
                                <li>{{ $menu->title_3 }} at IDR {{ number_format($menu->price_3, 0, '.', ',')  }}</li>
                                @endif
                                @if ($menu->title_4)
                                <li>{{ $menu->title_4 }} at IDR {{ number_format($menu->price_4, 0, '.', ',')  }}</li>
                                @endif
                            </ul>
                        </div>
                        @endif
                        @if ($menu->video_url)
                        <a target="_blank" href="{{ $menu->video_url }}" class="flex flex-row items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.91 11.672a.375.375 0 010 .656l-5.603 3.113a.375.375 0 01-.557-.328V8.887c0-.286.307-.466.557-.327l5.603 3.112z" />
                            </svg>
                            <span class=" text-gray-500 text-sm"> Click here to see how the food is prepared</span>
                        </a>
                        @endif
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @endforeach
    </div>
</div>
