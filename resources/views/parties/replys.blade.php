@foreach($comments as $comment)
    <div class="media mb-2">
        <?php $user = \App\User::where('id',$comment['user_id'])->first() ?>
        @if($user->avatar !="")
            <img class="d-flex mr-3 rounded-circle" src="{{ $user->avatar }}" height="40" width="40" alt="">
        @else
            <img class="d-flex mr-3 rounded-circle" src="http://placehold.it/50x50" alt="">
        @endif

        <div class="media-body mt-2">
            <h5 class="mt-0">{{ $user->username }}</h5>
            {{ $comment['comment'] }}
            @if(Auth::check())
                <a href="javascript:" onclick="reply('{{ $comment['id'] }}')" >Reply </a>
            @else
                <a href="{{ route('login') }}" >Reply</a>

            @endif
            <div id="reply_{{ $comment['id'] }}" style="display: none">
                <form method="post" action="{{ route('post.addcomment') }}">
                    @csrf
                    <div class="form-group">
                        <input type="hidden" name="parent_id" value="{{ $comment['id'] }}">
                        <input type="hidden" name="post_id" value="{{ $post->id }}">
                        <textarea class="form-control" rows="3" name="comment" id="comment" required></textarea>
                    </div>
                    <div class="form-group">
                        <input type="submit" class="btn btn-sm btn btn-primary py-0" style="font-size: 0.8em;" value="Reply" />
                    </div>
                </form>
            </div>
            <hr>
            <?php $sub_comment = \App\Comment::where('parent_id',$comment['id'])->where('status','approved')->get(); ?>
            @include('parties.replys', ['comments' => $sub_comment])
        </div>
    </div>
@endforeach
