@props(['value'])

<label {{ $attributes->merge(['class' => 'block font-medium text-sm text-gray-700']) }}>
    {{ is_array($value) ? '' : htmlspecialchars($value, ENT_QUOTES, 'UTF-8') }}
</label>
