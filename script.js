$(document).ready(function() {
    // Selector input yang akan menampilkan autocomplete.
    $( "#search" ).autocomplete({
        source: "./autocomplete.php",
    });

    // ambil get di url
    var parts = window.location.search.substr(1).split("&");
    var $_GET = {};
    for (var i = 0; i < parts.length; i++) {
        var temp = parts[i].split("=");
        $_GET[decodeURIComponent(temp[0])] = decodeURIComponent(temp[1]);
    }

    // jika ada get filter date range
    if ($_GET['from_date'] && $_GET['to_date']) {
        var startDate = $_GET['from_date'];
        var endDate = $_GET['to_date'];

        // terapkan daterangerpicker
        $('#filterDate').daterangepicker({
            startDate: startDate,
            endDate: endDate,
            locale: {
                format: 'YYYY-MM-DD'
            }
        });
    } else {
        // terapkan daterangerpicker
        $('#filterDate').daterangepicker({
            locale: {
                format: 'YYYY-MM-DD'
            }
        });
    }

    // jika ada get filter rentang sinyal
    if ($_GET['signal_min'] && $_GET['signal_max']) {
        var signalMin = $_GET['signal_min'];
        var signalMax = $_GET['signal_max'];

        $("#fromSinyal").val(signalMin);
        $("#toSinyal").val(signalMax);
    }

    // jika ada get filter rentang harga IDR
    if ($_GET['harga_min'] && $_GET['harga_max']) {
        var hargaMin = $_GET['harga_min'];
        var hargaMax = $_GET['harga_max'];

        $("#hargaMin").val(hargaMin);
        $("#hargaMax").val(hargaMax);
    }

    // jika ada get filter rentang harga USD
    if ($_GET['harga_usd_min'] && $_GET['harga_usd_max']) {
        var hargaUsdMin = $_GET['harga_usd_min'];
        var hargaUsdMax = $_GET['harga_usd_max'];

        $("#hargaMinUSD").val(hargaUsdMin);
        $("#hargaMaxUSD").val(hargaUsdMax);
    }

    // ambil daftar level
    $.ajax({
        url: "./getLevel.php",
        type: "POST",
        dataType: "json",
        success: function(data) {
            const levels = [];
            data.forEach(element => {
                levels.push(element.level);
            });

            // unikkan daftar level
            var uniqueLevels = [...new Set(levels)];
            
            // tambahkan option pada select level
            uniqueLevels.forEach(element => {
                $("#level").append(`<option value="${element}">${element}</option>`);
            });

            // jika ada get filter level
            if ($_GET['level']) {
                var level = $_GET['level'];

                $("#level").val(level);
            }
        }
    })

})

// variabel current url
var url = window.location.href;
if (window.location.search == "") {
    url = url + "?halaman=1";
}

// event saat klik tombol filter date
$("#dateSubmit").click(function(){
    // ambil nilai dari input
    var filterDate = $("#filterDate").val();
    var startDate = filterDate.split(" - ")[0];
    var endDate = filterDate.split(" - ")[1];
    if (startDate != "" && endDate != "") {
        location.href = url + "&from_date=" + startDate + "&to_date=" + endDate;
    }
});

// event saat klik tombol filter rentang sinyal
$("#sinyalSubmit").click(function(){
    // ambil nilai dari input
    var fromSinyal = $("#fromSinyal").val();
    var toSinyal = $("#toSinyal").val();
    if (fromSinyal != "" && toSinyal != "") {
        location.href = url + "&signal_min=" + fromSinyal + "&signal_max=" + toSinyal;
    }
});

// event saat klik tombol filter rentang harga IDR
$("#hargaSubmit").click(function(){
    // ambil nilai dari input
    var fromHarga = $("#hargaMin").val();
    var toHarga = $("#hargaMax").val();
    if (fromHarga != "" && toHarga != "") {
        location.href = url + "&harga_min=" + fromHarga + "&harga_max=" + toHarga;
    }
});

// event saat klik tombol filter rentang harga USD
$("#hargaUSDSubmit").click(function(){
    // ambil nilai dari input
    var fromHarga = $("#hargaMinUSD").val();
    var toHarga = $("#hargaMaxUSD").val();
    if (fromHarga != "" && toHarga != "") {
        location.href = url + "&harga_usd_min=" + fromHarga + "&harga_usd_max=" + toHarga;
    }
});

// event saat klik tombol filter level
$("#levelSubmit").click(function(){
    // ambil nilai dari input
    var level = $("#level").val();
    if (level != "") {
        location.href = url + "&level=" + level;
    }
});