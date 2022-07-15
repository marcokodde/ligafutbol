<thead>
    <tr class="lg:hover:bg-gray-100 lg:bg-gray-50">
        <th class="px-4 py-2 w-80">{{__("Name")}}</th>
        <th class="px-4 py-2 w-80">{{__("Birthday")}}</th>
        <th class="px-4 py-2 w-80">{{__("Gender")}}</th>
        @if (Auth::user()->isAdmin())
            <th class="px-4 py-2 w-80">{{__("Coach")}}</th>
        @endif
        <th colspan="3" class="px-4 py-2 text-center">{{__("Actions")}}</th>
    </tr>
</thead>
