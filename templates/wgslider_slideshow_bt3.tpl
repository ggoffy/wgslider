<style>
    .img-fluid {
        <{if $wgs_params.fullsize}>
        width: 100%;
        <{else}>
        max-width: 100%;
        <{/if}>
        height: auto;
    }
</style>

<div id="myCarousel<{$wgslider_identifier}>" class="carousel slide slideshow" data-ride="carousel">
    <!-- Indicators -->
    <{if $wgs_params.show_indicator}>
    <ol class="carousel-indicators">
        <{foreach $block as $slider_images name=loop}>
        <li class="<{if $smarty.foreach.loop.index == 0}>active<{/if}>" data-slide-to="<{$smarty.foreach.loop.index}>" data-target="#myCarousel<{$wgslider_identifier}>"></li>
        <{/foreach}>
    </ol>
    <{/if}>
    <div class="carousel-inner">
        <{foreach $block as $slider_images name=loop}>
        <li class="item <{if $smarty.foreach.loop.index == 0}>active<{/if}>">
            <img class="img-fluid" alt="<{$slider_images.description}>" src="<{$wgslider_upload_image_url|default:''}>/<{$slider_images.realname}>">
        </li>
        <{/foreach}>
    </div>
    <{if $wgs_params.show_prev_next}>
    <a class="left carousel-control" href="#myCarousel<{$wgslider_identifier}>" data-slide="prev"><span class="icon-prev"></span></a>
    <a data-slide="next" href="#myCarousel<{$wgslider_identifier}>" class="right carousel-control"><span class="icon-next"></span></a>
    <{/if}>
</div><!-- .carousel -->

<script>
    $('#myCarousel<{$wgslider_identifier}>').carousel({
        interval: <{$wgs_params.interval|default:5000}>,
        pause: "<{$wgs_params.pause|default:'hover'}>",
        wrap: <{$wgs_params.wrap|default:true}>,
        keyboard: <{$wgs_params.keyboard|default:true}>
    });
</script>


