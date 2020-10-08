<!DOCTYPE html>
<html>
<head>
	<title>My Transactions</title>
	<?php $title = 'My Transactions'; ?>
	@include('_mobile.layouts.ion_head')
</head>
<body >
	@include('_mobile.partials.spinner')
	{{--
The phpWallet mobile web App runs smoophly on Google Chrome V8 engine. We strongly recomment you to launch the Chrome Wallet 

We Strongly Recommend You to Use phpWallet on Google Chrome's V8 Engine for better Performance.
	--}}
<ion-app >
		@include('_mobile.partials.PWA.main_menu')
		@include('_mobile.partials.currencies_menu')
		<div class="ion-page" main>
			@include('_mobile.partials.PWA.header')
			<ion-content style="padding:0">
				@include('_mobile.partials.wallet_current')
			
	    			<ion-list lines="none">
		        		@include('_mobile.home.partials.transactions_to_confirm')
	    			</ion-list>
					<ion-item-divider>
						<ion-label>
							{{__('Completed Transactions')}}
						</ion-label>
					</ion-item-divider>

					<ion-list  lines="none">
						@include('_mobile.home.partials.transactions')
					</ion-list>

					
					{{$transactions->links()}}
			</ion-content>
			@include('_mobile.partials.fab')
		</div>
</ion-app>
<ion-menu-controller></ion-menu-controller>
@include('_mobile.layouts.js.PWA.ionjs')
</body>
</html>
