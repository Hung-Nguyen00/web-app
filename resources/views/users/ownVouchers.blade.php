@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="card-header">
                    <div class="d-flex align-items-center justify-content-between">
                        <h4 class="pt-1"> {{ $user->name }}'s voucher</h4>
                        <strong> {{ $vouchers->count()}} {{ Str::plural('voucher', $vouchers->count()) }}</strong>
                    </div>
                </div>
                <div class="col-12 d-flex">
                    @foreach($vouchers as $voucher)
                        @if($voucher->voucher_enable > \Carbon\Carbon::now())
                        <div class="col-3 btn btn-info mt-3 d-flex mr-2 align-items-center justify-content-center">

                            <h4 class="text-light pt-2" style="font-size: 15px"> {{ $voucher->code}}</h4>
                        </div>
                        @else
                            <div class="col-3 btn btn-danger mt-3 mr-2 d-flex align-items-center justify-content-center">
                                <h4 class="text-dark pt-2" style="font-size: 15px"> {{ $voucher->code}}</h4>
                            </div>
                        @endif

                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
