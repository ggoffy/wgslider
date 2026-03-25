
<link href="<{$wgslider_url|default:''}>/assets/splide/splide.min.css" rel="stylesheet">
<script src="<{$wgslider_url|default:''}>/assets/splide/splide.min.js"></script>

<style>
    .wgs-splide img {
        width: 100%;
        height: auto;
        display: block;
    }

    .wgs-caption {
        position: absolute;
        bottom: 0;
        left: 0;
        width: 100%;
        background: rgba(0,0,0,0.5);
        color: #fff;
        text-align: center;
        padding: 10px 15px;
        box-sizing: border-box;
    }

    .splide__slide {
        position: relative;
    }

    <{if $wgs_params.show_thumbs}>
        #thumbnail-splide-slider-<{$wgslider_identifier}> {
            margin-top: 3px;
        }
        #thumbnail-splide-slider-<{$wgslider_identifier}> .splide__slide img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
    <{/if}>
</style>


<div class="splide wgs-splide"
     data-perpage="<{$wgs_params.perview}>"
     data-autoplay="<{$wgs_params.autoplay}>">

    <div id="splide-slider-<{$wgslider_identifier}>" class="splide__track">
        <ul class="splide__list">
            <{foreach item=slide from=$block}>
                <li class="splide__slide">
                    <img src="<{$wgslider_upload_image_url}>/<{$slide.realname}>" alt="<{$slide.name}>">
                    <{if $slide.name && $wgs_params.show_caption}>
                        <div class="wgs-caption">
                            <h4><{$slide.name}></h4>
                            <{if $slide.description && $wgs_params.show_descr}>
                                <p><{$slide.description}></p>
                            <{/if}>
                        </div>
                    <{/if}>
                </li>
            <{/foreach}>
        </ul>
    </div>
</div>

<{if $wgs_params.show_thumbs}>
    <!-- Thumbnail-Slider -->
    <div id="thumbnail-splide-slider-<{$wgslider_identifier}>" class="splide">
        <div class="splide__track">
            <ul class="splide__list">
                <{foreach item=slide from=$block}>
                    <li class="splide__slide"><img src="<{$wgslider_upload_image_url}>/<{$slide.realname}>" alt="<{$slide.name}>"></li>
                <{/foreach}>
            </ul>
        </div>
    </div>
<{/if}>

<script>

    document.addEventListener("DOMContentLoaded", function () {

        document.querySelectorAll('.wgs-splide').forEach(function (slider) {

            const perpage = parseInt(<{$wgs_params.perview}>) || 1;
            const autoplay = "<{$wgs_params.autoplay}>" === "1";

            const options = {

                type: 'loop',
                perPage: perpage,
                autoplay: autoplay,
                gap: <{$wgs_params.gap|@json_encode}>,
                interval: <{$wgs_params.interval}>,
                pauseOnHover: <{$wgs_params.pauseOnMouse|@json_encode}>,
                arrows:  <{$wgs_params.show_indicator|@json_encode}>,
                pagination: <{$wgs_params.show_prev_next|@json_encode}>

            };

            if (perpage > 1) {
                options.breakpoints = {
                    1024: { perPage: Math.min(perpage, 3) },
                    768: { perPage: Math.min(perpage, 2) },
                    480: { perPage: 1 }
                };
            }

            const main = new Splide(slider, options);

            <{if $wgs_params.show_thumbs}>
                const thumbnails = new Splide('#thumbnail-splide-slider-<{$wgslider_identifier}>', {
                    fixedWidth  : 100,
                    fixedHeight : 60,
                    gap         : 10,
                    rewind      : true,
                    pagination  : false,
                    isNavigation: true,
                    focus       : 'center',
                    breakpoints : {
                        600: {
                            fixedWidth : 60,
                            fixedHeight: 40,
                        },
                    },
                });
                thumbnails.mount();
                main.sync(thumbnails);
            <{/if}>

            main.mount();

        });
    });

</script>