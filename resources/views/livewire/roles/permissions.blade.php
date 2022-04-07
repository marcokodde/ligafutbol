@include('common.crud_header')
<div class="py-4 px-4">
    @include('common.crud_message')
        <div class="mb-2">
            <div class="col-span-3 sm:col-span-2 md:col-span-3 lg:col-span-4 xl:col-span-3">
                <select wire:model="role_id"
                    wire:change="read_role()"
                    class="w-56 bg-white border rounded-b-lg border-white-200 text-gray-700 py-1 px-4 pr-8 mb-4 rounded leading-tight focus:outline-none focus:shadow-outline mx-2">
                        <option class="block mt-0 text-lg leading-tight font-serif text-gray-900 hover:underline" value="">{{__('Select Role')}}</option>
                        @foreach($roles as $record_role)
                            <option class="block mt-0 text-lg leading-tight font-serif text-gray-900 hover:underline"
                                    value="{{$record_role->id}}">
                                    @if(App::isLocale('en'))
                                        {{$record_role->english}}
                                    @else
                                        {{$record_role->spanish}}
                                    @endif

                            </option>
                        @endforeach
                    </select>
                    @if($role)
                        <div class="inline">
                            <input type="text"
                            wire:model="search"
                            placeholder="{{__($search_label)}}"
                            class="inline w-1/4 shadow appearance-none border rounded  py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                            >
                        </div>
                    @endif
                </div>
            </div>
            @if($role)
                <div class="mx-4 px-4">
                    @include('common.read_only_linked_records')
                </div>
                <div class="grid grid-cols-2 gap-2 mt-4">
                    <div class="col-span-6 sm:col-span-2 md:col-span-6 lg:col-span-4 xl:col-span-2">
                        <table>
                            <thead>
                                <tr class="bg-gray-100">
                                    <th class="px-2 py-1 w-72">{{__("Description")}}</th>
                                    <th class="px-2 py-1 text-center w-28">{{__("Action")}}</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach($records as $record)
                                <tr>
                                    <td class="border leading-relaxed sm:text-base md:text-xl xl:text-base text-gray-600 px-2 py-1 text-left w-auto">
                                        @if(App::isLocale('en'))
                                            {{ $record->english}}
                                        @else
                                            {{ $record->spanish}}
                                        @endif

                                    </td>
                                    <td class="border leading-tight font-semibold text-gray-900 hover:underline px-2 py-1 text-center w-32">
                                        @if($record->hasrole($role->id))
                                            <button wire:click="unlinkRecord({{ $record->id }})" class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-2 rounded-lg text-center">{{__("Remove")}}</button>
                                        @else
                                            <button wire:click="linkRecord({{ $record->id }})" class="bg-indigo-500 hover:bg-indigo-900 text-white font-bold py-1 px-2 rounded-lg text-center">{{__("To Assign")}}</button>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        @include('common.pagination')
                    </div>
                </div>
            @endif

        </div>
    </div>
</div>
