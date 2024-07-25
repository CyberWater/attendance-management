<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Attendance System</title>
    <link rel="stylesheet" type="text/css" href="public/bootstrap/css/bootstrap.min.css">
    <!--<script src="face/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="fingerprint/app.css" type="text/css" />-->
    <!--<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script defer src="face/tf.min.js"></script>
    <script defer src="face/face-api.min.js"></script>
    <script src="app.js"></script>-->
    
</head>
<body>
<?php include("config.php"); ?>
    <div class="row gap-4">
        <div class="col-12 col-lg-2"></div>
        <div class="col-12 col-lg-8">
            <div class="card">
                <div class="card-header bg-primary text-white text-center">
                    <h3>ATTENDANCE SYSTEM USING FACE RECOGNITION AND FINGERPRINT</h3>
                </div>
                <div class="card-body" style="min-height: 400px;">
                    <h3>All Attendance</h3><hr>
                    <a href="index">Home</a>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="card">
                                <div class="card-body">
                                    <table class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Matric No</th>
                                                <th>Status</th>
                                                <th>Date</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                $getquery = mysqli_query($conn, "SELECT * FROM att_attendance");
                                                if(mysqli_num_rows($getquery) > 0){
                                                    while($fattend = mysqli_fetch_array($getquery)){
                                                        extract($fattend);

                                                        echo'
                                                            <tr>
                                                                <td>'.$att_matric.'</td>
                                                                <td>'.$att_status.'</td>
                                                                <td>'.$att_time.'</td>
                                                            </tr>
                                                        ';
                                                    }
                                                } 
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-2"></div>
    </div>



    <script type="text/javascript">
        /*
        function close_window(){
            if (confirm("Close Window?")){
                close();
            }
        }*/
    </script>
    <script src="face/jquery-3.6.0.min.js"></script>
    <script src="public/bootstrap/js/bootstrap.min.js"></script>
    <!--
    <script defer src="face/face-api.min.js"></script>
    <script src="attendadance-capture.js"></script>-->
    <!--
    <script src="scripts/es6-shim.js"></script>
    <script src="scripts/websdk.client.bundle.min.js"></script>
    <script src="scripts/fingerprint.sdk.min.js"></script>
    <script src="fingerprint/app.js"></script>-->
    

    
</body>
</html>
