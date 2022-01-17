<x-home-master>

    @section('content')

        <h1 class="my-4">Profile <small> {{$user->name}}</small>
        </h1>

        @if(Session::has('message'))
            <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
        @endif

        <form method="post" action="{{route('user.update.profile')}}" enctype="multipart/form-data">
            @csrf

            <div class="form-group {{ $errors->has('avatar') ? ' has-error' : '' }}">
                <div><img height="100px" src="{{$user->avatar}}" alt=""></div>
                <label for="file">File</label>
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


            <div class="form-group {{ $errors->has('username') ? ' has-error' : '' }}">
                <label for="title">Username</label>
                <input type="text"
                       name="username"
                       class="form-control"
                       id="username"
                       aria-describedby=""
                       placeholder="Enter username" value="{{$user->username}}">
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
                       placeholder="Enter username" value="{{$user->name}}">
                @if ($errors->has('name'))
                    <span class="help-block text-danger">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                @endif
            </div>

            <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">
                <label for="email">Email</label>
                <input type="text"
                       name="email"
                       class="form-control"
                       id="email"
                       aria-describedby=""
                       placeholder="Enter email" value="{{$user->email}}">
                @if ($errors->has('email'))
                    <span class="help-block text-danger">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                @endif
            </div>

            <div class="form-group {{ $errors->has('password') ? ' has-error' : '' }}">
                <label for="email">Password</label>
                <input type="password"
                       name="password"
                       class="form-control"
                       id="password"
                       aria-describedby=""
                       placeholder="Enter password" value="">
                @if ($errors->has('password'))
                    <span class="help-block text-danger">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                @endif
            </div>

            <div class="form-group {{ $errors->has('password') ? ' has-error' : '' }}">
                <label for="email">Confirm Password</label>
                <input type="password"
                       name="password_confirmation"
                       class="form-control"
                       id="password_confirmation"
                       aria-describedby=""
                       placeholder="Enter password" value="">
                @if ($errors->has('password_confirmation'))
                    <span class="help-block text-danger">
                                <strong>{{ $errors->first('password_confirmation') }}</strong>
                            </span>
                @endif
            </div>



            <button type="submit" class="btn btn-primary">Submit</button>
        </form>

        <br>

    @endsection


</x-home-master>