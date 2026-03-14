<style>
    .img-fluid {
        width: 100%;
        height: auto;
    }
</style>

<div class="wgslider-slider-default center">
    <{foreach $block as $slider_images}>
        <div class="wgslider-slider-default-slide">
            <img class="img-fluid" src="<{$wgslider_upload_image_url|default:''}>/<{$slider_images.realname}>" alt="<{$slider_images.tooltip}>" title="<{$slider_images.tooltip}>">
        </div>
    <{/foreach}>
</div>

<script>
    let slideIndex = 0;
    showSlides();

    function showSlides() {
        let slides = document.querySelectorAll(".wgslider-slider-default-slide");

        slides.forEach(slide => slide.style.display = "none");

        slideIndex++;
        if (slideIndex > slides.length) {
            slideIndex = 1;
        }

        if (slides.length > 0) {
            slides[slideIndex - 1].style.display = "block";
        }

        setTimeout(showSlides, <{$wgslider_param_timeout|default:1000}>); // 4 seconds
    }
</script>