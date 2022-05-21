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
            $("#levelDiagram2").append(`<option value="${i}">${element}</option>`);
            i++;
        });

        // jika ada get level pada diagram 2
        if ($_GET['levelD2']) {
            var level = $_GET['levelD2'];
            $("#levelDiagram2").val(level);
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
if ($_GET['levelD2']) {
    var idLevelD2 = $_GET['levelD2'];
} else {
    var idLevelD2 = 0;
}

$("#levelDiagram2Submit").click(function(){
    // ambil nilai dari input
    idLevelD2 = $("#levelDiagram2").val();

    location.href = "./diagram2.php?levelD2=" + idLevelD2;
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
                    data: jumlahDataPerLevelJenis[0][idLevelD2],
                },
                {
                    label: 'Moon',
                    backgroundColor: 'rgb(54, 162, 235)',
                    borderColor: 'rgb(54, 162, 235)',
                    data: jumlahDataPerLevelJenis[1][idLevelD2],
                },
            ]
        };
        
        const config = {
            type: 'line',
            data: dataDiagram,
            options: {}
        };
        
        const myChart = new Chart(
            document.getElementById('diagram2'),
            config
        );
    }
})