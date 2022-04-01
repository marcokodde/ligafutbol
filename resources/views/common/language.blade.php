@if(App::isLocale('en'))
    <button class="px-4 py-2 font-semibold text-sm bg-white text-slate-700  rounded-md shadow-sm ring-1 ring-slate-900/5 border-indigo-500 border-2 border-solid hover:text-blue-500" title="Change Languaje">
        <a href="/language/es">{{__('Spanish')}}</a>
    </button>
@else
    <button class="px-4 py-2 font-semibold text-sm bg-white text-slate-700  rounded-md shadow-sm ring-1 ring-slate-900/5 border-green-500 border-2 border-solid hover:text-green-500" title="Cambiar Lenguaje">
        <a href="/language/en">{{__('English')}}</a>
    </button>
@endif