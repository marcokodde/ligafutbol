
<div class="bd-example bd-example-modal">
    <div class="md:rounded block bg-white border border-gray-100">
        <div class="hola mundo">
            <div class="flex items-center flex-col justify-center overflow-hidden fixed inset-0 z-50" style="">
                <div class="absolute inset-0 bg-gradient-to-tr opacity-90 dark:from-gray-700 from-gray-700 via-gray-900 to-gray-700">
                </div>
                <div class="md:rounded flex bg-white border border-gray-100 shadow-lg items-end justify-center pt-4 px-4 pb-20 text-center sm:block sm:p-0 md:w-3/5 lg:w-2/5 z-50" style="">
                    <header class="flex items-stretch border-b border-gray-100 dark:border-gray-700">
                        <p class="flex items-center py-3 grow font-bold px-6">
                            {{$create_button_label}}
                        </p>
                    </header>
                    <form>
                        <div class="grid grid-cols-2 gap-2 text-sm text-center">
                            {{-- Tablero --}}
                            <div class="p-2 rounded-lg">
                                <label class="block text-gray-700 text-sm font-bold text-left">{{__("Board")}}</label>
                                <select wire:model="board_id"
                                    wire:click="fill_groups"
                                    class="block form-select form-select-md  rounded w-auto">
                                    <option value="" selected>{{__('Choose')}}</option>
                                    @if($boards->count())
                                        @foreach($boards as $board)
                                            <option value="{{ $board->id }}">{{ $board->title }}</option>
                                        @endforeach
                                    @endif
                                </select>
                                <div>@error('board_id') <span class="text-red-500">{{ $message }}</span>@enderror</div>
                            </div>
                            {{-- Grupo --}}
                            <div class="p-2 rounded-lg">
                                @if($board_id)
                                <label class="block text-gray-700 text-sm font-bold text-left">{{__("Group")}}</label>
                                    <select wire:model="group_id"
                                        class="block form-select form-select-md  rounded w-auto">
                                        <option value="" selected>{{__('Choose')}}</option>
                                            @foreach($groups as $group)
                                                <option value="{{ $group->id }}">{{ $group->title }}</option>
                                            @endforeach
                                    </select>
                                    <div>@error('group_id') <span class="text-red-500">{{ $message }}</span>@enderror</div>
                                @endif
                            </div>
                        </div>

                        <div class="grid grid-cols-2 gap-2 text-sm text-center">
                            <div class="p-2 rounded-lg">
                                {{-- Grupo --}}
                                @if($group_id)
                                    <label class="block text-gray-700 text-sm font-bold text-left">{{__("Departament")}}</label>
                                    <select wire:model="departament_id"
                                        class="block form-select form-select-md  rounded w-auto">
                                        <option value="" selected>{{__('Choose')}}</option>
                                        @foreach($departaments as $departament)
                                                <option value="{{ $departament->id }}">
                                                @if(App::isLocale('en'))
                                                    {{ $departament->english }}
                                                @else
                                                    {{ $departament->spanish }}
                                                @endif
                                            </option>
                                        @endforeach
                                    </select>
                                    <div>@error('departament_id') <span class="text-red-500">{{ $message }}</span>@enderror</div>
                                @endif
                            </div>
                            <div class="p-2 rounded-lg">
                                @if($departament_id)
                                    {{-- Usuario que requeire --}}
                                    <label class="block text-gray-700 text-sm font-bold text-left">{{__("Required By")}}</label>
                                    <select wire:model="user_require_id"
                                            class="block form-select form-select-md rounded w-auto">
                                            <option value="" selected>{{__('Choose')}}</option>
                                            @foreach($users as $user)
                                                <option value="{{ $user->id }}">{{ $user->name }} </option>
                                            @endforeach
                                        </select>
                                        <div>@error('user_require_id') <span class="text-red-500">{{ $message }}</span>@enderror</div>
                                @endif
                            </div>
                        </div>

                        <div class="grid grid-cols-2 gap-2 text-sm text-center">
                            <div class="p-2 rounded-lg">
                                {{-- Usuario que requeire --}}
                                @if($user_require_id)
                                    <label class="block text-gray-700 text-sm font-bold text-left">{{__("Responsible")}}</label>
                                    <select wire:model="user_responsible_id"
                                            class="block form-select form-select-md  rounded w-auto">
                                            <option value="" selected>{{__('Choose')}}</option>
                                            @foreach($users as $user)
                                                <option value="{{ $user->id }}">{{ $user->name }} </option>
                                            @endforeach
                                        </select>
                                    <div>@error('user_responsible_id') <span class="text-red-500">{{ $message }}</span>@enderror</div>
                                @endif
                            </div>
                            <div class="p-2 rounded-lg">
                                {{-- Fecha compromiso --}}
                                @if ($user_responsible_id)
                                    <label  class="block text-gray-700 text-base font-bold text-left">{{__("Deadline Date")}}</label>
                                    <span>
                                        <input type="date"
                                        wire:model="deadline"
                                        required
                                        style=cursor:pointer;
                                        class="block rounded w-auto border py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                    </span>
                                    <div>@error('date_at') <span class="text-red-500">{{ $message }}</span>@enderror</div>
                                @endif
                            </div>
                        </div>
                        @if($user_require_id && $user_responsible_id )
                        {{-- Título de tarea --}}
                        <div class="mb-2 m-2">
                            <label class="block text-gray-700 text-sm font-bold text-left">{{__("Title")}}</label>
                            <input type="text" wire:model="title" maxlength="50" placeholder="{{__("Title")}}"
                            class="block shadow appearance-none border rounded w-auto py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" >
                            <div>@error('title') <span class="text-red-500">{{ $message }}</span>@enderror</div>
                        </div>

                        {{-- Descripción --}}
                        <div class="mb-2 m-2">
                            <div class="field">
                                <label class="block text-gray-700 text-sm font-bold text-left">{{__("Description")}}</label>
                                <div class="control">
                                <textarea wire:model="description" class="textarea" placeholder="{{__('Explain about it')}}"></textarea>
                                </div>
                                <div>@error('description') <span class="text-red-500">{{ $message }}</span>@enderror</div>
                            </div>
                        </div>

                        {{-- Estado de la tarea --}}
                        <div class="grid grid-cols-2 gap-2 text-sm text-center">
                            <div class="p-2 rounded-lg">
                                <label class="block text-gray-700 text-sm font-bold text-left">{{__("Status")}}</label>
                                <span>
                                    <select wire:model="status_id"
                                    class="form-select form-select-md  sm:mr-2">
                                    <option value="" selected>{{__('Choose')}}</option>
                                    @foreach($statuses as $status)
                                                                                <option value="{{ $status->id }}">
                                            @if(App::isLocale('en'))
                                                {{ $status->english }}
                                            @else
                                                {{ $status->spanish }}
                                            @endif
                                        </option>
                                    @endforeach
                                    </select>
                                    <div>@error('status_id') <span class="text-red-500">{{ $message }}</span>@enderror</div>
                                </span>
                            </div>
                            {{-- Prioridad --}}
                            <div class="p-2 rounded-lg">
                                <label class="block text-gray-700 text-sm font-bold text-left">{{__("Priority")}}</label>
                                <span>
                                    <select wire:model="priority_id"
                                    class="form-select form-select-md  sm:mr-2">
                                    <option value="" selected>{{__('Choose')}}</option>
                                    @foreach($priorities as $priority)
                                            <option value="{{ $priority->id }}">
                                            @if(App::isLocale('en'))
                                                {{ $priority->english }}
                                            @else
                                                {{ $priority->spanish }}
                                            @endif
                                        </option>
                                    @endforeach
                                    </select>
                                    <div>@error('priority_id') <span class="text-red-500">{{ $message }}</span>@enderror</div>
                                </span>
                            </div>
                        </div>
                        @endif

                        @include('common.crud_save_cancel')
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
