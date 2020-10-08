<ion-menu side="end" type="push">
  <ion-header>
    <ion-toolbar color="white">
    
    </ion-toolbar>
  </ion-header>
  <ion-content>
    <ion-list>
    
    <ion-item lines="none" float-left><ion-badge color="light">{{ Auth::user()->currentCurrency()->symbol }}</ion-badge> <ion-button size="small" color="primary" mode="ios">{{ Auth::user()->currentCurrency()->name }}</ion-button> </ion-item>
    @if(count(\App\Models\Currency::where('id', '!=', Auth::user()->currentCurrency()->id)->get()))
		@foreach(\App\Models\Currency::where('id', '!=', Auth::user()->currentCurrency()->id)->get() as $currency )
		<ion-item lines="none" float-right><ion-text><ion-button size="small" color="light" mode="ios" href="{{ url('/') }}/wallet/{{$currency->id}}" float-right>{{ $currency->name }}</ion-button></ion-text></ion-item>

       	@endforeach
    @endif
    </ion-list>
  </ion-content>
</ion-menu>