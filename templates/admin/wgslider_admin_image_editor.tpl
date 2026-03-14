<{include file='db:wgslider_admin_header.tpl'}>

<div id='imghandler' class='col-xs-12 col-sm-12'>
    <div class='tab-content'>
        <div class='tab-pane center' id='4'>

            <input type='hidden' id='imageIdCrop' name='imageIdCrop' value='<{$imageId|default:0}>'>

            <!-- IMAGE -->
            <div class="container-crop">
                <div class="row">
                    <div class="img-container">
                        <img id='cropImg'
                             class="img-fluid"
                             src="<{$imgCurrent.src|default:''}><{$currentTime|default:''}>"
                             alt="<{$imgCurrent.img_name|default:''}>">
                    </div>
                </div>
            </div>

            <!-- LIVE SIZE -->
            <div class="crop-size-indicator">
                <span id="cropWidth">0</span> × <span id="cropHeight">0</span> px
            </div>

            <!-- TOOLBAR -->
            <div class="ie-toolbar">
                <!-- Aspect Ratio -->
                <div class="ie-group">
                    <button class="ie-btn-crop ie-btn-crop-tooltip" data-method="setAspectRatio" data-option="1.3333" title="<{$smarty.const._AM_WGSLIDER_IMAGE_EDITOR_CROP_ASPECTRATIO}> 4:3">4:3</button>
                    <button class="ie-btn-crop ie-btn-crop-tooltip" data-method="setAspectRatio" data-option="0.6666" title="<{$smarty.const._AM_WGSLIDER_IMAGE_EDITOR_CROP_ASPECTRATIO}> 2:3">2:3</button>
                    <button class="ie-btn-crop ie-btn-crop-tooltip" data-method="setAspectRatio" data-option="1.5" title="<{$smarty.const._AM_WGSLIDER_IMAGE_EDITOR_CROP_ASPECTRATIO}> 3:2">3:2</button>
                    <button class="ie-btn-crop ie-btn-crop-tooltip" data-method="setAspectRatio" data-option="3" title="<{$smarty.const._AM_WGSLIDER_IMAGE_EDITOR_CROP_ASPECTRATIO}> 3:1">3:1</button>
                    <button class="ie-btn-crop ie-btn-crop-tooltip" data-method="setAspectRatio" data-option="2" title="<{$smarty.const._AM_WGSLIDER_IMAGE_EDITOR_CROP_ASPECTRATIO}> 2:1">2:1</button>
                    <button class="ie-btn-crop ie-btn-crop-tooltip" data-method="setAspectRatio" data-option="1" title="<{$smarty.const._AM_WGSLIDER_IMAGE_EDITOR_CROP_ASPECTRATIO}> 1:1">1:1</button>
                    <button class="ie-btn-crop ie-btn-crop-tooltip" data-method="setAspectRatio" data-option="1.7777" title="<{$smarty.const._AM_WGSLIDER_IMAGE_EDITOR_CROP_ASPECTRATIO}> 16:9">16:9</button>
                    <button class="ie-btn-crop ie-btn-crop-tooltip" data-method="setAspectRatio" data-option="NaN" title="<{$smarty.const._AM_WGSLIDER_IMAGE_EDITOR_CROP_ASPECTRATIO}> <{$smarty.const._AM_WGSLIDER_IMAGE_EDITOR_CROP_ASPECTRATIO_FREE}>">Free</button>
                </div>

                <!-- Zoom -->
                <div class="ie-group">
                    <button class="ie-btn-crop ie-btn-crop-tooltip" data-method="zoom" data-option="0.1" title="<{$smarty.const._AM_WGSLIDER_IMAGE_EDITOR_CROP_ZOOMIN}>"><span class="fa fa-search-plus"></span></button>
                    <button class="ie-btn-crop ie-btn-crop-tooltip" data-method="zoom" data-option="-0.1" title="<{$smarty.const._AM_WGSLIDER_IMAGE_EDITOR_CROP_ZOOMOUT}>"><span class="fa fa-search-minus"></span></button>
                </div>

                <!-- Move -->
                <div class="ie-group">
                    <button class="ie-btn-crop ie-btn-crop-tooltip" data-method="move" data-option="-10" data-second-option="0" title="<{$smarty.const._AM_WGSLIDER_IMAGE_EDITOR_CROP_MOVE_LEFT}>"><span class="fa fa-arrow-left"></span></button>
                    <button class="ie-btn-crop ie-btn-crop-tooltip" data-method="move" data-option="10" data-second-option="0" title="<{$smarty.const._AM_WGSLIDER_IMAGE_EDITOR_CROP_MOVE_RIGHT}>"><span class="fa fa-arrow-right"></span></button>
                    <button class="ie-btn-crop ie-btn-crop-tooltip" data-method="move" data-option="0" data-second-option="-10" title="<{$smarty.const._AM_WGSLIDER_IMAGE_EDITOR_CROP_MOVE_UP}>"><span class="fa fa-arrow-up"></span></button>
                    <button class="ie-btn-crop ie-btn-crop-tooltip" data-method="move" data-option="0" data-second-option="10" title="<{$smarty.const._AM_WGSLIDER_IMAGE_EDITOR_CROP_MOVE_DOWN}>"><span class="fa fa-arrow-down"></span></button>
                </div>

                <!-- Rotate / Flip -->
                <div class="ie-group">
                    <button class="ie-btn-crop ie-btn-crop-tooltip" data-method="rotate" data-option="-45" title="<{$smarty.const._AM_WGSLIDER_IMAGE_EDITOR_CROP_ROTATE_LEFT}>"><span class="fa fa-rotate-left"></span></button>
                    <button class="ie-btn-crop ie-btn-crop-tooltip" data-method="rotate" data-option="45" title="<{$smarty.const._AM_WGSLIDER_IMAGE_EDITOR_CROP_ROTATE_RIGHT}>"><span class="fa fa-rotate-right"></span></button>
                    <button class="ie-btn-crop ie-btn-crop-tooltip" data-method="scaleX" data-option="-1" title="<{$smarty.const._AM_WGSLIDER_IMAGE_EDITOR_CROP_FLIP_HORIZONTAL}>"><span class="fa fa-arrows-h"></span></button>
                    <button class="ie-btn-crop ie-btn-crop-tooltip" data-method="scaleY" data-option="-1" title="<{$smarty.const._AM_WGSLIDER_IMAGE_EDITOR_CROP_FLIP_VERTICAL}>"><span class="fa fa-arrows-v"></span></button>
                </div>

                <!-- Reset -->
                <div class="ie-group">
                    <button class="ie-btn-crop ie-btn-crop-tooltip" data-method="reset" title="<{$smarty.const._RESET}>"><span class="fa fa-refresh"></span></button>
                </div>

                <!-- Actions -->
                <div class="ie-group ie-actions">
                    <button id="btnCropPreview" class="ie-btn-crop" data-method="getCroppedCanvas" data-option='{"maxWidth":4096,"maxHeight":4096,"save":0}'> <{$smarty.const._PREVIEW}> </button>
                    <button id="btnCropCreate" class="ie-btn-crop" data-method="getCroppedCanvas" data-option='{"maxWidth":4096,"maxHeight":4096,"save":1}'> <{$smarty.const._AM_WGSLIDER_IMAGE_EDITOR_CREATE}> </button>
                    <a id="btnCropApply" class="ie-btn-crop disabled" href="<{$wgslider_image_editor}>/image_editor.php?op=saveCrop&id=<{$imageId|default:0}>&target=<{$croptarget|default:''}>&start=<{$start|default:0}>&limit=<{$limit|default:0}>"> <{$smarty.const._AM_WGSLIDER_IMAGE_EDITOR_APPLY}> </a>
                    <button class="ie-btn-crop" onclick='history.go(-1);return true;'> <{$smarty.const._CANCEL}> </button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Show the cropped image in modal -->
<div class="modal fade docs-cropped modern-crop-modal"
     id="getCroppedCanvasModal"
     tabindex="-1"
     role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
        <div class="modal-content crop-modal-content">
            <div class="modal-body crop-preview-body">
                <button type="button" class="crop-close" data-dismiss="modal">&times;</button>
                <div class="crop-image-wrapper"></div>
                <div class="crop-actions">
                    <a class="btn btn-primary hidden" id="download" href="javascript:void(0);" download="cropped.jpg">Download</a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- SCRIPT -->
<script>
    let cropper;

    const image = document.getElementById("cropImg");

    image.addEventListener("load", function() {

        cropper = new Cropper(image, {
            viewMode:1,
            autoCropArea:1,
            responsive:true,
            crop(event){
                document.getElementById("cropWidth").innerText = Math.round(event.detail.width);
                document.getElementById("cropHeight").innerText = Math.round(event.detail.height);
            }
        });

        // Buttons handler
        document.querySelectorAll("[data-method]").forEach(btn=>{
            btn.addEventListener("click", function(e){

                e.preventDefault();

                let method = this.dataset.method;
                let option = this.dataset.option;
                let second = this.dataset.secondOption;

                if(option !== undefined){

                    if(option === "NaN"){
                        option = NaN;
                    }
                    else if(option.startsWith("{")){
                        option = JSON.parse(option);
                    }
                    else{
                        option = Number(option);
                    }

                }

                if(second !== undefined) second = Number(second);

                /* ---- Spezialfall Canvas ---- */

                if(method === "getCroppedCanvas"){

                    const result = cropper.getCroppedCanvas(option);

                    if(result){

                        if(option.save === 1){

                            const imgBase = result.toDataURL('image/jpeg');
                            const formData = new FormData();

                            formData.append('op', 'cropimage');
                            formData.append('imageIdCrop', $("#imageIdCrop").val());
                            formData.append('croppedImage', imgBase);
                            formData.append('form_key', window.FORM_KEY);

                            $.ajax('image_editor.php', {
                                method: "POST",
                                data: formData,
                                processData: false,
                                contentType: false,
                                success: function (data) {
                                    console.log('create crop finished');
                                    console.log(data);
                                },
                                error: function (data) {
                                    console.log('create crop failed');
                                    console.log(data);
                                    alert('<{$smarty.const._AM_WGSLIDER_IMAGE_EDITOR_CROP_ERROR}>');
                                }
                            });

                        } else {

                            const modal = document.getElementById('getCroppedCanvasModal');
                            const modalBody = modal.querySelector('.crop-image-wrapper');
                            modalBody.innerHTML = '';
                            modalBody.appendChild(result);

                            document.getElementById("getCroppedCanvasModal").style.display = "block"

                        }

                        if(option.save === 1){
                            document.getElementById("btnCropApply").classList.remove("disabled");
                        }
                    }

                    return;
                }

                /* ---- Standard Cropper Methoden ---- */

                if(second !== undefined){
                    cropper[method](option, second);
                }else{
                    cropper[method](option);
                }

                /* ---- Aspect Ratio Button aktiv ---- */

                if(method==="setAspectRatio"){
                    document.querySelectorAll('[data-method="setAspectRatio"]').forEach(b=>b.classList.remove("active"));
                    this.classList.add("active");
                }

            });
        });
        // Keyboard shortcuts
        document.addEventListener("keydown", function(e){
            const map = {
                "+": ()=>cropper.zoom(0.1),
                "-": ()=>cropper.zoom(-0.1),
                "r": ()=>cropper.rotate(45),
                "R": ()=>cropper.rotate(-45),
                "ArrowLeft": ()=>cropper.move(-10,0),
                "ArrowRight": ()=>cropper.move(10,0),
                "ArrowUp": ()=>cropper.move(0,-10),
                "ArrowDown": ()=>cropper.move(0,10),
                "0": ()=>cropper.reset()
            };
            if(map[e.key]) map[e.key]();
        });

    });

    // Modal schließen
    var modal = document.getElementById('getCroppedCanvasModal');
    var closeBtn = modal.querySelector('.crop-close');

    if (modal) {
        modal.onclick = function () {
            modal.style.display = 'none';
        };
    }

    if (closeBtn) {
        closeBtn.onclick = function () {
            modal.style.display = 'none';
        };
    }

    // Klick außerhalb des Modals schließen
    window.onclick = function(event) {
        if (event.target === modal) {
            modal.style.display = 'none';
        }
    };

    // ESC Taste schließen
    document.addEventListener('keydown', function(event) {
        if (event.key === 'Escape') {
            modal.style.display = 'none';
        }
    });
</script>

<{include file='db:wgslider_admin_footer.tpl'}>