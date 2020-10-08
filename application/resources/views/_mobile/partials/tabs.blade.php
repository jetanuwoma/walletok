<ion-tab-button @if(Route::is('profile.info')) tab="Profile" @else href="{{route('profile.info')}}" @endif>
	<ion-icon name="at" mode="ios"></ion-icon>
</ion-tab-button>

<ion-tab-button @if(Route::is('home')) tab="Transactions" @else href="{{route('home')}}" @endif>
  <ion-icon name="paper"></ion-icon>
  <!-- <ion-badge>6</ion-badge> -->
</ion-tab-button>

<ion-tab-button @if(Route::is('sendMoneyForm')) tab="Send"   @else href="{{route('sendMoneyForm')}}" @endif>
  <ion-icon name="paper-plane" mode="ios"></ion-icon>
</ion-tab-button>

<ion-tab-button @if(Route::is('exchange.form')) tab="Exchange" @else href="{{url('/')}}/exchange/first/0/second/0" @endif>
	<ion-icon name="repeat"></ion-icon>
</ion-tab-button>