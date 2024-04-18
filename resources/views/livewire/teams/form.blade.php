
<div class="bd-example bd-example-modal">
    <div class="block bg-white border border-gray-100 md:rounded">
        <div class="hola mundo">
            <div class="fixed inset-0 z-50 flex flex-col items-center justify-center overflow-hidden" style="">
                <div class="absolute inset-0 bg-gradient-to-tr opacity-90 dark:from-gray-700 from-gray-700 via-gray-900 to-gray-700">
                </div>
                <div class="z-50 flex items-end justify-center px-4 pt-4 pb-20 text-center bg-white border border-gray-100 shadow-lg md:rounded sm:block sm:p-0" style="">
                    <header class="flex items-stretch border-b border-gray-100 dark:border-gray-700">
                        <p class="flex items-center px-6 py-3 font-bold grow">
                            {{$create_button_label}}
                        </p>
                    </header>
                    <form>
                        <div class="mx-auto bg-white">
                            {{-- Nombre Equipo --}}
                            <div class="mb-4">
                                <label class="block text-sm font-bold text-left text-gray-700">{{__("Name")}}</label>
                                <input type="text" wire:model="name" maxlength="50" placeholder="{{__("Name")}}"
                                class="w-3/4 px-3 py-2 leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline" >
                                <div>@error('name') <span class="text-red-500">{{ $message }}</span>@enderror</div>
                            </div>

                            {{-- Categoría --}}

                            <div class="mb-4">
                                <label class="block text-sm font-bold text-left text-gray-700">{{__("Category")}}</label>
                                <select wire:model="category_id"
                                    class="w-3/4 rounded select">
                                    <option value="" selected>{{__('Choose')}}</option>
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                </select>
                                <div>@error('category_id') <span class="text-red-500">{{ $message }}</span>@enderror</div>
                            </div>
                        </div>
                        @include('common.crud_save_cancel')
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
