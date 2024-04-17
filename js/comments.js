$(document).ready(function () {
    $(".postComment").submit(function (event) {
        event.preventDefault();
        let cardId = $(this).data('target');
        let comment = $(this).find(".com").val();
        let $commentSection = $(this).closest(".footCard").find(".commentSection");


        $.ajax({
            type: "POST",
            url: "http://localhost/Tweeter_Clone/comment",
            data: { postId: cardId, comment: comment },
            success: function (response) {
                if (response.success) {
                    $(".com").val("");
                    $commentSection.find(".containComment").empty();
                    response.message.forEach(com => {
                        let comment = $("<div class='comment'></div>");
                        let link1 = $(`<a href='./profil?uid=${com.id}'><div class='imgProfil rounded'><img src='${com.profil}' alt='Profil'></div></a>`);
                        let msgBox = $(`<div class="boxMsg"><div class="user"><a href="./profil?uid=${com.id}">${com.username}</a><a href="./profil?uid=${com.id}">@${com.pseudo}</a></div><div class="contentMsg">${com.comment}</div></div>`);
                        comment.append(link1);
                        comment.append(msgBox);
                        $commentSection.find(".containComment").append(comment);
                    });
                }
                console.log(response);
            },
            error: function (xhr, status, error) {
                console.error("Erreur lors de la requête POST :", error);
            }
        });
    });
});
