<?php
header("Content-Type: application/json; charset=UTF-8");

include_once("conn.php");

// Deklarasi variable keyword buah.
$key = $_GET["term"];

// Query ke database.
$sql  = "SELECT * FROM btc WHERE jenis LIKE '%".$key."%' LIMIT 5";

$results = mysqli_query($conn, $sql);

//Disajikan dengan menggunakan perulangan
while ($row = mysqli_fetch_array($results)) {
    $data[] = $row['jenis'];
}

// Encode ke format JSON.
echo json_encode($data);