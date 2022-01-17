<x-home-master>

@section('content')

        <h1 class="my-4">Create <small>Post</small>
        </h1>

        <form method="post" action="{{route('user.store_post')}}" enctype="multipart/form-data">
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
                                 rows="6">{{ old('body') }}</textarea>

                @if ($errors->has('body'))
                    <span class="help-block text-danger">
                                    <strong>{{ $errors->first('body') }}</strong>
                                </span>
                @endif

            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>

        <br>

        @endsection


</x-home-master>