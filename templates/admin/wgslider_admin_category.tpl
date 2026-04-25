<!-- Header -->
<{include file='db:wgslider_admin_header.tpl' }>

<{if $category_list|default:''}>
    <table class='outer'>
        <thead>
            <tr class='head'>
                <th class='center'><{$smarty.const._AM_WGSLIDER_CATEGORY_ID}></th>
                <th class='center'><{$smarty.const._AM_WGSLIDER_CATEGORY_NAME}></th>
                <th class='center'><{$smarty.const._AM_WGSLIDER_CATEGORY_DISPLAY}></th>
                <th class='center'><{$smarty.const._AM_WGSLIDER_CATEGORY_KEY}></th>
                <th class='center'><{$smarty.const._AM_WGSLIDER_CATEGORY_SLIDESHOW}></th>
                <th class='center'><{$smarty.const._AM_WGSLIDER_DATECREATED}></th>
                <th class='center'><{$smarty.const._AM_WGSLIDER_SUBMITTER}></th>
                <th class='center'><{$smarty.const._AM_WGSLIDER_STATUS}></th>
                <th class='center width5'><{$smarty.const._AM_WGSLIDER_FORM_ACTION}></th>
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
                    <div class='wgs-check-info'>
                        <{if $category.slideshow_offline|default:false}>
                            <img src='<{$modPathIcon32}>warning.png' alt='<{$smarty.const._AM_WGSLIDER_WARNING_SLIDESHOW_OFFLINE}>' title='<{$smarty.const._AM_WGSLIDER_WARNING_SLIDESHOW_OFFLINE}>'>
                        <{/if}>
                        <{$category.slideshow_text|default:false}>
                    </div>
                </td>
                <td class=''><{$category.datecreated_text|default:false}></td>
                <td class=''><{$category.submitter_text|default:false}></td>
                <td class='center'>
                    <form action='category.php' method='post' style='display:inline;'>
                        <{$token}>
                        <input type='hidden' name='op' value='change_status'>
                        <input type='hidden' name='id' value='<{$category.id}>'>
                        <input type='hidden' name='start' value='<{$start}>'>
                        <input type='hidden' name='limit' value='<{$limit}>'>
                        <input type='image'  src='<{$modPathIcon32}>status<{$category.status}>.png' style='height:16px;border:0;'>
                    </form>
                </td>
                <td class='center width5'>
                    <div class='xo-buttons'>
                        <{if $category.perm_edit|default:false}>
                            <a href='category.php?op=preview&id=<{$category.id|default:false}>' title='<{$smarty.const._PREVIEW}>'><i class='fa fa-eye'></i></a>
                            <a href='category.php?op=edit&id=<{$category.id|default:false}>&start=<{$start|default:0}>&limit=<{$limit|default:0}>' title='<{$smarty.const._EDIT}>'><i class='fa fa-edit'></i></a>
                            <a href='category.php?op=clone&id_source=<{$category.id|default:false}>' title='<{$smarty.const._CLONE}>'><i class='fa fa-copy'></i></a>
                            <a href='category.php?op=delete&id=<{$category.id|default:false}>' title='<{$smarty.const._DELETE}>'><i class='fa fa-trash'></i></a>
                        <{else}>
                            <i class='fa fa-ban'></i>
                        <{/if}>
                    </div>
                </td>
            </tr>
            <{/foreach}>
        </tbody>
        <{/if}>
    </table>
    <div class='clear'>&nbsp;</div>
    <{if $pagenav|default:''}>
        <div class='xo-pagenav floatright'><{$pagenav|default:false}></div>
        <div class='clear spacer'></div>
    <{/if}>
<{/if}>
<{if $form|default:''}>
    <{$form|default:false}>
<{/if}>
<{if $error|default:''}>
    <div class='errorMsg'><strong><{$error|default:false}></strong></div>
<{/if}>

<{if $preview|default:false}>
    <{if $preview_css|default:[]}>
        <{foreach item=css from=$preview_css}><{/foreach}>
    <{/if}>
    <{if $preview_js|default:[]}>
        <{foreach item=js from=$preview_js}><{/foreach}>
    <{/if}>
    <div class='wgs-preview-container'>
        <div class='wgs-preview-container-header center'>
            <div class='xo-buttons'>
                <a href='category.php?op=list' title='<{$smarty.const._AM_WGSLIDER_LIST_CATEGORY}>'><i class='fa fa-list'></i> <{$smarty.const._AM_WGSLIDER_LIST_CATEGORY}> </a>
            </div>
        </div>
        <div class='wgs-preview-container-body center'>
            <{include file='db:$wgslider_slideshow_tpl' block=$block}>
        </div>
    </div>
<{/if}>

<!-- Footer -->
<{include file='db:wgslider_admin_footer.tpl' }>
