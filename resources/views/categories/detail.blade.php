@extends('layouts.app')

@section('content')
    <div class="container">

        <div class="justify-content-center">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="pt-1">Category - {{ $category->name }}</h5>
                <form action="{{ route('posts.search')}}">
                    @csrf
                    <input class="border-info "  name="search_post" placeholder="Search user" style="padding: 6px; border-radius: 5px;" type="text">
                    <input class="btn btn-info" type="submit" value="Search">
                </form>
            </div>
            <div class="col-12 card-body d-flex justify-content-center flex-wrap">
                @if($posts->count() >0 )
                <div class="row">
                    @foreach($posts as $post)
                        <div class=" col-4 mb-2" style="">
                            <div class="col-12 pb-3 bg-white border-0 mt-2" style="border-radius: 5px">
                                <h5 class="text-info pt-2 pb-2">
                                    <a class="font-weight-bold text-decoration-none" href="{{ route('user.ownPosts', $post->user->id) }}"> {{ $post->user->name }}</a>
                                    <h4 class="font-weight-normal" style="font-size: 16px">{{ $post->title}}</h4>
                                </h5>
                            </div>
                            <div>
                                <a href=" {{route('read', $post->id)}}">
                                    <img src="/storage/{{ $post->image }}"class="w-100" style="max-width: 100%;" alt="">
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
                @else
                <h5 class="text-center">There are any post here</h5>
                @endif
            </div>
        </div>
    </div>
@endsection
