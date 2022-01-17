<x-admin-master>

    @section('content')

        <h1>All Users</h1>

        @if(session('user-deleted'))
                    <div class="alert alert-danger">{{session('user-deleted')}}</div>
        @endif

        @if(session('user-updated'))
            <div class="alert alert-success">{{session('user-updated')}}</div>
        @endif

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Users</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th>Id</th>
                            <th>Username</th>
                            <th>Avatar</th>
                            <th>Name</th>
                            <th>Registered date</th>
                            <th>Updated profile date</th>
                            <th>Action</th>
                        </tr>

                   </thead>
                        <tfoot>
                        <tr>
                            <th>Id</th>
                            <th>Username</th>
                            <th>Avatar</th>
                            <th>Name</th>
                            <th>Registered date</th>
                            <th>Updated profile date</th>
                            <td>Action</td>
                        </tr>
                        </tfoot>
                        <tbody>

                        @foreach($users as $user)

                        <tr>
                            <td>{{$user->id}}</td>
                            <td>{{$user->username}}</td>
                            <td>
                                <img width="100px" src="{{$user->avatar}}" alt="">
                            </td>
                            <td>{{$user->name}}</td>
                            <td>{{$user->created_at->diffForhumans()}}</td>
                            <td>{{$user->updated_at->diffForhumans()}}</td>
                            <td class="text-center">
                                <button class="btn btn-danger" type="button" data-toggle="modal" data-target="#myModal{{$user->id}}" style="padding: 2px 10px"><i class="fa fa-trash"></i></button>
                                <a class="btn btn-info" href="{{ route('user.edit',$user->id) }}" style="padding: 2px 10px"><i class="fa fa-edit"></i></a>
                            </td>
                        </tr>

                        <div id="myModal{{$user->id}}" class="fade modal modal-danger" role="dialog">
                            <form method="post" action="{{route('user.destroy', $user->id)}}" enctype="multipart/form-data" style="display: inline">
                                @csrf
                                @method('DELETE')
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span></button>
                                            <h4 class="modal-title">Delete User</h4>
                                        </div>
                                        <div class="modal-body">
                                            <p>Are you sure you want to delete this user?</p>
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
    @endsection

</x-admin-master>