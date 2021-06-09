@extends('Admin.layout.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="card-header d-flex align-items-center ">
                    <h5 class="font-weight-bold mt-1">Permission</h5>
                </div>
                <table class="table">
                    <thead>
                    <tr>
                        <th>STT</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Updated_at</th>
                        <th>Edit</th>
                    </tr>
                    </thead>
                    <tbody>
                    @php  $i = 0 @endphp
                    @if($users->count() > 0)
                        @foreach($users as $user)
                            <form action="{{ route('users.update', $user) }} " method="post">
                        <tr>
                            <td> {{ $i++ }}</td>
                            <td>{{ $user->email }}</td>
                            <td>
                                <select class="btn btn-info"  name="role_id" aria-label="Default select example">
                                    @foreach( $roles as $role)
                                        <option value="{{ $role->id }}"  class="text-light" {{ ($role->name === $user->role->name) ? 'selected' : '' }}>{{ $role->name }}</option>
                                    @endforeach
                                </select>
                            </td>
                            <td> {{ \Carbon\Carbon::parse($user->role->updated_at)->format('d-m-Y | H:i')}}</td>
                            <td >
                                <a class="btn btn-info" href=" {{ route('permissions.edit', $user->role->id) }}">Detail</a>
                                @method('PATCH')
                                @csrf
                                <button type="submit" class="btn btn-primary">Change</button>
                            </td>
                        </tr>
                            </form>
                        @endforeach

                    @endif

                    </tbody>
                </table>
                {{
                      $users->links()
                  }}
            </div>
        </div>
    </div>
@endsection

