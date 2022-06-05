<?php
include_once("conn.php");

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Diagram 3 Level & Tanggal (Datepicker) Menurut Jenis</title>
        
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
                    <a class="list-group-item list-group-item-action list-group-item-light p-3" href="index.php">Dashboard</a>
                    <a class="list-group-item list-group-item-action list-group-item-light p-3" href="tabel.php">Tabel BTC</a>
                    <a class="list-group-item list-group-item-action list-group-item-light p-3" href="diagram1.php">Diagram 1</a>
                    <a class="list-group-item list-group-item-action list-group-item-light p-3" href="diagram2.php">Diagram 2</a>
                    <a class="list-group-item list-group-item-action list-group-item-primary p-3 active" href="diagram3.php">Diagram 3</a>
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
                    <h1 class="text-center">Diagram 3 Level & Tanggal (Datepicker) Menurut Jenis</h1>

                    <div class="card mt-4">
                        <div class="card-body">  
                            <!-- Level -->
                            <div class="mb-3 row">
                                <label class="col-sm-2 col-form-label">Level</label>
                                <div class="col-sm-7">
                                    <select class="form-select" id="level">
                                        
                                    </select>
                                </div>
                            </div>

                            <!-- rentang tanggal -->
                            <div class="mb-3 row">
                                <label class="col-sm-2 col-form-label">Rentang tanggal</label>
                                <div class="col-sm-7">
                                    <input type="text" class="form-control" id="dateRange" name="dateRange">
                                </div>
                                <div class="col-sm-2">
                                    <button type="button" class="btn btn-primary" id="submit">Pilih</button>
                                </div>
                            </div>

                            <div>
                                <canvas id="diagram3"></canvas>
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

        <!-- My JS -->
        <script src="js/diagram3.js"></script>
    </body>
</html>
