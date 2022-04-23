@include('common.crud_header')

<div class="py-4 px-4">
    @include('common.crud_message')

        <div class="md:rounded block bg-white border border-gray-100">

                <div class="flex  flex-col justify-center" style="">
                    <div class="md:rounded flex bg-white border border-gray-100 shadow-lg items-end justify-center pt-4 px-4 pb-20 text-center sm:block sm:p-0 z-50" style="">
                        {{-- Categoría --}}
                            @include('livewire.rosters.category')

                            @if($category_id)
                                {{-- Nombre Equipo --}}
                                @include('livewire.rosters.team')
                            @endif

                        <form>
                            @include('common.crud_save_cancel')
                        </form>
                    </div>
                </div>

    </div>

</div>
