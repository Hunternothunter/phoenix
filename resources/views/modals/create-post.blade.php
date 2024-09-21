<x-modal name="whats-on-your-mind" maxWidth="md" title="Create post" focusable>
    <style>
        .remove-preview-btn {
            top: 10px;
            right: 10px;
            z-index: 1000;
        }

        .preview-image,
        .preview-video {
            max-width: 100%;
            max-height: 400px;
        }

        .upload-btn {
            background-color: transparent;
            border: 1px solid transparent;
        }

        .upload-btn:hover {
            background-color: #EBEBEB;
            border-color: #EBEBEB;
        }
    </style>
    <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="row align-items-start">
            <!-- User Profile Section -->
            <div class="col-auto d-flex justify-content-center mb-2">
                <img src="{{ Auth::user()->profile_pictures ? asset('storage/profile_pictures/' . Auth::user()->profile_pictures) : asset('storage/profile_pictures/default-user.png') }}"
                    width="50" height="50" class="rounded-circle border border-light shadow-sm"
                    alt="{{ Auth::user()->firstname }}">
            </div>

            <div class="col">
                <!-- Textarea for Content Input -->
                <div class="mb-3">
                    <input id="content" name="content" class="form-control custom-textarea" rows="3"
                        placeholder="What's on your mind, {{ Auth::user()->firstname }} ?" autofocus></input>
                </div>

                <hr class="my-2">

                <!-- Preview Container -->
                <div id="preview-container" class="mt-3 d-none position-relative">
                    <button type="button" id="remove-preview"
                        class="btn btn-sm btn-danger position-absolute remove-preview-btn">
                        <i class="bi bi-x" data-lucide="circle-x"></i>
                    </button>
                    <img id="image-preview" class="img-fluid preview-image">
                    <video id="video-preview" class="d-none preview-video" controls></video>
                </div>

                <hr class="my-2">

                <!-- File Upload and Submit Button -->
                <div class="d-flex flex-wrap align-items-center">
                    <label for="file-upload" class="btn btn-lg me-2 d-flex align-items-center upload-btn">
                        <i class="fs-5 me-2" data-lucide="images"></i>
                        <span class="fs-5 fw-bold">Photo/Video</span>
                        <input type="file" id="file-upload" name="image" class="d-none" accept="image/*,video/*">
                    </label>
                    <button type="submit" class="btn btn-primary fs-5 fw-bold">Post</button>
                </div>
            </div>
        </div>
    </form>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const fileInput = document.getElementById('file-upload');
            const imagePreview = document.getElementById('image-preview');
            const videoPreview = document.getElementById('video-preview');
            const previewContainer = document.getElementById('preview-container');
            const removePreviewButton = document.getElementById('remove-preview');

            fileInput.addEventListener('change', function() {
                const file = fileInput.files[0];
                if (file) {
                    const fileURL = URL.createObjectURL(file);
                    if (file.type.startsWith('image/')) {
                        imagePreview.src = fileURL;
                        imagePreview.classList.remove('d-none');
                        videoPreview.classList.add('d-none');
                    } else if (file.type.startsWith('video/')) {
                        videoPreview.src = fileURL;
                        videoPreview.classList.remove('d-none');
                        imagePreview.classList.add('d-none');
                    }
                    previewContainer.classList.remove('d-none');
                } else {
                    previewContainer.classList.add('d-none');
                }
            });

            removePreviewButton.addEventListener('click', function() {
                fileInput.value = '';
                imagePreview.src = '';
                videoPreview.src = '';
                imagePreview.classList.add('d-none');
                videoPreview.classList.add('d-none');
                previewContainer.classList.add('d-none');
            });
        });
    </script>
</x-modal>