
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

                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold text-left">{{__("Board")}}</label>
                            <select wire:model="board_id"
                                    class="form-select form-select-md  sm:mr-2">
                                <option value="" selected>{{__('Choose')}}</option>
                                    @foreach($boards as $board)
                                        <option value="{{ $board->id }}">{{ $board->title }}</option>
                                    @endforeach
                                </select>
                                <div>@error('board_id') <span class="text-red-500">{{ $message }}</span>@enderror</div>
                        </div>


                        <div class="bg-white mx-auto">
                            <div class="mb-4">
                                <label class="block text-gray-700 text-sm font-bold text-left">{{__("Title")}}</label>
                                <input type="text" wire:model="title" maxlength="50" placeholder="{{__("Title")}}"
                                class="shadow appearance-none border rounded w-2/4 py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" >
                                <div>@error('title') <span class="text-red-500">{{ $message }}</span>@enderror</div>
                            </div>

                            <div class="mb-4">
                                <div class="field">
                                    <label class="block text-gray-700 text-sm font-bold text-left">{{__("Description")}}</label>
                                    <div class="control">
                                      <textarea wire:model="description" class="textarea" placeholder="{{__('Explain about it')}}"></textarea>
                                    </div>
                                    <div>@error('description') <span class="text-red-500">{{ $message }}</span>@enderror</div>
                                </div>
                            </div>



                        </div>

                        @include('common.crud_save_cancel')
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
