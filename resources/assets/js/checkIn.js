import jQuery from "jquery";
import axios from "axios";

!(function ($) {
    
    $.validator.addMethod(
        "regex",
        function(value, element, regexp)  {
            if (regexp && regexp.constructor != RegExp) {
                regexp = new RegExp(regexp);
            }
            else if (regexp.global) regexp.lastIndex = 0;
            return this.optional(element) || regexp.test(value);
        }
    );

    $('form[name="checkin_form_home"], form[name="checkin_form"]').validate({
        rules:{
            name:{
                required:true,
                accept: "[a-zA-Z]+"
            },
            email:{
                required:true,
                email:true,
                regex: /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/
            },
            designation:{
                required:true,
                accept: "[a-zA-Z]+"
            },
            school:{
                required:true,
            },
            mailing_address:{
                required:true,
            },
            acknowledge:{
                required:true,
                maxlength: 1
            }
        },
        messages: {
            name: {
                required: "Name is required.",
                accept: "Only alphabets are allowed"
            },
            designation: {
                required: "Designation is required.",
                accept: "Only alphabets are allowed"
            },
            school: {
                required: "School is required."
            },
            mailing_address: {
                required: "Mailing Address is required."
            },
            email: {
                required: "Email is required.",
                email: "Please enter a valid email address",
                regex: "Please enter a valid email address"
            }
        },
        errorPlacement: function (error, element) {
            error.appendTo(element.parent().find("span.text-danger"));
        }
    });

    jQuery.validator.addMethod("accept", function(value, element, param) {
        return value.match(new RegExp("." + param + "$"));
    });

    $(document).on('submit', 'form[name="checkin_form_home"]', function (e) {
        e.preventDefault();

        axios.post('/checkin', $(this).serialize()).then(e => {
            if (e.data.type === 'success') {
                window.open('/gallery', '_blank');
                window.location.reload();
            }
        });
    });
})(jQuery);
