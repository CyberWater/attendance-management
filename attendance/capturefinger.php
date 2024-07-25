<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Attendance System</title>
    <link rel="stylesheet" type="text/css" href="public/bootstrap/css/bootstrap.min.css">
    <!--<script src="face/jquery-3.6.0.min.js"></script>-->
    <link rel="stylesheet" href="fingerprint/app.css" type="text/css" />
    <!--<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script defer src="face/tf.min.js"></script>
    <script defer src="face/face-api.min.js"></script>
    <script src="app.js"></script>-->
    
</head>
<body>
    <div class="row gap-4">
        <div class="col-12 col-lg-2"></div>
        <div class="col-12 col-lg-8">
            <div class="card">
                <div class="card-header bg-primary text-white text-center">
                    <h3>ATTENDANCE SYSTEM USING FACE RECOGNITION AND FINGERPRINT</h3>
                </div>
                <div class="card-body" style="min-height: 400px;">
                    <h3>Register student</h3><hr>
                    <a href="index">Home</a>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="card">
                                <div class="card-body">
                                    <h5>Student details</h5><hr>
                                    <?php 
                                        if (isset($_GET['matno']) && !empty($_GET['matno'])) {
                                            extract($_GET);
                                            echo '<input id="studmat" value="'.$matno.'" type="text" class="form-control" readonly>';
                                        }
                                        else{
                                            echo '<input id="studmat" type="text" class="form-control" readonly>';
                                        }
                                    ?>
                                </div>
                            </div>

                            <!--<div class="card">
                                <div class="card-body">
                                    <h5>Face recognition</h5><hr>
                                    <div>
                                        <video id="webcam" width="360" height="370" autoplay></video>
                                        <canvas id="canvas" style="display:none;"></canvas>
                                        <button id="capture">Capture</button>
                                    </div>

                                </div>
                            </div>-->

                        </div>
                        <div class="col-lg-6">
                            <div class="card">
                                <div class="card-body">
                                    <h5>Capture Finger</h5><hr>
                                    <div>
                                        
                                    <b>Fingerprint</b>
                                          <span id="Reader" class="active">
                                            <a href="#" style="color: white;" onclick="toggle_visibility(['content-reader','content-capture']);setActive('Reader','Capture')">
                                                Reader</a>
                                          </span>
                                          <span id="Capture" class="">
                                            <a href="#" style="color: white;" onclick="toggle_visibility(['content-capture','content-reader']);setActive('Capture','Reader')">
                                                Capture</a>
                                          </span>
                                   <span id="Scores" style="visibility: hidden;">
                                       <h5>Scan Quality : <input type="text" id="qualityInputBox" size="20" style="background-color:#DCDCDC;text-align:center;"></h5> 

                                   </span>
                                    <div id="content-capture" style="display : none;">    
                                        <div id="status"></div>            
                                        <div id="imagediv"></div>
                                        <div id="contentButtons">
                                            <table width=70% align="center">
                                                <tr>
                                                    <td>
                                                        <input type="button" class="btn btn-warning" id="clearButton" value="Clear" onclick="Javascript:onClear()">
                                                    </td>
                                                    <!--
                                                    <td data-toggle="tooltip" title="Will work with the .png format.">
                                                        <input type="button" class="btn btn-primary" id="save" value="Save">
                                                    </td>-->
                                                    <td>
                                                        <input type="button" class="btn btn-primary" id="start" value="Start" onclick="Javascript:onStart()">
                                                    </td>
                                                    <!--
                                                    <td>
                                                       <input type="button" class="btn btn-primary" id="stop" value="Stop" onclick="Javascript:onStop()">
                                                    </td>
                                                    <td>
                                                        <input type="button" class="btn btn-primary" id="info" value="Info" onclick="Javascript:onGetInfo()">
                                                    </td>-->
                                            </table>
                                        </div>
                                   
                                        <div id="imageGallery">
                                        </div>
                                        <div id="deviceInfo">           
                                        </div>

                                        <div id="" style="visibility: hidden;">
                                         
                                          <form name="myForm" style ="border : solid grey;padding:5px;">
                                            <input type="checkbox" name="PngImage" checked="true" value="4" onclick="checkOnly(this)"> PNG
                                          </form>
                                          <br>
                                         <input type="button" class="btn btn-primary"  value="Export" >
                                        </div>

                                    </div>

                                    <div id="content-reader">  
                                        <h4>Select Reader :</h4>
                                        <select class="form-control" id="readersDropDown" onchange="selectChangeEvent()">
                                        </select>
                                        
                                    </div>
                                    </div>
                                    
                                </div>
                            </div>
                            
                        </div>
                    </div>
                    <p></p>
                    <div class="row">
                        <div class="col-lg-12 d-flex justify-content-center">
                            <button type="button" id="saveImagePng" class="btn btn-primary" onclick="Javascript:onImageDownload()">Save details</button>
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
    <script src="scripts/es6-shim.js"></script>
    <script src="scripts/websdk.client.bundle.min.js"></script>
    <script src="scripts/fingerprint.sdk.min.js"></script>
    <script src="fingerprint/app.js"></script>
    

    
</body>
</html>
