@if(App::isLocale('en'))
    <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold  py-1 px-1 rounded ml-3 mr-3">
        <a href="/language/es">{{__('Spanish')}}</a>
    </button>
@else 
<button class="bg-blue-500 hover:bg-blue-700 text-white font-bold  py-1 px-1 rounded ml-3 mr-3">
    <a href="/language/en">{{__('English')}}</a>
</button>
@endif