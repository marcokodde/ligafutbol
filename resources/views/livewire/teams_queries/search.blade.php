
    <div class="w-max text-center flex justify-between">
            <!-- Categoría -->
        <div class="w-auto md:w-1/6 mx-1">
            <label  class="text-gray-700 text-sm font-bold">{{__("Category")}}</label>
            <select wire:model="category_id"
                    wire:change="read_category"
                    class="block w-40 bg-white border border-white-200 text-gray-700 py-2 px-2 pr-6 mb-2 rounded leading-tight focus:outline-none focus:shadow-outline"

            >
                <option class="bg-white-200" value="">{{__('Category')}}</option>
                    @foreach($categories as $category_search)
                        <option class="block mt-0 text-lg leading-tight font-serif text-gray-900 hover:underline"
                            value="{{$category_search->id}}">
                                {{$category_search->name}}
                        </option>
                    @endforeach
            </select>
        </div>
        @if($category)
            <div>
                <label  class="text-gray-700 text-sm font-bold">
                    {{ __("Total Teams")        . '='  . $category->teams_categories->sum('qty_teams')  . ' ' .
                    __("Registered Teams")   . '='  . $category->teams_categories->sum('registered_teams')
                    }}
            </label>
            </div>
        @endif
    </div>

