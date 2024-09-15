<x-modal name="whats-on-your-mind" maxWidth="md" title="Create Post" focusable>
    <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="row align-items-start">
            <!-- User Profile Section -->
            <div class="col-1 d-flex justify-content-center">
                <img src="{{ Auth::user()->profile_picture ? asset('storage/profile_pictures/' . Auth::user()->profile_picture) : asset('storage/profile_pictures/default-user.png') }}"
                    width="50" height="50" class="rounded-circle border border-light shadow-sm"
                    alt="{{ Auth::user()->firstname }}">
            </div>

            <!-- Input Field and Photo/Video Button Section -->
            <div class="col-11">
                <div class="mb-3">
                    <textarea id="content" name="content" class="form-control custom-textarea" rows="3"
                        placeholder="What's on your mind, {{ Auth::user()->firstname }} ?" autofocus></textarea>
                </div>
                <hr class="my-2">
                <div class="d-flex align-items-center">
                    <label for="file-upload" class="btn btn-lg me-2 d-flex align-items-center"
                        style="background-color: transparent; border: 1px solid transparent;"
                        onmouseover="this.style.backgroundColor='#EBEBEB'; this.style.borderColor='#EBEBEB';"
                        onmouseout="this.style.backgroundColor='transparent'; this.style.borderColor='transparent';">
                        <i class="align-middle fs-5 me-2" data-lucide="images"></i>
                        <span class="align-middle fs-5 fw-bold">Photo/Video</span>
                        <!-- Hidden file input -->
                        <input type="file" id="file-upload" name="image" class="d-none" accept="image/*,video/*">
                    </label>
                    <button type="submit" class="btn btn-primary fs-5 fw-bold">Post</button>
                </div>

            </div>
        </div>
    </form>
</x-modal>