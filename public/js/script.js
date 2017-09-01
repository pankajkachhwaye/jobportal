
$(document).ready(function () {


    $.validator.addMethod("valueNotEquals", function(value, element, arg){
        return arg != value;
    }, "Value must not equal arg.");

    // configure your validation
    $("#add_attribute").validate({
        rules: {
            category_name: { valueNotEquals: "default" }
        },
        messages: {
            category_name: { valueNotEquals: "Please select an item!" }
        },highlight: function (input) {
            console.log(input);
            $(input).parents('.form-line').addClass('error');
        },
        unhighlight: function (input) {
            $(input).parents('.form-line').removeClass('error');
        }

    });

    // $('#submit_pro').click(function () {
    //
    // });

    if(status == 101){
        $.notify({
            message: message
        },
            {
                allow_dismiss: true,
                newest_on_top: true,
            timer: 1000,
            placement:{
                    from: 'top',
                align: 'right'
            },
                animate: {
                    enter: 'animated fadeInDown',
                    exit: 'animated fadeOutUp'
                }
        });
    };

    $(document).on('click','.getdetails',function () {
        console.log(APP_URL);
        var id = $(this).attr('data-react');
        var recruiter_id = $(this).attr('data-recruiter');
        $.ajax({
            type: "GET",
            url: APP_URL + '/recruiter/posted-jobs-details/' + id+'/recruiter/'+recruiter_id,
            data: {'id':id,'recruiter_id':recruiter_id},
            success: function (data){
                $('#job_by_roles').text(data.job_by_roles);
                $('#job_location').text(data.job_location);
                $('#specialization').text(data.specialization);
                $('#qualification').text(data.qualification);
                $('#year_of_passing').text(data.year_of_passing);
                $('#percentage_or_cgpa').text(data.percentage_or_cgpa);
                $('#skills_required').text(data.skills_required);
                $('#min_sal').text(data.min_sal+' '+ data.per);
                $('#max_sal').text(data.max_sal+' '+ data.per);
                $('#job_type').text(data.job_type+' '+ data.job_type);
               var process =  data.process.toString();
                $('#process').text(process);


                $('#job_discription').text(data.job_discription);
                $('#organisation_name').text(data.recruiter.organisation_name);
                $('#recruiter_email').text(data.recruiter.recruiter_email);
                $('#recruiter_mobile_no').text(data.recruiter.recruiter_mobile_no);
                $('#i_am').text(data.recruiter.recruiter_profile.i_am);
                $('#org_address').text(data.recruiter.recruiter_profile.org_address);
                $('#org_location').text(data.recruiter.recruiter_profile.org_location);
                $('#org_website').text(data.recruiter.recruiter_profile.org_website);
                // $('#org_website').text(data.recruiter_profile.org_website);
               $('#job-detail').modal('show');



            }
        });
    });




});








