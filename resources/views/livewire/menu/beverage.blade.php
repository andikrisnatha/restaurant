<div class="mx-6 relative">
    {{-- nav --}}
    <nav class="bg-white border-gray-200 sticky top-0 z-50">
        <div class="max-w-screen-xl flex flex-wrap items-center justify-between p-4">
            <div class="flex gap-4 w-full sm:w-auto">
                <img src="{{ asset('img/logo/kunyit.svg') }}" class="h-8">
                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                    <span class="sr-only">Search icon</span>
                </div>
                <input wire:model.debounce.200ms='search' type="text" class="block w-full text-sm text-slate-800 border border-gray-300 rounded-lg bg-gray-50 focus:ring-brand-border focus:border-brand-border dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" placeholder="try: low calories...">
            </div>
        </div>
    </nav>
    
    {{-- @include('livewire.menu.component.slider') --}}
    
    {{-- Category Tab section --}}
    
    <div class="flex flex-wrap max-w-md mx-auto justify-center" aria-label="Tabs" role="tablist">
        @foreach ($categories as $category)
        <button id="menu-item-{{ $category->id }}" data-hs-tab="#menu-{{ $category->id }}" aria-controls="menu-{{ $category->id }}"  type="button" class="border m-1 border-brand-border hover:bg-brand-background hover:text-brand-text active:bg-brand-background active:text-brand-text  rounded-full text-sm px-4 py-1 inline-block" role="tab">
            {{ $category->description }}
        </button>
        @endforeach
    </div>
    
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
    <div class="mt-3 mx-12">
        <ul role="list" class="divide-y divide-gray-100">
            @foreach ($categories as $category)
            <div id="menu-{{ $category->id }}" role="tabpanel" aria-labelledby="menu-item-{{ $category->id }}">
                @foreach ($category->beverages as $bev)
                <li class="flex justify-between gap-x-6 py-5" id="">
                    <div class="flex min-w-0 gap-x-4">
                        <img class="h-12 w-12 flex-none rounded-full bg-gray-50" src="{{ $bev->image == true ?  'storage/menu/'. $bev->image : 'https://plus.unsplash.com/premium_photo-1679397829259-5cd327e1e467?w=600&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MXx8Y29ja3RhaWxzfGVufDB8fDB8fHww'}}" alt="">
                        <div class="min-w-0 flex-auto">
                            <p class="text-sm font-semibold leading-6 text-gray-900">{{ $bev->main_title }}</p>
                            <p class="truncate text-xs leading-5 text-gray-500">{{ $bev->description }}</p>
                        </div>
                    </div>
                    <div class="shrink-0 sm:flex sm:flex-col sm:items-end">
                        <p class="text-sm leading-6 text-gray-900">IDR {{ number_format($bev->price_glass, 0, '.', ',') }}  / glass</p>
                        @if ($bev->price_bottle)
                        <p class="text-xs leading-5 text-gray-500">IDR {{ number_format($bev->price_bottle, 0, '.', ',') }}  / bottle</p>
                        @endif
                    </div>
                </li>
            </div>      
            @endforeach
            @endforeach
        </ul>
    </div>

</div>
