@props([
    'name',
    'show' => false,
    'maxWidth' => '2xl'
])

@php
$maxWidth = [
    'sm' => 'modal-dialog modal-sm',
    'md' => 'modal-dialog',
    'lg' => 'modal-dialog modal-lg',
    'xl' => 'modal-dialog modal-xl',
    '2xl' => 'modal-dialog modal-xl', // Adjust if needed
][$maxWidth];
@endphp

<!-- Modal -->
<div class="modal fade {{ $show ? 'show' : '' }}" id="{{ $name }}" tabindex="-1" aria-labelledby="{{ $name }}Label" aria-hidden="true" style="{{ $show ? 'display: block;' : 'display: none;' }}">
    <div class="modal-dialog {{ $maxWidth }}">
        <div class="modal-content">
            <div class="modal-header text-center">
                <h5 class="modal-title" id="{{ $name }}Label">{{ $attributes->get('title', 'Modal Title') }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                {{ $slot }}
            </div>
            {{-- <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <!-- Add other footer buttons as needed -->
            </div> --}}
        </div>
    </div>
</div>

<!-- Include Bootstrap JS and Popper.js -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        var modalElement = document.getElementById('{{ $name }}');
        var modal = new bootstrap.Modal(modalElement);

        window.addEventListener('open-modal', function (e) {
            if (e.detail === '{{ $name }}') {
                modal.show();
            }
        });

        window.addEventListener('close-modal', function (e) {
            if (e.detail === '{{ $name }}') {
                modal.hide();
            }
        });
    });
</script>
