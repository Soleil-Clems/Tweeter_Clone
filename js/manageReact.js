$(document).ready(function(){
    $(".commentaire").click(function(){
        
        $(".commentSection").not($(this).closest('.card').find('.commentSection')).hide();
        
        
        $(this).closest('.card').find('.commentSection').toggle();
    });


    $(".share").click(function(){
        let cardId = $(this).data('target');
        let userId = $(this).data('uid')
        
        $.ajax({
            type: "POST",
            url:"http://localhost/Tweeter_Clone/share",
            data: { postId: cardId, retweeter_id: userId},
            success: function(response) {
                if (response.success) {
                    
                }
                console.log(response);
            },
            error: function(xhr, status, error) {
                
                console.error("Erreur lors de la requête POST :", error);
            }
        });
    });
});