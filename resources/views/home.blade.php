@extends('layouts.app')

@section('title')
    Afandi Blog
@endsection


@section('content')
    <!-- Main Content -->
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
                @foreach($posts as $post)
                <div class="post-preview">
                    <a href="{{ route('blogshow', ['slug' => $post->slug]) }}">
                        <h2 class="post-title">
                            {{ ucfirst($post->title) }}
                        </h2>
                    </a>
                    <p class="post-meta">Posted by <a href="#">Afandi</a> on {{ with($post->created_at)->format('F d, Y') }}</p>
                </div>
                <hr>
                @endforeach
                <!-- Pager -->
                <ul class="pager">
                    @if ($prevpage)
                    <li class="previous">
                        <a href="{{ $prevpage }}"> &larr; New Posts</a>
                    </li>
                    @endif
                    @if($nextpage)
                    <li class="next">
                        <a href="{{ $nextpage }}">Older Posts &rarr;</a>
                    </li>
                    @endif
                </ul>
            </div>
        </div>
    </div>
@endsection
