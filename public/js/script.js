
$(document).ready(function () {

    $.validator.addMethod("valueNotEquals", function(value, element, arg){
        return arg != value;
    }, "Value must not equal arg.");



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



});