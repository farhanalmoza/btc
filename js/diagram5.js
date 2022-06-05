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
            maxDate: '2022-06-03',
            locale: {
                format: 'YYYY-MM-DD'
            }
        });
    } else {
        // terapkan daterangerpicker
        $('#dateRange').daterangepicker({
            startDate: '2022-04-29',
            endDate: '2022-06-03',
            minDate: '2022-04-29',
            maxDate: '2022-06-03',
            locale: {
                format: 'YYYY-MM-DD'
            }
        });
    }

    if ($_GET['volume']) {
        var volume = $_GET['volume'];
        $("#volume").val(volume);
    }
});

var parts = window.location.search.substr(1).split("&");
var $_GET = {};
for (var i = 0; i < parts.length; i++) {
    var temp = parts[i].split("=");
    $_GET[decodeURIComponent(temp[0])] = decodeURIComponent(temp[1]);
}

// DIAGRAM 2 =============================================================
if ($_GET['volume']) {
    var volidr = $_GET['volume'];
} else {
    var volidr = 1;
}

// pilih volume & rentang tanggal
$('#submit').click(function() {
    // ambil nilai dari input
    volidr = $("#volume").val();
    var startDate = $('#dateRange').data('daterangepicker').startDate.format('YYYY-MM-DD');
    var endDate = $('#dateRange').data('daterangepicker').endDate.format('YYYY-MM-DD');
    location.href = "./diagram4.php?volume=" + volidr + "&from_date=" + startDate + "&to_date=" + endDate;
});

// diagram 2 (level dan tanggal) menurut jenisnya
$.ajax({
    url: "./getAll.php",
    type: "POST",
    dataType: "json",
    success: function(data) {
        const tanggal = [];
        const volume = [];
        const jenis = [];
        data.forEach(element => {
            // date without time
            var date = element.tanggal;
            var onlyDate = date.split(" ");
            var onlyDate = onlyDate[0];
            tanggal.push(onlyDate);

            // bulatkan volume IDR
            var volumeIDR = element.volidr;
            var volumeIDR = volumeIDR.slice(0,2);
            volume.push(volumeIDR);

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
            // potong daftar tanggal sesuai rentang tangga l
            var uniqueTanggal = uniqueTanggal.filter(function(date) {
                return date >= startDate && date <= endDate;
            });
        }

        // unikkan daftar volume
        var uniqueVolume = [...new Set(volume)];
        // drop volume 0
        uniqueVolume.shift();

        // unikkan daftar jenis
        var uniqueJenis = [...new Set(jenis)];
        // drop jenis null
        uniqueJenis.shift();

        // hitung jumlah data per tanggal (perhari) dan rentang volume volume dan jenis
        var jummlahDataPerVolumeJenis = [];
        uniqueJenis.forEach(jenis => {
            var jumlahDataPerVolume = [];
            for (var i=1; i<10; i++) {
                var jumlahDataPerTanggal = [];
                uniqueTanggal.forEach(tanggal => {
                    var jumlahData = 0;
                    data.forEach(element => {
                        var date = element.tanggal;
                        var onlyDate = date.split(" ");
                        var onlyDate = onlyDate[0];
                        if (element.jenis == jenis && element.volidr > (i*10) && element.volidr <= (i*10)+10 && onlyDate == tanggal) {
                            jumlahData++;
                        }
                    });
                    jumlahDataPerTanggal.push(jumlahData);
                });
                jumlahDataPerVolume.push(jumlahDataPerTanggal);
            }
            jummlahDataPerVolumeJenis.push(jumlahDataPerVolume);
        });
        console.log(jummlahDataPerVolumeJenis);

        const dataDiagram = {
            labels: uniqueTanggal,
            datasets: [
                {
                    label: 'Crash',
                    backgroundColor: 'rgb(255, 99, 132)',
                    borderColor: 'rgb(255, 99, 132)',
                    data: jummlahDataPerVolumeJenis[0][volidr-1],
                },
                {
                    label: 'Moon',
                    backgroundColor: 'rgb(54, 162, 235)',
                    borderColor: 'rgb(54, 162, 235)',
                    data: jummlahDataPerVolumeJenis[1][volidr-1],
                },
            ]
        };
        
        const config = {
            type: 'line',
            data: dataDiagram,
            options: {}
        };
        
        const myChart = new Chart(
            document.getElementById('diagram4'),
            config
        );
    }
})