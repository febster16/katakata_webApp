<x-home-master>

@section('content')

        <h1 class="my-4">Latest
            <small>Post</small>
        </h1>

    @foreach($posts as $post)
        <div class="card mb-4">
            <img class="card-img-top" src="{{$post->post_image}}" alt="Card image cap">
            <div class="card-body">
                <h2 class="card-title">{{$post->title}}</h2>
                <p class="card-text">{{Str::limit($post->body, '50', '.....')}}</p>
                <a href="{{route('post', $post->id)}}" class="btn btn-primary">Read More &rarr;</a>
            </div>
            <div class="card-footer text-muted">
                Posted on {{$post->created_at->diffForHumans()}}
            </div>
        </div>
        @endforeach



            <div style="">
                @include('pagination.limit_links', ['paginator' => $posts])</div>


    @endsection

    @section('sidebar')

            <div class="card my-4">
                <h5 class="card-header">Search</h5>
                <form method="get" action="/search">
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

            <div class="card my-8">
                <h5 class="card-header">Categories</h5>
                <div class="card-body">
                    <div class="row">
                        @foreach($categories as $category)
                        <div class="col-lg-6">
                            <a href="{{ url('/search')."/".$category->id }}"
                               @if($selected_category == $category->id) style="color: white;background-color:#343A40; padding: 0px 2px" @endif
                            >{{ $category->name }}</a>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
{{--
            <div class="card my-4">
                <h5 class="card-header">Side Widget</h5>
                <div class="card-body">
                    You can put anything you want inside of these side widgets. They are easy to use, and feature the new Bootstrap 4 card containers!
                </div>
            </div> --}}

    @endsection


</x-home-master>
