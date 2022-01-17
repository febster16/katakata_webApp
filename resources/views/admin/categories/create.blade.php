<x-admin-master>
    @section('content')

        <h1>Create</h1>

                @include('admin.error')
                <form method="post" action="{{route('category.store')}}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group {{ $errors->has('username') ? ' has-error' : '' }}">
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

                    <div class="form-group {{ $errors->has('image') ? ' has-error' : '' }}">
                        <label for="file">File</label>
                        <input type="file"
                               name="image"
                               class="form-control-file"
                               id="image">
                        @if ($errors->has('image'))
                            <span class="help-block text-danger">
                                    <strong>{{ $errors->first('image') }}</strong>
                                </span>
                        @endif
                    </div>

                    <div class="form-group {{ $errors->has('description') ? ' has-error' : '' }}">
                         <textarea
                                 name="description"
                                 class="form-control"
                                 id="description"
                                 cols="30"
                                 rows="10">{{ old('description') }}</textarea>

                        @if ($errors->has('description'))
                            <span class="help-block text-danger">
                                    <strong>{{ $errors->first('description') }}</strong>
                                </span>
                        @endif

                    </div>

                    <div class="form-group {{ $errors->has('status') ? ' has-error' : '' }}">
                        @foreach (\App\Category::$status as $key => $value)
                            <label>
                                @if($key == 'active')
                                    <input type="radio" value="{{ $key }}" name="status" class="flat-red" id="status_{{ $key }}" checked> <span style="margin-right: 10px" id="status_val_{{$key}}">{{ $value }}</span>
                                @else
                                    <input type="radio" value="{{ $key }}" name="status" class="flat-red" id="status_{{ $key }}"> <span style="margin-right: 10px" id="status_val_{{$key}}">{{ $value }}</span>

                                @endif
                            </label>
                        @endforeach

                        @if ($errors->has('status'))
                            <span class="help-block text-danger">
                                    <strong>{{ $errors->first('status') }}</strong>
                                </span>
                        @endif

                    </div>

                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>

    @endsection
</x-admin-master>