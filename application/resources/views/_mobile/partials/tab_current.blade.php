@if(Route::is('profile.info'))
	tab="Profile" >
@elseif(Route::is('home'))
	tab="Transactions" >
@elseif(Route::is('sendMoneyForm'))
	tab="Send" >
@elseif(Route::is('exchange.form'))
	tab="Exchange" >
@else
	tab="Undefined" >
@endif