
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
                        <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                            <h1 class="text-xl text-center">
                            {{ __('Do you want to delete the record?')}}
                            </h1>

                            <h1 class="text-lg text-center">
                            {{ __('This action can not be undone')}}
                            </h1>
                            <div class="bg-gray-50 px-4 py-3 mx-auto sm:px-6 sm:flex sm:flex-row-reverse items-center align-bottom">
                                <button wire:click.prevent="destroy()"
                                        type="button"
                                        class="button green --jb-modal hover:text-black font-bold rounded-lg px-4 py-2 ml-4">
                                {{__("Confirm")}}
                                </button>

                                <button wire:click="closeModal()"
                                        type="button"
                                        class="button red --jb-modal hover:text-black font-bold rounded-lg px-4 py-2 m-1">
                                {{__("Cancel")}}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
