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
            $("#levelDiagram1").append(`<option value="${i}">${element}</option>`);
            i++;
        });

        // jika ada get level pada diagram 1
        if ($_GET['levelD1']) {
            var level = $_GET['levelD1'];
            $("#levelDiagram1").val(level);
        }
    }
})

var parts = window.location.search.substr(1).split("&");
var $_GET = {};
for (var i = 0; i < parts.length; i++) {
    var temp = parts[i].split("=");
    $_GET[decodeURIComponent(temp[0])] = decodeURIComponent(temp[1]);
}

// DIAGRAM 1 =============================================================
if ($_GET['levelD1']) {
    var idLevelD1 = $_GET['levelD1'];
} else {
    var idLevelD1 = 0;
}

$("#levelDiagram1Submit").click(function(){
    // ambil nilai dari input
    idLevelD1 = $("#levelDiagram1").val();

    location.href = "./diagram1.php?levelD1=" + idLevelD1;
});

// diagram 1 (level dan tanggal)
$.ajax({
    url: "./getAll.php",
    type: "POST",
    dataType: "json",
    success: function(data) {
        const tanggal = [];
        const level = [];
        data.forEach(element => {
            // date without time
            var date = element.tanggal;
            var onlyDate = date.split(" ");
            var onlyDate = onlyDate[0];
            tanggal.push(onlyDate);

            // level
            level.push(element.level);
        });

        // unikkan daftar tanggal
        var uniqueTanggal = [...new Set(tanggal)];
        // drop tanggal 0000-00-00
        uniqueTanggal.shift();

        // unikkan daftar level
        var uniqueLevel = [...new Set(level)];
        // console.log(uniqueLevel);

        // hitung jumlah data per tanggal (perhari) dan per level
        var jumlahDataPerLevel = [];
        uniqueLevel.forEach(level => {
            var jumlahDataPerTanggal = [];
            uniqueTanggal.forEach(tanggal => {
                var jumlah = 0;
                data.forEach(element => {
                    if (element.level == level && element.tanggal.includes(tanggal)) {
                        jumlah++;
                    }
                });
                jumlahDataPerTanggal.push(jumlah);
            });
            jumlahDataPerLevel.push(jumlahDataPerTanggal);
        });

        const dataDiagram = {
            labels: uniqueTanggal,
            datasets: [
                {
                    label: uniqueLevel[idLevelD1],
                    backgroundColor: 'rgb(255, 99, 132)',
                    borderColor: 'rgb(255, 99, 132)',
                    data: jumlahDataPerLevel[idLevelD1],
                }
            ]
        };
        
        const config = {
            type: 'line',
            data: dataDiagram,
            options: {}
        };
        
        const myChart = new Chart(
            document.getElementById('diagram1'),
            config
        );
    }
})