$(document).ready(function () {
    $('#loginForm').submit(function (event) {
        event.preventDefault();

        let email = $('#emaillogin').val();
        let psw = $('#pswlogin').val();
        let mail = $.fn.verifyContent($('#emaillogin'))
        let pass = $.fn.verifyContent($('#pswlogin'))

        if (mail && pass) {

            $.ajax({
                url: "http://localhost/Tweeter_Clone/login",
                type: 'POST',
                data: $(this).serialize(),
                success: function (response) {
                    if (response.success) {
                        $("#responseMessage").text("Login succesfully")
                        $("#responseMessage").css({ "color": "green" })
                        $("#responseMessage").show()
                        window.location.href = 'profil';
                    } else {
                        $("#responseMessage").text("Email or password incorrect")
                        $("#responseMessage").css({ "color": "red" })
                        $("#responseMessage").show()

                    }
                    console.log(response);
                },
                error: function (xhr, status, error) {
                    console.error(error);
                }
            });
        }

    });

    $("#emaillogin").on("input", function () {
        let mail = $("#emaillogin");
        let isMail = /^[\w\.-]+@[a-zA-Z\d\.-]+\.[a-zA-Z]{2,}$/.test(mail.val());
        if (isMail) {
            mail.css({ "border": "1px solid rgba(28, 155, 241, 255)", "background": "white" });
        } else {
            mail.css({ "border": "1px solid red", "background": "rgba(255,0,0, .2)" });
        }
    })

    $.fn.verifyContent = function (input) {
        if (input.val().trim() == "") {
            input.css({ "border": "1px solid red" })
            input.css({ "background": "rgba(255,0,0, .2)" })
            error = false
        } else {
            input.css({ "border": "1px solid rgba(28, 155, 241, 255)" })
            input.css({ "background": "whithe" })
            error = true

        }
        return error
    }
});

