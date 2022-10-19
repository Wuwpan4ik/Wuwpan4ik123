<div class="media-cart placeholder">

    <div class="btn-upload">
        <form class="upload__form" id="upload_form" enctype="multipart/form-data" method="post">

            <input class="upload_video" accept=".mp4" style="display:none;" id="video" name="video_uploader" type="file"/>

            <label class="upload_video upload__label" for="video"><img src="img/Create.svg" class="create-ico"><span>Добавьте видео</span></label>

            <div class="progress" id="progressDiv">
                <progress id="progressBar" value="0" max="100" style="width:100%; height: 1.2rem;">
                </progress>
            </div>

            <button class="upload_video" type="button" onclick="uploadFileHandler()">Сохранить</button>

        </form>
    </div>

</div>
