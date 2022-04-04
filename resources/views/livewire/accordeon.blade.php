@include('common.crud_header')
<div>
    @foreach($boards as $board)
        <div class="overflow-hidden border-t">
            <label>
                <input class="absolute opacity-0 peer" type="checkbox" name="" id="">
                <p class="p-5 inline-block">{{$board->title}}</p>
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 inline-block float-right mr-20 mt-5 border-2 rounded-full" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                </svg>
                @foreach($board->groups as $group)
                    <div class="bg-gray-300 max-h-0 peer-checked:max-h-screen">
                            <p class="p-5">{{$group->id . '=' . $group->title}}</p>
                    </div>
                @endforeach
            </label>
        </div>
    @endforeach
</div>
<script src="https://unpkg.com/tailwindcss-jit-cdn"></script>
