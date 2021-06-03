@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="card-header">
                    <div class="d-flex align-items-center justify-content-between">
                        <h4 class="pt-1"> {{ $user->name }}'s posts</h4>
                        <strong> {{ $posts->count()}} {{ Str::plural('post', $posts->count()) }}</strong>
                    </div>
                </div>
                <div class="col-12 d-flex">
                @foreach($posts as $post)
                    <div class=" col-4 mb-2" style="">
                        <div class="col-12 pb-3 bg-white border-0 mt-2" style="border-radius: 5px">
                            <div class="d-flex pt-1 justify-content-between">
                                <div>
                                    <h5 class="text-info pt-2 pb-2">
                                        <a href=""> {{ $post->user->name }}</a>
                                    </h5>

                                </div>
                                @if($post->ownPost() == true)
                                    <form action=" {{ route('user.destroy', $post->id)}}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger" type="submit">X</button>
                                    </form>
                                @endif

                            </div>
                            <h6 class="" STYLE="font-size: 16px;">
                                {{ $post->title }}
                            </h6>
                        </div>
                        <a href=" {{route('read', $post->id)}}">
                            <img src="/storage/{{ $post->image }}"class="w-100" style="max-width: 100%;" alt="">
                        </a>
                </div>
                @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
