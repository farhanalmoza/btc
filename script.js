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

})

// event saat klik tombol cari
$("#dateSubmit").click(function(){
    // ambil nilai dari input
    var filterDate = $("#filterDate").val();
    var startDate = filterDate.split(" - ")[0];
    var endDate = filterDate.split(" - ")[1];
    if (startDate != "" && endDate != "") {
        location.href = "./index.php?from_date=" + startDate + "&to_date=" + endDate;
    }
});