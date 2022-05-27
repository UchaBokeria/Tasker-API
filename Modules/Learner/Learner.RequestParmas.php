<?php

$RAWJSONREQUESTPARAMETERS = json_decode(file_get_contents('php://input'), TRUE);

if($_SERVER["REQUEST_METHOD"] == 'POST')
    $_POST = array_merge($_POST, $RAWJSONREQUESTPARAMETERS);

if($_SERVER["REQUEST_METHOD"] == 'PUT')
    $_POST = array_merge($_POST, $RAWJSONREQUESTPARAMETERS);

if($_SERVER["REQUEST_METHOD"] == 'DELETE')
    $_POST = array_merge($_POST, $RAWJSONREQUESTPARAMETERS);

if($_SERVER["REQUEST_METHOD"] == 'GET')
    $_GET = array_merge($_GET, $RAWJSONREQUESTPARAMETERS);