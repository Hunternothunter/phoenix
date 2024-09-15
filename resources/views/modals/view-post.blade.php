<x-modal name="view-post" maxWidth="lg" centered="true" title="Post Details" focusable>
    <div class="container">
        <div class="row">
            <!-- Image Column -->
            <div class="col-md-5">
                <div id="post-image-container" class="mb-3">
                    <!-- Post image will be inserted dynamically -->
                </div>
            </div>

            <!-- Content Column -->
            <div class="col-md-7">
                <!-- User Info -->
                <div class="mb-3 d-flex align-items-center">
                    <a id="post-user-link" href="#"
                        class="text-decoration-none fw-bold text-body fs-lg d-flex align-items-center">
                        <img id="post-user-profile" src="#" width="45" height="45"
                            class="rounded-circle me-2 border border-sm" alt="Profile Picture">
                        <span id="post-user-name"></span>
                    </a>
                </div>

                <!-- Post Content -->
                <p id="post-content"></p>

                <!-- Comments Section -->
                <h3>Comments</h3>
                <div id="post-comments" class="border border-gray-100 p-3 mb-3">
                    <!-- Comments will be dynamically added here -->
                </div>

                @auth
                    <!-- Comment Form -->
                    <form id="comment-form" action="{{ route('comments.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="post_id" id="comment-post-id">
                        <div class="form-group">
                            <label for="content">Add a Comment</label>
                            <textarea id="content" name="content" class="form-control" rows="3" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary mt-2">Post Comment</button>
                    </form>                    
                @endauth
            </div>
        </div>
    </div>
</x-modal>