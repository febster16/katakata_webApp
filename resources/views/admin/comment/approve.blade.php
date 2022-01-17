<x-admin-master>
    @section('content')

        <h1>All Approved Comment List</h1>

        @if(session('message'))
            <div class="alert alert-danger">{{session('message')}}</div>
        @endif

        <div class="card shadow mb-4">

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th>Id</th>
                            <th>Post</th>
                            <th>Comment</th>
                            <th>Status</th>
                            <th>Created At</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tfoot>
                        <tr>
                            <th>Id</th>
                            <th>Post</th>
                            <th>Comment</th>
                            <th>Status</th>
                            <th>Created At</th>
                            <th>Action</th>
                        </tr>
                        </tfoot>
                        <tbody>

                        @foreach($comments as $comment)

                            <tr>
                                <td>{{$comment->id}}</td>
                                <td><a href="{{route('post.edit', $comment->post_id)}}">{{$comment->post_id}}</a></td>
                                <td>{{$comment->comment}}</td>
                                <td>{{ $comment->status }}</td>
                                <td>{{$comment->created_at->diffForHumans()}}</td>
                                <td width="5%" class="text-center">
                                    <button class="btn btn-danger" type="button" data-toggle="modal" data-target="#myModal{{$comment->id}}" style="padding: 2px 10px"><i class="fa fa-trash"></i></button>
                                    {{--<a class="btn btn-info" href="{{ route('comment.edit',$comment->id) }}" style="padding: 2px 10px"><i class="fa fa-edit"></i></a>--}}
                                </td>
                            </tr>

                            <div id="myModal{{$comment->id}}" class="fade modal modal-danger" role="dialog">
                                <form method="post" action="{{route('comment.destroy', $comment->id)}}" enctype="multipart/form-data" style="display: inline">
                                    @csrf
                                    @method('DELETE')
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span></button>
                                                <h4 class="modal-title">Delete Comment</h4>
                                            </div>
                                            <div class="modal-body">
                                                <p>Are you sure you want to delete this comment?</p>
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
            $(document).ready(function(){
                $('.assign').click(function(){
                    var emp_id = $(this).attr('uid');
                    $.ajax({
                        url: '{{url('admin/category/assign')}}',
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
                        url: '{{url('admin/category/unassign')}}',
                        type: "post",
                        data: {'id': emp_id,'_token' : $('meta[name=_token]').attr('content')},
                        success: function(data){
                            $('#assign_remove_'+emp_id).hide();
                            $('#assign_add_'+emp_id).show();
                        }
                    });
                });
            });
        </script>
    @endsection

</x-admin-master>