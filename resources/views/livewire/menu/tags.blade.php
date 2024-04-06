<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
            <div class="overflow-hidden rounded-lg border border-gray-200 shadow-md m-5">
                <div class="">
                    <div class="flex m-8">
                        @if ($editMode)
                        <form wire:submit.prevent="update" action="" class="w-full max-w-sm m-30">
                            <div class="flex items-center border-b border-indigo-500 py-2 mb-6">
                                <input wire:model='title' class="appearance-none bg-transparent border-none w-full text-gray-700 mr-3 py-1 px-2 leading-tight focus:outline-none" type="text" placeholder="Jane Doe" aria-label="Full name">
                                <button type="submit" class="flex-shrink-0 bg-indigo-500 hover:bg-indigo-700 border-teal-500 hover:border-teal-700 text-sm border-4 text-white py-1 px-2 rounded" type="button">
                                    Submit
                                </button>
                            </div>
                        </form>
                        @else
                        <form wire:submit.prevent="store" action="" class="w-full max-w-sm m-30">
                            <div class="flex items-center border-b border-indigo-500 py-2 mb-6">
                                <input wire:model='title' class="appearance-none bg-transparent border-none w-full text-gray-700 mr-3 py-1 px-2 leading-tight focus:outline-none" type="text" placeholder="Jane Doe" aria-label="Full name">
                                <button type="submit" class="flex-shrink-0 bg-indigo-500 hover:bg-indigo-700 border-indigo-500 hover:border-indigo-700 text-sm border-4 text-white py-1 px-2 rounded" type="button">
                                    Submit
                                </button>
                            </div>
                        </form>
                        @endif
                        <ul class="w-full max-w-md grid gap-4 mx-auto">
                            @foreach ($menuTags as $tag)
                            <li class="flex gap-2 dark:text-white items-center">
                                {{ $tag->title }}
                                {{-- <code class="bg-neutral-300 text-neutral-800 dark:bg-neutral-600 dark:text-neutral-300">{{ $tag->slug }}</code> --}}
                                <div class="flex-1"></div>
                                <div class="flex gap-2">
                                    <a wire:click.prevent='delete({{ $tag->id }})' x-data="" href="">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-6 w-6" x-tooltip="tooltip">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0"/>
                                        </svg>
                                    </a>
                                    <a wire:click.prevent='edit({{ $tag->id }})' x-data="" href="">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-6 w-6" x-tooltip="tooltip">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L6.832 19.82a4.5 4.5 0 01-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 011.13-1.897L16.863 4.487zm0 0L19.5 7.125"/>
                                        </svg>
                                    </a>
                                </div>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
