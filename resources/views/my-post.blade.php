<x-home-master>

    <style>
        .modal-header{ display: block; !important;}
    </style>

@section('content-full')

        <h1 class="my-4">My <small>Post</small>
        </h1>



            <div class="container">
                @if(Session::has('message'))
                    <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
                @endif

                @if($posts->count()>0)
                @foreach($posts as $post)
                <div class="card mt-2" >

                    <div class="row">
                        <div class="col-md-12">
                            <div class="card-footer text-muted">
                                {{$post->title}}
                                <div style="float: right">
                                    @if($post->status == 'in-active')
                                        <span class="text-danger">Pending for approval</span>
                                    @endif
                                    @if($post->status == 'active')
                                        <span class="text-success">Approved</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="img-fluid lazyloaded" style="background-image: url({{$post->post_image}}); height: 100px;width: 150px;
                                    background-repeat: no-repeat; background-size: contain;
                                    background-position: center; font-size: 15px; margin: 10px">
                            </div>
                        </div>
                        <div class="col-md-10">
                            <div class="card-body">
                                <h2 class="card-title">{{$post->title}}</h2>
                                <p class="card-text">{{Str::limit($post->body, '200', '.....')}}</p>

                                <div style="float: right">
                                <a href="{{route('post', $post->id)}}" class="btn btn-primary">Read More &rarr;</a>
                                <a href="{{route('user.my_post.edit', $post->id)}}" class="btn btn-warning">Edit Post &rarr;</a>
                                {{--<a href="{{route('post', $post->id)}}" class="btn btn-danger">Delete Post &rarr;</a>--}}
                                <button class="btn btn-danger" type="button" data-toggle="modal" data-target="#myModal{{$post->id}}"
                                        >Delete Post &rarr;</button>
                                </div>
                                <br>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="card-footer text-muted">
                                Posted on {{$post->created_at->diffForHumans()}}
                            </div>
                        </div>

                    </div>
                </div>

                <div id="myModal{{$post->id}}" class="fade modal modal-danger" role="dialog">
                    <form method="post" action="{{route('user.mypost.destroy', $post->id)}}" enctype="multipart/form-data" style="display: inline">
                        @csrf
                        @method('DELETE')
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title">Delete Post</h4>
                                </div>
                                <div class="modal-body">
                                    <p>Are you sure you want to delete this post?</p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Close</button>

                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                @endforeach
                @else
                        <div class="card mt-2" >

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="card-body">
                                        <p class="card-text">No post found!</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br>
                    @endif

            </div>


        <br>

        @endsection


</x-home-master>