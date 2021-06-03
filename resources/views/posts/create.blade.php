@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header"> Create Post</div>
                    <div class="card-body">
                        <form method="post" enctype="multipart/form-data" action="{{ route('posts.store') }}">
                            @csrf
                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label">Title</label>
                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="title" value="{{ old('title')}}" >
                                    @if($errors->has('title'))
                                        <div class="text-danger font-weight-bold mt-2 text-sm-left">
                                            {{ $errors->first('title') }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label">Caption</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="caption" value="{{ old('name')}}" >
                                    @if($errors->has('caption'))
                                        <div class="text-danger font-weight-bold mt-2 text-sm-left">
                                            {{ $errors->first('caption') }}
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="image" class="col-md-4 col-form-label">Image</label>
                                <div class="col-md-6">
                                    <input id="file" type="file" class="form-control @error('name') is-invalid @enderror" name="image" value="{{ old('name') }}">
                                    @if($errors->has('image'))
                                        <div class="text-danger font-weight-bold mt-2 text-sm-left">
                                            {{ $errors->first('image') }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label">{{ __('Name') }}</label>
                                <div class="col-md-6">
                                    <select name="category" id="" class="form-control">
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}"> {{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                    @if($errors->has('category'))
                                        <div class="text-danger font-weight-bold mt-2 text-sm-left">
                                            {{ $errors->first('category') }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        Save
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
