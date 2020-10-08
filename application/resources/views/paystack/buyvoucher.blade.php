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
                    <div class="preview col-lg-4 col-md-12">
                        <div class="preview-pic tab-content">
                            <div class="tab-pane active show" id="product_1">
                            	<img src="{{url('/')}}/storage/imgs/smOMNQbvaoIgP8Y2TcA6DfgAdVdWsXe1Caww3aYV.png
" class="img-fluid">
                            </div>
                            
                            </div>
                                       
                    </div>
                    <div class="details col-lg-8 col-md-12" id="buy_form">
                        <h3 class="product-title m-b-0">{{__('Add funds to your wallet with your Paystack') }}</h3>                        
                        
                        <div class="action">
                          <form class="d-flex justify-content-left" method="post" action="{{url('/')}}/buyvoucher/paystack">
                          	<div class="row mb-5">
		                      <div class="col-lg-12">
		                        <div class="form-group ">
		                          	<label for="message">{{__('Value')}} in {{ Auth::user()->currentCurrency()->name }}</label>
                            		<input type="number" value="1" name="amount" aria-label="Search" class="form-control" style="width: 100px" v-on:keyup="totalize"  v-on:change="totalize" >
		                        </div>
		                      </div>
		                    	<div class="col-lg-12">
                                    {{csrf_field()}}
                            	<input type="hidden" name="product_id" value="18">
                              <input class="btn btn-primary btn-round waves-effect" value="{{__('Purchase')}}" type="submit">
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