@include('common.crud_header')

<div class="py-4 px-4">
        @include('livewire.rosters.message')

        <div class="md:rounded block bg-white border border-gray-100">

            <div class="flex  flex-col justify-center" style="">
                <div class="md:rounded flex bg-white border border-gray-100 shadow-lg items-end justify-center pt-4 px-4 pb-20 text-center sm:block sm:p-0 z-50" style="">
                    {{-- Categoría y Equipo--}}
                        @include('livewire.rosters.category_and_team')


                        @if($category_id && $this->zipcode_exists)
                            @include('livewire.rosters.fields_to_players')
                        @endif

                </div>
            </div>
        </div>

</div>
