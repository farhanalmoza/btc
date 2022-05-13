<?php
/**
 * using mysqli_connect for database connection
 */
 
// koneksi ke database
$conn = mysqli_connect("localhost", "root", "", "catata33_575");

function query($query) {
    global $conn;
    $result = mysqli_query($conn, $query);
    $rows = [];
    while( $row = mysqli_fetch_assoc($result) ) {
        $rows[] = $row;
    }
    return $rows;
}

?>