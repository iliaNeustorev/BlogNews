<x-layouts.base title="Все видео">
    <hr>
    @forelse($videos as $video)
        <div class="card mb-2" style="width: 18rem;">
            <div class="card-body row">
                <iframe
                    src="https://www.youtube.com/embed/{{ $video->code }}"
                    fs="0"
                    frameborder="0"
                    allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"
                    allowfullscreen>
                </iframe>
                <p><em>{{ $video->user->name }}</em></p>
                <a href="{{ route('video.one', $video->slug) }}">подробнее...</a>
            </div>
        </div>
    @empty
        <em>Видео нет</em>
    @endforelse
    {{ $videos->links() }}
</x-layouts.base>