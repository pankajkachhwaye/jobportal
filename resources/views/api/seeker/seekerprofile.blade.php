<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Api-Panel</title>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <!-- Jquery Core Js -->
    <script src="{{URL::asset('plugins/jquery/jquery.min.js')}}"></script>

</head>
<body>

<h1>
    URL::   {{url('/').'/api/fill-seeker-profile'}}

</h1>
<form method="POST" enctype="multipart/form-data" action="{{url('/api/fill-seeker-profile')}}" >

    Seeker(seeker_id) :: <select name="seeker_id">
        <option >Please select</option>
        @foreach($seeker as $key_seeker => $value_seeker)
            <option value="{{$value_seeker['id']}}">{{$value_seeker['email']}}</option>
           @endforeach
    </select>
    <br />
    <br />

    Gender(gender) :: <input type="radio" value="male" name="gender">Male
    <input type="radio" value="female" name="gender">Female

    <br />
    <br />

    Profile Picture(avtar) :: <input type="file" name="avtar">
    <br>
    <br>


    Current Address(current_address) :: <textarea rows="3" cols="5" name="current_address"></textarea>

    <br />
    <br />

    Preferred Location(preferred_location) :: <select name="preferred_location">
        <option >Please select</option>
        @foreach($basicInfo['locations'] as $key_location => $value_location)
            <option value="{{$value_location['id']}}">{{$value_location['location_name']}}</option>
        @endforeach
    </select>
    <br />
    <br />

    Job Type Looking For(job_type) :: @foreach($basicInfo['job_types'] as $key_job_type => $value_job_type)
    <input type="radio" value="{{$value_job_type['id']}}" name="job_type">{{$value_job_type['job_type']}}
    @endforeach
    <br />
    <br />

    <div class="qualification">
  Highest Qualification(qualification) :: <select name="seeker_qualification">
        <option >Please select</option>
        @foreach($basicInfo['qualifications'] as $key_qual => $value_qual)
           <option value="{{$value_qual['id']}}">{{$value_qual['qualification']}}</option>
        @endforeach
    </select>
    Year Of Passing(year_of_passing) ::  * <input type="text" name="year_of_passing">
    Percentage/CGPA(percentage_or_cgpa) ::  * <input type="text" name="percentage_or_cgpa">
    <br />
    <br />
    </div>

    <br>
    <br>
    Area Of Sector(area_of_sector) :: <select name="area_of_sector">
        <option >Please select</option>
        @foreach($basicInfo['area_of_sectors'] as $key_sector => $value_sector)
            <option value="{{$value_sector['id']}}">{{$value_sector['area_of_sector']}}</option>
        @endforeach
    </select>
    <br />
    <br />

    Work Experience(work_experience) ::  <input type="radio" id="freasher" value="freasher" name="work_experience">Freasher
    <input type="radio" value="experience" id="experience" name="work_experience">Experienced
    <br>
    <br>

    <div class="experience_cadidate" style="display: none;">
        Total Experience :: (experience_in_year) <select name="experience_in_year">
            <option value="">Please select</option>
            <option value="1-year">1 Year </option>
            <option value="2-year">2 Year </option>
            <option value="3-year">3 Year </option>
            <option value="4-year">4 Year </option>
            <option value="5-year">5 Year </option>
            <option value="6-year">6 Year </option>
            <option value="7-year">7 Year </option>
            <option value="8-year">8 Year </option>
            <option value="9-year">9 Year </option>
            <option value="10-year">10 Year </option>
            <option value="11-year">11 Year </option>
            <option value="12-year">12 Year </option>

        </select>

        (experience_in_months) <select name="experience_in_months">
            <option value="">Please select</option>
            <option value="1-month">1 Month </option>
            <option value="2-month">2 Month </option>
            <option value="3-month">3 Month </option>
            <option value="4-month">4 Month </option>
            <option value="5-month">5 Month </option>
            <option value="6-month">6 Month </option>
            <option value="7-month">7 Month </option>
            <option value="8-month">8 Month </option>
            <option value="9-month">9 Month </option>
            <option value="10-month">10 Month </option>
            <option value="11-month">11 Month </option>
            <option value="12-month">12 Month </option>

        </select>
        <br />
        <br />
        Specialization(specialization) :: <select name="specialization">
        <option value="">Please select</option>
        @foreach($basicInfo['specialization'] as $key_specilization => $value_specilization)
        <option value="{{$value_specilization['id']}}">{{$value_specilization['specialization']}}</option>
        @endforeach
        </select>
        <br />
        <br />

        Role Type(role_type) :: <select name="role_type">
            <option value="">Please select</option>
            @foreach($basicInfo['job_by_roles'] as $key_role => $value_role)
                <option value="{{$value_role['id']}}">{{$value_role['job_by_role']}}</option>
            @endforeach
        </select>
        <br />
        <br />
        Certification(certification) :: <input type="text" name="certification">
    </div>
    {{--<a data-counter="1" href="javascript:void(0)" style="float: right;" id="add_qulaification"> Add More Qualifiaction</a>--}}
        {{--<a href="javascript:void(0)" style="float: right;" id="remove_qulaification"> Remove Qualifiaction</a>--}}

    <br />
    <br />

    Upload Resume(resume) :: <input type="file" name="resume">
    <br />


    <button class="btn btn-block btn-lg bg-pink waves-effect" type="submit">UPDATE</button>

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

</script>

</body>
</html>