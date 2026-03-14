<!-- Header -->
<{include file='db:wgslider_admin_header.tpl' }>

<{if $category_list|default:''}>
    <table class='outer'>
        <thead>
            <tr class='head'>
                <th class="center"><{$smarty.const._AM_WGSLIDER_CATEGORY_ID}></th>
                <th class="center"><{$smarty.const._AM_WGSLIDER_CATEGORY_NAME}></th>
                <th class="center"><{$smarty.const._AM_WGSLIDER_CATEGORY_DISPLAY}></th>
                <th class="center"><{$smarty.const._AM_WGSLIDER_CATEGORY_KEY}></th>
                <th class="center"><{$smarty.const._AM_WGSLIDER_CATEGORY_SLIDESHOW}></th>
                <th class="center"><{$smarty.const._AM_WGSLIDER_DATECREATED}></th>
                <th class="center"><{$smarty.const._AM_WGSLIDER_SUBMITTER}></th>
                <th class="center"><{$smarty.const._AM_WGSLIDER_STATUS}></th>
                <th class="center width5"><{$smarty.const._AM_WGSLIDER_FORM_ACTION}></th>
            </tr>
        </thead>
        <{if $category_count|default:''}>
        <tbody>
            <{foreach item=category from=$category_list}>
            <tr class='<{cycle values='odd, even'}>'>
                <td class=''><{$category.id|default:false}></td>
                <td class=''><{$category.name|default:false}></td>
                <td class=''><{$category.display_text|default:false}></td>
                <td class=''><{$category.key|default:false}></td>
                <td class=''>
                    <{if $category.slideshow_offline|default:false}>
                        <img src="<{$modPathIcon32}>warning.png" alt="<{$smarty.const._AM_WGSLIDER_WARNING_SLIDESHOW_OFFLINE}>" title="<{$smarty.const._AM_WGSLIDER_WARNING_SLIDESHOW_OFFLINE}>">
                    <{/if}>
                    <{$category.slideshow_text|default:false}>
                </td>
                <td class=''><{$category.datecreated_text|default:false}></td>
                <td class=''><{$category.submitter_text|default:false}></td>
                <td class='center'>
                    <form action="category.php" method="post" style="display:inline;">
                        <{$token}>
                        <input type="hidden" name="op" value="change_status">
                        <input type="hidden" name="id" value="<{$category.id}>">
                        <input type="hidden" name="start" value="<{$start}>">
                        <input type="hidden" name="limit" value="<{$limit}>">
                        <input type="image"  src="<{$modPathIcon32}>status<{$category.status}>.png" style="height:16px;border:0;">
                    </form>
                </td>
                <td class="center width5">
                    <a href="category.php?op=edit&amp;id=<{$category.id|default:false}>&amp;start=<{$start|default:0}>&amp;limit=<{$limit|default:0}>" title="<{$smarty.const._EDIT}>"><img src="<{xoModuleIcons16 'edit.png'}>" alt="<{$smarty.const._EDIT}> category" ></a>
                    <a href="category.php?op=clone&amp;id_source=<{$category.id|default:false}>" title="<{$smarty.const._CLONE}>"><img src="<{xoModuleIcons16 'editcopy.png'}>" alt="<{$smarty.const._CLONE}> category" ></a>
                    <a href="category.php?op=delete&amp;id=<{$category.id|default:false}>" title="<{$smarty.const._DELETE}>"><img src="<{xoModuleIcons16 'delete.png'}>" alt="<{$smarty.const._DELETE}> category" ></a>
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

<!-- Footer -->
<{include file='db:wgslider_admin_footer.tpl' }>
