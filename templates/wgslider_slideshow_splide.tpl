
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
</style>


<div class="splide wgs-splide"
     data-perpage="<{$wgs_params.perview}>"
     data-autoplay="<{$wgs_params.autoplay}>">

    <div class="splide__track">
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

<script>

    document.addEventListener("DOMContentLoaded", function () {

        document.querySelectorAll('.wgs-splide').forEach(function (slider) {

            const perpage = parseInt(slider.dataset.perpage) || 1;
            const autoplay = slider.dataset.autoplay === "1";

            const options = {

                type: 'loop',
                perPage: perpage,
                autoplay: autoplay,
                interval: <{$wgs_params.interval}>,
                pauseOnHover: <{$wgs_params.pauseOnMouse}>,
                arrows:  <{$wgs_params.show_indicator}>,
                pagination: <{$wgs_params.show_prev_next}>

            };

            if (perpage > 1) {
                options.breakpoints = {
                    1024: { perPage: Math.min(perpage, 3) },
                    768: { perPage: Math.min(perpage, 2) },
                    480: { perPage: 1 }
                };
            }

            new Splide(slider, options).mount();
        });
    });

</script>