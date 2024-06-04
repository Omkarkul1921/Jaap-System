<?php
session_start();

require 'dbcon.php';


// Input fields validations
function validate($inputData)
{
    global $conn;

    $validateData = mysqli_real_escape_string($conn, $inputData);

    return trim($validateData);
}


// Redirect from one page to another with a message

function redirect($url, $status)
{

    $_SESSION['status'] = $status;
    header('location:' . $url);
    exit(0);
}

// display message

function alertMessage()
{
    if (isset($_SESSION['status'])) {
        echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                <strong>' . $_SESSION['status'] . '</strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>';
        unset($_SESSION['status']);
    }
}


// crud
// insert
function insert($tableName, $data)
{
    global $conn;

    $table = validate($tableName);

    $columns = array_keys($data);
    $values = array_values($data);

    $finalColumn = implode(',', $columns);
    $finalValues = "'" . implode("', '", $values) . "'";

    $query = "INSERT INTO $table ($finalColumn) VALUES ($finalValues)";
    $result = mysqli_query($conn, $query);

    return $result;
}


// update
function update($tableName, $id, $data)
{

    global $conn;

    $table = validate($tableName);
    $id = validate($id);

    $updateDataString = "";

    foreach ($data as $columns => $value) {

        $updateDataString .= $columns . '=' . "'$value',";
    }

    $finalUpdateDate = substr(trim($updateDataString), 0, -1);

    $query = "UPDATE $table SET $finalUpdateDate WHERE id='$id'";
    $result = mysqli_query($conn, $query);
    return $result;
}

// fetch all data 
function getAll($tableName, $status = NULL)
{

    global $conn;

    $table = validate($tableName);
    $status = validate($status);

    if ($status == 'status') {
        $query = "SELECT * FROM $table WHERE status='1'";
    } else {
        $query = "SELECT * FROM $table";
    }
    return mysqli_query($conn, $query);
}

function getAllMembers($tableName, $status = NULL, $Request = NULL)
{
    global $conn;

    $table = validate($tableName);

    $query = "SELECT * FROM $table WHERE Request='1'";



    return mysqli_query($conn, $query);
}


function getAllJaapDeatails($tableName){
    global $conn;

    $table = validate($tableName);

    $query = "SELECT jd.*, j.JaapName, j.StartOn, m.FullName
    FROM tbljaapdetails jd
    JOIN tbljaap j ON jd.JaapId = j.id
    JOIN tblmembers m ON jd.MemberId = m.id
    ORDER BY jd.id DESC;"; 

    return mysqli_query($conn, $query);
}


function getUserJaapDeatails($tableName) {
    global $conn;

    $table = validate($tableName);
    $id = $_SESSION['LoggedInMember']['id'];

    $query = "SELECT jd.*, j.JaapName, j.ClosedOn, j.StartOn 
              FROM tbljaapdetails jd 
              JOIN tbljaap j ON jd.JaapId = j.id 
              WHERE jd.MemberId = '$id' 
              ORDER BY jd.id DESC;"; 

    return mysqli_query($conn, $query);
}


// fetch single data 
function getById($tableName, $id = NULL)
{

    global $conn;

    $table = validate($tableName);
    $id = validate($id);

    $query = "SELECT * FROM $table WHERE id='$id' LIMIT 1";
    $result = mysqli_query($conn, $query);

    if ($result) {
        if (mysqli_num_rows($result) == 1) {

            $row = mysqli_fetch_assoc($result);

            $response = [
                'status' => 200,
                'data' => $row,
                'message' => 'Record Found'
            ];
            return $response;
        } else {
            $response = [
                'status' => 404,
                'message' => 'No Data Found'
            ];
            return $response;
        }
    } else {
        $response = [
            'status' => 500,
            'message' => 'Something Went Wrong'
        ];
        return $response;
    }
}

// delete data 
function delete($tableName, $id)
{

    global $conn;

    $table = validate($tableName);
    $id = validate($id);

    $query = "DELETE FROM  $table WHERE id='$id' LIMIT 1";
    $result = mysqli_query($conn, $query);
    return $result;
}


function checkParamId($type)
{
    if (isset($_GET[$type])) {
        if ($_GET[$type] != '') {
            return $_GET[$type];
        } else {
            return '<h5>No Id Found</h5>';
        }
    } else {
        return '<h5>No Id Given</h5>';
    }
}


function LogoutSession()
{
    unset($_SESSION['LoggedIn']);
    unset($_SESSION['LoggedInUser']);
}

function jsonResponse($status, $status_type, $message)
{
    $response = [
        'status' => $status,
        'status_type' => $status_type,
        'message' => $message
    ];
    echo json_encode($response);
    return;
}


function getCount($tableName)
{
    global $conn;

    $table = validate($tableName);

    $query = "SELECT COUNT(*) AS total FROM $table";
    $query_run = mysqli_query($conn, $query);

    if ($query_run) {
        $row = mysqli_fetch_assoc($query_run);
        $totalCount = $row['total'];
        return $totalCount;
    } else {
        return 0;
    }
}



