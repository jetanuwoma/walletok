<!DOCTYPE html>
<html>
<head>
	<title>My Transactions</title>
	@include('layouts.ion_head')
</head>
<body >
@include('partials.spinner')
<ion-app >
		@include('partials.currencies_menu')
		<div class="ion-page" main>
				<ion-content >
					@include('partials.wallet_current')
	    			<ion-list lines="none">
		        		@include('home.partials.transactions_to_confirm')
	    			</ion-list>
					<ion-item-divider>
						<ion-label>
							{{__('Completed Transactions')}}
						</ion-label>
					</ion-item-divider>

					<ion-list  lines="none">
						@include('home.partials.transactions')
					</ion-list>

					
								{{$transactions->links()}}
								
							
					</ion-content>
		</div>
</ion-app>
<ion-menu-controller></ion-menu-controller>

@include('layouts.js.APP.ionjs')

</body>
</html>
{{--
@extends('layouts.app')

@section('content')

    <div class="row clearfix">
        @include('partials.sidebar')
		
		<div class="col-md-9 " >
        	@include('partials.flash')
	        @include('home.partials.transactions_to_confirm')
	        
	        @include('home.partials.transactions')

    	</div>

    </div>
@endsection

@section('footer')
	@include('partials.footer')
@endsection
--}}