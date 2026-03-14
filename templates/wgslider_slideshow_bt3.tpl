<style>
    .img-fluid {
        <{if $wgslider_param_bt3_fullsize == 'true'}>
        width: 100%;
        <{else}>
        max-width: 100%;
        <{/if}>
        height: auto;
    }
</style>

<div id="myCarousel<{$wgslider_identifier}>" class="carousel slide slideshow" data-ride="carousel">
    <!-- Indicators -->
    <{if $wgslider_param_bt3_show_indicators == 'true'}>
    <ol class="carousel-indicators">
        <{foreach $block as $slider_images name=loop}>
        <li class="<{if $smarty.foreach.loop.index == 0}>active<{/if}>" data-slide-to="<{$smarty.foreach.loop.index}>" data-target="#myCarousel<{$wgslider_identifier}>"></li>
        <{/foreach}>
    </ol>
    <{/if}>
    <div class="carousel-inner">
        <{foreach $block as $slider_images name=loop}>
        <li class="item <{if $smarty.foreach.loop.index == 0}>active<{/if}>">
            <img class="img-fluid" alt="<{$slider_images.tooltip}>" src="<{$wgslider_upload_image_url|default:''}>/<{$slider_images.realname}>">
        </li>
        <{/foreach}>
    </div>
    <{if $wgslider_param_bt3_show_prev_next == 'true'}>
    <a class="left carousel-control" href="#myCarousel<{$wgslider_identifier}>" data-slide="prev"><span class="icon-prev"></span></a>
    <a data-slide="next" href="#myCarousel<{$wgslider_identifier}>" class="right carousel-control"><span class="icon-next"></span></a>
    <{/if}>
</div><!-- .carousel -->

<script>
    $('#myCarousel<{$wgslider_identifier}>').carousel({
        interval: <{$wgslider_param_bt3_data_interval|default:5000}>,
        pause: "<{$wgslider_param_bt3_data_pause|default:'hover'}>",
        wrap: <{$wgslider_param_bt3_data_wrap|default:true}>,
        keyboard: <{$wgslider_param_bt3_data_keyboard|default:true}>
    });
</script>


