$(document).ready(function () {
    const video = document.getElementById('video');
    const canvas = document.getElementById('canvas');
    const captureButton = document.getElementById('capture');
    const verifyButton = document.getElementById('verify');

    // Load models
    Promise.all([
        faceapi.nets.tinyFaceDetector.loadFromUri('/models'),
        faceapi.nets.faceLandmark68Net.loadFromUri('/models'),
        faceapi.nets.faceRecognitionNet.loadFromUri('/models')
    ])
    .then(startVideo)
    .catch(err => console.error("Model loading error:", err));

    function startVideo() {
        navigator.mediaDevices.getUserMedia({ video: {} })
            .then(stream => {
                video.srcObject = stream;
            })
            .catch(err => {
                console.error("Error accessing the webcam:", err);
                alert("Could not access the webcam. Please ensure it is not being used by another application and that you have granted the necessary permissions.");
            });
    }

    captureButton.addEventListener('click', async () => {
        const detections = await faceapi.detectAllFaces(video, new faceapi.TinyFaceDetectorOptions()).withFaceLandmarks().withFaceDescriptors();
        const displaySize = { width: video.width, height: video.height };
        faceapi.matchDimensions(canvas, displaySize);
        const resizedDetections = faceapi.resizeResults(detections, displaySize);

        if (resizedDetections.length > 0) {
            const descriptor = resizedDetections[0].descriptor;
            canvas.getContext('2d').drawImage(video, 0, 0, canvas.width, canvas.height);
            const dataUrl = canvas.toDataURL('image/jpeg');

            // Send descriptor and image to server
            $.post('/save-face.php', { descriptor: JSON.stringify(descriptor), image: dataUrl, name: 'studentName' }, function (response) {
                alert(response.message);
            });
        } else {
            alert('No face detected. Please try again.');
        }
    });

    verifyButton.addEventListener('click', async () => {
        const detections = await faceapi.detectAllFaces(video, new faceapi.TinyFaceDetectorOptions()).withFaceLandmarks().withFaceDescriptors();
        const displaySize = { width: video.width, height: video.height };
        faceapi.matchDimensions(canvas, displaySize);
        const resizedDetections = faceapi.resizeResults(detections, displaySize);

        if (resizedDetections.length > 0) {
            const descriptor = resizedDetections[0].descriptor;
            $.post('/verify-face.php', { descriptor: JSON.stringify(descriptor) }, function (response) {
                alert(response.message);
            });
        } else {
            alert('No face detected. Please try again.');
        }
    });
});
