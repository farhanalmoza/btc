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

})

// event saat klik tombol filter date
$("#dateSubmit").click(function(){
    // ambil nilai dari input
    var filterDate = $("#filterDate").val();
    var startDate = filterDate.split(" - ")[0];
    var endDate = filterDate.split(" - ")[1];
    if (startDate != "" && endDate != "") {
        location.href = "./index.php?from_date=" + startDate + "&to_date=" + endDate;
    }
});

// event saat klik tombol filter rentang sinyal
$("#sinyalSubmit").click(function(){
    // ambil nilai dari input
    var fromSinyal = $("#fromSinyal").val();
    var toSinyal = $("#toSinyal").val();
    if (fromSinyal != "" && toSinyal != "") {
        location.href = "./index.php?signal_min=" + fromSinyal + "&signal_max=" + toSinyal;
    }
});