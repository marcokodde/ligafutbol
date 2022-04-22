<div class="card-content">
    <div class="card-content">
        @if($records->count())
            <table class="table mb-5" id="mytable">
                @if(isset($view_table))
                    @include($view_table)
                @endif
                @include('livewire.each_record')
            </table>
            @if($show_pagination)
                @include('common.crud_pagination')
            @endif
        @else
            @include('common.no_records_found')
        @endif
    </div>
</div>

