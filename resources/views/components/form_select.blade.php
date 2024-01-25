@props([
    'name',
    'list',
    'value',
    'label', 
    'icon', 
    'col' => '12',
    'show' => 'name',
    'show2'
])

<div class="col-md-{{ $col }} mb-3">
    <label class="form-label"><i class="{{ $icon }} me-2"></i>{{ $label }}:</label>
    <select name="{{ $name }}" class="form-select">
        @foreach ($list as $item)
            <option value="{{ $item->id }}" @selected($item->id == old($name, $value))>
                {{ $item->{$show} }}
                @isset($show2)
                     ({{ $item->{$show2} }})
                @endisset
            </option>
        @endforeach
    </select>
    @error($name)
        <x-msg_error :message="$message" />
    @enderror
</div>