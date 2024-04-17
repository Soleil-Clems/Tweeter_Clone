$(document).ready(function () {
    $("#profilImg").change(function () {
        const file = $("#profilImg")[0].files;
        let fileName = file[0].name;
        let allowedExtension = ['jpg', 'jpeg', 'png'];
        let extension = fileName.split(".").pop();
        if (allowedExtension.includes(extension)) {
            let formData = new FormData();
            formData.append('profil', file[0]);
            $.ajax({
                url: 'http://localhost/Tweeter_Clone/imgprofil',
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function (response) {
                    
                    window.location.href = 'profil'
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    console.error("Erreur lors de l'envoi de la requête : ", response);
                }
            });
        }else{
            alert("Le format de l'image doit etre: jpg, jpeg ou png ")
        }
    });

    $("#bannerImg").change(function () {
        const file = $("#bannerImg")[0].files;
        let fileName = file[0].name;
        let allowedExtension = ['jpg', 'jpeg', 'png'];
        let extension = fileName.split(".").pop();
        if (allowedExtension.includes(extension)) {
            let formData = new FormData();
            formData.append('banner', file[0]);
            $.ajax({
                url: 'http://localhost/Tweeter_Clone/imgbanner',
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function (response) {
                    
                    window.location.href = 'profil'
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    console.error("Erreur lors de l'envoi de la requête : ", response);
                }
            });
        }else{
            alert("Le format de l'image doit etre: jpg, jpeg ou png ")
        }
    });
});