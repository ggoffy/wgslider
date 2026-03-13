<{include file='db:wgslider_admin_header.tpl'}>

<div id='imghandler' class='col-xs-12 col-sm-12'>
    <div class='tab-content '>
        <!-- ***************Tab for crop image ***************-->
        <div class='tab-pane center' id='4' >
            <input type='hidden' id='imageIdCrop' name='imageIdCrop' value='<{$imageId|default:0}>'>
            <!-- Content -->
            <div class="container-crop">
                <div class="row">
                    <div class="img-container">
                        <img id='cropImg' class="img-fluid" src="<{$imgCurrent.src|default:''}><{$currentTime|default:''}>" alt="<{$imgCurrent.img_name|default:''}>'">
                    </div>
                </div>
            </div>
            <div class="ie-toolbar" id="actions">
                <div class="docs-toggles">
                    <!-- <h3>Toggles:</h3> -->
                    <div class="ie-group" data-toggle="buttons">
                        <label class="btn imageeditor-btn-crop <{$btn_style|default:''}>">
                            <input type="radio" class="sr-only" id="aspectRatio1" name="aspectRatio" value="1.7777777777777777">
                            <span class="docs-tooltip" data-toggle="tooltip" title="<{$smarty.const._AM_WGSLIDER_IMAGE_EDITOR_CROP_ASPECTRATIO}>: 16 / 9">16:9</span>
                        </label>
                        <label class="btn imageeditor-btn-crop <{$btn_style|default:''}> active">
                            <input type="radio" class="sr-only" id="aspectRatio2" name="aspectRatio" value="1.3333333333333333">
                            <span class="docs-tooltip" data-toggle="tooltip" title="<{$smarty.const._AM_WGSLIDER_IMAGE_EDITOR_CROP_ASPECTRATIO}>: 4 / 3">4:3</span>
                        </label>
                        <label class="btn imageeditor-btn-crop <{$btn_style|default:''}>">
                            <input type="radio" class="sr-only" id="aspectRatio3" name="aspectRatio" value="1">
                            <span class="docs-tooltip" data-toggle="tooltip" title="<{$smarty.const._AM_WGSLIDER_IMAGE_EDITOR_CROP_ASPECTRATIO}>: 1 / 1">1:1</span>
                        </label>
                        <label class="btn imageeditor-btn-crop <{$btn_style|default:''}>">
                            <input type="radio" class="sr-only" id="aspectRatio4" name="aspectRatio" value="0.6666666666666666">
                            <span class="docs-tooltip" data-toggle="tooltip" title="<{$smarty.const._AM_WGSLIDER_IMAGE_EDITOR_CROP_ASPECTRATIO}>: 2 / 3">2:3</span>
                        </label>
                        <label class="btn imageeditor-btn-crop <{$btn_style|default:''}>">
                            <input type="radio" class="sr-only" id="aspectRatio5" name="aspectRatio" value="NaN">
                            <span class="docs-tooltip" data-toggle="tooltip" title="<{$smarty.const._AM_WGSLIDER_IMAGE_EDITOR_CROP_ASPECTRATIO}>: NaN"><{$smarty.const._AM_WGSLIDER_IMAGE_EDITOR_CROP_ASPECTRATIO_FREE}></span>
                        </label>
                    </div>
                </div><!-- /.docs-toggles -->
                <div class="docs-buttons">
                    <!-- <h3>Toolbar:</h3> -->
                    <div class="ie-group">
                        <button type="button" class="btn imageeditor-btn-crop <{$btn_style|default:''}>" data-method="zoom" data-option="0.1" title="<{$smarty.const._AM_WGSLIDER_IMAGE_EDITOR_CROP_ZOOMIN}>">
                            <span class="fa fa-search-plus"></span>
                        </button>
                        <button type="button" class="btn imageeditor-btn-crop <{$btn_style|default:''}>" data-method="zoom" data-option="-0.1" title="<{$smarty.const._AM_WGSLIDER_IMAGE_EDITOR_CROP_ZOOMOUT}>">
                            <span class="fa fa-search-minus"></span>
                        </button>
                    </div>
                    <div class="ie-group">
                        <button type="button" class="btn imageeditor-btn-crop <{$btn_style|default:''}>" data-method="move" data-option="-10" data-second-option="0" title="<{$smarty.const._AM_WGSLIDER_IMAGE_EDITOR_CROP_MOVE_LEFT}>">
                            <span class="fa fa-arrow-left"></span>
                        </button>
                        <button type="button" class="btn imageeditor-btn-crop <{$btn_style|default:''}>" data-method="move" data-option="10" data-second-option="0" title="<{$smarty.const._AM_WGSLIDER_IMAGE_EDITOR_CROP_MOVE_RIGHT}>">
                            <span class="fa fa-arrow-right"></span>
                        </button>
                        <button type="button" class="btn imageeditor-btn-crop <{$btn_style|default:''}>" data-method="move" data-option="0" data-second-option="-10" title="<{$smarty.const._AM_WGSLIDER_IMAGE_EDITOR_CROP_MOVE_UP}>">
                            <span class="fa fa-arrow-up"></span>
                        </button>
                        <button type="button" class="btn imageeditor-btn-crop <{$btn_style|default:''}>" data-method="move" data-option="0" data-second-option="10" title="<{$smarty.const._AM_WGSLIDER_IMAGE_EDITOR_CROP_MOVE_DOWN}>">
                            <span class="fa fa-arrow-down"></span>
                        </button>
                    </div>
                    <div class="ie-group">
                        <button type="button" class="btn imageeditor-btn-crop <{$btn_style|default:''}>" data-method="rotate" data-option="-45" title="<{$smarty.const._AM_WGSLIDER_IMAGE_EDITOR_CROP_ROTATE_LEFT}>">
                            <span class="fa fa-rotate-left"></span>
                        </button>
                        <button type="button" class="btn imageeditor-btn-crop <{$btn_style|default:''}>" data-method="rotate" data-option="45" title="<{$smarty.const._AM_WGSLIDER_IMAGE_EDITOR_CROP_ROTATE_RIGHT}>">
                            <span class="fa fa-rotate-right"></span>
                        </button>
                        <button type="button" class="btn imageeditor-btn-crop <{$btn_style|default:''}>" data-method="scaleX" data-option="-1" title="<{$smarty.const._AM_WGSLIDER_IMAGE_EDITOR_CROP_FLIP_HORIZONTAL}>">
                            <span class="fa fa-arrows-h"></span>
                        </button>
                        <button type="button" class="btn imageeditor-btn-crop <{$btn_style|default:''}>" data-method="scaleY" data-option="-1" title="<{$smarty.const._AM_WGSLIDER_IMAGE_EDITOR_CROP_FLIP_VERTICAL}>">
                            <span class="fa fa-arrows-v"></span>
                        </button>
                    </div>

                    <div class="ie-group">
                        <button type="button" class="btn imageeditor-btn-crop <{$btn_style|default:''}>" data-method="reset" title="<{$smarty.const._RESET}>">
                            <span class="fa fa-refresh"></span>
                        </button>
                    </div>

                    <div class="ie-group-horizontal ie-group-crop col-xs-12 col-sm-12">
                        <button type="button" class="btn imageeditor-btn-crop <{$btn_style|default:''}>" data-method="getCroppedCanvas" data-option="{ &quot;maxWidth&quot;: 4096, &quot;maxHeight&quot;: 4096, &quot;save&quot;: 0 }">
                            <{$smarty.const._PREVIEW}>
                        </button>
                        <button id="btnCropCreate" type="button" class="btn imageeditor-btn-crop <{$btn_style|default:''}>" data-method="getCroppedCanvas" data-option="{ &quot;maxWidth&quot;: 4096, &quot;maxHeight&quot;: 4096, &quot;save&quot;: 1 }">
                            <{$smarty.const._AM_WGSLIDER_IMAGE_EDITOR_CREATE}>
                        </button>
                        <a class="btn imageeditor-btn-crop <{$btn_style|default:''}> disabled" id="btnCropApply" href="<{$wgslider_image_editor}>/image_editor.php?op=saveCrop&id=<{$imageId|default:0}>&target=<{$croptarget|default:''}>&start=<{$start|default:0}>&limit=<{$limit|default:0}>"> <{$smarty.const._AM_WGSLIDER_IMAGE_EDITOR_APPLY}></a>
                        <button type="button" class="btn imageeditor-btn-crop <{$btn_style|default:''}>"onclick='history.go(-1);return true;'><{$smarty.const._CANCEL}></button>
                    </div>

                    <!-- Show the cropped image in modal -->
                    <div class="modal fade docs-cropped" id="getCroppedCanvasModal" role="dialog" aria-hidden="true" aria-labelledby="getCroppedCanvasTitle" tabindex="-1">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="getCroppedCanvasTitle"><{$smarty.const._PREVIEW}></h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="<{$smarty.const._CLOSE}>">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body"></div>
                                <div class="modal-footer">
                                    <a class="btn <{$btn_style|default:''}> hidden" id="download" href="javascript:void(0);" download="cropped.jpg">Download</a>
                                </div>
                            </div>
                        </div>
                    </div><!-- /.modal -->
                </div><!-- /.docs-buttons -->
            </div>
        </div>
    </div>
</div>

<script type='application/javascript'>

    $('#btnCropCreate').click(function () {
        $('#btnCropApply').removeClass('disabled');
    });

</script>

<script type='application/javascript'>

    // close modal
    var modal = document.getElementById('getCroppedCanvasModal');
    var closeBtn = modal.querySelector('.close');

    if (closeBtn) {
        closeBtn.onclick = function () {
            modal.style.display = 'none';
        };
    }

    // click outside modal
    window.onclick = function(event) {
        if (event.target === modal) {
            modal.style.display = 'none';
        }
    };

    // ESC
    document.addEventListener('keydown', function(event) {
        if (event.key === 'Escape') {
            modal.style.display = 'none';
        }
    });

</script>

<script>
    document.addEventListener("click", function (e) {
        const button = e.target.closest("[data-method]");
        if (!button) return;

        const method = button.dataset.method;
        let option = button.dataset.option;

        if (option !== undefined) {
            option = JSON.parse(option);
        }

        cropper[method](option);
    });
</script>

<style>
    .docs-toggles, .docs-buttons {display:flex;}
    .ie-toolbar{position:sticky;top:10px;z-index:100;display:flex;flex-wrap:wrap;gap:8px;padding:12px;background:transparent;border-radius:6px;margin-top:15px;}
    .ie-group{display:flex;gap:4px;padding-right:10px;border-right:1px solid #444;}
    .ie-group:last-child{border-right:none;}
    .imageeditor-btn-crop{position:relative;background:#3a3a3a;color:#fff;border:none;padding:6px 10px;border-radius:4px;cursor:pointer;transition:all .15s;}
    .imageeditor-btn-crop:hover{background:#505050;}
    .imageeditor-btn-crop.active{background:#2d7ef7;}
    .ie-primary{background:#2d7ef7 !important;}
    .crop-size-indicator{margin-top:10px;font-size:14px;font-weight:bold;color:#444;}
    .imageeditor-btn-crop:hover::after{content:attr(title);position:absolute;bottom:120%;left:50%;transform:translateX(-50%);background:#333;color:#fff;padding:5px 10px;border-radius:4px;font-size:12px;white-space:nowrap;z-index:1000;}
    .imageeditor-btn-crop:hover::before{content:"";position:absolute;bottom:110%;left:50%;transform:translateX(-50%);border-width:5px;border-style:solid;border-color:#333 transparent transparent transparent;}


</style>




<{include file='db:wgslider_admin_footer.tpl'}>