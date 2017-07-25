<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Api-Panel</title>
    <script
            src="https://code.jquery.com/jquery-3.2.1.min.js"
            integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="
            crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/css/bootstrap-datepicker.css">

    <!-- Jquery Core Js -->
    <script src="{{URL::asset('plugins/momentjs/moment.js')}}"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" type="text/javascript"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/js/bootstrap-datepicker.min.js" type="text/javascript"></script>

</head>
<body>

<h1>
    URL::   {{url('/').'/api/post-job'}}

</h1>
<form method="POST" enctype="multipart/form-data" action="{{url('/api/post-job')}}" >

    Recruiter(recruiter_id)<span style="color: red">*</span> :: <select name="recruiter_id">
        <option >Please select</option>
        @foreach($recruiter as $key_recruiter => $value_recruiter)
            <option value="{{$value_recruiter['id']}}">{{$value_recruiter['recruiter_email']}}</option>
        @endforeach
    </select>
    <br />
    <br />

    Job Type (job_type)<span style="color: red">*</span> :: @foreach($basicInfo['job_types'] as $key_job_type => $value_job_type)
        <input type="radio" value="{{$value_job_type['id']}}" name="job_type">{{$value_job_type['job_type']}}
    @endforeach
    <br />
    <br />
    Designation(job_by_roles)<span style="color: red">*</span> :: <select name="job_by_roles">
        <option value="">Please select</option>
        @foreach($basicInfo['job_by_roles'] as $key_role => $value_role)
            <option value="{{$value_role['id']}}">{{$value_role['job_by_role']}}</option>
        @endforeach
    </select>
    <br />
    <br />
    Qualification/ Eligibility(qualification)<span style="color: red">*</span> ::<select name="qualification">
        <option value="">Please select</option>
        @foreach($basicInfo['qualifications'] as $key_qual => $value_qual)
            <option value="{{$value_qual['id']}}">{{$value_qual['qualification']}}</option>
        @endforeach
    </select>
    <br />
    <br />
    Job Location(job_location)<span style="color: red">*</span>  :: <select name="job_location">
        <option value="">Please select</option>
        @foreach($basicInfo['locations'] as $key_location => $value_location)
            <option value="{{$value_location['id']}}">{{$value_location['location_name']}}</option>
        @endforeach
    </select>
    <br />
    <br />
    Year Of Passing(year_of_passing) ::   <input type="text" name="year_of_passing">
    Highest Qualification Marks Above(percentage_or_cgpa) ::  <input type="text" name="percentage_or_cgpa">
    <br />
    <br />

    Specialization (specialization)<span style="color: red">*</span>  :: <select name="specialization">
        <option value="">Please select</option>
        @foreach($basicInfo['specialization'] as $key_specilization => $value_specilization)
            <option value="{{$value_specilization['id']}}">{{$value_specilization['specialization']}}</option>
        @endforeach
    </select>
    <br />
    <br />

    Skills(skills_required)<span style="color: red">*</span>  :: <input type="text" name="skills_required">
    <br />
    <br />
    Minimum Experience Required (experience)<span style="color: red">*</span> :: <select name="experience">
        <option value="">Please select</option>
      <option value="0(Freasher)">0(Freasher)</option>
      <option value="06 Months">06 Months</option>
      <option value="1 Year">1 Year</option>
      <option value="1.5 Year">1.5 Year</option>
      <option value="2 Year">2 Year</option>
      <option value="2.5 Year">2.5 Year</option>
      <option value="3 Year">3 Year</option>
      <option value="3+ Year">3+ Year</option>

    </select>
    <br />
    <br />

    Job Discription(job_discription)<span style="color: red">*</span> :: <textarea rows="3" cols="5" name="job_discription"></textarea>

    <br />
    <br />

    Salary Range<span style="color: red">*</span> :: Min(min_sal) :: <input type="text" name="min_sal"> Max(max_sal) :: <input type="text" name="max_sal">
        per(per) :: <select name="per">
        <option value="">Please select</option>
        <option value="Per Year">Per Year</option>
        <option value="Per Month">Per Month</option>
        <option value="Per Day">Per Day</option>
        <option value="Per Hour">Per Hour</option>
    </select>
    <br />
    <br />

    Number of Vacancies(vacancies)<span style="color: red">*</span> ::<input type="text" name="vacancies">
    <br />
    <br />
    Last Date of Application(last_date)<span style="color: red">*</span> ::<input id="datetimepicker1" type="text" name="last_date">
    <br />
    <br />

    Hiring Process(process)<span style="color: red">*</span>::  <input type="checkbox" value="Face to Face" name="process[]"> Face to Face
                                                        <input type="checkbox" value="Written-test" name="process[]"> Written-test
                                                        <input type="checkbox" value="Telephonic" name="process[]"> Telephonic
                                                        <input type="checkbox" value="Group Discussion" name="process[]"> Group Discussion
                                                        <input type="checkbox" value="Walk In" name="process[]"> Walk In

    <br>
    <br>
    <button type="submit">UPDATE</button>

</form>
<script type="text/javascript">
    $(document).ready(function () {




        $(document).on('click','#add_qulaification' ,function () {
            var counter = parseInt($(this).attr('data-counter'));
            $(this).attr('data-counter',+counter+1);
            var clone = $(this).prev().clone();
            clone.find('input[type=text]').val('');
            $(this).before(clone);

        });

        $(document).on('click','#remove_qulaification' ,function () {
            var counter_rom = parseInt($(this).prev().attr('data-counter'));
            if(counter_rom > 1){
                $(this).prev().prev().remove();
                $(this).prev().attr('data-counter',+counter_rom-1);
            }
        });

        $(document).on('click','input[name=work_experience]' ,function () {
            if ($("#freasher").is(":checked")) {
                $('.experience_cadidate').hide()
            }

            if ($("#experience").is(":checked")) {
                $('.experience_cadidate').show()
            }


        });

    });


    $(function () {
        var date = new Date();
        date.setDate(date.getDate());
        $('#datetimepicker1').datepicker({
            format: 'dd-mm-yyyy',
            startDate: date,
            autoclose: true
        });
    });
</script>

</body>
</html>