import jQuery from "jquery";

!(function ($) {
    $.socialShare = {
        init: () => {
            const _fb_access_token = '1595962017097965|yxGUttUhHT9CTdRMjTPUOC_DjDk';
            console.log(_fb_access_token);
            window.fbAsyncInit = function() {
                // FB.init({
                //     appId: '1595962017097965',
                //     status: true,
                //     xfbml: true,
                //     oauth: true,
                //     version: 'v2.8'
                // });

                console.log(FB);

                FB.init({
                    appId            : '1595962017097965',
                    autoLogAppEvents : true,
                    xfbml            : true,
                    version          : 'v12.0'
                });

                FB.api(
                    "/CentralCoastCommunityCollege/feed?access_token=" + _fb_access_token,
                    function (response) {
                        console.log(response);
                    }
                );
            }
        }
    };

    $(document).ready(function () {

        // const _fb_access_token1 = 'IGQVJVa2hpRVo1WUtGWmhfOGZAwWmhzRDc5MDhVeGxURUowM1ZAhWEk3V0JaS0JiTWtSOHdfSkJ6VHdaZAGU0SVNJaGxwTWo5d1RGTFhPSFUyMlR6TkMzVk1JWFBnbUdMZAGxiWnNuUXNmNW4xNXJibllvXwZDZD';
        // let _fb_access_token = 'IGQVJYeVVGSWdIVjVkX2VqNWhyd1BYb2FCMmpBZA0F2ZAG1Ib2xSZAUl1U2Etdm02VzdFZA2pDUG84a1lUZADdxSmRVWW1RcWM3azhvdkVJRWlTMHNENFpSczlLNTN0RE1iNl9ubkR4d016T3RhUFd6WTNFLUJXR01XbWVUd3Rj';
        // // const _fb_access_token = '1159141630803949|AL_UP3xdXZOfUNAWb8D4N68dssE';
        // console.log(_fb_access_token);
        // window.fbAsyncInit = function() {
        //     // FB.init({
        //     //     appId: '1595962017097965',
        //     //     status: true,
        //     //     xfbml: true,
        //     //     oauth: true,
        //     //     version: 'v2.8'
        //     // });
        //
        //     console.log(FB);
        //
        //     FB.init({
        //         appId            : '1159141630803949',
        //         autoLogAppEvents : true,
        //         status           : true,
        //         xfbml            : true,
        //         // oauth: true,
        //         version          : 'v12.0',
        //     });
        //
        //     FB.AppEvents.logPageView();
        //
        //     /*FB.api(
        //         "/1056284487763005/me?access_token=" + _fb_access_token,
        //         'GET',
        //         {'fields': 'id,name'},
        //         function (response) {
        //             console.log("response");
        //             console.log(response);
        //         }
        //     );*/
        //
        //     FB.getLoginStatus(function(response) {
        //         console.log("login response");
        //         console.log(response);
        //         if (response && response.status === "connected") {
        //             // statusChangeCallback(response);
        //             _fb_access_token = response.authResponse.accessToken
        //             FB.api(
        //                 "/CentralCoastCommunityCollege/feed?access_token=" + _fb_access_token,
        //                 function (response) {
        //                     console.log("cccc feeds")
        //                     console.log(response)
        //                 }
        //             );
        //         }
        //     });
        // }

        $(document).on('click', '.shareOn', function (e) {
            e.preventDefault();

            const type = $(this).attr('data-type');
            const route = $(this).attr('data-route');
            const id = $(this).attr('data-id');
            const base_url = `${window.route.root}/share/${route}/${id}`;
            const imagePath = $('.photobooth-7 .left-block > img').attr('src');

            if(type === 'twitter') {
                window.open('https://twitter.com/intent/tweet?url='+ base_url +'&text=@astar', '_blank','width=500, height=500, scrollbars=yes, resizable=no');
            } else if(type === 'facebook') {
                window.open('https://www.facebook.com/sharer/sharer.php?u=' + base_url, '_blank','width=500, height=500, scrollbars=yes, resizable=no');
            } else if(type === 'linkedIn') {
                window.open('https://www.linkedin.com/share?url=' + base_url, '_blank','width=500, height=500, scrollbars=yes, resizable=no');
            } else if(type === 'whatsApp') {
                window.open("https://api.whatsapp.com/send?text=@astar%0a%0a" + base_url, '_blank','width=500, height=500, scrollbars=yes, resizable=no')
            } else if(type === 'email') {
                window.open('mailto:?subject=A*STAR 30th Anniversary&body=Hello,%0a%0a#astar.%0a%0a'+ base_url + '%0a%0a' + imagePath, '_blank','width=500, height=500, scrollbars=yes, resizable=no')
            } else if (type === 'download') {
                window.location.href = base_url + '/download';
            }/* else if(type === 'instagram') {
                $.socialShare.init();
            }*/
        });


    })
})(jQuery);

