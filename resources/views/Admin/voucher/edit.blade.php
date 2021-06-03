@extends('Admin.layout.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                   <div class="d-flex pt-2 pl-2">
                       <a class="font-weight-bold" style="font-size: 15px" href="{{ route('vouchers.index') }}">Posts </a>
                       <span class="text-info font-weight-bold" style="font-size: 16px; margin: 0 10px"> - </span>
                       <a href="" style="font-size: 15px">Edit Post</a>
                   </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('vouchers.update', $post)}}" enctype="multipart/form-data">
                            @csrf
                            @method('PATCH')
                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">Title</label>
                                <div class="col-md-6">
                                    <input id="name" type="text" name="title" class="form-control" value="{{$post->title }}">
                                    @if($errors->has('title'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong class="text-danger">{{ $errors->first('title') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">Caption</label>
                                <div class="col-md-6">
                                    <input id="name" type="text" name="caption" class="form-control" value="{{$post->caption }}">
                                    @if($errors->has('caption'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong class="text-danger">{{ $errors->first('caption') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            @if(session('success'))
                                <div class="alert-success d-none">
                                    {{session('success')}}
                                </div>
                            @endif

                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">Image</label>
                                <div class="col-md-6">
                                    <img src="/storage/{{ $post->image}}" style="max-width: 200px;">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">Voucher Quantity</label>
                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control" name="voucher_quantity" value="{{ $post->voucher_quantity}}">
                                    @if($errors->has('voucher_quantity'))
                                        <div class="text-danger font-weight-bold mt-2 text-sm-left">
                                            {{ $errors->first('voucher_quantity') }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="example-datetime-local-input" class="col-md-4 col-form-label text-md-right">Voucher Enable</label>
                                <div class="col-md-6">
                                    <input class="form-control" name="voucher_enable" type="datetime-local" value="{{ \Carbon\Carbon::parse($post->voucher_enable)->format('Y-m-d\TH:i')}}" id="example-datetime-local-input">
                                    @if($errors->has('voucher_enable'))
                                        <div class="text-danger font-weight-bold mt-2 text-sm-left">
                                            {{ $errors->first('voucher_enable') }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row d-flex align-items-center justify-content-center">
                                <button class="btn btn-info">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
