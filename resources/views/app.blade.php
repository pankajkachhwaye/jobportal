<!DOCTYPE html>
<html>

@include('layout.headdefault')


<body class="theme-blue">


<script type="text/javascript">
    var APP_URL = {!! json_encode(url('/')) !!}
    var token = '{!! csrf_token() !!}'

</script>
@if(session('returnStatus'))
    @include('partials.message')
@endif

@include('layout.headerdefault')


@include('layout.admin.asidebardefault')



@yield('main-content')




@include('layout.scriptdefault')


</body>

</html>