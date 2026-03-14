<!-- Header -->
<{include file='db:wgslider_admin_header.tpl' }>

<{if $image_list|default:''}>
    <table class='outer' id='sortable'>
        <thead>
            <tr class='head'>
                <th class="center">&nbsp;</th>
                <th class="center"><{$smarty.const._AM_WGSLIDER_IMAGE_ID}></th>
                <th class="center"><{$smarty.const._AM_WGSLIDER_IMAGE_NAME}></th>
                <th class="center"><{$smarty.const._AM_WGSLIDER_IMAGE_TOOLTIP}></th>
                <th class="center"><{$smarty.const._AM_WGSLIDER_IMAGE_PREVIEW}></th>
                <th class="center"><{$smarty.const._AM_WGSLIDER_IMAGE_WIDTH}></th>
                <th class="center"><{$smarty.const._AM_WGSLIDER_IMAGE_HEIGHT}></th>
                <th class="center"><{$smarty.const._AM_WGSLIDER_IMAGE_CATEGORY}></th>
                <th class="center"><{$smarty.const._AM_WGSLIDER_IMAGE_DATECREATED}></th>
                <th class="center"><{$smarty.const._AM_WGSLIDER_IMAGE_SUBMITTER}></th>
                <th class="center"><{$smarty.const._AM_WGSLIDER_IMAGE_STATUS}></th>
                <th class="center width5"><{$smarty.const._AM_WGSLIDER_FORM_ACTION}></th>
            </tr>
        </thead>
        <{if $image_count|default:''}>
        <tbody>
            <{foreach item=image from=$image_list}>
            <tr class='<{cycle values='odd, even'}>' id="iorder_<{$image.id}>">
                <td class=""><img src="<{$modPathIcon16}>/up_down.png" alt="drag&drop" class="icon-sortable"/></td>
                <td class=''><{$image.id|default:false}></td>
                <td class=''><{$image.name|default:''}></td>
                <td class=''><{$image.tooltip|default:''}></td>
                <td class=''><img class='gallery-img' src="<{$wgslider_upload_url|default:false}>/images/<{$image.realname|default:false}><{$currentTime|default:''}>" alt="image" style="max-width:100px" ></td>
                <td class='center'><{$image.width_text|default:''}></td>
                <td class='center'><{$image.height_text|default:''}></td>
                <td class=''><{$image.category_name|default:''}></td>
                <td class=''><{$image.datecreated_text|default:''}></td>
                <td class=''><{$image.submitter_text|default:''}></td>
                <td class='center'>
                    <form action="image.php" method="post" style="display:inline;">
                        <{$token}>
                        <input type="hidden" name="op" value="change_status">
                        <input type="hidden" name="id" value="<{$image.id}>">
                        <input type="hidden" name="start" value="<{$start}>">
                        <input type="hidden" name="limit" value="<{$limit}>">
                        <input type="image"  src="<{$modPathIcon32}>status<{$image.status}>.png" style="height:16px;border:0;">
                    </form>
                </td>
                <td class="center  width5">
                    <a href="image.php?op=edit&amp;id=<{$image.id|default:false}>&amp;start=<{$start|default:0}>&amp;limit=<{$limit|default:0}>" title="<{$smarty.const._EDIT}>"><img src="<{xoModuleIcons16 'edit.png'}>" alt="<{$smarty.const._EDIT}> image" ></a>
                    <a href="image.php?op=clone&amp;id_source=<{$image.id|default:false}>" title="<{$smarty.const._CLONE}>"><img src="<{xoModuleIcons16 'editcopy.png'}>" alt="<{$smarty.const._CLONE}> image" ></a>
                    <a href="image.php?op=delete&amp;id=<{$image.id|default:false}>" title="<{$smarty.const._DELETE}>"><img src="<{xoModuleIcons16 'delete.png'}>" alt="<{$smarty.const._DELETE}> image" ></a>
                    <a href="image_editor.php?op=edit&amp;id=<{$image.id|default:false}>" title="<{$smarty.const._AM_WGSLIDER_IMAGE_EDITOR}>"><img src="<{$modPathIcon16}>image_editor.png" alt="<{$smarty.const._AM_WGSLIDER_IMAGE_EDITOR}> image" ></a>
                </td>
            </tr>
            <{/foreach}>
        </tbody>
        <{/if}>
    </table>
    <div class="clear">&nbsp;</div>
    <{if $pagenav|default:''}>
        <div class="xo-pagenav floatright"><{$pagenav|default:false}></div>
        <div class="clear spacer"></div>
    <{/if}>
<{/if}>
<{if $form|default:''}>
    <{$form|default:false}>
<{/if}>
<{if $error|default:''}>
    <div class="errorMsg"><strong><{$error|default:false}></strong></div>
<{/if}>


<!-- Modal -->
<div id="myModal" class="modal">
    <span class="close">&times;</span>
    <img class="modal-content" id="modalImg">
</div>
<!-- end of modal -->


<!-- Footer -->
<{include file='db:wgslider_admin_footer.tpl' }>

<script>
    const modal = document.getElementById("myModal");
    const modalImg = document.getElementById("modalImg");
    const closeBtn = document.querySelector(".close");

    // select all images
    const images = document.querySelectorAll(".gallery-img");

    images.forEach(img => {
        img.onclick = function() {
            modal.style.display = "block";
            modalImg.src = this.src;
        }
    });

    // close
    closeBtn.onclick = function() {
        modal.style.display = "none";
    }

    // close after click somewhere
    modal.onclick = function(e) {
        if (e.target === modal) {
            modal.style.display = "none";
        }
    }
</script>