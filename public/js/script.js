
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
        $.ajax({
            type: "GET",
            url: APP_URL + '/recruiter/posted-jobs-details/' + id,
            data: {'id':id},
            success: function (data){
               console.log(data);
            }
        });
    });




});