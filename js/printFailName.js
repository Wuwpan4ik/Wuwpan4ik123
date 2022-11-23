function uploadFile(target) {

    document.getElementById("file-name").innerHTML = (target.files[0].name);
    document.getElementById("file-size").innerHTML = Math.round(target.files[0].size / 1024) + "кБ из доступных 5мб" ;
}
uploadFile()