<x-app-layout>
    <h1>Videos</h1>

    <div class="video-list">
        @foreach ($videos as $video)
            <div class="d-flex flex-column">
                <div class="video-item">
                    <h4>{{ $video->user->firstname }} {{ $video->user->lastname }}</h4>
                    <p>{{ $video->content }}</p>
                    <video controls class="d-flex justify-content-center" width="980" height="720">
                        <source src="{{ asset('storage/' . $video->post_media) }}" type="video/mp4">
                        Your browser does not support the video tag.
                    </video>
                    <p>{{ $video->description }}</p>
                </div>
            </div>
        @endforeach

        @if ($videos->isEmpty())
            <p>No videos uploaded yet.</p>
        @endif
    </div>
</x-app-layout>
