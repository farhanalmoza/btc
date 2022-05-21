$(document).ready(function() {
    // jika ada get filter date range
    if ($_GET['from_date'] && $_GET['to_date']) {
        var startDate = $_GET['from_date'];
        var endDate = $_GET['to_date'];

        // terapkan daterangerpicker
        $('#dateRange').daterangepicker({
            startDate: startDate,
            endDate: endDate,
            minDate: '2022-04-29',
            maxDate: '2022-05-11',
            locale: {
                format: 'YYYY-MM-DD'
            }
        });
    } else {
        // terapkan daterangerpicker
        $('#dateRange').daterangepicker({
            startDate: '2022-04-29',
            endDate: '2022-05-11',
            minDate: '2022-04-29',
            maxDate: '2022-05-11',
            locale: {
                format: 'YYYY-MM-DD'
            }
        });
    }
});

// ambil daftar level
$.ajax({
    url: "./getAll.php",
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
        var i = 0;
        uniqueLevels.forEach(element => {
            $("#level").append(`<option value="${i}">${element}</option>`);
            i++;
        });

        // jika ada get level pada diagram 2
        if ($_GET['level']) {
            var level = $_GET['level'];
            $("#level").val(level);
        }
    }
})

var parts = window.location.search.substr(1).split("&");
var $_GET = {};
for (var i = 0; i < parts.length; i++) {
    var temp = parts[i].split("=");
    $_GET[decodeURIComponent(temp[0])] = decodeURIComponent(temp[1]);
}

// DIAGRAM 2 =============================================================
if ($_GET['level']) {
    var idLevel = $_GET['level'];
} else {
    var idLevel = 0;
}

// pilih level & rentang tanggal
$('#submit').click(function() {
    // ambil nilai dari input
    idLevel = $("#level").val();
    var startDate = $('#dateRange').data('daterangepicker').startDate.format('YYYY-MM-DD');
    var endDate = $('#dateRange').data('daterangepicker').endDate.format('YYYY-MM-DD');
    location.href = "./diagram3.php?level=" + idLevel + "&from_date=" + startDate + "&to_date=" + endDate;
});

// diagram 2 (level dan tanggal) menurut jenisnya
$.ajax({
    url: "./getAll.php",
    type: "POST",
    dataType: "json",
    success: function(data) {
        const tanggal = [];
        const level = [];
        const jenis = [];
        data.forEach(element => {
            // date without time
            var date = element.tanggal;
            var onlyDate = date.split(" ");
            var onlyDate = onlyDate[0];
            tanggal.push(onlyDate);

            // level
            level.push(element.level);

            // jenis
            jenis.push(element.jenis);
        });

        // unikkan daftar tanggal
        var uniqueTanggal = [...new Set(tanggal)];
        // drop tanggal 0000-00-00
        uniqueTanggal.shift();

        if ($_GET['from_date'] && $_GET['to_date']) {
            var startDate = $_GET['from_date'];
            var endDate = $_GET['to_date'];
            // potong daftar tanggal sesuai rentang tanggal
            var uniqueTanggal = uniqueTanggal.filter(function(date) {
                return date >= startDate && date <= endDate;
            });
        }

        // unikkan daftar level
        var uniqueLevel = [...new Set(level)];

        // unikkan daftar jenis
        var uniqueJenis = [...new Set(jenis)];
        // drop jenis null
        uniqueJenis.shift();

        // hitung jumlah data per tanggal (perhari) dan per level dan jenis
        var jumlahDataPerLevelJenis = [];
        uniqueJenis.forEach(jenis => {
            var jumlahDataPerLevel = [];
            uniqueLevel.forEach(level => {
                var jumlahDataPerTanggal = [];
                uniqueTanggal.forEach(tanggal => {
                    var jumlah = 0;
                    data.forEach(element => {
                        if (element.level == level && element.tanggal.includes(tanggal) && element.jenis == jenis) {
                            jumlah++;
                        }
                    });
                    jumlahDataPerTanggal.push(jumlah);
                });
                jumlahDataPerLevel.push(jumlahDataPerTanggal);
            });
            jumlahDataPerLevelJenis.push(jumlahDataPerLevel);
        });

        const dataDiagram = {
            labels: uniqueTanggal,
            datasets: [
                {
                    label: 'Crash',
                    backgroundColor: 'rgb(255, 99, 132)',
                    borderColor: 'rgb(255, 99, 132)',
                    data: jumlahDataPerLevelJenis[0][idLevel],
                },
                {
                    label: 'Moon',
                    backgroundColor: 'rgb(54, 162, 235)',
                    borderColor: 'rgb(54, 162, 235)',
                    data: jumlahDataPerLevelJenis[1][idLevel],
                },
            ]
        };
        
        const config = {
            type: 'line',
            data: dataDiagram,
            options: {}
        };
        
        const myChart = new Chart(
            document.getElementById('diagram3'),
            config
        );
    }
})