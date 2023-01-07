<div class="media-cart placeholder">

    <div class="btn-upload">
        <form method="POST" class="upload__form" id="upload_form" enctype="multipart/form-data">

            <input class="upload_video" style="display:none;" id="video" onchange="uploadFileHandler()" name="video_uploader" type="file" accept="video/mp4"/>

            <label class="upload_video upload__label" for="video"><img src="/img/Create.svg" class="create-ico"><span>Добавьте видео</span></label>

            <div class="progress" id="progressDiv" style="width:100%;">
                <div class="progressTitle" id="progressTitle">Ваше видео загружается</div>
                <div class="progressSubTitle" id="progressSubTitle"">пожалуйста дождитесь завершения</div>
                <progress class="progressBar" id="progressBar" value="0" max="100" style="width:100%; height: 1.2rem;">
                </progress>
            <div class="progress-values" id="progress-values">
                100
            </div>
            </div>

        </form>
    </div>

</div>
