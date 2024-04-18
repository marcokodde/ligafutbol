@if($records && $records->count())
   <div class="table-pagination">
        <div class="flex items-center justify-between">
            {{ $records->links()}}
        </div>
    </div>
@endif
