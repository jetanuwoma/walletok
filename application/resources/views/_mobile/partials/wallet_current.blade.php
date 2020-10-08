<div id="top"></div>
	
	<ion-card  color="primary" style="margin-top: -40px; margin-left: 0;margin-right: 0">
		<ion-card-header>
			<ion-card-subtitle>Wallet Balance</ion-card-subtitle>
		</ion-card-header>
		<ion-item color="primary" lines="none" margin-bottom>
			<ion-label float-left >
				<ion-card-subtitle >
					<ion-button mode="ios" id="c-but" color="primary" onclick="openEnd()" style="margin-left: -12px">
						<ion-icon name="arrow-forward" mode="ios" slot="end"></ion-icon>{{ Auth::user()->currentCurrency()->name }}
					</ion-button>
					{{--
					@if(count(\App\Models\Currency::where('id', '!=', Auth::user()->currentCurrency()->id)->get()))

					<ion-select  onclick="openEnd()" value="{{ Auth::user()->currentCurrency()->name }}" style="padding-left: 0; padding-right: 0" placeholder="Select One">

						<ion-select-option value="{{ Auth::user()->currentCurrency()->name }}">{{ Auth::user()->currentCurrency()->name }}</ion-select-option>
						
				    </ion-select>
	                   
	                @endif
	                
	                --}}
				</ion-card-subtitle>
				<ion-card-title>{{ \App\Helpers\Money::instance()->value(Auth::user()->balance(), Auth::user()->currentCurrency()->symbol) }}</ion-card-title>
			</ion-label>
			<ion-button expand="block" size="large" color="secondary" float-right href="{{route('add.credit')}}" mode="ios" style="margin-bottom:0">
				<ion-icon name="add-circle" ></ion-icon>
			</ion-button>
		</ion-item>	
	</ion-card>
	@include('partials.flash')