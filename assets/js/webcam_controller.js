Webcam.set({
    width: 466,
    height: 400,
    image_format: 'jpeg',
    jpeg_quality: 90
});

function take_snapshot() {
    // take snapshot and get image data
    Webcam.snap( function(data_uri) {
        // display results in page
        console.log(data_uri);
        document.getElementById('userimage').src = data_uri;
        toastr.success("Success");
            
        Webcam.upload( data_uri, 'saveimgfromwebcam.php', function(code, text) {
            //document.getElementById("imagetoupload").value = text;
            console.log(text);
        } );    
    } );
}