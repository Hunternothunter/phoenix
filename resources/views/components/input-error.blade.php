@props(['messages'])

@if ($messages)
    <div {{ $attributes->merge(['class' => 'alert alert-danger alert-dismissible fade show']) }}>
        <ul class="mb-0">
            @foreach ((array) $messages as $message)
                <li>{{ $message }}</li>
            @endforeach
        </ul>
    </div>
@endif
