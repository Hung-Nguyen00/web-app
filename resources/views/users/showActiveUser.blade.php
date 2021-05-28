@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-6">
                <div class="card-header">Posts</div>
                @foreach($users as $user)
                    @if($user->isOnline())
                        {{ $user->name }} online
                     @else
                        {{ $user->name }} offline
                    @endif
                @endforeach
            </div>
        </div>
    </div>
@endsection
