@if (session()->has('message'))
    <div class="bg-teal-100 border-t-4 border-teal-500 rounded-b text-teal-900 px-4 py-3 shadow-md my-3" role="alert">
    <div class="flex">
        <div>
            @if($member_expired)
                <p class="text-sm bg-red-600">{{ session('message') }}</p>
            @else
                <p class="text-sm">{{ session('message') }}</p>
            @endif
        
        </div>
    </div>
    </div>
@endif
