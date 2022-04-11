@if(isset($records) && $records)
    <div class="flex items-center mt-2">
        {{ $records->links() }}
    </div>
@endif
