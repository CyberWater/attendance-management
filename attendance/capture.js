$(document).ready(function(){
    const video = document.getElementById('webcam');
    const canvas = document.getElementById('canvas');
    const captureBtn = document.getElementById('captureBtn');
    

    Promise.all([
        faceapi.nets.tinyFaceDetector.loadFromUri('/attendance/models'),
        faceapi.nets.faceLandmark68Net.loadFromUri('/attendance/models'),
        faceapi.nets.faceRecognitionNet.loadFromUri('/attendance/models')
    ]);
    
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
    captureBtn.addEventListener('click', async () => {
        //canvas.getContext('2d').drawImage(video, 0, 0, canvas.width, canvas.height);
        const displaySize = { width: video.width, height: video.height };

        faceapi.matchDimensions(canvas, displaySize);

        const detections = await faceapi.detectAllFaces(video, new faceapi.TinyFaceDetectorOptions())
                                       .withFaceLandmarks()
                                       .withFaceDescriptors();

        if (detections.length === 0) {
            console.error('No faces detected');
            alert('No faces detected');
            return;
        }

        const resizedDetections = faceapi.resizeResults(detections, displaySize);
        const context = canvas.getContext('2d');
        context.drawImage(video, 0, 0, canvas.width, canvas.height);
        const imgData = canvas.toDataURL('image/png');

        let smatric = $("#smatric").val();
        let sfname = $("#sfname").val();
        let slname = $("#slname").val();
       

        console.log(smatric + " -" + sfname + "- " + slname);
        
        // Send image data to server to save it
        $.ajax({
            type: 'POST',
            url: 'save-face.php', // Replace with your server-side script to save the image
            data: { image: imgData, sfname: sfname, slname: slname, smatric: smatric },
            success: function(response) {
                console.log('Image saved successfully:', response);
                alert(response.message);
                window.location.href = "capturefinger?matno="+smatric;
            },
            error: function(xhr, status, error) {
                console.error('Error saving image:', error);
            }
        });

        //return true;
    });
});

/*
$(document).ready(function() {
    const video = document.getElementById('webcam');
    const canvas = document.getElementById('canvas');
    const context = canvas.getContext('2d');
    const captureButton = $('#capture');
    let stream;

    // Access the device camera and stream to video element
    async function startWebcam(){
        try{
            /*
            const devices = await navigator.mediaDevices.enumerateDevices();
            const videoDevices = devices.filter(device => device.kind === 'videoinput');
            if (videoDevices.lenght === 0) {
                throw new Error('No webcam found.');
            }
            const videoDeviceId = videoDevices[0].deviceId;
            stream = await navigator.mediaDevices.getUserMedia({
                video: {deviceId:{exact: videoDeviceId}}
            });
            video.srcObject = stream;
            stream = await navigator.mediaDevices.getUserMedia({ video: true });
            video.srcObject = stream;
        }catch (err){
            console.error("Error accessing webcam: ", err);
        }
    }
    

    function stopWebcam() {
        if (stream) {
            stream.getTracks().forEach(track => track.stop());
            stream = null;
        }
    }

    startWebcam();

    // Capture the image from the video stream
    captureButton.on('click', function() {
        canvas.width = video.videoWidth;
        canvas.height = video.videoHeight;
        context.drawImage(video, 0, 0, canvas.width, canvas.height);
        const dataURL = canvas.toDataURL('image/png');

        // Display the captured image (optional)
        $('<img>').attr('src', dataURL).appendTo('body');

        // Optionally save the image via AJAX
        saveImage(dataURL);
    });

    $(window).on('unload', function() {
        stopWebcam();
    });

    function saveImage(dataURL) {
        $.ajax({
            type: 'POST',
            url: 'save_image.php',
            data: {
                imgBase64: dataURL
            },
            success: function(response) {
                console.log('Image saved successfully:', response);
            },
            error: function(err) {
                console.error('Error saving image:', err);
            }
        });
    }
});
*/