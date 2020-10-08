<ion-fab vertical="bottom" horizontal="end" slot="fixed" mode="ios">
	<ion-fab-button  color="primary">
	  <ion-icon name="add" ></ion-icon>
	</ion-fab-button>
	<ion-fab-list side="top">
	  	<ion-fab-button  @if(Route::is('home')) color="dark" @else href="{{route('home')}}" @endif ><ion-icon name="paper" mode="ios"></ion-icon></ion-fab-button>
	   	<ion-fab-button @if(Route::is('sendMoneyForm')) color="dark"   @else href="{{route('sendMoneyForm')}}" @endif><ion-icon name="paper-plane" mode="ios"></ion-icon></ion-fab-button>
	    <ion-fab-button @if(Route::is('exchange.form')) color="repeat" @else href="{{url('/')}}/exchange/first/0/second/0" @endif><ion-icon name="repeat"></ion-icon></ion-fab-button>
	    <ion-fab-button  @if(Route::is('profile.info')) color="dark" @else href="{{route('profile.info')}}" @endif><ion-icon name="at" mode="ios"></ion-icon></ion-fab-button>
	</ion-fab-list>
</ion-fab>