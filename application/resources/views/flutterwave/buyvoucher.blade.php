@extends('layouts.app')

@section('content')
    <div class="row">
        @include('partials.sidebar')
        <div class="col-md-9 ">
        	<div class="card">
            <div class="body">
                <row class="clearfix">
                    @if($_ENV['APP_DEMO'])
                        <div class="alert alert-info">
                            <p><strong>Heads up!</strong> Use the test cards for demo testing.</p>
                        </div>
                    @endif
                </row>
                <div class="row">
                   
                    <div class="details col-lg-8 col-md-12" id="buy_form">
                               
                        
                        <div class="action">
                          <form class="d-flex justify-content-left" method="post" action="{{ route('pay') }}">
                          	<div class="row mb-5">
		                      <div class="col-lg-12">
		                        <div class="form-group ">
		                          	<label for="message">{{__('Value')}} in {{ Auth::user()->currentCurrency()->name }}</label>
                            		<input type="number" value="1" name="amount" aria-label="Search" class="form-control" style="width: 100px" v-on:keyup="totalize"  v-on:change="totalize" >
		                        </div>
		                      </div>
		                    	<div class="col-lg-12">
                                    {{csrf_field()}}
                                    <input type="hidden" name="payment_method" value="both" /> <!-- Can be card, account, both -->
                                    <input type="hidden" name="description" value="Fund Wallet" /> <!-- Replace the value with your transaction description -->
                                    <input type="hidden" name="country" value="NG" /> <!-- Replace the value with your transaction country -->
                                    <input type="hidden" name="currency" value="NGN" /> <!-- Replace the value with your transaction currency -->
                                    <input type="hidden" name="email" value="{{ Auth::user()->email }}" /> <!-- Replace the value with your customer email -->
                                    <input type="hidden" name="firstname" value="{{ Auth::user()->first_name }}" /> <!-- Replace the value with your customer firstname -->
                                    <input type="hidden" name="lastname" value="{{ Auth::user()->last_name }}" /> <!-- Replace the value with your customer lastname -->
                                     <input type="hidden" name="phonenumber" value="{{ Auth::user()->phonenumber }}" /> <!-- Replace the value with your customer phonenumber -->

                            	<input type="hidden" name="product_id" value="18">
                              <input class="btn btn-primary btn-round waves-effect" value="Add Money" type="submit">
		                    	</div>
		                    </div>
                           
                              
                          </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </div>
    
@endsection
@section('js')
    
@endsection


@section('footer')
  @include('partials.footer')
@endsection