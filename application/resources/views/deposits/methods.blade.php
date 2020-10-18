
@extends('layouts.app')


@section('content')
    <div class="row">
        @include('partials.sidebar')
        <div class="col-md-9 " >

          <div class="card" >
            <div class="header">
                <h2><strong>{{  __('Automatic Deposit Methods') }}</strong></h2>
                
            </div>
            <div class="body">
             
              @if(setting('payment-gateways.enable_paystack') == 1 )
              <a class="media border border-radius" style="border-radius: 6px" href="{{url('/')}}/buyvoucher/flutterwave">
                <img class="align-self-center mr-3" src="{{url('/')}}/storage/cardpayment.jpeg" alt="Generic placeholder image" style="width: 400px; height: 60px">
              </a>
              @endif

            </div>
          </div>

         

        </div>
    </div>

@endsection
