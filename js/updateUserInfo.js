$(document).ready(function () {
    const bio = $("#bio");
    const pseudo = $("#pseudo")
    const userName = $("#uName")
    const actualPass = $("#actualPass")
    const newPass = $("#newPass")
    const cfPass = $("#cfPass")
    let limitText;

    $("#editForm").submit((event) => {
        event.preventDefault();
        $.fn.verifyContent(userName)
        $.fn.verifyContent(pseudo)

        if ($.fn.verifyContent(userName) && $.fn.verifyContent(pseudo)) {
            $.ajax({
                url: "http://localhost/Tweeter_Clone/update",
                type: 'POST',
                data:{username:userName.val(), pseudo: pseudo.val(), psw:actualPass.val(), newPsw: newPass.val(), cfPsw: cfPass.val(), bio:bio.val()},
                success: function (response) {
                    if (response.success) {
                        
                        window.location.href = 'profil';
                    } else {
                        

                    }
                    console.log(response);
                },
                error: function (xhr, status, error) {
                    console.error(error);
                }
            });
        }

    })
    bio.on("input", () => {
        const max = 142;
        let size = bio.val().length
        if (max >= size) {
            limitText = bio.val()


        } else {
            bio.val(limitText)
        }

        if (bio.val() !== "") {
            bio.css({ "background": "rgba(28, 155, 241, .2)" })
        } else {
            bio.css({ "background": "inherit" })

        }
    })

    newPass.on('input', function () {
        
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

        let cf = cfPass;
        let pass = newPass;

        if (cf.val() == pass.val()) {
            cf.css({ "border": "1px solid black", "background": "white" });
        } else {
            cf.css({ "border": "1px solid red", "background": "rgba(255,0,0, .2)" });
        }

        if ($('#confPassword').val() != newPass.val()) {
            $('#update').hide()
        } else {
            $('#update').show()

        }

        if (password == "") {
            $('.password-criteria').hide();
        }

        if (cf.val() === pass.val()) {
            $('#update').show()

        }

        if (actualPass.val() !="" && newPass.val() !="" || actualPass.val() == "" && newPass.val() == "") {
            $('#update').show()
        }else{
            $('#update').hide()
        }
    });

    cfPass.on("input", function () {
        let cf = cfPass;
        let pass = newPass;

        if (cf.val() == pass.val()) {
            cf.css({ "border": "1px solid rgba(28, 155, 241, 255)", "background": "inherit" });
        } else {
            cf.css({ "border": "1px solid red", "background": "gray" });
        }

        if ($('#confPassword').val() != newPass.val()) {
            $('#update').hide()
        } else {
            $('#update').show()

        }

        if (cf.val() === pass.val()) {
            $('#update').show()

        }

        if (actualPass.val() !="" && newPass.val() !="" || actualPass.val() == "" && newPass.val() == "") {
            $('#update').show()
        }else{
            $('#update').hide()
        }

        
    });

    actualPass.on("input", ()=>{
        if (actualPass.val() !="" && newPass.val() !="" || actualPass.val() == "" && newPass.val() == "") {
            $('#update').show()
        }else{
            $('#update').hide()
        }


    })

    $.fn.verifyContent = function (input) {
        if (input.val().trim() == "") {
            input.css({ "border": "1px solid red" })
            input.css({ "background": "rgba(255,0,0, .2)" })
            error = false
        } else {
            input.css({ "border": "1px solid gray" })
            input.css({ "background": "inherit" })
            error = true

        }
        return error
    }
});