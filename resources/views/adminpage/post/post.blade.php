@extends('layouts.adminapp')

@section('content')
    <!-- Page Content -->
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Post Page</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->

            <div class="row">
                <div class="col-lg-12">
                    @if( session('delete_success') )
                        <div class="alert alert-success">
                            {{ session('delete_success') }}
                        </div>
                    @endif
                    <a href="{{ route('admin.post.create') }}" class="btn btn-primary" type="button">Add Post</a>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Title</th>
                                    <th>Content</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($posts as $no => $post)
                                <tr>
                                    <td>{{ $no+1 }}</td>
                                    <td>{{ $post->title }}</td>
                                    <td>{{ strip_tags($post->content) }}</td>
                                    <td>{{ ($post->status == 1)?'Publish':'Draft' }}</td>
                                    <td>
                                        <a href="{{ route('admin.post.edit', ['post' => $post->id]) }}" class="btn btn-warning btn-xs" type="button">Edit Post</a>
                                        <button class="btn btn-danger btn-xs" data-toggle="modal" data-target="#delete-{{ $post->id }}">
                                            Delete Post
                                        </button>
                                        <!-- Modal -->
                                        <div class="modal fade" id="delete-{{ $post->id }}" tabindex="-1" role="dialog" aria-labelledby="delete-{{ $post->id }}Label" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                        <h4 class="modal-title" id="myModalLabel">Confirmation</h4>
                                                    </div>
                                                    <div class="modal-body">
                                                        Are You Sure want Delete This Post?
                                                    </div>
                                                    <div class="modal-footer">
                                                        <form role="form" method="POST" action="{{ route('admin.post.destroy', $post->id) }}">
                                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                        {!! csrf_field() !!}
                                                        {!! method_field('DELETE') !!}
                                                        <button type="submit" class="btn btn-danger">Delete</button>
                                                        </form>
                                                    </div>
                                                </div>
                                                <!-- /.modal-content -->
                                            </div>
                                            <!-- /.modal-dialog -->
                                        </div>
                                        <!-- /.modal -->
                                    </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="4">Empty Post</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    {!! $posts->links() !!}
                </div>
                <!-- /.col-lg-12 -->
            </div>
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /#page-wrapper -->
@endsection
