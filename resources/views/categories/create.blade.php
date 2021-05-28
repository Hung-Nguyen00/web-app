@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header"> Add Category</div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('category.store') }}">
                            @csrf
                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">Category's Name</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                                <div class="col-md-6">
                                    <select name="parent" id="" class="form-control">
                                        <option value="none"> Add category parent</option>
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}"> {{ $category->name }}</option>
                                        @endforeach
                                    </select>

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
                <div class="card mt-2">
                    <div class="pt-3 pb-3 pl-2 d-flex">
                        @if( $categories->count() > 0)
                            @foreach($categories as $key => $category)
                                @if($category->descendants->count() > 0 && $category->ancestors->count() == 0)
                                    <div class="dropdown pr-2">
                                        <div class="dropbtn d-flex">
                                            <div class="d-flex">
                                                <a  class="text-light"  href="{{ route('category.show', $category->id) }}">{{ $category->name}}</a>
                                            </div>
                                            <div class="pl-2">
                                                <form action="{{ route('category.destroy', $category) }}" method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-danger" style="padding: 0 5px; font-size: 14px" type="submit">x</button>
                                                </form>
                                            </div>
                                        </div>
                                        <div class="dropdown-content">
                                            @foreach($category->descendants as $item)
                                                <div class="d-flex align-items-center justify-content-between pr-2">
                                                    <div>
                                                        <a class=""  href="{{ route('category.show', $item->id) }}">{{ $item->name}}</a>
                                                    </div>
                                                    <div>
                                                        <form action="{{ route('category.destroy', $item)  }}" method="post">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger" style="padding: 0 5px;">X</button>
                                                        </form>
                                                        {{--@if($item->descendants->count() >0)--}}
                                                            {{--@foreach($item->descendants as $childItem)--}}
                                                                {{--<button class="btn btn-danger"> {{ $childItem->name }}</button>--}}
                                                            {{--@endforeach--}}
                                                        {{--@endif--}}
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                @elseif($category->ancestors->count() == 0)
                                    <div class="dropdown pr-2 d-flex">
                                        <div class="dropbtn d-flex">
                                            <div class="d-flex">
                                                <a  class="text-light"  href="{{ route('category.show', $category->id) }}">{{ $category->name}}</a>
                                            </div>
                                            <div class="pl-2">
                                                <form action="{{ route('category.destroy', $category) }}" method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-danger" style="padding: 0 5px; font-size: 14px" type="submit">x</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
