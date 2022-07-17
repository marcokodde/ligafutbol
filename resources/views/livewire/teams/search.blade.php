<div class="grid grid-cols-4 gap-4">
    <div>
        <label class="block font-pop font-semibold text-normal">
            {{__('Search')}}
            <i class="mdi mdi-book-search-outline" style="font-size: 1.5rem;"></i>
        </label>
        @if (!$category_id && !$user_id)
            <div>
                <input class="form-control px-2 py-2 border border-blue-600"
                    wire:model="search"
                    placeholder="{{__($search_label)}}"
                >
            </div>
        @endif
    </div>
    @if (Auth::user()->IsAdmin())
        <div>
            <label class="font-pop font-semibold text-normal">{{__('Category')}}</label>
            <select class="block w-44 bg-white border border-white-200 text-gray-700 py-2 px-2 pr-6 mb-2 rounded leading-tight focus:outline-none focus:shadow-outline"
                wire:model="category_id"
                wire:change="read_teams()"
                >
                <option class="bg-white-200" value="">{{__('Category')}}</option>
                    @foreach($categories as $category)
                        <option class="block mt-0 text-lg leading-tight font-serif text-gray-900 hover:underline"
                            value="{{$category->id}}">
                                {{$category->name}}
                        </option>
                    @endforeach
            </select>
        </div>
        @if ($category_id)
            <div>
                <label class="font-pop font-semibold text-normal">{{__('Teams')}}</label>
                <select class="block w-44 bg-white border border-white-200 text-gray-700 py-2 px-2 pr-6 mb-2 rounded leading-tight focus:outline-none focus:shadow-outline"
                    wire:model="user_id"
                    wire:change="read_players()"
                    >
                    <option class="bg-white-200" value="">{{__('Team')}}</option>
                        @foreach($teams as $team)
                            <option class="block mt-0 text-lg leading-tight font-serif text-gray-900 hover:underline"
                                value="{{$team->id}}">
                                    {{$team->name}}
                            </option>
                        @endforeach
                </select>
            </div>
        @endif
    @endif
</div>