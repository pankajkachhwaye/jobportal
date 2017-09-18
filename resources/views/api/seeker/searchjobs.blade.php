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
    URL::   {{url('/').'/api/search-job'}}

</h1>
<form method="POST" action="{{url('/api/search-job')}}" >



    Value(value) ::*<input type="text" name="value" >
    <br />
    <br />



    Seeker(seeker_id) ::*<input type="text" name="seeker_id" >
    <br />
    <br />

    <button class="btn btn-block btn-lg bg-pink waves-effect" type="submit">Search</button>

</form>


</body>
</html>