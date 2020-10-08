@if(request()->server('HTTP_USER_AGENT') == "AppWebView")
	@include('_mobile.home.APP')
@else
	@include('_mobile.home.PWA')
@endif 