@extends('Admin.layout.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="card-header">
                    <a class="font-weight-bold" style="font-size: 15px" href="{{ route('vouchers.index') }}">Posts </a>
                    <span class="text-info font-weight-bold" style="font-size: 16px; margin: 0 10px"> - </span>
                    <a href="" style="font-size: 15px">Vouchers</a>
                </div>
                @if($vouchers->count() > 0)
                <table class="table">
                    <thead>
                    <tr>
                        <th>STT</th>
                        <th>Voucher Code</th>
                        <th class="text-center">Reviecing Time</th>
                        <th>User's Name</th>
                        <th>Edit</th>
                    </tr>
                    </thead>
                    <tbody>
                        @php
                            $i=0;
                        @endphp
                        @foreach($vouchers as $voucher)
                            <tr>
                                <td> {{ ++$i}}</td>
                                <td>{{ $voucher->voucher_code }}</td>
                                <td class="text-center">
                                    {{ Carbon\Carbon::parse($voucher->created_at)->format('d-m-Y\ | H:i')}}
                                </td>
                                <td>
                                    @foreach($users as $user)
                                    @if($user->id == $voucher->user_id)
                                        {{ $user->name}}
                                        @endif
                                    @endforeach
                                </td>
                                <td>
                                    <form method="post" action="{{ route('vouchers.destroy', $voucher) }}">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn-danger btn">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
                @else
                    <h2 class="text-center pt-5">There are any voucher of user hear</h2>
                @endif
            </div>
        </div>
    </div>
@endsection
