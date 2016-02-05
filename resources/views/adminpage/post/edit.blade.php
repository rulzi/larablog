@extends('layouts.adminapp')

@section('css_optionals')
    <!-- include libraries(jQuery, bootstrap, fontawesome) -->
    <link href="http://netdna.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.css" rel="stylesheet">
    <link href="http://netdna.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.css" rel="stylesheet">
@endsection

@section('js_optionals')
    <!-- include summernote css/js-->
    <link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.7.3/summernote.css" rel="stylesheet">
    <script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.7.3/summernote.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#summernote').summernote({
                height: 150,                 // set editor height
                minHeight: null,             // set minimum height of editor
                maxHeight: null,             // set maximum height of editor
            });
        });
    </script>

@endsection

@section('content')
    <!-- Page Content -->
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Edit Post</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->

            <div class="row">
                <div class="col-lg-6">
                        @if (count($errors) > 0)
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        @if( session('edit_success') )
                            <div class="alert alert-success">
                                {{ session('edit_success') }}
                            </div>
                        @endif
                        <form role="form" method="POST" action="{{ route('admin.post.update', $post->id) }}" enctype="multipart/form-data">
                            {!! csrf_field() !!}
                            {!! method_field('PUT') !!}
                            <div class="form-group">
                                <label>Title</label>
                                <input class="form-control" type="text" name="title" value="{{ old('title', $post->title) }}">
                            </div>
                            <div class="form-group">
                                <label>Content</label>
                                <textarea class="form-control" id="summernote" name="content" >{{ old('content', $post->content) }}</textarea>
                            </div>
                            <div class="form-group">
                                <label>Upload</label>
                                <input type="file" name="file">
                            </div>
                            <div class="form-group">
                                <label>status</label>
                                <select name="status" class="form-control">
                                    <option value="0" {{ (old('status') == 0)?'selected':'' }}>Draft</option>
                                    <option value="1" {{ (old('status') == 1)?'selected':'' }}>Publish</option>
                                </select>
                            </div>

                            <input class="btn btn-primary" type="submit" value="Simpan">

                        </form>
                </div>
                <!-- /.col-lg-12 -->
            </div>
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /#page-wrapper -->
@endsection