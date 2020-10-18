@extends('layouts.app')

@section('content')
{{--  @include('partials.nav')  --}}
    <div class="row">
        @include('partials.sidebar')

        <div class="col-md-9 ">
          @if(Auth::user()->currentCurrency()->symbol == "(BTC)")
          <div class="card">
            <div class="header">
              <h2><strong>{{__('About')}}</strong> BTC {{__('withdrawals')}}</h2>
            </div>
            <div class="body">
              <div class="row">
                <div class="col-lg-12">
                    <div >
                        Notice your withdrawal is subject approval and after withdrawal
                    </div>
                </div>
              </div>
            </div>
          </div>
          @else
          <div class="card">
              <div class="header">
               
              </div>
              <div class="body">
                <div class="row">
                  <div class="col-lg-12">
                     
                  </div>
                </div>
              </div>
            </div>
          @endif
          <div class="card">
          <div class="header">
            <h2><strong>{{__('Withdrawal Request')}}</strong></h2>
          </div>
          <div class="body">
            <form action="{{route('post.withdrawal')}}" method="post" enctype="multipart/form-data" id="withdrawal_form">
              {{csrf_field()}}
              
              <div class="row">
               
                </div>
                <div class="col-lg-5 col-xs-12">
                  <div class="form-group {{ $errors->has('merchant_site_url') ? ' has-error' : '' }}">
                    <div class="form-group">
                      <label for="bank_code">{{__('Bank')}}</label>
                      <select class="" id="bank_code" name="bank_code">
                          @forelse($banks as $bank)
                          <option value="{{$bank->Code}}">{{$bank->Name}}</option>
                        @empty
                        @endforelse
                      </select>
                     
                    </div>
                  </div>
                </div>
                <div class="col-lg-7 col-xs-12">
                  <div class="row">
                    <div class="col">
                      <div class="form-group {{ $errors->has('amount') ? ' has-error' : '' }}">
                       <label for="amount">{{__('Amount')}}</label>
                       <input type="number" name="amount" class="form-control"  v-on:keyup="totalize" v-on:change="totalize">
                        @if ($errors->has('amount'))
                            <span class="help-block">
                                <strong class="text-danger">{{ $errors->first('amount') }}</strong> <span class="text-primary">{{Auth::user()->currentCurrency()->symbol}}</span> 
                            </span>
                        @endif
                      </div>
                    </div>
                    <div class="col">
                      <div class="form-group {{ $errors->has('fee') ? ' has-error' : '' }}">
                       <label for="fee">Net [ <small class="bg-dark text-white"> {{__('gross')}} -  {{__('Fees')}} &nbsp;</span></small> ]</label>
                      {{-- <input type="number" name="fee" class="form-control" v-model="total"> --}}
                      <br>
                       <h2 style="margin-top: 0" ><span >@{{total}}</span> {{Auth::user()->currentCurrency()->symbol}}</h2> 
                        @if ($errors->has('fee'))
                            <span class="help-block">
                                <strong>{{ $errors->first('fee') }}</strong>
                            </span>
                        @endif
                      </div>
                    </div>
                  </div>
                </div>
  
              <div class="row">
                <div class="col">
                  <div class="form-group {{ $errors->has('platform_id') ? ' has-error' : '' }}">
                   <label for="platform_id">Account Name</label>
                 <input type="text" name="account_name" id="account_name" class="form-control" required> 
                    @if ($errors->has('account_name'))
                        <span class="help-block">
                            <strong>{{ $errors->first('account_name') }}</strong>
                        </span>
                    @endif
                  </div>
                </div>
              </div>
              <div class="row">
                  <div class="col">
                    <div class="form-group {{ $errors->has('platform_id') ? ' has-error' : '' }}">
                     <label for="platform_id">Account Number</label>
                   <input type="text" name="account_number" id="account_number" class="form-control" required> 
                      @if ($errors->has('account_number'))
                          <span class="help-block">
                              <strong>{{ $errors->first('account_number') }}</strong>
                          </span>
                      @endif
                    </div>
                  </div>
                </div>
 
              <div class="clearfix"></div>
              <div class="row">
                <div class="col-lg-12">
                  <input type="submit" class="btn btn-primary float-right" value="{{__('Request Withdrawal')}}">
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
@include('withdrawals.vue')
<script>

  

</script>

@endsection
@section('footer')
  @include('partials.footer')
@endsection