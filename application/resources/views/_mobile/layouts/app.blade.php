<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('page') - {{ setting('site.site_name') }}</title>

    <!-- Styles -->
    <!-- Fonts -->
    {{-- <link rel="dns-prefetch" href="https://fonts.gstatic.com">
            <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600" rel="stylesheet" type="text/css">  --}}

    <!-- Styles -->
    {{-- <link href="{{ asset('css/app.css') }}" rel="stylesheet"> --}}
    
   {{--  <link rel="icon" href="favicon.ico" type="image/x-icon"> <!-- Favicon--> --}}

    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/css/jquery-jvectormap-2.0.3.min.css')}}"/>
    <link rel="stylesheet" href="{{ asset('assets/css/morris.min.css')}}" />
    <!-- Custom Css -->
    <link rel="stylesheet" href="{{ asset('assets/css/main.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/css/ecommerce.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/css/color_skins.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap-select.min.css')}}">
    

    <style type="text/css">
    .jqstooltip { position: absolute;left: 0px;top: 0px;visibility: hidden;background: rgb(0, 0, 0) transparent;background-color: rgba(0,0,0,0.6);filter:progid:DXImageTransform.Microsoft.gradient(startColorstr=#99000000, endColorstr=#99000000);-ms-filter: "progid:DXImageTransform.Microsoft.gradient(startColorstr=#99000000, endColorstr=#99000000)";color: white;font: 10px arial, san serif;text-align: left;white-space: nowrap;padding: 5px;border: 1px solid white;box-sizing: content-box;z-index: 10000;}
    .jqsfield { color: white;font: 10px arial, san serif;text-align: left;}
    .bitcoin .body {position: absolute;word-break: break-all;}
    .remove{cursor: pointer;}
    .top_navbar {
    background: #2196f3;
    border-bottom: 1px solid #2196f3;
    }
    section.content::before,{
    background: #2196f3;
    }
    
    </style>


    @include('partials.footerstyles')

    <script src="{{ asset('js/vue.min.js') }}"></script>
    {{-- @include('layouts.jquery')
            <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script> --}}
</head>
<body class="theme-blue menu_light" id="app">
<div class="page-loader-wrapper">
    <div class="loader">
        <div class="m-t-30"><img class="zmdi-hc-spin" src="{{asset('assets/images/logo.svg')}}" width="48" height="48" alt="sQuare"></div>
        <p>Please wait...</p>        
    </div>
</div>
<!-- Overlay For Sidebars -->
<div class="overlay"></div>
@include('layouts.topnavbar')
@include('layouts.aside')
<section class="content">
            <div class="container">
                @auth
                <div class="row clearfix">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="header">
                                <h2><strong>{{__('Active')}}</strong> {{__('Wallet')}}</h2>
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
                            <div class="body block-header">
                                <div class="row">
                                    <div class="col">
                                        <h2>{{ Auth::user()->currentCurrency()->name }} </h2>
                                        <ul class="breadcrumb p-l-0 p-b-0 ">
                                            <li class="breadcrumb-item"><a href="{{url('/')}}"><i class="icon-home"></i></a></li>
                                            <li class="breadcrumb-item ">
                                                <span class="text-primary">{{ Auth::user()->currentCurrency()->code }} ({{ Auth::user()->currentCurrency()->symbol }})</span>
                                            </li>
                                        </ul>
                                    </div>            
                                    <div class="col text-right">
                                       <a href="{{route('add.credit')}}" class="btn btn-primary btn-round  float-right  m-l-10">{{__('Add Funds')}}</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row clearfix">
                   @if(count(Auth::user()->wallets()))
                        @foreach(Auth::user()->wallets() as $someWallet)
                        <div class="col hidden-xs hidden-sm">
                            <div class="card info-box-2">
                                <div class="header" style="padding-bottom: 0">
                                    <h2><strong>{{ $someWallet->currency->name }}</strong> {{ __('Balance')}}</h2>
                                    <ul class="header-dropdown">
                                        <li class="remove">
                                            <a role="button" class="boxs-close"><i class="zmdi zmdi-close"></i></a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="body" style="padding-top: 0">
                                    <div class="content">
                                        <div class="number">{{ \App\Helpers\Money::instance()->value($someWallet->amount, $someWallet->currency->symbol) }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    @endif
                </div>
                @endauth
                @yield('content')

                
            </div>

      <!-- Scripts -->
    @yield('footer')
</section>
    <!-- Jquery Core Js --> 
    <script src="{{ asset('assets/js/libscripts.bundle.js') }}"></script> <!-- Lib Scripts Plugin Js ( jquery.v3.2.1, Bootstrap4 js) --> 
    <script src="{{ asset('assets/js/vendorscripts.bundle.js')}}"></script> <!-- slimscroll, waves Scripts Plugin Js -->

    <script src="{{ asset('assets/js/morrisscripts.bundle.js')}}"></script><!-- Morris Plugin Js -->
    <script src="{{ asset('assets/js/jvectormap.bundle.js')}}"></script> <!-- JVectorMap Plugin Js -->
    <script src="{{ asset('assets/js/knob.bundle.js')}}"></script> <!-- Jquery Knob-->

    <script src="{{ asset('assets/js/mainscripts.bundle.js')}}"></script>
    <script src="{{ asset('assets/js/infobox-1.js')}}"></script>
    <script src="{{ asset('assets/js/index.js')}}"></script>

    @yield('js')
    
</body>
</html>
