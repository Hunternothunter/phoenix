@props([
    'name',
    'show' => false,
    'maxWidth' => '2xl',
    'centered' => false
])

@php
$maxWidth = [
    'sm' => 'modal-dialog modal-sm',
    'md' => 'modal-dialog',
    'lg' => 'modal-dialog modal-lg',
    'xl' => 'modal-dialog modal-xl',
    '2xl' => 'modal-dialog modal-xl', // Adjust if needed
][$maxWidth];

$centeredClass = $centered ? 'modal-dialog-centered' : '';
@endphp

<!-- Modal -->
<div class="modal fade {{ $show ? 'show' : '' }}" id="{{ $name }}" tabindex="-1" aria-labelledby="{{ $name }}Label" aria-hidden="true" style="{{ $show ? 'display: block;' : 'display: none;' }}">
    <div class="modal-dialog {{ $centeredClass }} {{ $maxWidth }}">
        <div class="modal-content" style="background-color: #f8f9fa;"> <!-- Inline CSS for light background -->
            <div class="modal-header text-center">
                <h5 class="modal-title text-center" id="{{ $name }}Label">{{ $attributes->get('title', 'Modal Title') }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                {{ $slot }}
            </div>
        </div>
    </div>
</div>

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
