@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-6">
                    <div class="card-header">Posts</div>
                    @foreach($posts as $post)
                        <div class="card mb-2">
                            <div class="col-12 pb-3 bg-white border-0 mt-2 mb-2" style="border-radius: 5px">
                                <h5 class="text-info pt-2 pb-2">
                                    <a href="{{ route('user.ownPosts', $post->user->id) }}"> {{ $post->user->name }}</a>
                                </h5>
                                <a href=" {{route('read', $post->id)}}">
                                    <img src="/storage/{{ $post->image }}"class="w-100" style="max-width: 100%;" alt="">
                                </a>
                            </div>
                        </div>
                    @endforeach
            </div>
        </div>
    </div>
@endsection
