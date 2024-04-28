document.getElementById('imagetoupload').onchange = function (evt) {
    var tgt = evt.target || window.event.srcElement,
    files = tgt.files;

    if(this.files[0].size > 2097152) {
        alert("File size is too big!");
        this.value = "";
    }else{
            // FileReader support
        if (FileReader && files && files.length) {
            var fr = new FileReader();
            fr.onload = function () {
            document.getElementById('userimage').src = fr.result;
            }
            fr.readAsDataURL(files[0]);
        }
        // Not supported
        else {
        // fallback -- perhaps submit the input to an iframe and temporarily store
        // them on the server until the user's session ends.
        }
    }
}  