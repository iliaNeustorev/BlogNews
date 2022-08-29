<x-layouts.base title="Посты">
    <x-admin.base-layout>
            <a href="{{ route('posts.create') }}">Добавить пост</a>
            <hr>
            <div class="container">
                <div class="row">
                  <div class="col">
                    @can('admin-moderator')
                        <h1>Новые посты</h1>
                        <hr>
                            @forelse($newPosts as $post)
                                <div class="btn-group gap-1">
                                    <h2>{{ $post->title }}</h2>
                                    <x-form method='put' action="{{ route('accept.post', $post->id) }}">
                                        <button class='btn btn-success btn-sm'>Принять</button>
                                    </x-form>
                                    <x-form method='put' action="{{ route('decline.post', $post->id) }}">
                                        <button class='btn btn-primary btn-sm'>Отклонить</button>
                                    </x-form>
                                </div>
                                <em>{{ $post->created_at }}-{{ $post->user->name }}</em><br>
                                <a href="{{ route('posts.show', $post->id) }}">подробнее...</a>
                                <hr>
                            @empty
                                <em>Новых постов нет</em>
                            @endforelse
                    @endcan
                  </div>
                  <div class="col">
                    <h1>Все посты</h1>
                    <hr>
                        @forelse($posts as $post)
                            <h2>{{ $post->title }}</h2>
                            <em>{{ $post->user->name }}</em>
                            <a href="{{ route('posts.show', $post->id) }}">подробнее...</a>
                            <p>{{ $post->status->text() }}</p>
                            <hr>
                        @empty
                            <em>Постов нет</em>
                        @endforelse
                    {{ $posts->links() }}
                  </div>
                </div>
              </div>
            @can('admin-writer')
                @if(auth()->user()->posts->count())
                    <div class="mt-3">
                        <h1>Мои посты</h1>
                        <hr>
                            @foreach(auth()->user()->posts as $post)
                                <h2>{{ $post->title }}</h2>
                                <em>{{ $post->user->name }}</em>
                                <p><a href="{{ route('posts.show', $post->id) }}">подробнее...</a></p>
                                <p>{{ $post->status->text() }}</p>  
                            @endforeach
                            <hr>
                        {{ $posts->links() }}
                    </div>
                @endif
            @endcan
    </x-admin.base-layout>
</x-layouts.base>