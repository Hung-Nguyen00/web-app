@extends('layouts.app')

@section('content')
        <div class="content border position-absolute shadow-sm p-3 mb-5 bg-white rounded" style="border-radius: 5px; top: 25%; left: 40%; padding: 10px 10px">
            <div class="title mt-2">
               <h2>Login</h2>
            </div>
            @if(session('status'))
                <div class="text-danger font-weight-bold mt-3 text-sm-left">
                    {{session('status')}}
                </div>
            @endif
            <form action="{{route('login')}}" method="post">
                @csrf
                <div class="form-group">
                    <label for="exampleInputEmail1" class="float-left font-weight-bold">Email address</label>
                    <input type="email" class="form-control" name="email" style="padding: 15px 15px;" placeholder="Enter email">
                    @if($errors->has('email'))
                        <div class="text-danger font-weight-bold mt-2 text-sm-left">
                            {{ $errors->first('email') }}
                        </div>
                    @endif
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1" class="float-left font-weight-bold">Password</label>
                    <input type="password" class="form-control"  style="padding: 15px 15px;"  name="password" placeholder="Password">
                    @if($errors->has('password'))
                        <div class="text-danger font-weight-bold mt-2 text-sm-left">
                            {{ $errors->first('password') }}
                        </div>
                    @endif
                </div>
                <div class="form-group form-check float-left">
                    <input type="checkbox" name="remember" class="form-check-input">
                    <label class="form-check-label w-100 font-weight-bold" style="margin-left: 10px"  for="exampleCheck1">Remember</label>
                </div>
                <button type="submit" class="btn btn-primary" style="width: 100%; ">Submit</button>
            </form>
        </div>
@endsection