@extends('Admin.layout.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h5 class="font-weight-bold mt-1">Permission</h5>
                    <button class="add_permission btn btn-primary">Add</button>
                </div>
                <table class="table">
                    <thead>
                    <tr>
                        <th>STT</th>
                        <th>Permission</th>
                        <th class="text-center">Write</th>
                        <th class="text-center">Read</th>
                        <th class="text-center">Update</th>
                        <th class="text-center">Delete</th>
                        <th class="text-center">Updated_at</th>
                        <th class="text-center">Edit</th>
                    </tr>
                    </thead>
                    <tbody class="tbody_permission">
                        @php  $i = 0 @endphp
                        @if($permissions->count() > 0)
                            @foreach($permissions as $permission)
                                <form action="{{ route('permissions.update', $permission->permissions_role_id) }}" method="post">
                                <tr>

                                    <td> {{ $i++ }}</td>
                                    <td>
                                        {{ $permission->permission_name}}
                                    </td>
                                    <td class="text-center">
                                            <input type="checkbox" class="form-check-input" name="write_able" {{ ($permission->write_able) ? 'checked' : '' }} >
                                    </td>
                                    <td class="text-center">
                                            <input type="checkbox" class="form-check-input" name="read_able"  {{ ($permission->read_able) ? 'checked' : '' }}>
                                    </td>
                                    <td class="text-center">
                                            <input type="checkbox" class="form-check-input" name="adjust_able" {{ ($permission->adjust_able) ? 'checked' : '' }}>
                                    </td>
                                    <td class="text-center">
                                            <input type="checkbox" class="form-check-input" name="cancel_able"  {{ ($permission->cancel_able) ? 'checked' : '' }}>
                                    </td>
                                    <td class="text-center">
                                        {{ \Carbon\Carbon::parse($permission->update_date)->format('d-m-Y | H:i')}}
                                    </td>
                                    <td>
                                            @method('PATCH')
                                            @csrf
                                            <button class="btn btn-info text-white float-right mt-2 mb-2">Save</button>
                                    </td>
                                </tr>
                                </form>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

