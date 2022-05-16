<?php
// filter date range
if (isset($_GET["from_date"]) && isset($_GET["to_date"])) {
    $from_date = $_GET["from_date"];
    $to_date = $_GET["to_date"];
    $sql = "SELECT * FROM btc WHERE tanggal BETWEEN '".$from_date."' AND '".$to_date." 23:59:59' ORDER BY id DESC";
    $param .= "&from_date=".$from_date."&to_date=".$to_date;
} else {
    $param .= "";
}

// filter by sinyal
if (isset($_GET["signal_min"]) && isset($_GET["signal_max"])) {
    $signal_min = $_GET["signal_min"];
    $signal_max = $_GET["signal_max"];
    $sql = "SELECT * FROM btc WHERE sinyal BETWEEN ".$signal_min." AND ".$signal_max." ORDER BY id DESC";
    $param .= "&signal_min=".$signal_min."&signal_max=".$signal_max;
} else {
    $param .= "";
}

?>