$(document).ready(function () {
    const followBtn = $(".followBtn");

    followBtn.each(function () {
        $(this).click(function () {
            const want = $(this).data('want');
            const target = $(this).data('target');
            $.fn.createFollower(target, want)

        });
    });

    $.fn.createFollower = (target, want) => {
        $.ajax({
            url: "http://localhost/Tweeter_Clone/follow",
            type: 'POST',
            data: { id: target, option: want },
            success: function (response) {
                if (response.success) {
                    $('.sug').empty()
                    response.message.forEach(suggestion => {

                        let line = $('<div class="line thinb"></div>');
                        let imgProfil = $(`<a href="./profil?uid=${suggestion.id}" class="imgProfil"><img src="${suggestion.profil}" alt="Profile Picture"></a>`);
                        let uInfo = $(`<a href="./profil?uid=${suggestion.id}" class="uInfo"><p>${suggestion.username}</p><p>@${suggestion.pseudo}</p></a>`);
                        let followBtn = $(`<div class="followBtn" data-want=true data-target="${suggestion.id}">Follow</div>`);
                        let followContainer = $('<div class="follow"></div>');


                        followContainer.append(followBtn);
                        line.append(imgProfil);
                        line.append(uInfo);
                        line.append(followContainer);

                        followBtn.click(() => {
                            const want1 = followBtn.data('want');
                            const target1 = followBtn.data('target');
                            console.log(want1);
                            console.log(target1);
                            $.fn.createFollower(target1, want1)
                        });
                        $('.sug').append(line);
                    })

                }
            },
            error: function (xhr, status, error) {
                console.error(error);
            }
        });
    }
});
