@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h5>{{ $post->title }}</h5>
                    </div>
                    <div class="col-12">
                        <h5 class="text-info pt-2">
                            <a href="{{ route('user.ownPosts', $post->user->id) }}"> {{ $post->user->name }}</a>
                        @auth
                                @if($post->ownPost() == false)
                                    @if($voucher != null)
                                        <h6 class="">Voucher code:
                                            <span class="font-weight-bold text-danger">{{ $voucher }}</span>
                                        </h6>
                                    @else
                                        <form action="{{ route('vouchers.store')}}" method="post">
                                            @csrf
                                            <input type="hidden" name="post_id" value="{{ $post->id }}">
                                            <button class="btn btn-info" type="submit">Get voucher</button>
                                        </form>
                                    @endif
                                @endif
                            @endauth
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
