<style>
    .img-fluid {
        <{if $block.params.fullsize}>
        width: 100%;
        <{else}>
        max-width: 100%;
        <{/if}>
        height: auto;
    }
</style>

<div id="myCarousel<{$wgslider_identifier}>" class="carousel slide slideshow" data-ride="carousel">
    <!-- Indicators -->
    <{if $block.params.show_indicator}>
    <ol class="carousel-indicators">
        <{foreach $block['images'] as $slider_image name=loop}>
        <li class="<{if $smarty.foreach.loop.index == 0}>active<{/if}>" data-slide-to="<{$smarty.foreach.loop.index}>" data-target="#myCarousel<{$wgslider_identifier}>"></li>
        <{/foreach}>
    </ol>
    <{/if}>
    <div class="carousel-inner">
        <{foreach $block['images'] as $slider_image name=loop}>
        <li class="item <{if $smarty.foreach.loop.index == 0}>active<{/if}>">
            <img class="img-fluid" alt="<{$slider_image.description}>" src="<{$wgslider_upload_image_url|default:''}>/<{$slider_image.realname}>">
        </li>
        <{/foreach}>
    </div>
    <{if $block.params.show_prev_next}>
    <a class="left carousel-control" href="#myCarousel<{$wgslider_identifier}>" data-slide="prev"><span class="icon-prev"></span></a>
    <a data-slide="next" href="#myCarousel<{$wgslider_identifier}>" class="right carousel-control"><span class="icon-next"></span></a>
    <{/if}>
</div><!-- .carousel -->

<script>
    $('#myCarousel<{$wgslider_identifier}>').carousel({
        interval: <{$block.params.interval|default:5000}>,
        pause: "<{$block.params.pause|default:'hover'}>",
        wrap: <{$block.params.wrap|default:true}>,
        keyboard: <{$block.params.keyboard|default:true}>
    });
</script>


