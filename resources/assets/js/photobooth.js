import jQuery from 'jquery';
import Webcam from "webcam-easy";
import mergeImages from "merge-images";
import axios from "axios";
import gifshot from "gifshot";

!(function($) {
    "use strict";

    let photoboothSettings;
    let submittingForm = false;

    $.photobooth = {
        initSettings: () => ({
            step: 1,
            image_type: null,
            image: null,
            thumbnail: null,
            frame: "1",
            framePath: null,
            frameSrc: null,
            sticker: null,
        }),
        refresh: (className = "") => {
            $.photobooth.animateLoader();

            const currentStep = parseInt(photoboothSettings.step);
            if (currentStep === 1) {
                $.photobooth.reset();
            } else if (currentStep === 2) {
                $.photobooth.reset();
                photoboothSettings.step = 2;
                $('.photobooth-4 input[name="image_type"]').val("");
                $('.photobooth-4 input[name="image"]').val("");
                $('.photobooth-4 .drag-area .drag-area-inner')
                    .html(
                        '<div class="icon">\n' +
                            '<img src="/assets/images/upload-icon.png" class="img-fluid" />\n' +
                        '</div>\n' +
                        '<header>Drop your image here, or <label for="upload-image" type="button">browse</label></header>'
                    );

                $('#photobooth-captured-gif-image').addClass('d-none');
                $('#photobooth-capture-webcam').addClass('d-none');

                $('.photobooth-take-image').addClass('d-none');
                $('.photobooth-start-camera').removeClass('d-none');

                $('.photobooth-capture-image > img').not('.d-none').addClass('d-none');
                $('.photobooth-take-image > img').not('.d-none').addClass('d-none');
            }

            $('#photobooth-steps > div').addClass('d-none');
            $(`#photobooth-steps > div.photobooth-${currentStep}${className}`).removeClass('d-none');
        },
        reset: () => {
            photoboothSettings = $.photobooth.initSettings();
            submittingForm = false;
        },
        resizeDataUrl: (src, width, height, imageSrc) => {
            const img = document.createElement('img');
            img.onload = function () {
                const canvas = document.createElement('canvas');
                const ctx = canvas.getContext('2d');
                canvas.width = width;
                canvas.height = height;

                ctx.drawImage(img, 0, 0, width, height);
                imageSrc(canvas.toDataURL());
                return canvas.toDataURL();
            }
            img.src = src;
        },
        setThumbnail: () => {
            $('#photobooth-steps .photobooth-5, #photobooth-steps .photobooth-6').find('img.frame-image').attr('src', photoboothSettings.thumbnail);
            $.photobooth.animateLoader();
        },
        mergeText: (image, thumbnail) => {
            const img = document.createElement('img');
            img.onload = function () {
                const canvas = document.createElement('canvas');
                const ctx = canvas.getContext('2d');
                canvas.width = 580;
                canvas.height = 580;

                ctx.font = "bold 33px Arial";
                ctx.fillStyle = "white";

                ctx.drawImage(img, 0, 0, 580, 580);
                ctx.fillText("A*STAR SCHOLARSHIP", 30, 40);
                ctx.fillText("AWARD CEREMONY", 30, 75);

                thumbnail(canvas.toDataURL());
            }
            img.src = image;
        },
        store: step => {
            $('a[class*="photobooth-select-step"][data-step="'+ step +'"]').addClass('disabled');
            if (!submittingForm) {
                $.photobooth.showLoader();
                axios.post('/photobooth', photoboothSettings).then(res => {
                    window.location.href = '/photobooth/share/' + res.data.id;
                    submittingForm = false;
                });
            } else {
                submittingForm = true;
            }
        },
        showLoader: () => {
            $('form[name="photobooth_form"] .background-loader').addClass('d-flex');
        },
        hideLoader: () => {
            $('form[name="photobooth_form"] .background-loader').removeClass('d-flex');
        },
        animateLoader: () => {
            $.photobooth.showLoader();
            setTimeout(() => {
                console.log('timeout');
                $.photobooth.hideLoader();
            }, 500);
        }
    };

    photoboothSettings = $.photobooth.initSettings();

    if ($('#photobooth-steps').length) {
        $(document).on('click', '#photobooth-steps .photobooth-select-step', function (e) {
            e.preventDefault();
            photoboothSettings.step = $(this).attr('data-step');

            if (photoboothSettings.step === "7") {
                if (!submittingForm)
                    $.photobooth.store(photoboothSettings.step);
            } else {
                const className = $(this).attr('data-class');
                $.photobooth.refresh(className);
            }
        });

        $(document).on('click', '#photobooth-steps .photobooth-choose-image-type', function (e) {
            e.preventDefault();
            photoboothSettings.step = $(this).attr('data-step');
            const className = $(this).attr('data-class');
            photoboothSettings.image_type = $(this).attr('data-image-type');
            $('input[name="image_type"]').val(photoboothSettings.image_type);

            $('.photobooth-capture-image > img[data-button-type="'+ photoboothSettings.image_type +'"]').removeClass('d-none');
            $('.photobooth-take-image > img[data-button-type="'+ photoboothSettings.image_type +'"]').removeClass('d-none');

            $.photobooth.refresh(className);
        });

        let photoboothWebcamElement, photoboothCanvasElement, photoboothSnapSoundElement, photoboothWebcam;

        $(document).on('click', '#photobooth-steps .photobooth-start-camera', function(e) {
            e.preventDefault();

            $('#photobooth-capture-webcam').removeClass('d-none');
            $('.photobooth-start-camera').addClass('d-none');
            if (photoboothSettings.image_type === 'gif') {
                gifshot.createGIF({
                    numFrames: 20,
                    interval: 0.1,
                    gifWidth: 200,
                    gifHeight: 200,
                    webcamVideoElement: document.getElementById('photobooth-capture-webcam'),
                }, function (obj) {
                    if (!obj.error) {
                        const image = obj.image;
                        $('#photobooth-captured-gif-image')
                            .attr('src', image)
                            .removeClass('d-none');
                        $('#photobooth-capture-webcam').addClass('d-none');
                        $('.photobooth-take-image').removeClass('d-none');

                        photoboothSettings.image = image;
                        photoboothSettings.thumbnail = image;
                    }
                });
            } else if (photoboothSettings.image_type === 'classic') {
                photoboothWebcamElement = document.getElementById('photobooth-capture-webcam');
                photoboothCanvasElement = document.getElementById('photobooth-capture-canvas');
                photoboothSnapSoundElement = document.getElementById('photobooth-capture-snapSound');
                photoboothWebcam = new Webcam(photoboothWebcamElement, "user", photoboothCanvasElement, photoboothSnapSoundElement);

                photoboothWebcam.start()
                    .then(() => {
                        // console.log("Webcam started");
                        $('.photobooth-take-image').removeClass('d-none');
                    })
                    .catch(e => {
                        console.log(e);
                    });
            }
        })

        $(document).on('click', '#photobooth-steps .photobooth-capture-image', function (e) {
            e.preventDefault();
            photoboothSettings.step = $(this).attr('data-step');
            const className = $(this).attr('data-class');
            $.photobooth.refresh(className);
        });

        $(document).on('click', '#photobooth-steps .photobooth-take-image', function (e) {
            e.preventDefault();

            if (photoboothSettings.image_type === "gif") {
                if (!submittingForm)
                    $.photobooth.store(4);
            } else {
                photoboothSettings.image = photoboothWebcam.snap();
                photoboothSettings.thumbnail = photoboothWebcam.snap();
                photoboothWebcam.stop();
                photoboothSettings.step = '5';

                $.photobooth.refresh();
                $.photobooth.setThumbnail();
            }
        });

        $(document).on('click', '#photobooth-steps .photobooth-choose-frame', function (e) {
            e.preventDefault();
            const frame = $(this).attr('data-frame');
            const imageSrc = $(this).find(">img").attr('src');

            photoboothSettings.frame = frame;
            photoboothSettings.frameSrc = imageSrc;

            if (frame === '1') {
                photoboothSettings.framePath = null;
                $.photobooth.resizeDataUrl(photoboothSettings.image, 580, 580, imgSrc => {
                    let images = [
                        {src: imgSrc, x: 0, y: 0},
                    ];

                    if (photoboothSettings.sticker) {
                        images.push({src: photoboothSettings.sticker, x: 450, y: 450});
                    }

                    mergeImages(images).then(img => {
                        photoboothSettings.thumbnail = img;
                        $.photobooth.setThumbnail();
                    });
                });
            } else {
                $.photobooth.resizeDataUrl(imageSrc, 580, 580, imgSrc => {
                    photoboothSettings.framePath = imgSrc;
                    let images = [
                        {src: imgSrc, x: 0, y: 0},
                        {src: photoboothSettings.image, width: 510, height: 510, x: 90, y: 90},
                    ];

                    if (photoboothSettings.sticker) {
                        images.push({src: photoboothSettings.sticker, x: 450, y: 450});
                    }

                    mergeImages(images).then(img => {
                        photoboothSettings.thumbnail = img;
                        $.photobooth.setThumbnail();
                    });
                });
            }
        });

        $(document).on('drag-and-drop-event', function(e) {
            const { image, imageType } = e.detail;

            if (imageType === 'gif') {
                photoboothSettings.image = image;
                photoboothSettings.thumbnail = image;
                $.photobooth.showLoader();
                $('form[name="photobooth_form"]').trigger('submit');
            } else {
                $.photobooth.resizeDataUrl(image, 400, 400, imgSrc => {
                    photoboothSettings.image = imgSrc;
                    photoboothSettings.thumbnail = imgSrc;

                    photoboothSettings.step = '5';
                    $.photobooth.refresh();

                    $.photobooth.setThumbnail();
                });
            }
        });

        $(document).on('click', '#photobooth-steps .photobooth-choose-sticker', function (e) {
            e.preventDefault();
            photoboothSettings.sticker = $(this).find(">img").attr('src');

            if (photoboothSettings.frame !== "1") {
                $.photobooth.resizeDataUrl(photoboothSettings.frameSrc, 580, 580, imgSrc => {
                    photoboothSettings.framePath = imgSrc;
                    let images = [
                        {src: imgSrc, x: 0, y: 0},
                        {src: photoboothSettings.image, width: 510, height: 510, x: 90, y: 90},
                    ];

                    if (photoboothSettings.sticker) {
                        images.push({src: photoboothSettings.sticker, x: 450, y: 450});
                    }

                    mergeImages(images).then(img => {
                        photoboothSettings.thumbnail = img;
                        $.photobooth.setThumbnail();
                    });
                });
            } else {
                $.photobooth.resizeDataUrl(photoboothSettings.image, 580, 580, imgSrc => {
                    let images = [
                        {src: imgSrc, x: 0, y: 0},
                    ];

                    if (photoboothSettings.sticker) {
                        images.push({src: photoboothSettings.sticker, x: 450, y: 450});
                    }

                    mergeImages(images).then(img => {
                        photoboothSettings.thumbnail = img;
                        $.photobooth.setThumbnail();
                    });
                });
            }
        });
    }

})(jQuery);
