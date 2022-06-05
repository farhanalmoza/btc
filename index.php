<?php
include_once("conn.php");

$sql = "SELECT count(*) as jumlah FROM btc";
$result = query($sql);
$jumlah = $result[0]['jumlah'];
// buat jumlah menjadi format ribuan
$jumlah = number_format($jumlah, 0, ',', '.');

// harga IDR terkahir
$sql = "SELECT * FROM btc ORDER BY id DESC LIMIT 1";
$result = query($sql);
$harga_idr = $result[0]['hargaidr'];
// buat harga menjadi format rupiah
$harga_idr = number_format($harga_idr, 0, ',', '.');

// harga USD terkahir
$harga_usd = $result[0]['hargausdt'];
// buat harga menjadi format USD
$harga_usd = number_format($harga_usd, 0, ',', '.');

// volume terkahir (IDR)
$volume_idr = $result[0]['volidr'];

// volume terkahir (USD)
$volume_usd = $result[0]['volusdt'];
// buat volume menjadi format ribuan
$volume_usd = number_format($volume_usd, 0, ',', '.');

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Dashboard</title>
        
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="css/styles.css" rel="stylesheet" />

        <!-- My CSS -->
        <link rel="stylesheet" href="css/color.css">
        <!-- jQuery UI -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css" integrity="sha512-aOG0c6nPNzGk+5zjwyJaoRUgCdOrfSDhmMID2u4+OIslr0GjpLKo7Xm0Ao3xmpM4T8AmIouRkqwj1nrdVsLKEQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <!-- Date Range Picker -->
        <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
    </head>
    <body>
        <div class="d-flex" id="wrapper">
            <!-- Sidebar-->
            <div class="border-end bg-white" id="sidebar-wrapper">
                <div class="sidebar-heading border-bottom bg-light">Farkhan | BTC</div>
                <div class="list-group list-group-flush">
                    <a class="list-group-item list-group-item-action list-group-item-primary p-3 active" href="index.php">Dashboard</a>
                    <a class="list-group-item list-group-item-action list-group-item-light p-3" href="tabel.php">Tabel BTC</a>
                    <a class="list-group-item list-group-item-action list-group-item-light p-3" href="diagram1.php">Diagram 1</a>
                    <a class="list-group-item list-group-item-action list-group-item-light p-3" href="diagram2.php">Diagram 2</a>
                    <a class="list-group-item list-group-item-action list-group-item-light p-3" href="diagram3.php">Diagram 3</a>
                    <a class="list-group-item list-group-item-action list-group-item-light p-3" href="diagram4.php">Diagram 4</a>
                    <a class="list-group-item list-group-item-action list-group-item-light p-3" href="diagram5.php">Diagram 5</a>
                </div>
            </div>
            <!-- Page content wrapper-->
            <div id="page-content-wrapper">
                <!-- Top navigation-->
                <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
                    <div class="container-fluid">
                        <button class="btn btn-primary" id="sidebarToggle">Toggle Menu</button>
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                    </div>
                </nav>

                <!-- Page content-->
                <div class="container-fluid">
                    <div class="row mt-4">
                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-body">
                                    <h3>Total Data</h3>
                                    <h4 id="total-data"><?= $jumlah; ?></h4>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-body">
                                    <h3>Harga Terakhir (IDR)</h3>
                                    <h4 id="harga-terakhir-idr">Rp. <?= $harga_idr; ?></h4>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-body">
                                    <h3>Harga Terakhir (USD)</h3>
                                    <h4 id="harga-terakhir-usd">$<?= $harga_usd; ?></h4>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-3 justify-content-evenly">
                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-body">
                                    <h3>Volume Terakhir (IDR)</h3>
                                    <h4 id="volume-terakhir-idr">Rp. <?= $volume_idr; ?></h4>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-body">
                                    <h3>Volume Terakhir (USD)</h3>
                                    <h4 id="volume-terakhir-usd">$<?= $volume_usd; ?></h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="js/sidebar.js"></script>

        <!-- jQuery -->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js" integrity="sha512-uto9mlQzrs59VwILcLiRYeLKPPbS/bT71da/OEBYEwcdNUk8jYIy+D176RYoop1Da+f9mvkYrmj5MCLZWEtQuA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

        <!-- Chart JS -->
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

        <!-- date range picker -->
        <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
        <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>

        <!-- date range picker -->
        <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
        <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    </body>
</html>
