@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">Post detail</div>
                        <div class="col-12">
                            <h5 class="text-info pt-2">
                                <a href="{{ route('user.ownPosts', $post->user->id) }}"> {{ $post->user->name }}</a>
                            </h5>
                            <p>{{ $post->caption }}</p>
                        </div>
                        <div class="border-0" style="border-radius: 5px;">
                            <img src="/storage/{{ $post->image }}"class="w-100" style="max-width: 100%;" alt="">
                        </div>
                </div>
            </div>
        </div>
    </div>
@endsection
