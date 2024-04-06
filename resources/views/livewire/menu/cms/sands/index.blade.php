<div class="py-12">

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
            <div class="flex flex-row m-5 uppercase">
                <button wire:click.prevent='openMenu' class="{{ $isMenu ? 'h-10 px-6 font-semibold rounded-md border text-white bg-slate-900' : 'text-gray-400' }}  py-2 px-4 mr-3 uppercase">
                    Menu
                </button>
                <button wire:click.prevent='openBoard' class="{{ $isBoard ? 'h-10 px-6 font-semibold rounded-md border text-white bg-slate-900' : 'text-gray-400' }}  py-2 px-4 mr-3 uppercase">
                    Board
                </button>
                @if (Auth::check() && Auth::user()->email === 'marcom@anvaya.com')
                <button wire:click.prevent='openCategory' class="{{ $isCategory ? 'h-10 px-6 font-semibold rounded-md border text-white bg-slate-900' : 'text-gray-400' }}  py-2 px-4 mr-3 uppercase">
                    Category
                </button>
                @endif
                @if (session()->has('message'))
                <div  id="messageContainer" x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 3000)" class="flex items-center transition-opacity duration-500 ease-out">
                    <span class="text-green-500 font-bold text-lg border rounded-full border-green-500">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                          </svg>
                    </span>
                </div>
                @endif
            </div>
            @if($isMenu)
            @include('livewire.menu.cms.sands.menu.list')
            @endif
            @if ($isCategory)
                <livewire:menu.cms.sands.category>
            @endif
            @if ($isBoard)
                @include('livewire.menu.cms.sands.board.board')
            @endif
        </div>
    </div>
</div>

