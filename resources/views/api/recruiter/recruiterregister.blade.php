<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Api-Panel</title>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

</head>
<body>
<h1>
    URL::   {{url('/').'/api/register-new-recruiter'}}

</h1>
<form method="POST" action="{{url('/api/register-new-recruiter')}}" >


    organisation_name ::*<input type="text"  name="organisation_name" >

    <br />
    recruiter_email ::*<input type="email" name="recruiter_email" >
    <br />


    password ::  * <input type="password" name="password" placeholder="Password" required>
    <br />

    recruiter_mobile_no ::*<input type="text"  name="recruiter_mobile_no" >
    <br />



    <button class="btn btn-block btn-lg bg-pink waves-effect" type="submit">REGISTER</button>

</form>


</body>
</html>