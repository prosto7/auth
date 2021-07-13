<?php
// connect to DB with mysqli connect, because we will use method mysqli_real_escape_string, and i don't know how i can use PDO with this method

class Model_Table extends Model {


public function get_data(){

 ## Read value
$draw = $_POST['draw'];
$row = $_POST['start'];
$rowperpage =$data =  $_POST['length']; // Rows display per page
$columnIndex = $_POST['order'][0]['column']; // Column index
$columnName = $_POST['columns'][$columnIndex]['data']; // Column name
$columnSortOrder = $_POST['order'][0]['dir']; // asc or desc
$searchValue = $_POST['search']['value']; // Search value

$searchArray = array();

## Search 
$searchQuery = " ";
if($searchValue != ''){
	$searchQuery = " AND (namefirst LIKE :namefirst OR  
    email LIKE :email OR 
    namelast LIKE :namelast OR 
    login LIKE :login ) ";
    $searchArray = array( 
        'namefirst'=>"%$searchValue%", 
        'email'=>"%$searchValue%", 
        'namelast'=>"%$searchValue%", 
        'login'=>"%$searchValue%", 
    );
}

$server = "localhost";
$username = "root";
$password = "tron";
$dbname = "sibers";

// Create connection
try{
  $conn = new PDO("mysql:host=$server;dbname=$dbname","$username","$password");
  $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
}catch(PDOException $e){
  die('Unable to connect with the database');
}



## Total number of records without filtering
$stmt = $conn->prepare("SELECT COUNT(*) AS allcount FROM users ");
$stmt->execute();
$records = $stmt->fetch();
$totalRecords = $records['allcount'];

## Total number of records with filtering
$stmt = $conn->prepare("SELECT COUNT(*) AS allcount FROM users WHERE 1 ".$searchQuery);
$stmt->execute($searchArray);
$records = $stmt->fetch();
$totalRecordwithFilter = $records['allcount'];

## Fetch records
$stmt = $conn->prepare("SELECT * FROM users WHERE 1 ".$searchQuery." ORDER BY ".$columnName." ".$columnSortOrder." LIMIT :limit,:offset");

// Bind values
foreach($searchArray as $key=>$search){
    $stmt->bindValue(':'.$key, $search,PDO::PARAM_STR);
}

$stmt->bindValue(':limit', (int)$row, PDO::PARAM_INT);
$stmt->bindValue(':offset', (int)$rowperpage, PDO::PARAM_INT);
$stmt->execute();
$empRecords = $stmt->fetchAll();

$data = array();

foreach($empRecords as $row){
    $data[] = array(
        "imagepath" => $row['imagepath'],
        "login" => $row['login'],
        "email" => $row['email'],
        "namefirst" => $row['namefirst'],
        "namelast" => $row['namelast'],
        "age" => $row['age'],
        "gender" => $row['gender'],
        "id" => $row['id'],
        );
}

## Response
$response = array(
    "draw" => intval($draw),
    "iTotalRecords" => $totalRecords,
    "iTotalDisplayRecords" => $totalRecordwithFilter,
    "aaData" => $data
);

echo json_encode($response);


}
}