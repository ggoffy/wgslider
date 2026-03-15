

<div id="carousel<{$wgslider_identifier}>" class="carousel slide" data-bs-ride="carousel">
    <{if $wgs_params.show_indicator}>
    <div class="carousel-indicators">
        <{foreach $block as $slider_images name=loop}>
        <button type="button" data-bs-target="#carousel<{$wgslider_identifier}>" data-bs-slide-to="<{$smarty.foreach.loop.index}>" class="<{if $smarty.foreach.loop.index == 0}>active<{/if}>" aria-current="true" aria-label="Slide <{$smarty.foreach.loop.index}>"></button>
        <{/foreach}>
    </div>
    <{/if}>

    <div class="carousel-inner">
        <{foreach $block as $slider_images name=loop}>
        <div class="carousel-item <{if $smarty.foreach.loop.index == 0}>active<{/if}>">
            <img src="<{$wgslider_upload_image_url|default:''}>/<{$slider_images.realname}>"
                 class="d-block <{if $wgs_params.fullsize}>w-100<{else}>center<{/if}>" alt="<{$slider_images.description}>">
            <{if $wgs_params.show_caption}>
            <div class="carousel-caption d-none d-md-block">
                <h4><{$slider_images.name}></h4>
                <{if $wgs_params.show_descr}>
                <p><{$slider_images.description}></p>
                <{/if}>
            </div>
            <{/if}>
        </div>
        <{/foreach}>
    </div>

    <{if $wgs_params.show_prev_next}>
    <button class="carousel-control-prev" type="button" data-bs-target="#carousel<{$wgslider_identifier}>" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carousel<{$wgslider_identifier}>" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
    <{/if}>
</div>

<script>
    (() => {
        const el = document.querySelector('#carousel<{$wgslider_identifier}>');
        if (!el) return;
        new bootstrap.Carousel(el, {
            interval: <{$wgs_params.interval|default:5000}>,
            pause: "<{$wgs_params.pause|default:'hover'|@json_encode}>",
            wrap: <{$wgs_params.wrap|default:true|@json_encode}>,
            keyboard: <{$wgs_params.keyboard|default:true|@json_encode}>
        });
    })();
</script>


