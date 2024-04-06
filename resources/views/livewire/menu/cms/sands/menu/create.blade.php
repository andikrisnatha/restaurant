<div class="relative z-10" aria-labelledby="modal-title" role="dialog" aria-modal="true">
    <div
    class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"
    x-transition:enter="ease-out duration-300"
    x-transition:enter-start="opacity-0"
    x-transition:enter-end="opacity-100"
    x-transition:leave="ease-in duration-200"
    x-transition:leave-start="opacity-100"
    x-transition:leave-end="opacity-0"
    ></div>

    <div class="fixed inset-0 z-10 overflow-y-auto">
        <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
            <div
            class="relative transform overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-2xl"
            x-transition:enter="ease-out duration-300"
            x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
            x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
            x-transition:leave="ease-in duration-200"
            x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
            x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
            >
            <div class="bg-white px-4 pb-4 pt-5 sm:p-6 sm:pb-4">
                <div class="">
                    <div class="mt-3 text-center sm:ml-4 sm:mt-0 sm:text-left">
                        <div class="flex justify-between mr-4">
                            <h3 class="text-base font-semibold leading-6 text-gray-900" id="modal-title">New Item</h3>
                            <button wire:click.prevent='closeModal' type="button" class="bg-white rounded-md p-2 inline-flex items-center justify-center text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-indigo-500">
                                <span class="sr-only">Close menu</span>
                                <!-- Heroicon name: outline/x -->
                                <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </div>                        <div class="mt-2">
                            <form class="">
                                <div class="flex flex-wrap -mx-3 mb-6">
                                    <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-1" for="grid-first-name">
                                            Main title
                                        </label>
                                        <input wire:model="main_title" name="main_title" id="main_title" placeholder="Nasi Goreng"  class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white">
                                        @error('main_title')
                                        <p class="text-red-500 text-xs italic">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-1" for="grid-last-name">
                                            Category
                                        </label>
                                        <div class="mt-2">
                                            <select wire:model="category_sands_id" id="category_sands_id" name="category_sands_id" autocomplete="category_sands_id" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white">
                                                <option>Select One</option>
                                                @foreach ($categories as $category)
                                                <option value="{{ $category->id }}">{{ $category->description }}</option>
                                                @endforeach
                                            </select>
                                            @error('category_sands_id')
                                            <p class="text-red-500 text-xs italic">{{ $message }}</p>
                                            @enderror

                                        </div>
                                    </div>
                                </div>
                                <div class="flex flex-wrap -mx-3">
                                    <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-1" for="title_1">
                                            Title 1
                                        </label>
                                        <input wire:model="title_1" type="text" name="title_1" id="title_1"  class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white">
                                    </div>
                                    <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-1" for="price_1">
                                            Price 1
                                        </label>
                                        <input wire:model="price_1" type="number" name="price_1" id="price_1"  class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white">
                                        @error('price_1')
                                        <p class="text-red-500 text-xs italic">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="flex flex-wrap -mx-3 ">
                                    <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-1" for="title_2">
                                            Title 2
                                        </label>
                                        <input wire:model="title_2" type="text" name="title_2" id="title_2"  class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white">
                                    </div>
                                    <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-1" for="price_2">
                                            Price 2
                                        </label>
                                        <input wire:model="price_2" type="number" name="price_2" id="price_2"  class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white">
                                    </div>
                                </div>
                                <div class="flex flex-wrap -mx-3 ">
                                    <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-1" for="title_3">
                                            Title 3
                                        </label>
                                        <input wire:model="title_3" type="text" name="title_3" id="title_3"  class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white">
                                    </div>
                                    <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-1" for="price_3">
                                            Price 3
                                        </label>
                                        <input wire:model="price_3" type="number" name="price_3" id="price_3"  class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white">
                                    </div>
                                </div>
                                <div class="flex flex-wrap -mx-3 ">
                                    <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-1" for="title_4">
                                            Title 4
                                        </label>
                                        <input wire:model="title_4" type="text" name="title_4" id="title_4"  class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white">
                                    </div>
                                    <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-1" for="price_4">
                                            Price 4
                                        </label>
                                        <input wire:model="price_4" type="number" name="price_4" id="price_4"  class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white">
                                        {{-- <p class="text-red-500 text-xs italic">Please fill out this field.</p> --}}
                                    </div>
                                </div>
                                <div class="flex flex-wrap -mx-3 mb-6">
                                    <div class="w-full px-3">
                                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-1" for="description">
                                            Description
                                        </label>
                                        <textarea wire:model="description" name="description" id="description" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-1 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"type="text"></textarea>
                                        @error('description')
                                        <p class="text-red-500 text-xs italic">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="flex flex-wrap -mx-3 mb-6">
                                    <div class="w-full px-3">
                                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-1" for="video_url">
                                            Video URL
                                        </label>
                                        <input wire:model='video_url' name="video_url" id="video_url" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                                    </div>
                                </div>
                                <div class="mb-2">
                                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-1" for="file_input">Upload file</label>
                                    <input wire:model='image' class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none" id="file_input" type="file">
                                    @error('image')
                                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                                    @enderror
                                </div>


                                <div wire:ignore class="mb-6">
                                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-1" for="grid-city">
                                        Tag
                                    </label>
                                    <x-input.select wire:model="tag_ids" prettyname="menu_tag" :options="$tags" optionKey="id" :selected="$selected_tags" optionLabel="title"/>
                                </div>
                                <div class="flex flex-wrap -mx-3 mb-2">
                                    <div class="w-full px-3">
                                        <label for="countries" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Set the menu live?</label>
                                        <select wire:model='status' id="countries" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                            <option disable>---Select One---</option>
                                            <option value='0'>Later</option>
                                            <option Value='1'>Now</option>
                                        </select>
                                        @error('status')
                                        <p class="text-red-500 text-xs italic">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="bg-gray-50 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6">
                <button wire:click.prevent='store' type="submit" class="inline-flex w-full justify-center rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 sm:ml-3 sm:w-auto">Submit</button>
                <button wire:click.prevent='closeModal' type="button" class="mt-3 inline-flex w-full justify-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 sm:mt-0 sm:w-auto">Cancel</button>
            </div>
        </div>
    </div>
</div>
