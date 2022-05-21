<?php

include_once 'conn.php';

$data = query("SELECT * FROM btc");

echo json_encode($data);

?>