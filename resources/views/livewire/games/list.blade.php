<tr>
    <td class="px-2 py-1 leading-relaxed text-gray-600 border sm:text-base md:text-xl xl:text-base">
        @if(App::isLocale('en'))
            {{ date('M d Y', strtotime($record->date)) .' '. date('g:i a', strtotime($record->date))}}
        @else
            {{ date('d M Y', strtotime($record->date)) .' '. date('g:i a', strtotime($record->date))}}
        @endif
    </td>
    <td class="px-2 py-1 leading-relaxed text-gray-600 border sm:text-base md:text-xl xl:text-base">
        {{$record->LocalTeam->name}}
    </td>
    <td class="px-2 py-1 leading-relaxed text-gray-600 border sm:text-base md:text-xl xl:text-base">
        {{$record->local_score}}
   vs
        {{$record->visit_score}}
    </td>

    <td class="px-2 py-1 leading-relaxed text-gray-600 border sm:text-base md:text-xl xl:text-base">
        {{$record->VisitTeam->name}}
    </td>
    <td class="px-2 py-1 leading-relaxed text-gray-600 border sm:text-base md:text-xl xl:text-base">
        @if($record->request_score)
            <label>  {{__('Yes')}}</label>
        @else
            <label class="text-danger">{{__('No')}}</label>
        @endif
    </td>
    @include('common.crud_actions')
</tr>
