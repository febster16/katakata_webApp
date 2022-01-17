<x-admin-master>
    @section('content')

        <h1>Create</h1>

                @include('admin.error')
                <form method="post" action="{{route('post.store')}}" enctype="multipart/form-data">
                        @csrf


                        <div class="form-group {{ $errors->has('title') ? ' has-error' : '' }}">
                            <label for="title">Title</label>
                                <input type="text"
                                       name="title"
                                       class="form-control"
                                       id="title"
                                       aria-describedby=""
                                       placeholder="Enter title" value="{{ old('title') }}">
                            @if ($errors->has('title'))
                                <span class="help-block text-danger">
                                <strong>{{ $errors->first('title') }}</strong>
                            </span>
                            @endif
                        </div>
                    <div class="form-group {{ $errors->has('category_id') ? ' has-error' : '' }}">
                        <label for="title">Category</label>
                        <select name="category_id" class="form-control" id="category_id">
                            <option value="">Select Category</option>
                            @foreach($category as $cat)
                                <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                            @endforeach
                        </select>

                        @if ($errors->has('category_id'))
                            <span class="help-block text-danger">
                                    <strong>{{ $errors->first('category_id') }}</strong>
                                </span>
                        @endif

                    </div>

                    <div class="form-group {{ $errors->has('post_image') ? ' has-error' : '' }}">
                                <label for="file">File</label>
                                <input type="file"
                                       name="post_image"
                                       class="form-control-file"
                                       id="post_image">
                                @if ($errors->has('post_image'))
                                    <span class="help-block text-danger">
                                    <strong>{{ $errors->first('post_image') }}</strong>
                                </span>
                                @endif
                        </div>


                        <div class="form-group {{ $errors->has('body') ? ' has-error' : '' }}">
                         <textarea
                                 name="body"
                                 class="form-control"
                                 id="body"
                                 cols="30"
                                 rows="10">{{ old('body') }}</textarea>

                            @if ($errors->has('body'))
                                <span class="help-block text-danger">
                                    <strong>{{ $errors->first('body') }}</strong>
                                </span>
                            @endif

                        </div>

                        <div class="form-group {{ $errors->has('status') ? ' has-error' : '' }}">
                            @foreach (\App\Post::$status as $key => $value)
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