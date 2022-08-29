<x-layouts.base title="Посты">
    <hr>
    @forelse($posts as $post)
        <h2>{{ $post->title }}</h2>
        <em>{{ $post->created_at }}-{{ $post->user->name }}</em><br>
        <a href="{{ route('post.one', $post->slug) }}">подбробнее...</a>
        <hr>
    @empty
        <em>Постов нет</em>
    @endforelse
    {{ $posts->links() }}
</x-layouts.base>
