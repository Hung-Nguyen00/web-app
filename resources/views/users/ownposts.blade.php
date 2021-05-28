@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-6">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <h4> {{ $user->name }}'s posts</h4>
                        <strong> {{ $posts->count()}} {{ Str::plural('post', $posts->count()) }}</strong>
                    </div>
                </div>
                @foreach($posts as $post)
                    <div class="card mb-2">
                        <div class="col-12 pb-3 bg-white border-0 mt-2 mb-2" style="border-radius: 5px">
                            <div class="d-flex justify-content-between align-items-center">
                                <h5 class="text-info pt-2 pb-2">
                                    <a href=""> {{ $post->user->name }}</a>
                                </h5>
                                @if($post->ownPost() == true)
                                    <form action=" {{ route('user.destroy', $post->id)}}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger" type="submit">X</button>
                                    </form>
                                @endif
                            </div>
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
