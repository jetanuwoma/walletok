 <div class="col-md-3">
    <div class="card ">
        <!-- overflowhidden -->
        <div class="header">
            <h2><strong>{{ Auth::user()->currentCurrency()->name }}</strong> {{ __('Balance')}}</h2>
            <ul class="header-dropdown">
                @if(count(\App\Models\Currency::where('id', '!=', Auth::user()->currentCurrency()->id)->get()))
                    <li class="dropdown"> <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> <i class="zmdi zmdi-refresh"></i> </a>
                        <ul class="dropdown-menu dropdown-menu-right slideUp float-right">
                            @foreach(\App\Models\Currency::where('id', '!=', Auth::user()->currentCurrency()->id)->get() as $currency )
                               <li>
                                <a href="{{ url('/') }}/wallet/{{$currency->id}}"><span> {{ $currency->name }}</span></a>
                                </li> 
                            @endforeach
                        </ul>
                    </li>
                @endif
               
            </ul>
        </div>
        <div class="body">
            <small></small> 
            <button class="btn btn-primary btn-round bg-blue show-balance" type="general">Show Balance</button>
            @if((Auth::user()->currentCurrency()->symbol != "(BTC)"))
                <h2 style="margin-bottom: 0;" id="account_balance" class="general"></h2>
                <p><a href="{{url('/')}}/exchange/first/0/second/0">{{ __('Convert Currency')}}</p></a>

            @else
                @if(!(Auth::user()->btc_address == null))
                <h2 style="margin-bottom: 0;" id="account_balance"></h2>
                <span style="font-size:10px;">{{ Auth::user()->btc_address}}</span>
                <div id="qrcode"></div>
                <script type="text/javascript">
                    var qrcode = new QRCode("qrcode", {
                        text: "{{Auth::user()->btc_address}}",
                        width: 160,
                        height: 160,
                        colorDark : "#000000",
                        colorLight : "#ffffff",
                        correctLevel : QRCode.CorrectLevel.H
                    });
                </script>

                @else
                <a href="{{route('bitcoin.wallet')}}" class="btn btn-primary btn-round bg-blue">Generate BTC wallet address</a>
                @endif
                <p><a href="{{url('/')}}/exchange/first/6/second/1">{{ __('Convert Currency')}}</p></a>
            @endif
        </div>
        {{-- <div id="sparkline16" class="text-center"><canvas width="403" height="390" style="display: inline-block; width: 403.328px; height: 390px; vertical-align: top;"></canvas></div> --}}
    </div>
    @if(Route::is('home'))

    @if(!empty($myEscrows))
    
    @foreach($myEscrows as $escrow)

        <div class="card">
            <div class="header">
                <h2><strong>On Hold</strong> #{{$escrow->id}}</h2>
                <ul class="header-dropdown">
                    <li class="remove">
                        <a role="button" class="boxs-close"><i class="zmdi zmdi-close"></i></a>
                    </li>
                </ul>
            </div>
            <div class="body">
                <h3 class="mb-0 pb-0">
               -  {{ \App\Helpers\Money::instance()->value( $escrow->gross, $escrow->currency_symbol )}}       
                </h3>
                Escrow money to  <a href="{{url('/')}}/escrow/{{$escrow->id}}"><span class="text-primary">{{$escrow->toUser->name}}</span></a> <br> 
                <form action="{{url('/')}}/escrow/release" method="post">
                    {{csrf_field()}}
                    <input type="hidden" name="eid" value="{{$escrow->id}}">
                    <input type="submit" class="btn btn-sm btn-round btn-primary btn-simple" value="{{_('Release')}}">
                    
                </form>
            </div>
        </div>

    @endforeach
    
    @endif 
    
    @if(!empty($toEscrows))
    
    @foreach($toEscrows as $escrow)

        <div class="card">
            <div class="header">
                <h2><strong>On Hold</strong> #{{$escrow->id}}</h2>
                <ul class="header-dropdown">
                    <li class="remove">
                        <a role="button" class="boxs-close"><i class="zmdi zmdi-close"></i></a>
                    </li>
                </ul>
            </div>
            <div class="body">
                <h3 class="mb-0 pb-0">
                +  {{ \App\Helpers\Money::instance()->value( $escrow->gross, $escrow->currency_symbol )}}       
                </h3>
                Escrow money from <a href="{{url('/')}}/escrow/{{$escrow->id}}"><span class="text-primary">{{$escrow->User->name}}</span></a> 
                <form action="{{url('/')}}/escrow/refund" method="post">
                    {{csrf_field()}}
                    <input type="hidden" name="eid" value="{{$escrow->id}}">
                    <input type="submit" class="btn btn-sm btn-round btn-danger btn-simple" value="{{_('refund')}}">
                </form>
            </div>
        </div>

    @endforeach
    
    @endif 

    @endif
 
    @if(Auth::user()->role_id == 1 or Auth::user()->is_ticket_admin )
    <div class="card hidden-sm">
        <div class="header">
            <h2><strong>Admin</strong> area</h2>
            <ul class="header-dropdown">
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
                    @if(Auth::user()->role_id == 1)
                        <a href="{{ url('/') }}/update_rates" class="list-group-item list-group-item-action ">{{__('Update Exchange Rates')}}</a>
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