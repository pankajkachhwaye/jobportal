<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Api-Panel</title>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="/resources/demos/style.css">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script>
        $( function() {
            $( "#accordion" ).accordion();
        } );
    </script>
</head>
<body>

<div id="accordion">
    <h3>Seeker</h3>
    <div>
        <p><a href="{{url('/active-jobs')}}">Active Jobs</a></p>
        <p><a href="{{url('/seeker-register')}}">Register Seeker</a></p>
        <p><a href="{{url('/seeker-login')}}">Login Seeker</a></p>
        <p><a href="{{url('/seeker-profile')}}">Seeker Fill-Profile</a></p>
        <p><a href="{{url('/apply-for-job')}}">Apply on Job</a></p>
        <p><a href="{{url('/seeker-change-pass-form')}}">Change Password</a></p>

    </div>
    <h3>Recruiter</h3>
    <div>
        <p><a href="{{url('/recruiter-register')}}">Register Recruiter</a></p>
        <p><a href="{{url('/recruiter-login')}}">Login Recruiter</a></p>
        <p><a href="{{url('/recruiter-profile')}}">Recruiter Fill-Profile</a></p>
        <p><a href="{{url('/post-new-job')}}">Post New Job</a></p>
        <p><a href="{{url('/job-applications-form')}}">Job Application</a></p>
        <p><a href="{{url('/recruiter-change-pass-form')}}">Change Password</a></p>

        {{--<p><a href="{{url('/seeker-profile')}}">Update-Profile </a></p>--}}


    </div>

    <h3>Common</h3>
    <div>
        <p><a href="{{url('/api/general')}}">General Information</a></p>


    </div>

</div>



</body>
</html>