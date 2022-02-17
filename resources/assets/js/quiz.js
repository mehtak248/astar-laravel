import jQuery from 'jquery';
import CryptoJS from "crypto-js";

!(function($) {
    let timeLeft = 10800;
    let interval;

    $.quiz = {
        makeTimer: clientKey => {
            let days    = Math.floor(timeLeft / 86400);
            let hours   = Math.floor((timeLeft - (days * 86400)) / 3600);
            let minutes = Math.floor((timeLeft - (days * 86400) - (hours * 3600 )) / 60);

            if (hours   < "10") { hours = "0" + hours; }
            if (minutes < "10") { minutes = "0" + minutes; }

             const timeRemaining = hours + ":" +minutes;

            $("#clock").html(hours + " : " +minutes);

            $('input[name="time_remaining"]').val($.quiz.encryptTimeString(clientKey, timeRemaining));

            timeLeft-=60;

            if(timeLeft <= 0) {
                $('#timeModal').modal('show');
                clearInterval(interval);
            }
        },
        encryptTimeString: (clientKey, timeRemaining) => {
            let iv = CryptoJS.lib.WordArray.random(16);
            const _key = CryptoJS.enc.Base64.parse(clientKey);
            const options = {
                iv: iv,
                mode: CryptoJS.mode.CBC,
                padding: CryptoJS.pad.Pkcs7
            };

            const encryptedTime = CryptoJS.AES.encrypt(timeRemaining.toString(), _key, options).toString();

            iv = CryptoJS.enc.Base64.stringify(iv);
            let result = {
                iv: iv,
                value: encryptedTime,
                mac: CryptoJS.HmacSHA256(iv + encryptedTime, _key).toString()
            };

            result = JSON.stringify(result);
            result = CryptoJS.enc.Utf8.parse(result);
            return CryptoJS.enc.Base64.stringify(result);
        }
    }

    $(document).ready(function() {
        $(document).on('click', '.quiz-start-action', function(e) {
            e.preventDefault();
            const clientKey = $('form[name="quiz_form"] input[name="token_key"]').val();

            $('.quiz-block .quiz-questions').removeClass('d-none');
            $('.quiz-block .quiz-start-block').addClass('d-none');

            interval = setInterval(function() { $.quiz.makeTimer(clientKey); }, 1000);
        });
    });

    /*Hide the modal*/
    $("#timeModal").on("hidden.bs.modal", function () {
        //Submit the form
        $("#quiz-form").submit();
    });

})(jQuery);
