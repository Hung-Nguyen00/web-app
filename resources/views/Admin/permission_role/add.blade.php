@extends('Admin.layout.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h5 class="font-weight-bold mt-1">Permission</h5>
                    <button class="add_permission btn btn-primary">Add</button>
                </div>
                <input type="text" name="name">
                <input type="checkbox" class="form-check-input" name="write_able" {{ ($permission->write_able) ? 'checked' : '' }} >
                <input type="checkbox" class="form-check-input" name="read_able"  {{ ($permission->read_able) ? 'checked' : '' }}>
                <input type="checkbox" class="form-check-input" name="adjust_able" {{ ($permission->adjust_able) ? 'checked' : '' }}>
                <input type="checkbox" class="form-check-input" name="cancel_able"  {{ ($permission->cancel_able) ? 'checked' : '' }}>
            </div>
        </div>
    </div>
@endsection

