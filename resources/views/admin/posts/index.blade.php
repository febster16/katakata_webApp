<x-admin-master>
    @section('content')

        <h1>All Posts</h1>

        @if(session('message'))
            <div class="alert alert-danger">{{session('message')}}</div>
            @elseif(session('post-created-message'))
            <div class="alert alert-success">{{session('post-created-message')}}</div>
            @elseif(session('post-updated-message'))
            <div class="alert alert-success">{{session('post-updated-message')}}</div>
        @endif

        <div class="card shadow mb-4">

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th>Id</th>
                            <th>Owner</th>
                            <th>Title</th>
                            <th>Category</th>
                            <th>Image</th>
                            <th>Status</th>
                            <th>Created At</th>
                            {{--<th>Updated At</th>--}}
                            <th>Action</th>

                        </tr>
                        </thead>
                        <tfoot>
                        <tr>
                            <th>Id</th>
                            <th>Owner</th>
                            <th>Title</th>
                            <th>Category</th>
                            <th>Image</th>
                            <th>Status</th>
                            <th>Created At</th>
                            {{--<th>Updated At</th>--}}
                            <th width="10%">Action</th>
                        </tr>
                        </tfoot>
                        <tbody>

                        @foreach($posts as $post)

                            <tr>
                                <td>{{$post->id}}</td>
                                <td>{{$post->user->name}}</td>
                                <td><a href="{{route('post.edit', $post->id)}}">{{$post->title}}</a></td>
                                <td>
                                    @if(!empty($post->category_id))
                                    <a href="{{route('category.edit', $post->category_id)}}">
                                        {{$post->category_name}}
                                    </a>
                                    @endif
                                </td>
                                <td><img width="100px" src=" {{$post->post_image}}" alt=""></td>
                                <td width="10%" class="text-center">
                                    @if($post->status == 'active')
                                        <div class="btn-group-horizontal" id="assign_remove_{{ $post->id }}" >
                                            <button class="btn btn-success unassign ladda-button" data-style="slide-left" id="remove" ruid="{{ $post->id }}"  type="button" style="height:28px; padding:0 12px"><span class="ladda-label">Active</span> </button>
                                        </div>
                                        <div class="btn-group-horizontal" id="assign_add_{{ $post->id }}"  style="display: none"  >
                                            <button class="btn btn-danger assign ladda-button" data-style="slide-left" id="assign" uid="{{ $post->id }}"  type="button" style="height:28px; padding:0 12px"><span class="ladda-label">In Active</span></button>
                                        </div>
                                    @endif
                                    @if($post->status == 'in-active')
                                        <div class="btn-group-horizontal" id="assign_add_{{ $post->id }}"   >
                                            <button class="btn btn-danger assign ladda-button" id="assign" data-style="slide-left" uid="{{ $post->id }}"  type="button" style="height:28px; padding:0 12px"><span class="ladda-label">In Active</span></button>
                                        </div>
                                        <div class="btn-group-horizontal" id="assign_remove_{{ $post->id }}" style="display: none" >
                                            <button class="btn  btn-success unassign ladda-button" id="remove" ruid="{{ $post->id }}" data-style="slide-left"  type="button" style="height:28px; padding:0 12px"><span class="ladda-label">Active</span></button>
                                        </div>
                                    @endif
                                </td>
                                <td>{{$post->created_at->diffForHumans()}}</td>
{{--                                <td>{{$post->updated_at->diffForHumans()}}</td>--}}
                                <td class="text-center">
                                    <button class="btn btn-danger" type="button" data-toggle="modal" data-target="#myModal{{$post->id}}" style="padding: 2px 10px"><i class="fa fa-trash"></i></button>
                                    <a class="btn btn-info" href="{{ route('post.edit',$post->id) }}" style="padding: 2px 10px"><i class="fa fa-edit"></i></a>
                                </td>
                            </tr>

                            <div id="myModal{{$post->id}}" class="fade modal modal-danger" role="dialog">
                                <form method="post" action="{{route('post.destroy', $post->id)}}" enctype="multipart/form-data" style="display: inline">
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

                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    @endsection

    @section('scripts')
        <script src="{{asset('vendor/datatables/jquery.dataTables.min.js')}}"></script>
        <script src="{{asset('vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>

        <script src="{{asset('js/demo/datatables-demo.js')}}"></script>

        <script type="text/javascript">
//            $(document).ready(function(){
                $('.assign').click(function(){
                    var emp_id = $(this).attr('uid');
                    $.ajax({
                        url: '{{url('admin/posts/assign')}}',
                        type: "post",
                        data: {'id': emp_id,'_token' : $('meta[name=_token]').attr('content')},
                        success: function(data){
                            $('#assign_remove_'+emp_id).show();
                            $('#assign_add_'+emp_id).hide();
                        }
                    });
                });

                $('.unassign').click(function(){

                    var emp_id = $(this).attr('ruid');
                    $.ajax({
                        url: '{{url('admin/posts/unassign')}}',
                        type: "post",
                        data: {'id': emp_id,'_token' : $('meta[name=_token]').attr('content')},
                        success: function(data){
                            $('#assign_remove_'+emp_id).hide();
                            $('#assign_add_'+emp_id).show();
                        }
                    });
                });
//            });
        </script>
    @endsection

</x-admin-master>