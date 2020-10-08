@if($transaction->activity_title == 'Payment Sent')

	<ion-card-subtitle>{{$transaction->activity_title}} </ion-card-subtitle><ion-card-title><ion-text color="">{{__('To')}} {{$transaction->entity_name}}</ion-text></ion-card-title>

@elseif($transaction->activity_title == 'Payment Received')

	<ion-card-subtitle>{{$transaction->activity_title}} </ion-card-subtitle><ion-card-title><ion-text color="">{{__('From')}} {{$transaction->entity_name}}</ion-text></ion-card-title>

@elseif($transaction->activity_title == 'Voucher Load')

	<ion-card-subtitle>{{$transaction->entity_name}} </ion-card-subtitle><ion-card-title><ion-text color=""> {{__('Voucher Load')}}</ion-text></ion-card-title>

@elseif($transaction->activity_title == 'Voucher Generation')

	<ion-card-subtitle>{{$transaction->entity_name}} </ion-card-subtitle><ion-card-title><ion-text color=""> {{__('Voucher Generation')}}</ion-text></ion-card-title>

@elseif($transaction->activity_title == 'Added Voucher to system')

	<ion-card-subtitle>{{$transaction->entity_name}} </ion-card-subtitle><ion-card-title><ion-text color=""> {{__('Added Voucher to system')}}</ion-text></ion-card-title>

@elseif($transaction->activity_title == 'Purchase')

	<ion-card-subtitle>{{$transaction->activity_title}} </ion-card-subtitle><ion-card-title><ion-text color="">{{__('From')}} {{$transaction->entity_name}}</ion-text></ion-card-title>

@elseif($transaction->activity_title == 'Sale')

	<ion-card-subtitle>{{$transaction->activity_title}} </ion-card-subtitle><ion-card-title><ion-text color="">{{__('In')}} {{$transaction->entity_name}} </ion-text></ion-card-title>

@elseif($transaction->activity_title == 'Withdrawal')

	<ion-card-subtitle>{{$transaction->activity_title}} {{__('From')}} {{setting('site.title')}} {{__('to')}}</ion-card-subtitle><ion-card-title><ion-text color="">{{Auth::user()->name}} {{$transaction->entity_name}} {{__('Account')}}</ion-text></ion-card-title>

@elseif($transaction->activity_title == 'Deposit')

	<ion-card-subtitle>{{$transaction->activity_title}} {{__('From')}} {{$transaction->entity_name}} {{__('Account')}}  {{__('to')}}</ion-card-subtitle><ion-card-title><ion-text color="">{{Auth::user()->name}} {{setting('site.title')}}</ion-text></ion-card-title>

@elseif($transaction->activity_title == 'Currency Exchange')

	<ion-card-subtitle>{{$transaction->activity_title}} </ion-card-subtitle><ion-card-title><ion-text color=""> @if($transaction->money_flow == '+') {{__('Exchanged To')}} 	
@else {{__('Exchanged From')}} @endif {{$transaction->entity_name}}</ion-text></ion-card-title>

@endif

{{--
@if($transaction->activity_title == 'Payment Sent')

	<ion-text color="primary">{{$transaction->activity_title}}</ion-text> <br><span class="">{{__('To')}} {{$transaction->entity_name}}</span>

@elseif($transaction->activity_title == 'Payment Received')

	<ion-text color="primary">{{$transaction->activity_title}}</ion-text> <br><span class="">{{__('From')}} {{$transaction->entity_name}}</span>

@elseif($transaction->activity_title == 'Voucher Load')

	<ion-text color="primary">{{$transaction->entity_name}}</ion-text> <br><span class=""> {{__('Voucher Load')}}</span>

@elseif($transaction->activity_title == 'Voucher Generation')

	<ion-text color="primary">{{$transaction->entity_name}}</ion-text> <br><span class=""> {{__('Voucher Generation')}}</span>

@elseif($transaction->activity_title == 'Added Voucher to system')

	<ion-text color="primary">{{$transaction->entity_name}}</ion-text> <br><span class=""> {{__('Added Voucher to system')}}</span>

@elseif($transaction->activity_title == 'Purchase')

	<ion-text color="primary">{{$transaction->activity_title}}</ion-text> <br><span class="">{{__('From')}} {{$transaction->entity_name}}</span>

@elseif($transaction->activity_title == 'Sale')

	<ion-text color="primary">{{$transaction->activity_title}}</ion-text> <br><span class="">{{__('In')}} {{$transaction->entity_name}} </span>

@elseif($transaction->activity_title == 'Withdrawal')

	<ion-text color="primary">{{$transaction->activity_title}}</ion-text> {{__('From')}} {{setting('site.title')}} {{__('to')}}<br><span class="">{{Auth::user()->name}} {{$transaction->entity_name}} {{__('Account')}}</span>

@elseif($transaction->activity_title == 'Deposit')

	<ion-text color="primary">{{$transaction->activity_title}}</ion-text> {{__('From')}} {{$transaction->entity_name}} {{__('Account')}}  {{__('to')}}<br><span class="">{{Auth::user()->name}} {{setting('site.title')}}</span>

@elseif($transaction->activity_title == 'Currency Exchange')

	<ion-text color="primary">{{$transaction->activity_title}}</ion-text> <br><span class=""> @if($transaction->money_flow == '+') {{__('Exchanged To')}} 	
@else {{__('Exchanged From')}} @endif {{$transaction->entity_name}}</span>

@endif

--}}