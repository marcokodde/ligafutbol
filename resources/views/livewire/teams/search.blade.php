<div class="grid grid-cols-4 gap-4">
    <div>
        <label class="block font-semibold font-pop text-normal">
            {{__('Search')}}
            <i class="mdi mdi-book-search-outline" style="font-size: 1.5rem;"></i>
        </label>
        @if (!$category_id && !$user_id)
            <div>
                <input class="px-2 py-2 border border-blue-600 form-control"
                    wire:model="search"
                    placeholder="{{__($search_label)}}"
                >
            </div>
        @endif
    </div>
    @if ($categories->count() > 1 && Auth::user()->IsAdmin())
        <div>
            <label class="font-semibold font-pop text-normal">{{__('Category')}}</label>
            <select class="block px-2 py-2 pr-6 mb-2 leading-tight text-gray-700 bg-white border rounded w-44 border-white-200 focus:outline-none focus:shadow-outline"
                wire:model="category_id"
                wire:change="read_teams()"
                >
                <option class="bg-white-200" value="">{{__('Category')}}</option>
                    @foreach($categories as $category)
                        <option class="block mt-0 font-serif text-lg leading-tight text-gray-900 hover:underline"
                            value="{{$category->id}}">
                                {{$category->name}}
                        </option>
                    @endforeach
            </select>
        </div>
    @endif
</div>
