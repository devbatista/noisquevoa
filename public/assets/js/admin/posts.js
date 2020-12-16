$(document).ready(function() {
    $('.summernote').summernote();

    $('table').DataTable({
        "language": {
            "url": window.origin + "/assets/plugins/datatables/Portuguese-Brasil.json"
        }
    });
});