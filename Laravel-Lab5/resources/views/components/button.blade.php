<button {{ $attributes->merge(['class' => 'btn btn-' . $type]) }}>
    {{ $slot }}
</button>
