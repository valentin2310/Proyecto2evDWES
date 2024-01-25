@props([
    'name',
    'value',
    'label', 
    'icon', 
    'col' => '12', 
    'type' => 'text', 
    'placeholder' => ''
])



<div class="col-md-{{ $col }} mb-3">
    <label class="form-label">
       @isset($icon)
        <i class="{{ $icon }} me-2"></i>
       @endisset
        {{ $label }}:
    </label>
    <input {{ $attributes }} type="{{ $type }}" name="{{ $name }}" class="form-control" placeholder="{{ $placeholder }}"
        @if (isset($value))
            value="{{ old($name, $value) }}"
        @else
            value="{{ old($name) }}"
        @endif
    >
    @error($name)
        <x-msg_error :message="$message" />
    @enderror
</div>