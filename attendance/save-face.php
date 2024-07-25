<?php
    include("config.php");
// Ensure that the request is a POST request
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Get the posted data
    //$descriptor = $_POST['descriptor'];
    $image = $_POST['image'];
    $fname = mysqli_real_escape_string($conn, $_POST['sfname']);
    $lname = mysqli_real_escape_string($conn, $_POST['slname']);
    $matricno = mysqli_real_escape_string($conn, $_POST['smatric']); 

    function logError($errorMessage) {
    // Log the error message to the file
    error_log($errorMessage);
}

    // Decode descriptor from JSON
    //$parsedDescriptor = json_decode($descriptor);

    // Save the image to the server
    $data = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $image));
    $imageName = './public/faces/' . $matricno . '.png';

    file_put_contents($imageName, $data);

    $savestudent = mysqli_query($conn, "INSERT INTO `att_student`(`student_fname`, `student_lname`, `student_matric`, `student_face`) VALUES('$fname', '$lname', '$matricno', '$imageName')")or die(mysqli_error($conn));

    if ($savestudent) {
        // Return success message
        header("Content-Type: application/json");
        echo json_encode(['message' => 'Student saved successfully']);
    }
    else{
        header("Content-Type: application/json");
        echo json_encode(['message' => 'Error saving student']);
        logError("Error in verification: " . mysqli_error($conn));
    }

} else {
    // Handle invalid requests
    logError("Error in verification: " . mysqli_error($conn));
    header("Content-Type: application/json");
    http_response_code(405);
    echo json_encode(['error' => 'Method Not Allowed']);
}
?>
