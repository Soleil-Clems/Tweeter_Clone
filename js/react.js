$(document).ready(function () {

    $(".reaction").click(function () {
        
        var reactionElement = $(this);

        let cardId = reactionElement.data('target');
        $.ajax({
            type: "POST",
            url: "http://localhost/Tweeter_Clone/like",
            data: { postId: cardId },
            success: function (response) {
                if (response.success) {
                    
                    reactionElement.find('.reacStat').text(response.message.like);
                    reactionElement.find('.fa-heart').css({"color":"red"})
                }
                console.log(response);
            },
            error: function (xhr, status, error) {
                console.error("Erreur lors de la requête POST :", error);
            }
        });
    });
});
