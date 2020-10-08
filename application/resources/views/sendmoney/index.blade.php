@extends('layouts.app')

@section('content')

    <div class="row">
        @include('partials.sidebar')
        <div class="col-md-9 " style="padding-right: 0" id="#sendMoney">
          @include('flash')
          <div class="card">
            <div class="header">
                <h2><strong>{{__('Money')}}</strong> {{__("Transfer")}}</h2>
                
            </div>
            <div class="body">
              <form action="{{route('sendMoney')}}" method="post" enctype="multipart/form-data">
                    {{csrf_field()}}
                    <div class="row">
                      <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                      <div class="form-group {{ $errors->has('merchant_site_url') ? ' has-error' : '' }}">
                        <div class="form-group">
                          <label for="deposit_method">{{__('Currency')}} [ <span class="text-primary">{{Auth::user()->currentCurrency()->code}}</span> ]</label>
                          <select class="form-control" id="currency" name="currency">
                            <option value="{{ Auth::user()->currentCurrency()->id }}" data-value="{{ Auth::user()->currentCurrency()->id}}" selected>{{ Auth::user()->currentCurrency()->name }} </option>
                            @forelse($currencies as $currency)
                                <option value="{{$currency->id}}" data-value="{{$currency->id}}">{{$currency->name}}</option>
                            @empty


                            @endforelse
                          </select>
                          @if ($errors->has('currency'))
                            <span class="help-block">
                                <strong>{{ $errors->first('currency') }}</strong>
                            </span>
                        @endif
                        </div>
                      </div>
                </div>
                      <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                        <div class="form-group {{ $errors->has('amount') ? ' has-danger' : '' }}">
                          <label for="amount">{{__('Amount')}}</label>
                          <input type="number" class="form-control" id="amount" name="amount" value="{{old('amount')}}" required placeholder="5.00" pattern="[0-9]+([\.,][0-9]+)?" 
                          step="0.01" >
                           @if ($errors->has('amount'))
                                <div class="form-control-feedback">
                                    <strong>{{ $errors->first('amount') }}</strong>
                                </div>
                            @endif
                        </div>
                      </div>
                      
                      
                      @if (Auth::user()->currentCurrency()->symbol != '(BTC)')
                      <div class="form-group">
                          <label for="deposit_method">Select Method </label>
                          <select class="form-control" id="payment_type" name="payment_type" >
                              <option value="User Wallet" data-value="wallet">User Wallet</option>
                            <option value="Paypal" data-value="paypal">Paypal</option>
                          </select>
                        
                        </div>
                      @endif
                      
                      
                      
                    </div>
                    <div class="clearfix"></div>

                    <div class="row">
                      <div class="col">

                        <div class="form-group">
                          @if (Auth::user()->currentCurrency()->symbol != '(BTC)')
                          <div class="account_group">
                            <label for="wallet_number">Account Number</label>
                            <input type="text" class="form-control" id="wallet_number" name="account" value="{{old('account')}}" placeholder="Receivers Account Number" 
                           >
                          </div>
                          <div class="paypal_group">
                              <label for="payal_details">Paypal Email</label>
                              <input type="text" class="form-control" id="paypal" name="paypal" value="{{old('paypal')}}"  placeholder="Receivers Paypal Email" 
                             >
                          </div>
                        </div>
                        @endif
                        <div class="form-group {{ $errors->has('description') ? ' has-danger' : '' }}">
                          <label for="description">Payment Detail</label>
                          @if (Auth::user()->currentCurrency()->symbol == '(BTC)')
                          <input type="text" class="form-control" id="address" name="address" value="{{old('address')}}" required placeholder="receivers address" 
                           >
                           @else
                           <textarea class="form-control" rows="5" id="description" name="description" placeholder="Note" ></textarea>
                           
                           @if ($errors->has('description'))
                                <div class="form-control-feedback">
                                    <strong>{{ $errors->first('description') }}</strong>
                                </div>
                            @endif
                          @endif
                         
                        </div>
                      </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="row">
                      <div class="col">
                        <input type="submit" class="btn btn-primary float-right" value="{{__('Send Money')}}">
                      </div>
                    </div>
                    <div class="clearfix"></div>
                  </form>                        
                
            </div>
          </div>
            
        </div>
    </div>
@endsection
@section('js')
<script>
$(document).ready(function() {
  $('.paypal_group').hide();
})
$( "#currency" )
  .change(function () {
    $( "#currency option:selected" ).each(function() {
      window.location.replace("{{url('/')}}/wallet/"+$(this).val());
  });
})

$('#payment_type').change(function(event) {
  if($(this).val() == 'Paypal') {
    $('.paypal_group').show();
    $('.account_group').hide();
  } else {
    $('.paypal_group').hide();
    $('.account_group').show();
  }
})
</script>

@endsection
@section('footer')
  @include('partials.footer')
@endsection
