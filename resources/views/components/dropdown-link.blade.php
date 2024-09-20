{{-- <a {{ $attributes->merge(['class' => 'd-block w-100 px-4 py-2 text-start text-muted rounded-3 bg-transparent border border-secondary hover-bg-light focus:outline-none focus-bg-light transition duration-150 ease-in-out']) }}>{{ $slot }}</a> --}}


<a {{ $attributes->merge(['class' => 'd-block w-100 px-4 py-2 text-muted rounded-3 bg-transparent border border-secondary hover:bg-light focus:outline-none focus:bg-light transition duration-150']) }}>
    {{ $slot }}
</a>
