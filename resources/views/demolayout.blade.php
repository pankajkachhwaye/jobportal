<!DOCTYPE html>
<html>

@include('layout.headdefault')


<body class="theme-deep-purple">


<script type="text/javascript">
    var APP_URL = {!! json_encode(url('/')) !!}
    var token = '{!! csrf_token() !!}'

</script>
@if(session('returnStatus'))
    @include('partials.message')
@endif

@include('layout.headerdefault')


@include('layout.recruiter.recruiterasidebar')



@yield('main-content-recruiter')




@include('layout.scriptdefault')


</body>

</html>