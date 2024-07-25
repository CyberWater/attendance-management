$(document).ready(function(){
    /*const video = document.getElementById('webcam');
    const canvas = document.getElementById('canvas');
    const captureBtn = document.getElementById('captureBtn');*/

    // Wait for face-api.js models to load
    Promise.all([
        faceapi.nets.tinyFaceDetector.loadFromUri('/attendance/models'),
        faceapi.nets.faceLandmark68Net.loadFromUri('/attendance/models'),
        faceapi.nets.faceRecognitionNet.loadFromUri('/attendance/models')
    ]).then(startVideo);

    const video = document.getElementById('video');
    const captureButton = document.getElementById('captureButton');
    const canvas = document.getElementById('overlay');
    const savedImage = document.getElementById('savedImage');

    function startVideo() {
    navigator.mediaDevices.getUserMedia({ video: {} })
        .then(stream => {
            video.srcObject = stream;
        })
        .catch(err => console.error(err));
}

captureButton.addEventListener('click', async () => {
    const displaySize = { width: video.width, height: video.height };
    faceapi.matchDimensions(canvas, displaySize);

    const detections = await faceapi.detectAllFaces(video, new faceapi.TinyFaceDetectorOptions())

                                   .withFaceLandmarks()
                                   .withFaceDescriptors();

    const resizedDetections = faceapi.resizeResults(detections, displaySize);

    const savedImageDetection = await faceapi.detectSingleFace(savedImage, new faceapi.TinyFaceDetectorOptions())
                                             .withFaceLandmarks()
                                             .withFaceDescriptor();
    /*
    if (!savedImageDetection) {
        console.error('No face detected in the saved image');
        return;
    }*/
    let smatric = $("#smatric").val();
    $.ajax({
        type: 'POST',
        url: 'mark-attend.php', // Replace with your server-side script to save the image
        data: {smatric: smatric },
        success: function(response) {
            console.log('Attendance successfully:', response);
            alert(response.message);
            window.location.href = "index";
        },
        error: function(xhr, status, error) {
            console.error('Error saving image:', error);
        }
    });
/*
    const savedImageDescriptor = savedImageDetection.descriptor;

    const faceMatcher = new faceapi.FaceMatcher(savedImageDescriptor);

    const results = resizedDetections.map(d => faceMatcher.findBestMatch(d.descriptor));

    results.forEach((result, i) => {
        const box = resizedDetections[i].detection.box;
        const text = result.toString();

        const drawBox = new faceapi.draw.DrawBox(box, { label: text });
        drawBox.draw(canvas);
    });*/
});

});




/*$(document).ready(function(){
    const video = document.getElementById('webcam');
    const canvas = document.getElementById('canvas');
    const captureBtn = document.getElementById('captureBtn');
    
    
    // Access webcam
    navigator.mediaDevices.getUserMedia({ video: true })
        .then(function(stream) {
            video.srcObject = stream;
            video.play();
        })
        .catch(function(err) {
            console.error('Error accessing webcam: ', err);
        });

    // Capture and save image
    captureBtn.addEventListener('click', function() {
        canvas.getContext('2d').drawImage(video, 0, 0, canvas.width, canvas.height);
        const imgData = canvas.toDataURL('image/png');

        let smatric = $("#smatric").val();

        

        console.log(smatric);
        
        // Send image data to server to save it
        $.ajax({
            type: 'POST',
            url: 'save-face.php', // Replace with your server-side script to save the image
            data: { image: imgData, sfname: sfname, slname: slname, smatric: smatric },
            success: function(response) {
                console.log('Image saved successfully:', response);
                alert(response);
                window.location.href = "capturefinger?matno="+smatric;
            },
            error: function(xhr, status, error) {
                console.error('Error saving image:', error);
            }
        });

        //return true;
    });
});
*/
