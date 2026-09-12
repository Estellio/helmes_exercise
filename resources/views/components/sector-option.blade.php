<li>
    <label class="flex items-center gap-2 rounded-lg py-1"
    style="padding-left: {{ 0.75 + ($level * 1.5) }}rem;">
        <input type="checkbox" wire:model="selectedSectors" value="{{ $sector->sector_number }}"
        class="h-4 w-4 rounded text-indigo-600 border-gray-600 bg-gray-700 ring-offset-gray-800">

        <span class="text-sm">
            {{ $sector->name }}
        </span>
    </label>

    @if ($sector->allChildren->isNotEmpty())
        <ul class="space-y-1">
            @foreach ($sector->allChildren as $child)
                @include('components.sector-option', [
                    'sector' => $child,
                    'level' => $level + 1
                ])
            @endforeach
        </ul>
    @endif
</li>