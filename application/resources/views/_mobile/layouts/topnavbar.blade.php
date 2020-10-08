<nav class="top_navbar">
    <div class="container">
        <div class="row clearfix">
            <div class="col-12">
                @include('cookieConsent::index')
            </div>
        </div>
        <div class="row clearfix">
            <div class="col-12">
                <div class="navbar-logo">
                    <a href="javascript:void(0);" class="bars"></a>
                    <a class="navbar-brand" href="{{ url('/') }}">
                        <img src="{{asset('assets/images/logo.svg')}}" width="30" alt="InfiniO"> 
                        <span class="m-l-10">{{ setting('site.site_name') }}</span>
                    </a>
                </div>
                @auth
                <ul class="nav navbar-nav">
                    <li><a href="{{url('/')}}/buyvoucher"><i class="icon-diamond"></i></a></li>
                    <li class="dropdown task ">
                        <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button">
                            <i class="icon-wallet"></i>
                            <span class="label-count">{{Auth::user()->currentCurrency()->code}}</span>
                        </a>
                    </li> 
                    <li class="dropdown profile">
                        <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button">
                            <img src="{{Auth::user()->avatar()}}" alt="" class="rounded-circle">
                        </a>
                        <ul class="dropdown-menu pullDown">
                            <li>
                                <div class="user-info">
                                    <h6 class="user-name m-b-0">{{Auth::user()->name}}</h6>
                                    @if(Auth::user()->verified == 1 )
                                    <p class="user-position"><span class="badge badge-success ml-0 mt-3">Verified</span></p>
                                    @else
                                    <p class="user-position"><a class="" href="{{url('/')}}/resend/activationlink"><span class="badge badge-danger ml-0 mt-3">Verify your email</span></a></p>
                                    @endif
                                    {{-- <a title="facebook" href="javascript:void(0);"><i class="zmdi zmdi-facebook"></i></a>
                                    <a title="twitter" href="javascript:void(0);"><i class="zmdi zmdi-twitter"></i></a>
                                    <a title="instagram" href="javascript:void(0);"><i class="zmdi zmdi-instagram"></i></a>
                                    <a title="linkedin" href="javascript:void(0);"><i class="zmdi zmdi-linkedin-box"></i></a>
                                    <a title="dribbble" href="javascript:void(0);"><i class="zmdi zmdi-dribbble"></i></a>
                                    <a title="google plus" href="javascript:void(0);"><i class="zmdi zmdi-google-plus-box"></i></a> --}}
                                    <hr>
                                </div>
                            </li>                            
                            <li><a href="{{route('profile.info')}}"><i class="icon-user m-r-10"></i> <span>{{__('Profile')}}</span> </a></li>                            
                            <li><a href="{{url('/')}}/my_tickets"><i class="icon-lock m-r-10"></i><span>{{__('Support')}}</span></a></li>
                            <li><a  href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();"><i class="icon-power m-r-10"></i><span>    {{ __('Logout') }}</span></a><form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form></li>
                        </ul>
                    </li>
                    <li class="hidden-xs hidden-sm"><a href="javascript:void(0);" class="js-right-sidebar"><i class="icon-equalizer"></i></a></li>
                </ul>
                @endauth
            </div>
        </div>        
    </div>
</nav>