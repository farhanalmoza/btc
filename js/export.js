window.jsPDF = window.jspdf.jsPDF;

function generatePDF() {
    $.ajax({
        url: "./getAll.php",
        type: "POST",
        dataType: "json",
        success: function(data) {
            var judul = "Penambangan Sinyal Harian INDODAX \n";
            // cetak data dalam text
            var text = "";
            data.forEach(element => {
                // cetak semua data
                text += element.sinyal + " " + element.level + " " + element.tanggal + " " + element.hargaidr + " " + element.hargausdt + "\n";
            });
            // buat pdf
            var doc = new jsPDF();
            doc.text(judul, 10, 10);
            doc.text(text, 10, 20);
            doc.save("penambangan.pdf");
        }
    })
}

// export excel
function generateExcel() {
    var dataType = 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet';
    var tableSelector = document.getElementById('tabel-penambangan');
    var tableHTML = tableSelector.outerHTML.replace(/ /g, '%20');
    
    // filename
    var filename = "penambangan.xls";

    // specify file as an attachment or viewing in browser
    if (navigator.msSaveOrOpenBlob) {
        var blob = new Blob(['\ufeff', tableHTML], {
            type: dataType
        });
        navigator.msSaveOrOpenBlob(blob, filename);
    } else {
        var link = document.createElement('a');
        link.href = 'data:' + dataType + ', ' + tableHTML;
        link.download = filename;
        link.target = '_blank';
        document.body.appendChild(link);
        link.click();
        document.body.removeChild(link);
    }
}