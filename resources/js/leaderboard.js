import jQuery from "jquery";
import "jquery-ui";
import datepickerFactory from "jquery-datepicker";

datepickerFactory(jQuery);

!(function ($) {
    $(document).ready(function () {
        $('.admin-leaderboard #from_date').datepicker({
            todayBtn: 'linked',
            format: 'yyyy-mm-dd',
            autoclose: true
        });
        $('.admin-leaderboard #to_date').datepicker({
            todayBtn: 'linked',
            format: 'yyyy-mm-dd',
            autoclose: true
        });
    });
})(jQuery);
