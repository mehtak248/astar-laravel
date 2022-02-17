import jQuery from "jquery";

!(function($) {
    "use strict";

    let step = 1;

    $(document).on('click', '#social-wall-steps .social-wall-select-step', function(e) {
        e.preventDefault();
        step = $(this).attr('data-step');

        const hasImage = $('.social-wall-step-1 input[name="image"]').val();

        if (!hasImage) {
            step = 1;
            alert("Please upload image.");
        }

        $('#social-wall-steps > div').addClass('d-none');
        $(`.social-wall-step-${step}`).removeClass('d-none');
    });

    $(document).on('click', '#social-wall-steps .social-wall-submit', function(e) {
        e.preventDefault();
        $('form[name="social-wall_form"]').submit();
    });


})(jQuery);
