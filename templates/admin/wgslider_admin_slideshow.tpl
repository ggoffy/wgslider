<!-- Header -->
<{include file='db:wgslider_admin_header.tpl' }>

<{if $slideshow_list|default:''}>
    <table class='outer'>
        <thead>
            <tr class='head'>
                <th class="center"><{$smarty.const._AM_WGSLIDER_SLIDESHOW_ID}></th>
                <th class="center"><{$smarty.const._AM_WGSLIDER_SLIDESHOW_NAME}></th>
                <th class="center"><{$smarty.const._AM_WGSLIDER_SLIDESHOW_DESCR}></th>
                <th class="center"><{$smarty.const._AM_WGSLIDER_SLIDESHOW_CREDITS}></th>
                <th class="center"><{$smarty.const._AM_WGSLIDER_SLIDESHOW_TPL}></th>
                <th class="center"><{$smarty.const._AM_WGSLIDER_SLIDESHOW_PARAMS}></th>
                <th class="center"><{$smarty.const._AM_WGSLIDER_STATUS}></th>
                <th class="center width5"><{$smarty.const._AM_WGSLIDER_FORM_ACTION}></th>
            </tr>
        </thead>
        <{if $slideshow_count|default:''}>
        <tbody>
            <{foreach item=slideshow from=$slideshow_list}>
            <tr class='<{cycle values='odd, even'}>'>
                <td class=''><{$slideshow.id|default:false}></td>
                <td class=''><{$slideshow.name|default:false}></td>
                <td class=''><{$slideshow.descr|default:false}></td>
                <td class=''><{$slideshow.credits|default:false}></td>
                <td class=''><{$slideshow.tpl|default:false}></td>
                <td class=''>
                    <ul>
                        <{foreach $slideshow.params_arr|default:[] as $key => $value name=loop}>
                            <li><strong><{$value.descr}>:</strong> <{$value.value}></li>
                        <{/foreach}>
                    </ul>
                </td>
                <td class='center'>
                    <form action="slideshow.php" method="post" style="display:inline;">
                        <{$token}>
                        <input type="hidden" name="op" value="change_status">
                        <input type="hidden" name="id" value="<{$slideshow.id}>">
                        <input type="hidden" name="start" value="<{$start}>">
                        <input type="hidden" name="limit" value="<{$limit}>">
                        <input type="image"  src="<{$modPathIcon32}>status<{$slideshow.status}>.png" style="height:16px;border:0;">
                    </form>
                </td>
                <td class="center  width5">
                    <a href="slideshow.php?op=edit&amp;id=<{$slideshow.id|default:false}>&amp;start=<{$start|default:0}>&amp;limit=<{$limit|default:0}>" title="<{$smarty.const._EDIT}>"><img src="<{xoModuleIcons16 'edit.png'}>" alt="<{$smarty.const._EDIT}>" ></a>
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
