<button {{ $attributes->merge(['type' => 'submit', 'class' => 'btn btn-danger btn-sm px-4 py-2 rounded text-uppercase fw-semibold']) }}>
    {{ $slot }}
</button>
