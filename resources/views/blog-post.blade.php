<script>
    function reply(id){
        document.getElementById('reply_'+id).style.display="block";
    }
</script>
<x-home-master>

    @section('content')
            <h1 class="mt-4">{{$post->title}}</h1>

            <p class="lead">
               <p>by {{$post->user->name}}</p>
            </p>

            <hr>

            <p>Posted on {{$post->created_at->diffForHumans()}} </p>

            <hr>

            <img class="img-fluid rounded" src="{{$post->post_image}}" alt="">

            <hr>

            <p>{{$post->body}}</p>

            <hr>

            @if(Session::has('message'))
                <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
            @endif

            <div class="card my-4">
                <h5 class="card-header">Leave a Comment:</h5>
                <div class="card-body">
                    <form method="post" action="{{ route('post.addcomment') }}" id="store_comment">
                        {{ @csrf_field() }}
                        <div class="form-group">
                            <input type="hidden" name="post_id" value="{{ $post->id }}">
                            <input type="hidden" name="post_id" value="{{ $post->id }}">
                            <textarea class="form-control" rows="3" name="comment" id="comment" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>

            @include('parties.replys', ['comments' => $comments, 'post_id' => $post->id])

        @endsection

        @section('sidebar')

    <div class="card my-4">
        <h5 class="card-header">Search</h5>
        <form method="get" action="/">
            <div class="card-body">
                <div class="input-group">

                    <input type="text" class="form-control" name="keyword" id="keyword" placeholder="Search for..."
                           value = "@if(isset($_REQUEST['keyword'])){{ $_REQUEST['keyword'] }}@endif">
                        <span class="input-group-btn">
                            <input type="submit" class="btn btn-secondary" type="button" value="Go!">
                        </span>

                </div>
            </div>
        </form>
    </div>

    <div class="card my-4">
        <h5 class="card-header">Categories</h5>
        <div class="card-body">
            <div class="row">
                @foreach($categories as $category)
                    <div class="col-lg-6">
                        <a href="{{ url('/search')."/".$category->id }}" >{{ $category->name }}</a>
                    </div>
                @endforeach
            </div>
        </div>
    </div>


      @endsection

</x-home-master>
