@extends('Admin.layout.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="card-header d-flex align-items-center ">
                    <h5 class="font-weight-bold mt-1">Posts manager</h5>
                </div>
                <table class="table">
                    <thead>
                    <tr>
                        <th>STT</th>
                        <th>User's Name</th>
                        <td>Title</td>
                        <th>Image</th>
                        <th class="text-center">Voucher Quantity</th>
                        <th>Voucher Enable</th>
                        <th>Edit</th>
                    </tr>
                    </thead>
                    <tbody>
                    @php
                        $i=0;
                    @endphp
                    @foreach($posts as $post)
                            <tr>
                                <td> {{ ++$i}}</td>
                                <td>{{ $post->user->name }}</td>
                                <td>{{$post->title}}</td>
                                <td>
                                    <img src="/storage/{{$post->image}}" alt="post" style="max-width: 50px;">
                                </td>
                                <td class="text-center">
                                    @if($post->voucher_quantity == 0)
                                            0/{{$post->voucher_quantity}}
                                    @else
                                        {{ ($post->voucher_quantity - $post->hasVouchers()->count())
                                       .'/'.$post->voucher_quantity }}

                                    @endif
                                    @if($post->voucher_quantity == 0 || $post->voucher_enable < \Carbon\Carbon::now())
                                            <a class="text-danger" href="{{ route('vouchers.show', $post) }}">View</a>
                                        @else
                                            <a class="text-info" href="{{ route('vouchers.show', $post) }}">View</a>
                                    @endif
                                </td>
                                <td>
                                    {{ Carbon\Carbon::parse($post->voucher_enable)->format('d-m-Y\ | H:i') }}
                                </td>
                                <td>
                                    <a href="{{ route('vouchers.edit', $post) }}">Edit</a>
                                </td>
                            </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
