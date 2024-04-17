$(document).ready(function () {

    $('#registerForm').submit(function (event) {
        event.preventDefault();
// background: rgba(173, 216, 230, .2);
        let firstname = $('#firstname');
        let lastname = $('#lastname');
        let birthday = $('#birthday');
        let email = $('#email');
        let psw = $('#password');
        let cPsw = $('#confPassword');

        $.fn.verifyContent(firstname)
        $.fn.verifyContent(lastname)
        $.fn.verifyContent(birthday)
        $.fn.verifyContent(email)
        $.fn.verifyContent(psw)
        $.fn.verifyContent(cPsw)

        if ($.fn.verifyContent(firstname) && $.fn.verifyContent(lastname) && $.fn.verifyContent(birthday) && $.fn.verifyContent(email) && $.fn.verifyContent(psw) && $.fn.verifyContent(cPsw)) {

            $.ajax({
                url: 'http://localhost/Tweeter_Clone/register',
                type: 'POST',
                data: $(this).serialize(),
                success: function (response) {
                    if (response.success) {

                        window.location.href = 'profil';
                    } else {
                        $("#response").text(response.message)
                        $("#response").css({ "color": "red" })
                        $("#response").show()

                    }
                },
                error: function (xhr, status, error) {
                    console.error(error);
                }
            });
        }
    });

    $('#password').on('input', function () {
        let password = $(this).val();
        $('.password-criteria ').show();

        let isLengthValid = password.length >= 8 && password.length <= 50;
        let isMajValid = /[A-Z].*[A-Z]/.test(password);
        let isMinValid = /[a-z].*[a-z]/.test(password);
        let isNumericValid = password.match(/\d/g) ? password.match(/\d/g).length >= 2 : false;
        let isCharsValid = /[!@#$%^&*()-_=+{};:,<.>].*[!@#$%^&*()-_=+{};:,<.>]/.test(password);

        $('.password-criteria .length').css('color', isLengthValid ? 'green' : 'red');
        $('.password-criteria .numeric').css('color', isNumericValid ? 'green' : 'red');
        $('.password-criteria .maj').css('color', isMajValid ? 'green' : 'red');
        $('.password-criteria .min').css('color', isMinValid ? 'green' : 'red');
        $('.password-criteria .chars').css('color', isCharsValid ? 'green' : 'red');
        if (isLengthValid && isNumericValid && isMajValid && isMinValid && isCharsValid) {
            $('.password-criteria').hide();
        } else {
            $('.password-criteria').show();
        }

        let cf = $('#confPassword');
        let pass = $('#password');

        if (cf.val() == pass.val()) {
            cf.css({ "border": "1px solid black", "background": "white" });
        } else {
            cf.css({ "border": "1px solid red", "background": "rgba(255,0,0, .2)" });
        }

        if ($('#confPassword').val() != $('#password').val()) {
            $('#updateBtn').hide()
        } else {
            $('#updateBtn').show()

        }

        if (password == "") {
            $('.password-criteria').hide();
        }
    });

    $('#confPassword').on("input", function () {
        let cf = $('#confPassword');
        let pass = $('#password');

        if (cf.val() == pass.val()) {
            cf.css({ "border": "1px solid rgba(28, 155, 241, 255)", "background": "white" });
        } else {
            cf.css({ "border": "1px solid red", "background": "rgba(255,0,0, .2)" });
        }

        if ($('#confPassword').val() != $('#password').val()) {
            $('#updateBtn').hide()
        } else {
            $('#updateBtn').show()

        }
    });

    $("#email").on("input", function () {
        let mail = $("#email");
        let isMail = /^[\w\.-]+@[a-zA-Z\d\.-]+\.[a-zA-Z]{2,}$/.test(mail.val());
        if (isMail) {
            mail.css({ "border": "1px solid white", "background": "white" });
        } else {
            mail.css({ "border": "1px solid red", "background": "rgba(255,0,0, .2)" });
        }
    });

    $("#birthday").on("change", () => {
        let selectedDate = $("#birthday").val();
        let dateOfBirth = new Date(selectedDate);

        let today = new Date();


        let age = today.getFullYear() - dateOfBirth.getFullYear();

        if (age >= 18 && age <= 70) {
            $("#ageVerif").hide()
            $("#birthday").css({ "border": "1px solid rgba(28, 155, 241, 255)", "background": "white" });
        } else {
            $("#ageVerif").show()
            $("#ageVerif").css({ "color": "red" });
            $("#birthday").css({ "border": "1px solid red", "background": "rgba(255,0,0, .2)" });



        }


    });
});
