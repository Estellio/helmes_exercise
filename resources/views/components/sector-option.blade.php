<option value="{{ $sector->sector_number }}">
    {!! str_repeat('&nbsp;', $level * 4) !!}{{ $sector->name }}
</option>

@foreach ($sector->allChildren as $child)
    @include('components.sector-option', [
        'sector' => $child,
        'level' => $level + 1
    ])
@endforeach