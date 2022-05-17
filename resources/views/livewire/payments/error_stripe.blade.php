<div>
    <div class="mx-auto text-center p-4">
        <label for="error" class="text-5xl font-pop font-bold text-red-600 uppercase">
            {{__('Error processing payment')}}
        </label>
    </div>
    <div class="mx-auto text-center p-4">
        <h3 class="text-3xl font-pop font-extrabold text-red-600">{{$error_exception}}</h3>
    </div>

    <div class="mx-auto text-center items-center p-4">
        <h1 class="text-xl font-pop font-semibold">{{__('Enter the system to make your payment')}}</h1>

        <button  style="background-color:rgba(31,41,55,var(--tw-bg-opacity))"
            class="px-12 py-2 m-4 font-semibold text-sm text-white rounded-md shadow-sm ring-1 ring-slate-900/5 border-indigo-500 border-2 border-solid hover:text-blue-500">
            <a href="{{ route('login') }}">{{__('Login')}}</a>
        </button>
    </div>
</div>