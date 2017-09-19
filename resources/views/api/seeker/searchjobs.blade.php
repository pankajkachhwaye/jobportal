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

    Job Type(job_type) ::
    @foreach($basicInfo['job_types'] as $key_jobtype => $value_jobtype)
        <input type="checkbox" value="{{$value_jobtype['id']}}" name="job_type[]"> {{$value_jobtype['job_type']}}
    @endforeach
    <br />
    <br />
    Location(job_location) ::
    @foreach($basicInfo['locations'] as $key_loca => $value_loca)
        <input type="checkbox" value="{{$value_loca['id']}}" name="job_location[]"> {{$value_loca['location_name']}}
    @endforeach

    <br />
    <br />
    Specialization(specialization) ::
    @foreach($basicInfo['specialization'] as $key_spec => $value_spec)
        <input type="checkbox" value="{{$value_spec['id']}}" name="specialization[]"> {{$value_spec['specialization']}}
    @endforeach

    <br />
    <br />
    Qualification(qualification) ::
    @foreach($basicInfo['qualifications'] as $key_qua => $value_qua)
        <input type="checkbox" value="{{$value_qua['id']}}" name="qualification[]"> {{$value_qua['qualification']}}
    @endforeach
    <br />
    <br />

    Designation(job_by_roles) ::
    @foreach($basicInfo['job_by_roles'] as $key_role => $value_role)
        <input type="checkbox" value="{{$value_role['id']}}" name="job_by_roles[]"> {{$value_role['job_by_role']}}
    @endforeach
    <br />
    <br />

    Area of Sector(area_of_sector) ::
    @foreach($basicInfo['area_of_sectors'] as $key_sec => $value_sec)
        <input type="checkbox" value="{{$value_sec['id']}}" name="area_of_sector[]"> {{$value_sec['area_of_sector']}}
    @endforeach
    <br />
    <br />
    Experience(experience) ::  <input type="checkbox" value="Fresher" name="experience[]"> Fresher
                                <input type="checkbox" value="06 Months" name="experience[]"> 06 Months
                                <input type="checkbox" value="1 Year" name="experience[]"> 1 Year
                                <input type="checkbox" value="1.5 Year" name="experience[]"> 1.5 Year
                                <input type="checkbox" value="2 Year" name="experience[]"> 2 Year
                                <input type="checkbox" value="2.5 Year" name="experience[]"> 2.5 Year
                                <input type="checkbox" value="3 Year" name="experience[]"> 3 Year
                                <input type="checkbox" value="3+ Year" name="experience[]"> 3+ Year



    <br />
    <br />

    <button class="btn btn-block btn-lg bg-pink waves-effect" type="submit">Search</button>

</form>


</body>
</html>