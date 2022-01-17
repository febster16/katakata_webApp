<x-admin-master>
    @section('content')

        <h1>Create</h1>

                @include('admin.error')
                <form method="post" action="{{route('user.store')}}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group {{ $errors->has('username') ? ' has-error' : '' }}">
                            <label for="title">Username</label>
                                <input type="text"
                                       name="username"
                                       class="form-control"
                                       id="username"
                                       aria-describedby=""
                                       placeholder="Enter username" value="{{ old('username') }}">
                                @if ($errors->has('username'))
                                    <span class="help-block text-danger">
                                    <strong>{{ $errors->first('username') }}</strong>
                                </span>
                                @endif
                        </div>

                    <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
                        <label for="title">Name</label>
                        <input type="text"
                               name="name"
                               class="form-control"
                               id="name"
                               aria-describedby=""
                               placeholder="Enter name" value="{{ old('name') }}">
                        @if ($errors->has('name'))
                            <span class="help-block text-danger">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                        @endif
                    </div>


                    <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">
                        <label for="title">Email</label>
                        <input type="email"
                               name="email"
                               class="form-control"
                               id="email"
                               aria-describedby=""
                               placeholder="Enter email" value="{{ old('email') }}">
                        @if ($errors->has('email'))
                            <span class="help-block text-danger">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                        @endif
                    </div>

                    <div class="form-group {{ $errors->has('password') ? ' has-error' : '' }}">
                        <label for="title">Password</label>
                        <input type="password"
                               name="password"
                               class="form-control"
                               id="password"
                               aria-describedby=""
                               placeholder="Enter password" value="{{ old('password') }}">
                        @if ($errors->has('password'))
                            <span class="help-block text-danger">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                        @endif
                    </div>

                        <div class="form-group {{ $errors->has('avatar') ? ' has-error' : '' }}">
                                <label for="file">Avatar</label>
                                <input type="file"
                                       name="avatar"
                                       class="form-control-file"
                                       id="avatar">
                                @if ($errors->has('avatar'))
                                    <span class="help-block text-danger">
                                    <strong>{{ $errors->first('avatar') }}</strong>
                                </span>
                                @endif
                        </div>

                        <button type="submit" class="btn btn-primary">Submit</button>
                </form>

    @endsection
</x-admin-master>