@foreach ($model->comments as $comment)
        <hr>
        <div class="alert @if($checkCommentStatus($comment->status))alert-success @else alert-danger @endif }}">
           <span class="badge bg-warning text-dark">{{ $comment->user->name }}</span> <em>{{ $comment->created_at }}</em> 
                @if(!$checkCommentStatus($comment->status)) 
                    <x-form method='put' action="{{ route('accept.comment', $comment->id) }}">
                        <b>Неодобрен</b>
                        <button class='btn btn-success btn-sm'>Принять</button>
                    </x-form>
                @endif
            <div class="mt-2">{{ $comment->text }}</div>
            @can('comment-update', $comment)
                @can('comment-timeout', $comment)
                    <a href="{{ route('comments.edit', [ $comment->id ]) }}">Исправить</a>
                    <x-form class="text-end" method="delete" action="{{ route('comments.destroy', $comment->id) }}">
                        <button class="btn btn-danger btn-sm">X</button>
                    </x-form>
                @endcan
            @endcan
        </div>
@endforeach