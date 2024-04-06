@if (Route::currentRouteName() == 'sands.frontend')
<button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full fixed bottom-6 right-6 shadow-md shadow-neutral-500">
    <a href="{{ route('beverage.frontend') }}">Beverage List</a>
</button>
@endif
@if (Route::currentRouteName() == 'kunyit.frontend')
<button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full fixed bottom-6 right-6 shadow-md shadow-neutral-500">
    <a href="{{ route('beverage.frontend') }}">Beverage List</a>
</button>
@endif
@if (Route::currentRouteName() == 'beverage.frontend')
<div class="fixed bottom-6 right-6 flex flex-col items-end">
    <button class="shadow-md shadow-neutral-500 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full mb-2">
        <a href="{{ route('sands.frontend') }}">Sands Menu</a>
    </button>
    <button class="shadow-md shadow-neutral-500 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full mb-2">
        <a href="{{ route('kunyit.frontend') }}">Kunyit Menu</a>
    </button>
</div>
@endif
