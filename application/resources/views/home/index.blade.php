@extends('layouts.app')

@section('content')

    <div class="row clearfix">
        @include('partials.sidebar')
		
		<div class="col-md-9 " >
			@auth
				<div class="row clearfix">
				   
					<div class="col">
						<div class="card info-box-2">
							<div class="header" style="padding-bottom: 0">
								<h2><strong>Account </strong> Number</h2>
								<ul class="header-dropdown">
									<li class="remove">
										<a role="button" class="boxs-close"><i class="zmdi zmdi-close"></i></a>
									</li>
								</ul>
							</div>
							<div class="body" style="padding-top: 0">
								<div class="content">
									<div class="number">{{ Auth::user()->getWalletNumber() }}</div>
									<p><a href="{{url('/account_number/regenerate')}}">{{ __('Regenerate Account Number')}}</p></a>
								</div>
							</div>
						</div>
					</div>
				</div>
			 
					@endauth
        	@include('partials.flash')
    	</div>

    </div>
@endsection

@section('footer')
	@include('partials.footer')
@endsection
