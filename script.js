$(document).ready(function() {
    // Selector input yang akan menampilkan autocomplete.
    $( "#search" ).autocomplete({
        source: "./autocomplete.php",
    });
})