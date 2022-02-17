<!DOCTYPE html>
<html lang="en">
<head>
    <title>3d gallery</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport" id="metaViewport" content="user-scalable=no, initial-scale=1, width=device-width, viewport-fit=cover" data-tdv-general-scale="0.5"/>
    <meta name="apple-mobile-web-app-capable" content="yes"/>
    <meta name="apple-mobile-web-app-status-bar-style" content="default">
    <link rel="preload" href="3dvista/locale/en.txt?v={{ rand() }}" as="fetch" crossorigin="anonymous"/>
    <link rel="preload" href="3dvista/script.js?v={{ rand() }}" as="script"/>
    <meta name="description" content="Virtual Tour"/>
    <meta name="theme-color" content="#FFFFFF"/>
    <script src="3dvista/lib/tdvplayer.js?v={{ rand() }}"></script>
    <script src="3dvista/script.js?v={{ rand() }}"></script>
    <script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
    <link href="{{ asset('assets/css/public.css') }}" rel="stylesheet">
    <script type="text/javascript">
        var tour;
        var devicesUrl = {"general":"3dvista/script_general.js?v={{ rand() }}"};

        (function()
        {
            var deviceType = ['general'];
            if(TDV.PlayerAPI.mobile)
                deviceType.unshift('mobile');
            if(TDV.PlayerAPI.device == TDV.PlayerAPI.DEVICE_IPAD)
                deviceType.unshift('ipad');
            var url;
            for(var i=0; i<deviceType.length; ++i) {
                var d = deviceType[i];
                if(d in devicesUrl) {
                    url = devicesUrl[d];
                    break;
                }
            }
            if(typeof url == "object") {
                var orient = TDV.PlayerAPI.getOrientation();
                if(orient in url) {
                    url = url[orient];
                }
            }
            var link = document.createElement('link');
            link.rel = 'preload';
            link.href = url;
            link.as = 'script';
            var el = document.getElementsByTagName('script')[0];
            el.parentNode.insertBefore(link, el);
        })(jQuery);

        function loadTour()
        {
            if(tour) return;

            if (/AppleWebKit/.test(navigator.userAgent) && /Mobile\/\w+/.test(navigator.userAgent)) {
                var preloadContainer = document.getElementById('preloadContainer');
                if(preloadContainer)
                    document.body.style.backgroundColor = window.getComputedStyle(preloadContainer).backgroundColor;
            }

            var settings = new TDV.PlayerSettings();
            settings.set(TDV.PlayerSettings.CONTAINER, document.getElementById('viewer'));
            settings.set(TDV.PlayerSettings.WEBVR_POLYFILL_URL, '3dvista/lib/WebVRPolyfill.js?v={{ rand() }}');
            settings.set(TDV.PlayerSettings.HLS_URL, '3dvista/lib/Hls.js?v={{ rand() }}');
            settings.set(TDV.PlayerSettings.QUERY_STRING_PARAMETERS, 'v={{ rand() }}');

            tour = new TDV.Tour(settings, devicesUrl);
            tour.bind(TDV.Tour.EVENT_TOUR_INITIALIZED, onVirtualTourInit);
            tour.bind(TDV.Tour.EVENT_TOUR_LOADED, onVirtualTourLoaded);
            tour.bind(TDV.Tour.EVENT_TOUR_ENDED, onVirtualTourEnded);
            tour.load();
        }

        function pauseTour()
        {
            if(!tour)
                return;

            tour.pause();
        }

        function resumeTour()
        {
            if(!tour)
                return;

            tour.resume();
        }

        function onVirtualTourInit()
        {
            var updateTexts = function() {
                document.title = this.trans("tour.name")
            };

            tour.locManager.bind(TDV.Tour.LocaleManager.EVENT_LOCALE_CHANGED, updateTexts.bind(tour.locManager));
            
            if (tour.player.cookiesEnabled)
                enableCookies();
            else
                tour.player.bind('enableCookies', enableCookies);
        }

        function onVirtualTourLoaded()
        {
            var modal = document.getElementById("checkinModal");
            var btn = document.getElementById("78");
            var span = document.getElementsByClassName("close")[0];
            
            btn.onclick = function() {
                console.log('onclick')
                modal.style.display = "block";
            }
            
            // btn.addEventListener('touchstart', function () {
            //     console.log('touchstart')
            //     modal.style.display = "block";
            // });

            span.onclick = function() {
                modal.style.display = "none";
            }

            window.onclick = function(event) {
                if (event.target == modal) {
                    modal.style.display = "none";
                }
            }
            
            disposePreloader();
        }

        function onVirtualTourEnded()
        {

        }

        function enableCookies()
        {
            
        }

        function setMediaByIndex(index) {
            if(!tour)
                return;

            tour.setMediaByIndex(index);
        }

        function setMediaByName(name)
        {
            if(!tour)
                return;

            tour.setMediaByName(name);
        }

        function showPreloader()
        {
            var preloadContainer = document.getElementById('preloadContainer');
            if(preloadContainer != undefined)
                preloadContainer.style.opacity = 1;
        }

        function disposePreloader()
        {
            var preloadContainer = document.getElementById('preloadContainer');
            if(preloadContainer == undefined)
                return;

            var transitionEndName = transitionEndEventName();
            if(transitionEndName)
            {
                preloadContainer.addEventListener(transitionEndName, hide, false);
                preloadContainer.style.opacity = 0;
                setTimeout(hide, 500); //Force hide. Some cases the transitionend event isn't dispatched with an iFrame.
            }
            else
            {
                hide();
            }

            function hide()
            {
                
                document.body.style.backgroundColor = window.getComputedStyle(preloadContainer).backgroundColor;
                preloadContainer.style.visibility = 'hidden';
                preloadContainer.style.display = 'none';
                var videoList = preloadContainer.getElementsByTagName("video");
                for(var i=0; i<videoList.length; ++i)
                {
                    var video = videoList[i];
                    video.pause();
                    while (video.children.length)
                        video.removeChild(video.children[0]);
                }
            }

            function transitionEndEventName () {
                var el = document.createElement('div');
                var transitions = {
                        'transition':'transitionend',
                        'OTransition':'otransitionend',
                        'MozTransition':'transitionend',
                        'WebkitTransition':'webkitTransitionEnd'
                    };

                var t;
                for (t in transitions) {
                    if (el.style[t] !== undefined) {
                        return transitions[t];
                    }
                }

                return undefined;
            }
        }

        function onBodyClick(){
            document.body.removeEventListener("click", onBodyClick);
            document.body.removeEventListener("touchend", onBodyClick);
            
        }

        function onLoad() {
            if (/AppleWebKit/.test(navigator.userAgent) && /Mobile\/\w+/.test(navigator.userAgent))
            {
                var onOrientationChange = function()
                {
                    document.documentElement.style.height = 'initial';
                    Array.from(document.querySelectorAll('.fill-viewport')).forEach(function(element)
                    {
                        element.classList.toggle('landscape-right', window.orientation == -90);
                        element.classList.toggle('landscape-left', window.orientation == 90);
                    });
                    setTimeout(function()
                    {
                        document.documentElement.style.height = '100%';
                    }, 500);
                };
                window.addEventListener('orientationchange', onOrientationChange);
                onOrientationChange();
            }

            var params = getParams(location.search.substr(1));
            if(params.hasOwnProperty("skip-loading"))
            {
                loadTour();
                disposePreloader();
                return;
            }

            if (isOVRWeb()){
                showPreloader();
                loadTour();
                return;
            }

            showPreloader();
            loadTour();
        }

        function playVideo(video) {
            function isSafariDesktopV11orGreater() {
                return /^((?!chrome|android|crios|ipad|iphone).)*safari/i.test(navigator.userAgent) && parseFloat(/Version\/([0-9]+\.[0-9]+)/i.exec(navigator.userAgent)[1]) >= 11;
            }

            function hasAudio (video) {
                return video.mozHasAudio ||
                       Boolean(video.webkitAudioDecodedByteCount) ||
                       Boolean(video.audioTracks && video.audioTracks.length);
            }

            function detectUserAction() {
                var onVideoClick = function(e) {
                    if(video.paused) {
                        video.play();
                    }
                    video.muted = false;
                    if(hasAudio(video))
                    {
                        e.stopPropagation();
                        e.stopImmediatePropagation();
                        e.preventDefault();
                    }

                    video.removeEventListener('click', onVideoClick);
                    video.removeEventListener('touchend', onVideoClick);
                };
                video.addEventListener("click", onVideoClick);
                video.addEventListener("touchend", onVideoClick);
            }

            if (isSafariDesktopV11orGreater()) {
                video.muted = true;
                video.play();
            } else {
                var canPlay = true;
                var promise = video.play();
                if (promise) {
                    promise.catch(function() {
                        video.muted = true;
                        video.play();
                        detectUserAction();
                    });
                } else {
                    canPlay = false;
                }

                if (!canPlay || video.muted) {
                    detectUserAction();
                }
            }
        }

        function isOVRWeb(){
            return window.location.hash.substring(1).split('&').indexOf('ovrweb') > -1;
        }

        function getParams(params) {
            var queryDict = {}; params.split("&").forEach(function(item) {var k = item.split("=")[0], v = decodeURIComponent(item.split("=")[1]);queryDict[k.toLowerCase()] = v});
            return queryDict;
        }

        document.addEventListener('DOMContentLoaded', onLoad);
    </script>
    <style type="text/css">
        html, body { height:100%; width:100%; height:100vh; width:100vw; margin:0; padding:0; overflow:hidden; }
        .fill-viewport { position:fixed; top:0; left:0; right:0; bottom:0; padding:0; margin:0; overflow: hidden; }
        .fill-viewport.landscape-left { left: env(safe-area-inset-left); }
        .fill-viewport.landscape-right { right: env(safe-area-inset-right); }
        #viewer { z-index:1; }
        #preloadContainer { z-index:2; opacity:0; background-color:rgba(255,255,255,1); transition: opacity 0.5s; -webkit-transition: opacity 0.5s; -moz-transition: opacity 0.5s; -o-transition: opacity 0.5s;}

        #warning-message { 
            display: none;
            font-size: 38px;
            text-align: center;
            background: #000;
            padding: 15px 30px;
            height: 100vh;
        }

        #warning-message img { 
            max-width: 700px;
            margin: 0 0 70px;
        }

        #warning-message p { 
            color: #fff;
            margin: 0;
            font-size: 74px;
            line-height: 92px;
            font-family: 'proxima_novaregular';
        }

        
        @media only screen and (max-width: 767px){
            #warning-message p { 
                font-size: 40px;
                line-height: 50px;
            }

            #warning-message img { 
                max-width: 500px;
                margin: 0 0 70px;
            }
        }

        @media only screen and (orientation:portrait){
            #viewer { display:none; }
            #warning-message { 
                display: flex;
                align-items: center; 
                justify-content: center;
            }
        }
        @media only screen and (orientation:landscape){
            #warning-message { display:none; }
        }

        .checkin-modal {
            padding: 0;
            box-shadow: none;
        }

        .checkin-modal .modal-content {
            background: transparent;
            box-shadow: none;
            border: 0;
        }

        @media (min-width: 576px) {
            .checkin-modal .modal-dialog {
                max-width: none;
                margin: 0;
                top: 50%;
                transform: translateY(-50%);
            }
        }

        .checkin-modal .banner-block {
            padding: 0;
            height: auto;
        }

        .checkin-modal .common-block {
            padding: 0;
        }

        .checkin-modal .common-block .close {
            position: absolute;
            top: 20px;
            right: 20px;
            font-size: 38px;
            cursor: pointer;
            z-index: 999;
        }
    </style>
    <link rel="stylesheet" href="3dvista/fonts.css?v={{ rand() }}">
</head>
<body>
    <div id="preloadContainer" class="fill-viewport"><div style="z-index: 4; position: absolute; left: 0%; top: 50%; width: 100.00%; height: 10.00%"><div style="text-align:left; color:#000; "><DIV STYLE="text-align:center;font-size:1.6666666666666663vmin;"><SPAN STYLE="display:inline-block; letter-spacing:0vmin; white-space:pre-wrap;color:#777777;font-size:1.67vmin;font-family:Arial, Helvetica, sans-serif;">Loading virtual tour. Please wait...</SPAN></DIV></div></div></div>
    <div id="viewer" class="fill-viewport">
    </div>
    <div id="warning-message">
        <div class="warning-message-subblock">
            <img src="{{asset('assets/images/tablet-mobile.png')}}" class="img-fluid" />
            <p>This site works best when using a mobile tablet or phone in landscape mode.</p>
        </div>
    </div>
    <div class="modal checkin-modal" id="checkinModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="banner-block">
                        <div class="container">
                            <div class="common-block">
                                <span class="close">&times;</span>
                                <div class="quiz-checkin-block">
                                    <div class="container">
                                        <div class="quiz-checkin-subblock">
                                            <h1>Guest Check-In</h1>
                                            <div class="quiz-checkin-form-block">
                                                <form>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label>First Name</label>
                                                                <input type="text" class="form-control">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label>Email Address</label>
                                                                <input type="email" class="form-control">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label>Age Group<sup>*</sup></label>
                                                                <div class="select-box">
                                                                    <select class="form-control">
                                                                        <option value="0-20">0-20</option>
                                                                        <option value="20-40">20-40</option>
                                                                        <option value="40-60">40-60</option>
                                                                        <option value="60-80">60-80</option>
                                                                        <option value="80 and above">80 And above</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label>Designation<sup>*</sup></label>
                                                                <input type="text" class="form-control">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label>Organization/School<sup>*</sup></label>
                                                                <input type="text" class="form-control">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label>How did you get to know about the website?<sup>*</sup></label>
                                                                <div class="select-box">
                                                                    <select class="form-control">
                                                                        <option value="social site">Social Site</option>
                                                                        <option value="email or newsletter">Email OR Newsletter</option>
                                                                        <option value="friends">Friends</option>
                                                                        <option value="others">Others</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <div class="form-group checkbox-group">
                                                                <input type="checkbox" id="mail-list">
                                                                <label for="mail-list">Subscribe to mailing list</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <div class="form-group button-group">
                                                                <button type="submit" class="btn-submit"><img src="http://localhost:8080/astar/public/assets/images/next.png" class="img-fluid"></button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>