import jQuery from 'jquery';

!(function($) {
    "use strict";

    $(document).ready(function() {
        var owlCarousel = $('.owl-carousel').owlCarousel({
            autoplay: false,
            autoplayTimeout: 3000,
            loop: false,
            items: 1,
            nav: true
        });

        setTimeout(() => {
            const completeButton = $('.quiz-questions .right-block .btn-quiz-complete');
            const completeButtonClone = completeButton.clone(true);
            $('.quiz-questions .owl-carousel .owl-nav').append('<button type="button" class="btn-quiz-complete d-none">'+ completeButtonClone.html() +'</button>');
            completeButton.remove();
        }, 1000);

        //QuowlCarousel Change Event
        owlCarousel.on('changed.owl.carousel', function(event) {
            if(event.item.index === 9) {
                $('.owl-nav .owl-next').addClass('d-none');
                $('.btn-quiz-complete').removeClass('d-none');
            } else {
                $('.owl-nav .owl-next').removeClass('d-none');
                $('.btn-quiz-complete').addClass('d-none');
            }
        });

        //Complete button to submit the event
        $(document).on('click', '.btn-quiz-complete', function() {
            if(confirm('Are you sure want to finish?')) {
                $('#quiz-form').submit();
            } else {
                $('.owl-nav').removeClass('d-none');
                $('.btn-quiz-complete').addClass('d-none');
            }
        });
    });

    $(document).ready(function() {
        function setBoundries(slick, state) {
            if (state === 'default') {
                slick.find('ul.slick-dots li').eq(4).addClass('n-small-1');
            }
        }

        // Slick Selector.
        var slickSlider = $('.scoreboard-slider');
        var maxDots = 3;
        var transformXIntervalNext = -22;
        var transformXIntervalPrev = 22;

        slickSlider.on('init', function(event, slick) {
            $(this).find('ul.slick-dots').wrap("<div class='slick-dots-container'></div>");
            $(this).find('ul.slick-dots li').each(function(index) {
                $(this).addClass('dot-index-' + index);
            });
            $(this).find('ul.slick-dots').css('transform', 'translateX(0)');
            setBoundries($(this), 'default');
        });

        var transformCount = 0;
        slickSlider.on('beforeChange', function(event, slick, currentSlide, nextSlide) {
            var totalCount = $(this).find('.slick-dots li').length;
            if (totalCount > maxDots) {
                if (nextSlide > currentSlide) {
                    if ($(this).find('ul.slick-dots li.dot-index-' + nextSlide).hasClass('n-small-1')) {
                        if (!$(this).find('ul.slick-dots li:last-child').hasClass('n-small-1')) {
                            transformCount = transformCount + transformXIntervalNext;
                            $(this).find('ul.slick-dots li.dot-index-' + nextSlide).removeClass('n-small-1');
                            var nextSlidePlusOne = nextSlide + 1;
                            $(this).find('ul.slick-dots li.dot-index-' + nextSlidePlusOne).addClass('n-small-1');
                            $(this).find('ul.slick-dots').css('transform', 'translateX(' + transformCount + 'px)');
                            var pPointer = nextSlide - 3;
                            var pPointerMinusOne = pPointer - 1;
                            $(this).find('ul.slick-dots li').eq(pPointerMinusOne).removeClass('p-small-1');
                            $(this).find('ul.slick-dots li').eq(pPointer).addClass('p-small-1');
                        }
                    }
                } else {
                    if ($(this).find('ul.slick-dots li.dot-index-' + nextSlide).hasClass('p-small-1')) {
                        if (!$(this).find('ul.slick-dots li:first-child').hasClass('p-small-1')) {
                            transformCount = transformCount + transformXIntervalPrev;
                            $(this).find('ul.slick-dots li.dot-index-' + nextSlide).removeClass('p-small-1');
                            var nextSlidePlusOne = nextSlide - 1;
                            $(this).find('ul.slick-dots li.dot-index-' + nextSlidePlusOne).addClass('p-small-1');
                            $(this).find('ul.slick-dots').css('transform', 'translateX(' + transformCount + 'px)');
                            var nPointer = currentSlide + 3;
                            var nPointerMinusOne = nPointer - 1;
                            $(this).find('ul.slick-dots li').eq(nPointer).removeClass('n-small-1');
                            $(this).find('ul.slick-dots li').eq(nPointerMinusOne).addClass('n-small-1');
                        }
                    }
                }
            }
        });

        $('.scoreboard-slider').slick({
            dots: false,
            arrows: false,
            autoplay: true,
            autoplaySpeed: 2000,
        });

        $('.navbar-toggler').on('click', function() {
            $('.navbar-collapse').slideToggle();
        });

        /*$("#checkinModal").on("hidden.bs.modal", function () {
            window.open('/gallery', '_blank');
        });*/
    });
})(jQuery);
