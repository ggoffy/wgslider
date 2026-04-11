<style>
    .wgs-swiper img {
        width: 100%;
        height: auto;
        display: block;
    }

    .wgs-caption {
        position: absolute;
        bottom: 0;
        left: 0;
        width: 100%;
        <{if $block.params.bg_caption == 'smooth'}>
        background: linear-gradient(
                to top,
                rgba(0,0,0,0.9),
                rgba(0,0,0,0)
        );
        <{/if}>
        <{if $block.params.bg_caption == 'hard'}>
        background: rgba(0,0,0,0.5);
        <{/if}>
        color: #fff;
        text-align: center;
        padding: 10px 15px;
        box-sizing: border-box;
    }
    .wgs-caption-h {
        margin: 0;
    }

    .wgs-caption-p {
        margin: 5px 0 0 0;
    }
    .swiper-slide {
        position: relative;
    }

    <{if $block.params.show_thumbs}>
    /*Thumbnail Slider*/
    .wgs-swiper-thumbs {
        margin-top: 10px;
    }

    .wgs-swiper-thumbs .swiper-slide {
        opacity: 0.5;
        cursor: pointer;
    }

    .wgs-swiper-thumbs .swiper-slide-thumb-active {
        opacity: 1;
    }

    .wgs-swiper-thumbs img {
        width: 100%;
        height: 80px;
        object-fit: cover;
    }
    <{/if}>

</style>

<div id="wgs-swiper-<{$wgslider_identifier}>" class="swiper wgs-swiper"
     data-effect="<{$block.params.effect}>"
     data-perview="<{$block.params.perview}>"
     data-autoplay="<{$block.params.autoplay}>">
    <div class="swiper-wrapper">
        <{foreach item=slide from=$block['images']}>
            <div class="swiper-slide">
                <img class="swiper-lazy" src="<{$wgslider_upload_image_url|default:''}>/<{$slide.realname}>" alt="<{$slide.name}>">
                <{if $slide.name && $block.params.show_caption}>
                    <div class="wgs-caption">
                        <h4 class="wgs-caption-h"><{$slide.name}></h4>
                        <{if $slide.description && $block.params.show_descr}>
                        <p class="wgs-caption-p"><{$slide.description}></p>
                        <{/if}>
                    </div>
                <{/if}>
            </div>
        <{/foreach}>
    </div>

    <{if $block.params.show_indicator}>
        <div class="swiper-pagination"></div>
    <{/if}>
    <{if $block.params.show_prev_next}>
        <div class="swiper-button-prev"></div>
        <div class="swiper-button-next"></div>
    <{/if}>
</div>

<{if $block.params.show_thumbs}>
    <!-- Thumbnail Slider -->
    <div id="wgs-swiper-thumbs-<{$wgslider_identifier}>" class="swiper wgs-swiper-thumbs">
        <div class="swiper-wrapper">
            <{foreach item=slide from=$block['images']}>
                <div class="swiper-slide">
                    <img src="<{$wgslider_upload_image_url|default:''}>/<{$slide.realname}>" alt="">
                </div>
            <{/foreach}>
        </div>
    </div>
<{/if}>

<link href="<{$wgslider_url|default:''}>/assets/swiper/swiper-bundle.min.css" rel="stylesheet">
<script src="<{$wgslider_url|default:''}>/assets/swiper/swiper-bundle.min.js"></script>

<script>
    document.addEventListener("DOMContentLoaded", function () {

        document.querySelectorAll('.wgs-swiper').forEach(function (slider) {

            const effect = slider.dataset.effect || 'slide';
            const perview = parseInt(slider.dataset.perview) || 1;
            const autoplay = slider.dataset.autoplay === "1";

            let thumbsSwiper = null;

            // link thumbnail-slider to related slider
            <{if $block.params.show_thumbs}>
            const thumbsEl = slider.parentNode.querySelector('.wgs-swiper-thumbs');

            if (thumbsEl) {
                thumbsSwiper = new Swiper(thumbsEl, {

                    spaceBetween: 10,
                    slidesPerView: 5,
                    freeMode: true,
                    watchSlidesProgress: true,

                    breakpoints: {
                        0: { slidesPerView: 3 },
                        768: { slidesPerView: 4 },
                        1024: { slidesPerView: 5 }
                    }

                });
            }
            <{/if}>

            const options = {

                loop: true,
                effect: effect,
                slidesPerView: perview,

                autoplay: autoplay ? {
                    delay: <{$block.params.delay}>,
                    pauseOnMouseEnter: <{$block.params.pauseOnMouse|@json_encode}>,
                    disableOnInteraction: false
                } : false,

                <{if $block.params.show_indicator}>
                pagination: {
                    el: slider.querySelector('.swiper-pagination'),
                    clickable: true
                },
                <{/if}>

                <{if $block.params.show_prev_next}>
                navigation: {
                    nextEl: slider.querySelector('.swiper-button-next'),
                    prevEl: slider.querySelector('.swiper-button-prev')
                },
                <{/if}>

                autoHeight: <{$block.params.autoheight|@json_encode}>

            };

            // breakpoints if necessary
            if (perview > 1) {
                options.breakpoints = {
                    0: { slidesPerView: 1 },
                    768: { slidesPerView: 2 },
                    1024: { slidesPerView: perview }
                };
            }

            // link thumbnails if necessary
            <{if $block.params.show_thumbs}>
            if (thumbsSwiper) {
                options.thumbs = {
                    swiper: thumbsSwiper
                };
            }
            <{/if}>

            new Swiper(slider, options);

        });

    });
</script>