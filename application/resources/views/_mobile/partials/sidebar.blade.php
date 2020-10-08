 <div class="col-md-3">
    <div class="card overflowhidden bitcoin hidden-sm hidden-xs">
        <div class="header">
            <h2><strong>{{ Auth::user()->currentCurrency()->name }}</strong> {{__('Wallet')}} {{ __('Balance')}}</h2>
            <ul class="header-dropdown">
                @if(count(\App\Models\Currency::where('id', '!=', Auth::user()->currentCurrency()->id)->get()))
                    <li class="dropdown"> <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> <i class="zmdi zmdi-more"></i> </a>
                        <ul class="dropdown-menu dropdown-menu-right slideUp float-right">
                            @foreach(\App\Models\Currency::where('id', '!=', Auth::user()->currentCurrency()->id)->get() as $currency )
                               <li>
                                <a href="{{ url('/') }}/wallet/{{$currency->id}}"><span> {{ $currency->name }}</span></a>
                                </li> 
                            @endforeach
                        </ul>
                    </li>
                @endif
                <li class="remove">
                    <a role="button" class="boxs-close"><i class="zmdi zmdi-close"></i></a>
                </li>
            </ul>
        </div>
        <div class="body">
            <small></small> 
           
            <h2>{{ \App\Helpers\Money::instance()->value(Auth::user()->balance(), Auth::user()->currentCurrency()->symbol) }}</h2>
            <h6>{{ Auth::user()->currentCurrency()->name }} {{__('Earnings')}}</h6>
            <p>This is the available <br>{{ Auth::user()->currentCurrency()->name }} wallet earnings<br>  use the button bellow<br> to request a payout.</p>
            <a href="{{route('withdrawal.form')}}" class="btn btn-primary btn-round">{{__('Withdraw funds')}}</a>
        </div>
        <div id="sparkline16" class="text-center"><canvas width="403" height="390" style="display: inline-block; width: 403.328px; height: 390px; vertical-align: top;"></canvas></div>
    </div>
    <div class="card overflowhidden d-block d-md-none bg-green " >
        <div class="header">
          <h2 class="text-white"><strong></strong>{{__('Available')}} {{ __('Balance')}} </h2>
           
        </div>
        <div class="body block-header">
            <div class="row">
                <div class="col">
                    <h1 class="text-white">{{ \App\Helpers\Money::instance()->value(Auth::user()->balance(), Auth::user()->currentCurrency()->symbol) }} </h1>

                   <a href="{{route('withdrawal.form')}}" class="btn float-right btn-primary btn-round">{{__('Withdraw funds')}}</a>
                </div>   
            </div>
        </div>
    </div>
 
    @if(Auth::user()->role_id == 1 or Auth::user()->is_ticket_admin )
    <div class="card hidden-sm">
    <div class="header">
        <h2><strong>Admin</strong> area</h2>
        <ul class="header-dropdown">
            <li class="dropdown"> <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> <i class="zmdi zmdi-more"></i> </a>
                <ul class="dropdown-menu dropdown-menu-right slideUp float-right">
                    <li><a href="javascript:void(0);">Edit</a></li>
                    <li><a href="javascript:void(0);">Delete</a></li>
                    <li><a href="javascript:void(0);">Report</a></li>
                </ul>
            </li>
            <li class="remove">
                <a role="button" class="boxs-close"><i class="zmdi zmdi-close"></i></a>
            </li>
        </ul>
    </div>
    <div class="body">
               <h5 class="card-title">Howdy Mr. admin {{Auth::user()->name}}</h5>
            <p class="card-text">In this section you have links that are only visible to admins.</p>
             <div class="list-group mb-2">
                <a href="{{ route('makeVouchers') }}" class="list-group-item list-group-item-action {{ (Route::is('makeVouchers') ? 'active' : '') }}">{{__('Generate Vouchers')}}</a>
                @if (Auth::user()->is_ticket_admin)
                    <a href="{{ url('ticketadmin/tickets') }}" class="list-group-item list-group-item-action {{ (Route::is('support') ? 'active' : '') }}">{{__('Manage Tickets')}}</a>
                @endif
            </div>
            <a href="{{url('/')}}/admin" class="btn btn-primary btn-round">Go to admin dashboard</a>                  
        
    </div>
</div> 
    @endif
    @if(!Route::is('exchange.form'))
     
    <div class="list-group">
        {{--
        <a href="{{ route('home') }}" class="list-group-item list-group-item-action {{ (Route::is('home') ? 'active' : '') }}">Transactions</a>
        <a href="{{url('/')}}/exchange/first/0/second/0"  class="list-group-item list-group-item-action  {{ (Route::is('exchange.form') ? 'active' : '') }}">Exchange</a>
        <a href="{{route('sendMoneyForm')}}" class="list-group-item list-group-item-action {{ (Route::is('sendMoneyForm') ? 'active' : '') }}">Send Money</a>
        <a href="{{route('mydeposits')}}"  class="list-group-item list-group-item-action {{ (Route::is('mydeposits') ? 'active' : '') }}">Deposits</a>
        <a href="{{route('withdrawal.index')}}"  class="list-group-item list-group-item-action  {{ (Route::is('withdrawal.index') ? 'active' : '') }}">Withdrawals</a>
        
        <a class="list-group-item list-group-item-action {{ (Route::is('profile.info') ? 'active' : '') }}" href="{{route('profile.info')}}">{{__('Profile')}}</a>
        <a href="{{url('/')}}/my_tickets"  class="list-group-item list-group-item-action {{ (Route::is('support') ? 'active' : '') }}">{{__('Support')}}</a>
        @if(Auth::user()->role_id != 1)
        <a href="{{url('/')}}/my_vouchers"  class="list-group-item list-group-item-action {{ (Route::is('my_vouchers') ? 'active' : '') }}">{{__('Vouchers')}}</a>
        @endif
        <a href="{{ route('mymerchants') }}" class="list-group-item list-group-item-action {{ (Route::is('mymerchants') ? 'active' : '') }}">{{__('Developers API')}}</a>
        --}}
    </div>
    @endif
</div>