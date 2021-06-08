@extends('Admin.layout.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="card-header">
                    <h5>User's manager</h5>
                    <div>
                        <form action=" {{ route('users.import') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <input type="file" name="file" class="form-control">
                            <button type="submit">Import User data</button>
                            @if($errors->has('file'))
                                <p class="text-danger"> {{ $errors->first('file')}}</p>
                                @endif
                            <a href="{{ route('users.export') }}" class="btn btn-info">Export User Data</a>
                        </form>
                    </div>
                </div>
                <table class="table">
                    <thead>
                    <tr>
                        <th>STT</th>
                        <th>Email</th>
                        <th>Name</th>
                        <th>Permission</th>
                        <th>Status</th>
                        <th>Edit</th>
                    </tr>
                    </thead>
                    <tbody>
                    @php
                        $i=0;
                    @endphp
                    @foreach($users as $user)
                        @if($user->isOnline())
                            <tr>
                                <td> {{ ++$i}}</td>
                                <td>{{$user->email}}</td>
                                <td>{{$user->name }}</td>
                                <td></td>
                                <td> Online <span class="text-success font-weight-bold">*</span> </td>
                                <td>
                                    <a href="{{ route('users.edit', $user) }}"> Edit</a>
                                </td>
                            </tr>

                        @else
                            <tr>
                                <td> {{ ++$i}}</td>
                                <td>{{$user->email }}</td>
                                <td>{{$user->name  }}</td>
                                <td></td>
                                <td>Offline <span class="text-dark font-weight-bold">*</span> </td>
                                <td>
                                    <a href="{{ route('users.edit', $user->id)}}"> Edit </a>
                                </td>
                            </tr>
                        @endif
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
