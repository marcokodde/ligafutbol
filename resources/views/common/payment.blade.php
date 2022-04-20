@if (Auth::user()->teams->count())
    <div>
        <button style="background-color: #d3f347" class="px-4 py-2 m-4 font-bold text-base text-black rounded-md shadow-sm ring-1 ring-slate-900/5 border-black border-2 border-solid hover:text-white" title="Payment">
            <a href="{{ url("payments") }}">
                <p class="cursor-pointer inline-block">{{__('Check Out')}}</p>
            </a>
        </button>
    </div>
@endif

