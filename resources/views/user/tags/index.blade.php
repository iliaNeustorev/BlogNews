<x-layouts.base title="Все теги">
        <hr>
        @forelse($tags as $tag)
            <a href="{{ route('tag.posts', [ $tag->url ]) }}"><h2>{{ $tag->title }}</h2></a>
                <em>{{ $tag->url }}</em><br>
                <p>{{ $tag->description }}</p>
                <hr>
        @empty
            <em>Тегов нет</em>
        @endforelse
        {{ $tags->links() }}
</x-layouts.base>