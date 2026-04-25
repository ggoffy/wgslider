

<div id="carousel<{$wgslider_identifier}>" class="carousel slide" data-bs-ride="carousel">
    <{if $block.params.show_indicator}>
    <div class="carousel-indicators">
        <{foreach $block['images'] as $slider_image name=loop}>
        <button type="button" data-bs-target="#carousel<{$wgslider_identifier}>" data-bs-slide-to="<{$smarty.foreach.loop.index}>" class="<{if $smarty.foreach.loop.index == 0}>active<{/if}>" aria-current="true" aria-label="Slide <{$smarty.foreach.loop.index}>"></button>
        <{/foreach}>
    </div>
    <{/if}>

    <div class="carousel-inner">
        <{foreach $block['images'] as $slider_image name=loop}>
        <div class="carousel-item <{if $smarty.foreach.loop.index == 0}>active<{/if}>">
            <img src="<{$wgslider_upload_image_url|default:''}>/<{$slider_image.realname}>"
                 class="d-block <{if $block.params.fullsize}>w-100<{else}>center<{/if}>" alt="<{$slider_image.description}>">
            <{if $block.params.show_caption}>
            <div class="carousel-caption d-none d-md-block">
                <h4><{$slider_image.name}></h4>
                <{if $block.params.show_descr}>
                <p><{$slider_image.description}></p>
                <{/if}>
            </div>
            <{/if}>
        </div>
        <{/foreach}>
    </div>

    <{if $block.params.show_prev_next}>
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
            interval: <{$block.params.interval|default:5000}>,
            pause: "<{$block.params.pause|default:'hover'|@json_encode}>",
            wrap: <{$block.params.wrap|default:true|@json_encode}>,
            keyboard: <{$block.params.keyboard|default:true|@json_encode}>
        });
    })();
</script>


