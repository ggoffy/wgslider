<style>
    .img-fluid {
        width: 100%;
        height: auto;
    }
</style>

<div class="wgslider-slider-default center">
    <{foreach $block['images'] as $slider_image}>
        <div class="wgslider-slider-default-slide">
            <img class="img-fluid" src="<{$wgslider_upload_image_url|default:''}>/<{$slider_image.realname}>" alt="<{$slider_image.tooltip}>" title="<{$slider_image.tooltip}>">
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

        setTimeout(showSlides, <{$block.params.timeout|default:1000}>); // 4 seconds
    }
</script>