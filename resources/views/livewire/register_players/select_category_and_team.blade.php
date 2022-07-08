<div>
    {{-- Seleccionar Categoría y luego Equipo --}}
    <div class="flex justify-center items-center gap-4">
            <label class="block text-xl text-gray-700 font-bold mt-2">{{ __('Category') }}</label>
            <fieldset x-data="window.Components.radioGroup({ initialCheckedIndex: 2 })" x-init="init()" class="mt-4">
                <div class="grid grid-cols-3 gap-2">
                    @foreach ($categories as $category_select)
                        <label x-radio-group-option=""
                            class="group relative border border-blue-400 cursor-pointer rounded-md py-3 px-4 flex items-center justify-center text-sm font-medium uppercase hover:bg-gray-500 focus:outline-none sm:flex-1 bg-white shadow-sm text-gray-900 undefined"
                            x-description="Active: &quot;ring-2 ring-indigo-500&quot;"
                            :class="{ 'ring-2 ring-indigo-500': (active === '{{ $category_select->name }}'), 'undefined': !(active === '{{ $category_select->name }}') }">
                            <svg class="flex-shrink-0 mr-1.5 h-5 w-5 text-gray-400" x-description="Heroicon name: solid/location-marker" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"></path>
                            </svg>
                            <input type="radio" wire:model="category_id"
                                wire:change="read_category" name="category_id"
                                value="{{ $category_select->id }}" class="sr-only"
                                aria-labelledby="category_id-0-label">
                            <span id="category_id-0-label">
                                {{ $category_select->name }}
                            </span>
                            <span class="absolute -inset-px rounded-md pointer-events-none border-2 border-transparent"
                                aria-hidden="true"
                                x-description="Active: &quot;border&quot;, Not Active: &quot;border-2&quot;	Checked: &quot;border-indigo-500&quot;, Not Checked: &quot;border-transparent&quot;"
                                :class="{ 'border': (active === '{{ $category_select->name }}'), 'border-2': !(active === '{{ $category_select->name }}'), 'border-indigo-500': (value === '{{ $category_select->name }}'), 'border-transparent': !(value === '{{ $category_select->name }}') }">
                            </span>
                        </label>
                    @endforeach
                </div>
            </fieldset>
    </div>
    <div class="flex justify-center items-center gap-4">
        <label class="block text-xl text-gray-700 font-bold mt-2">{{ __('Teams') }}</label>
        <fieldset x-data="window.Components.radioGroup({ initialCheckedIndex: 2 })" x-init="init()" class="mt-4">
            <div class="grid grid-cols-none gap-2">
                @if ($category_id)
                    @foreach ($teams as $team_select)
                    <label x-radio-group-option=""
                        class="group relative border border-blue-400 cursor-pointer rounded-md py-3 px-4 flex items-center justify-center text-sm font-medium uppercase hover:bg-green-500 focus:outline-none sm:flex-1 bg-white shadow-sm text-gray-900 undefined"
                        x-description="Active: &quot;ring-2 ring-blue-500&quot;"
                        :class="{ 'ring-2 ring-blue-500': (active === '{{ $team_select->name }}'), 'undefined': !(active === '{{ $team_select->name }}') }">
                        <svg class="flex-shrink-0 mr-1.5 h-5 w-5 text-gray-400" x-description="Heroicon name: solid/users" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                            <path d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z"></path>
                        </svg>
                        <input type="radio" wire:model="team_id"
                            wire:change="read_team" name="team_id"
                            value="{{ $team_select->id }}" class="sr-only"
                            >
                            {{ $loop->index+1. .".-" }}
                            <span id="team_id-0-label">
                            {{ $team_select->name }}
                        </span>
                        <span class="absolute -inset-px rounded-md pointer-events-none border-2 border-transparent"
                            aria-hidden="true"
                            x-description="Active: &quot;border&quot;, Not Active: &quot;border-2&quot;	Checked: &quot;border-blue-500&quot;, Not Checked: &quot;border-transparent&quot;"
                            :class="{ 'border': (active === '{{ $team_select->name }}'), 'border-2': !(active === '{{ $team_select->name }}'), 'border-blue-500': (value ===
                                '{{ $team_select->name }}'), 'border-transparent': !(value === '{{ $team_select->name }}') }">
                        </span>
                    </label>
                    @endforeach
                @endif
            </div>
        </fieldset>
    </div>
</div>