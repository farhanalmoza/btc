<?php
include_once("conn.php");

// konfigurasi pagination
$jumlahDataPerHalaman = 100;
if (isset($_GET["search"])) {
    $search = $_GET["search"];
    $sql = "SELECT * FROM btc WHERE jenis LIKE '%".$search."%' ORDER BY id DESC";
    $param2 = "&search=".$search;
} else {
    $sql = "SELECT * FROM btc ORDER BY id DESC";
    $param2 = "";
}
$jumlahData = count(query($sql));
$jumlahHalaman = ceil($jumlahData / $jumlahDataPerHalaman);
$halamanAktif = ( isset($_GET["halaman"]) ) ? $_GET["halaman"] : 1;
// superset range of pages
$superset_range = range(1, $jumlahHalaman);
// subset range of pages to display
$subset_range = range($halamanAktif - 3, $halamanAktif + 3);

// adjust the subset range
if ($halamanAktif - 3 < 1) {
    $subset_range = range(1, 6);
} else if ($halamanAktif + 3 > $jumlahHalaman) {
    $subset_range = range($jumlahHalaman - 5, $jumlahHalaman);
}

$awalData = ( $jumlahDataPerHalaman * $halamanAktif ) - $jumlahDataPerHalaman;

// ambil data
$results = query($sql . " LIMIT $awalData, $jumlahDataPerHalaman");
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- My CSS -->
    <link rel="stylesheet" href="style.css">
    <!-- jQuery UI -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css" integrity="sha512-aOG0c6nPNzGk+5zjwyJaoRUgCdOrfSDhmMID2u4+OIslr0GjpLKo7Xm0Ao3xmpM4T8AmIouRkqwj1nrdVsLKEQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <title>Penambangan Sinyal Harian INDODAX</title>
  </head>
  <body>
    <div class="container">
        <h1 class="text-center">Penambangan Sinyal Harian INDODAX</h1>

        <!-- card pencarian -->
        <div class="card mt-5">
            <div class="card-body">
                <form class="d-flex">
                    <input class="form-control me-2" type="search" id="search" name="search" placeholder="Cari" aria-label="Search">
                    <button class="btn btn-outline-success" type="submit">Cari</button>
                </form>
            </div>
        </div>

        <!-- card table -->
        <div class="card mt-4 mb-5">
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Sinyal</th> 
                            <th>Level</th> 
                            <th>Tanggal dan Waktu</th>
                            <th>Harga Rp.</th>
                            <th>Harga USDT</th> 
                            <th>Vol BTC</th> 
                            <th>Vol Rp.</th>
                            <th>Last Buy</th>
                            <th>Last Sell</th>
                            <th>Jenis</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php 
                        foreach ($results as $result) {
                            $konter = $result['sinyal'];
                            echo "<tr>";
                                $hrgidr  = number_format($result['hargaidr']);
                                $hrgusdt = number_format($result['hargausdt']);
                                $vidr    = number_format($result['volidr'],8,",",".");
                                $vusdt   = number_format($result['volusdt']);
                                $lbuy    = number_format($result['lastbuy']);
                                $lsell   = number_format($result['lastsell']);

                                if ($konter >= 120) {
                                    echo "<td class='text-center bg-1'>".$result['id']."</td>";
                                    echo "<td class='text-center bg-1'>".$result['sinyal']."</td>";
                                    echo "<td class='text-center bg-1'>".$result['level']."</td>";
                                    echo "<td class='text-center bg-1'>".$result['tanggal']."</td>";
                                    echo "<td class='text-center bg-1'>".$hrgidr."</td>";
                                    echo "<td class='text-center bg-1'>".$hrgusdt."</td>";
                                    echo "<td class='text-center bg-1'>".$vidr."</td>";
                                    echo "<td class='text-center bg-1'>".$vusdt."</td>";
                                    echo "<td class='text-center bg-1'>".$lbuy."</td>";
                                    echo "<td class='text-center bg-1'>".$lsell."</td>";
                                    if ($result['jenis']=='crash') {
                                        echo "<td class='text-center bg-danger'>".$result['jenis']."</td>";
                                    } elseif ($result['jenis']=='moon') {
                                        echo "<td class='text-center bg-success'>".$result['jenis']."</td>";
                                    }
                                }

                                elseif($konter>=111) {
                                    echo "<td class='text-center bg-2'>".$result['id']."</td>";
                                    echo "<td class='text-center bg-2'>".$result['sinyal']."</td>";
                                    echo "<td class='text-center bg-2'>".$result['level']."</td>";
                                    echo "<td class='text-center bg-2'>".$result['tanggal']."</td>";
                                    echo "<td class='text-center bg-2'>".$hrgidr."</td>";
                                    echo "<td class='text-center bg-2'>".$hrgusdt."</td>";
                                    echo "<td class='text-center bg-2'>".$vidr."</td>";
                                    echo "<td class='text-center bg-2'>".$vusdt."</td>";
                                    echo "<td class='text-center bg-2'>".$lbuy."</td>";
                                    echo "<td class='text-center bg-2'>".$lsell."</td>";    
                                    if ($result['jenis']=='crash'){
                                        echo "<td class='text-center bg-danger'>".$result['jenis']."</td>";
                                    } elseif ($result['jenis']=='moon'){
                                        echo "<td class='text-center bg-success'>".$result['jenis']."</td>";
                                    }
                                }

                                elseif($konter>=101) {
                                    echo "<td class='text-center bg-3'>".$result['id']."</td>";
                                    echo "<td class='text-center bg-3'>".$result['sinyal']."</td>";
                                    echo "<td class='text-center bg-3'>".$result['level']."</td>";
                                    echo "<td class='text-center bg-3'>".$result['tanggal']."</td>";
                                    echo "<td class='text-center bg-3'>".$hrgidr."</td>";
                                    echo "<td class='text-center bg-3'>".$hrgusdt."</td>";
                                    echo "<td class='text-center bg-3'>".$vidr."</td>";
                                    echo "<td class='text-center bg-3'>".$vusdt."</td>";
                                    echo "<td class='text-center bg-3'>".$lbuy."</td>";
                                    echo "<td class='text-center bg-3'>".$lsell."</td>";    
                                    if ($result['jenis']=='crash') {
                                        echo "<td class='text-center bg-danger'>".$result['jenis']."</td>";
                                    } elseif ($result['jenis']=='moon') {
                                        echo "<td class='text-center bg-success'>".$result['jenis']."</td>";
                                    }
                                }

                                elseif($konter>=91) {
                                    echo "<td class='text-center bg-4'>".$result['id']."</td>";
                                    echo "<td class='text-center bg-4'>".$result['sinyal']."</td>";
                                    echo "<td class='text-center bg-4'>".$result['level']."</td>";
                                    echo "<td class='text-center bg-4'>".$result['tanggal']."</td>";
                                    echo "<td class='text-center bg-4'>".$hrgidr."</td>";
                                    echo "<td class='text-center bg-4'>".$hrgusdt."</td>";
                                    echo "<td class='text-center bg-4'>".$vidr."</td>";
                                    echo "<td class='text-center bg-4'>".$vusdt."</td>";
                                    echo "<td class='text-center bg-4'>".$lbuy."</td>";
                                    echo "<td class='text-center bg-4'>".$lsell."</td>";    
                                    if ($result['jenis']=='crash') {
                                        echo "<td class='text-center bg-danger'>".$result['jenis']."</td>";
                                    } elseif ($result['jenis']=='moon') {
                                        echo "<td class='text-center bg-success'>".$result['jenis']."</td>";
                                    }
                                }

                                elseif($konter>=81) {
                                    echo "<td class='text-center bg-5'>".$result['id']."</td>";
                                    echo "<td class='text-center bg-5'>".$result['sinyal']."</td>";
                                    echo "<td class='text-center bg-5'>".$result['level']."</td>";
                                    echo "<td class='text-center bg-5'>".$result['tanggal']."</td>";
                                    echo "<td class='text-center bg-5'>".$hrgidr."</td>";
                                    echo "<td class='text-center bg-5'>".$hrgusdt."</td>";
                                    echo "<td class='text-center bg-5'>".$vidr."</td>";
                                    echo "<td class='text-center bg-5'>".$vusdt."</td>";
                                    echo "<td class='text-center bg-5'>".$lbuy."</td>";
                                    echo "<td class='text-center bg-5'>".$lsell."</td>";    
                                    if ($result['jenis']=='crash') {
                                        echo "<td class='text-center bg-danger'>".$result['jenis']."</td>";
                                    } elseif ($result['jenis']=='moon') {
                                        echo "<td class='text-center bg-success'>".$result['jenis']."</td>";
                                    }
                                }

                                elseif($konter>=71) {
                                    echo "<td class='text-center bg-6'>".$result['id']."</td>";
                                    echo "<td class='text-center bg-6'>".$result['sinyal']."</td>";
                                    echo "<td class='text-center bg-6'>".$result['level']."</td>";
                                    echo "<td class='text-center bg-6'>".$result['tanggal']."</td>";
                                    echo "<td class='text-center bg-6'>".$hrgidr."</td>";
                                    echo "<td class='text-center bg-6'>".$hrgusdt."</td>";
                                    echo "<td class='text-center bg-6'>".$vidr."</td>";
                                    echo "<td class='text-center bg-6'>".$vusdt."</td>";
                                    echo "<td class='text-center bg-6'>".$lbuy."</td>";
                                    echo "<td class='text-center bg-6'>".$lsell."</td>";    
                                    if ($result['jenis']=='crash'){
                                        echo "<td class='text-center bg-danger'>".$result['jenis']."</td>";
                                    } elseif ($result['jenis']=='moon'){
                                        echo "<td class='text-center bg-success'>".$result['jenis']."</td>";
                                    }
                                }

                                elseif($konter>=61) {
                                    echo "<td class='text-center bg-7'>".$result['id']."</td>";
                                    echo "<td class='text-center bg-7'>".$result['sinyal']."</td>";
                                    echo "<td class='text-center bg-7'>".$result['level']."</td>";
                                    echo "<td class='text-center bg-7'>".$result['tanggal']."</td>";
                                    echo "<td class='text-center bg-7'>".$hrgidr."</td>";
                                    echo "<td class='text-center bg-7'>".$hrgusdt."</td>";
                                    echo "<td class='text-center bg-7'>".$vidr."</td>";
                                    echo "<td class='text-center bg-7'>".$vusdt."</td>";
                                    echo "<td class='text-center bg-7'>".$lbuy."</td>";
                                    echo "<td class='text-center bg-7'>".$lsell."</td>";    
                                    if ($result['jenis']=='crash'){
                                        echo "<td class='text-center bg-danger'>".$result['jenis']."</td>";
                                    } elseif ($result['jenis']=='moon'){
                                        echo "<td class='text-center bg-success'>".$result['jenis']."</td>";
                                    }
                                }

                                elseif($konter>=51) {
                                    echo "<td class='text-center bg-8'>".$result['id']."</td>";
                                    echo "<td class='text-center bg-8'>".$result['sinyal']."</td>";
                                    echo "<td class='text-center bg-8'>".$result['level']."</td>";
                                    echo "<td class='text-center bg-8'>".$result['tanggal']."</td>";
                                    echo "<td class='text-center bg-8'>".$hrgidr."</td>";
                                    echo "<td class='text-center bg-8'>".$hrgusdt."</td>";
                                    echo "<td class='text-center bg-8'>".$vidr."</td>";
                                    echo "<td class='text-center bg-8'>".$vusdt."</td>";
                                    echo "<td class='text-center bg-8'>".$lbuy."</td>";
                                    echo "<td class='text-center bg-8'>".$lsell."</td>";    
                                    if ($result['jenis']=='crash') {
                                        echo "<td class='text-center bg-danger'>".$result['jenis']."</td>";
                                    } elseif ($result['jenis']=='moon') {
                                        echo "<td class='text-center bg-success'>".$result['jenis']."</td>";
                                    }
                                }

                                elseif($konter>=41) {
                                    echo "<td class='text-center bg-9'>".$result['id']."</td>";
                                    echo "<td class='text-center bg-9'>".$result['sinyal']."</td>";
                                    echo "<td class='text-center bg-9'>".$result['level']."</td>";
                                    echo "<td class='text-center bg-9'>".$result['tanggal']."</td>";
                                    echo "<td class='text-center bg-9'>".$hrgidr."</td>";
                                    echo "<td class='text-center bg-9'>".$hrgusdt."</td>";
                                    echo "<td class='text-center bg-9'>".$vidr."</td>";
                                    echo "<td class='text-center bg-9'>".$vusdt."</td>";
                                    echo "<td class='text-center bg-9'>".$lbuy."</td>";
                                    echo "<td class='text-center bg-9'>".$lsell."</td>";    
                                    if ($result['jenis']=='crash'){
                                        echo "<td class='text-center bg-danger'>".$result['jenis']."</td>";
                                    } elseif ($result['jenis']=='moon'){
                                        echo "<td class='text-center bg-success'>".$result['jenis']."</td>";
                                    }
                                }

                                elseif($konter>=31) {
                                    echo "<td class='text-center bg-10'>".$result['id']."</td>";
                                    echo "<td class='text-center bg-10'>".$result['sinyal']."</td>";
                                    echo "<td class='text-center bg-10'>".$result['level']."</td>";
                                    echo "<td class='text-center bg-10'>".$result['tanggal']."</td>";
                                    echo "<td class='text-center bg-10'>".$hrgidr."</td>";
                                    echo "<td class='text-center bg-10'>".$hrgusdt."</td>";
                                    echo "<td class='text-center bg-10'>".$vidr."</td>";
                                    echo "<td class='text-center bg-10'>".$vusdt."</td>";
                                    echo "<td class='text-center bg-10'>".$lbuy."</td>";
                                    echo "<td class='text-center bg-10'>".$lsell."</td>";    
                                    if ($result['jenis']=='crash'){
                                        echo "<td class='text-center bg-danger'>".$result['jenis']."</td>";
                                    } elseif ($result['jenis']=='moon'){
                                        echo "<td class='text-center bg-success'>".$result['jenis']."</td>";
                                    }
                                }

                                elseif($konter>=21) {
                                    echo "<td class='text-center bg-11'>".$result['id']."</td>";
                                    echo "<td class='text-center bg-11'>".$result['sinyal']."</td>";
                                    echo "<td class='text-center bg-11'>".$result['level']."</td>";
                                    echo "<td class='text-center bg-11'>".$result['tanggal']."</td>";
                                    echo "<td class='text-center bg-11'>".$hrgidr."</td>";
                                    echo "<td class='text-center bg-11'>".$hrgusdt."</td>";
                                    echo "<td class='text-center bg-11'>".$vidr."</td>";
                                    echo "<td class='text-center bg-11'>".$vusdt."</td>";
                                    echo "<td class='text-center bg-11'>".$lbuy."</td>";
                                    echo "<td class='text-center bg-11'>".$lsell."</td>";    
                                    if ($result['jenis']=='crash'){
                                        echo "<td class='text-center bg-danger'>".$result['jenis']."</td>";
                                    } elseif ($result['jenis']=='moon'){
                                        echo "<td class='text-center bg-success'>".$result['jenis']."</td>";
                                    }
                                }

                                elseif($konter>=11) 
                                {
                                    echo "<td class='text-center bg-12'>".$result['id']."</td>";
                                    echo "<td class='text-center bg-12'>".$result['sinyal']."</td>";
                                    echo "<td class='text-center bg-12'>".$result['level']."</td>";
                                    echo "<td class='text-center bg-12'>".$result['tanggal']."</td>";
                                    echo "<td class='text-center bg-12'>".$hrgidr."</td>";
                                    echo "<td class='text-center bg-12'>".$hrgusdt."</td>";
                                    echo "<td class='text-center bg-12'>".$vidr."</td>";
                                    echo "<td class='text-center bg-12'>".$vusdt."</td>";
                                    echo "<td class='text-center bg-12'>".$lbuy."</td>";
                                    echo "<td class='text-center bg-12'>".$lsell."</td>";    
                                    if ($result['jenis']=='crash'){
                                        echo "<td class='text-center bg-danger'>".$result['jenis']."</td>";
                                    } elseif ($result['jenis']=='moon'){
                                        echo "<td class='text-center bg-success'>".$result['jenis']."</td>";
                                    }
                                }

                                elseif($konter>=1) {
                                    echo "<td class='text-center bg-13'>".$result['id']."</td>";
                                    echo "<td class='text-center bg-13'>".$result['sinyal']."</td>";
                                    echo "<td class='text-center bg-13'>".$result['level']."</td>";
                                    echo "<td class='text-center bg-13'>".$result['tanggal']."</td>";
                                    echo "<td class='text-center bg-13'>".$hrgidr."</td>";
                                    echo "<td class='text-center bg-13'>".$hrgusdt."</td>";
                                    echo "<td class='text-center bg-13'>".$vidr."</td>";
                                    echo "<td class='text-center bg-13'>".$vusdt."</td>";
                                    echo "<td class='text-center bg-13'>".$lbuy."</td>";
                                    echo "<td class='text-center bg-13'>".$lsell."</td>";    
                                    if ($result['jenis']=='crash'){
                                        echo "<td class='text-center bg-danger'>".$result['jenis']."</td>";
                                    } elseif ($result['jenis']=='moon'){
                                        echo "<td class='text-center bg-success'>".$result['jenis']."</td>";
                                    }
                                }

                                else {
                                    echo "<td class='text-center bg-14'>".$result['id']."</td>";
                                    echo "<td class='text-center bg-14'>".$result['sinyal']."</td>";
                                    echo "<td class='text-center bg-14'>".$result['level']."</td>";
                                    echo "<td class='text-center bg-14'>".$result['tanggal']."</td>";
                                    echo "<td class='text-center bg-14'>".$hrgidr."</td>";
                                    echo "<td class='text-center bg-14'>".$hrgusdt."</td>";
                                    echo "<td class='text-center bg-14'>".$vidr."</td>";
                                    echo "<td class='text-center bg-14'>".$vusdt."</td>";
                                    echo "<td class='text-center bg-14'>".$lbuy."</td>";
                                    echo "<td class='text-center bg-14'>".$lsell."</td>";
                                    if ($result['jenis']=='crash'){
                                        echo "<td class='text-center bg-danger'>".$result['jenis']."</td>";
                                    } elseif ($result['jenis']=='moon'){
                                        echo "<td class='text-center bg-success'>".$result['jenis']."</td>";
                                    }
                                }

                            echo "</tr>";
                        }
                    ?>
                    </tbody>
                </table>

                <!-- navigasi pagination -->
                <nav aria-label="Page navigation example">
                    <ul class="pagination justify-content-center">
                        <!-- halaman pertama -->
                        <li class="page-item">
                            <a class="page-link" href="?halaman=1<?= $param2; ?>">Pertama</a>
                        </li>

                        <!-- tombol prev -->
                        <?php if($halamanAktif > 1) : ?>
                            <li class="page-item">
                                <a class="page-link" href="?halaman=<?= $halamanAktif - 1; ?><?= $param2; ?>" aria-label="Previous">
                                    <span aria-hidden="true">&laquo;</span>
                                </a>
                            </li>
                        <?php else : ?>
                            <li class="page-item disabled">
                                <a class="page-link" href="#" aria-label="Previous">
                                    <span aria-hidden="true">&laquo;</span>
                                </a>
                            </li>
                        <?php endif; ?>
                        
                        <!-- tombol nomor halaman -->
                        <?php if($subset_range[0] > $superset_range[0]) : ?>
                            <li class="page-item">...&nbsp;</li>
                        <?php endif; ?>

                        <?php foreach($subset_range as $p) : ?>
                            <?php if($p == $halamanAktif) : ?>
                                <li class="page-item active"><a class="page-link" href="?halaman=<?= $p ?><?= $param2; ?>"><?= $p ?></a></li>
                            <?php else : ?>
                                <li class="page-item"><a class="page-link" href="?halaman=<?= $p ?><?= $param2; ?>"><?= $p ?></a></li>
                            <?php endif; ?>
                        <?php endforeach; ?>

                        <?php if($subset_range[count($subset_range) - 1] < $superset_range[count($superset_range) - 1]) : ?>
                            <li class="page-item">&nbsp;...</li>
                        <?php endif; ?>
                        
                        <!-- tombol next -->
                        <?php if($halamanAktif < $jumlahHalaman) : ?>
                            <li class="page-item">
                                <a class="page-link" href="?halaman=<?= $halamanAktif + 1; ?><?= $param2; ?>" aria-label="Next">
                                    <span aria-hidden="true">&raquo;</span>
                                </a>
                            </li>
                        <?php else : ?>
                            <li class="page-item disabled">
                                <a class="page-link" href="#" aria-label="Next">
                                    <span aria-hidden="true">&raquo;</span>
                                </a>
                            </li>
                        <?php endif; ?>

                        <!-- halaman terakhir -->
                        <li class="page-item">
                            <a class="page-link" href="?halaman=<?= $jumlahHalaman; ?><?= $param2; ?>">Terakhir</a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>

        <!--  -->
    </div>

    <!-- footer -->
    <div class="card">
        <div class="card-body">
            <div class="text-center">&copy; Farkhan 2022</div>
        </div>
    </div>


    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js" integrity="sha512-uto9mlQzrs59VwILcLiRYeLKPPbS/bT71da/OEBYEwcdNUk8jYIy+D176RYoop1Da+f9mvkYrmj5MCLZWEtQuA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <!-- My JS -->
    <script src="./script.js"></script>
  </body>
</html>