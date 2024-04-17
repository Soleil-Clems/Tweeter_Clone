
$(document).ready(function () {
    $('#form').submit(function (e) {
        e.preventDefault();

        var formData = $(this).serialize();


        $.ajax({
            url: 'http://localhost/minimvc/',
            method: 'POST',
            data: formData,
            success: function (response) {
                if (response.success) {

                    console.log(response);
                } else {

                    console.log("Source code");
                    console.log(response);
                }
            },
            error: function (xhr, status, error) {
                console.error('Une erreur s\'est produite', error);
            }
        });
    });
});