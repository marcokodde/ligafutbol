
@if($error_message)
    <div class="bg-teal-100 border-t-4 border-teal-500 rounded-b text-teal-900 px-2 py-2 shadow-md my-3" role="alert">
        <div class="flex justify-center">
            <p class="font-bold text-red-600"> {{ $error_message}}</p>
        </div>
    </div>
@endif

@if(session()->has('message'))
    <div class="flex justify-center bg-teal-100 border-t-4 border-teal-500 rounded-b text-teal-900 px-2 py-2 shadow-md my-3" role="alert">
        <p class="font-bold text-xl text-green-400"> {{ session('message') }}</p>
    </div>
@endif

