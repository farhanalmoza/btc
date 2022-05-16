<?php
// filter date range
if (isset($_GET["from_date"]) && isset($_GET["to_date"])) {
    $from_date = $_GET["from_date"];
    $to_date = $_GET["to_date"];
    $sql .= " AND tanggal BETWEEN '".$from_date."' AND '".$to_date." 23:59:59'";
    $param .= "&from_date=".$from_date."&to_date=".$to_date;
} else {
    $param .= "";
}

// filter by sinyal
if (isset($_GET["signal_min"]) && isset($_GET["signal_max"])) {
    $signal_min = $_GET["signal_min"];
    $signal_max = $_GET["signal_max"];
    $sql .= " AND sinyal BETWEEN ".$signal_min." AND ".$signal_max."";
    $param .= "&signal_min=".$signal_min."&signal_max=".$signal_max;
} else {
    $param .= "";
}

// filter by harga idr
if (isset($_GET["harga_min"]) && isset($_GET["harga_max"])) {
    $harga_min = $_GET["harga_min"];
    $harga_max = $_GET["harga_max"];
    $sql .= " AND hargaidr BETWEEN ".$harga_min." AND ".$harga_max."";
    $param .= "&harga_min=".$harga_min."&harga_max=".$harga_max;
} else {
    $param .= "";
}

// filter by harga usd
if (isset($_GET["harga_usd_min"]) && isset($_GET["harga_usd_max"])) {
    $harga_usd_min = $_GET["harga_usd_min"];
    $harga_usd_max = $_GET["harga_usd_max"];
    $sql .= " AND hargausdt BETWEEN ".$harga_usd_min." AND ".$harga_usd_max."";
    $param .= "&harga_usd_min=".$harga_usd_min."&harga_usd_max=".$harga_usd_max;
} else {
    $param .= "";
}

// filter by level
if (isset($_GET["level"])) {
    $level = $_GET["level"];
    $sql .= " AND level = '".$level."'";
    $param .= "&level=".$level;
} else {
    $param .= "";
}

?>