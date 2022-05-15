<?php
// filter date range
if (isset($_GET["from_date"]) && isset($_GET["to_date"])) {
    $from_date = $_GET["from_date"];
    $to_date = $_GET["to_date"];
    $sql = "SELECT * FROM btc WHERE tanggal BETWEEN '".$from_date."' AND '".$to_date." 23:59:59' ORDER BY id DESC";
    $param3 = "&from_date=".$from_date."&to_date=".$to_date;
} else {
    $param3 = "";
}

?>