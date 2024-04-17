$(document).ready(function () {
    const links = $(".links")
    // console.log(links);

    links.each((link) => {
        $(links[1]).css({"background":"rgba(28, 155, 241, .2)"})
        $(links[link]).on("click", ()=>{
            
            switch (link) {
                case 0:
                    $(links[link]).css({"background":"rgba(28, 155, 241, .2)"})
                    $(links[1]).css({"background":"none"})
                    $(links[2]).css({"background":"none"})
                    $(links[3]).css({"background":"none"})
                    $(links[4]).css({"background":"none"})
                    $(links[5]).css({"background":"none"})
                    $("#Edit").show()
                    $("#allTweets").hide()
                    $("#allReTweets").hide()
                    $("#allLikes").hide()
                    $("#followers").hide()
                    $("#followings").hide()
                    break;
                case 1:
                    $(links[link]).css({"background":"rgba(28, 155, 241, .2)"})
                    $(links[0]).css({"background":"none"})
                    $(links[2]).css({"background":"none"})
                    $(links[3]).css({"background":"none"})
                    $(links[4]).css({"background":"none"})
                    $(links[5]).css({"background":"none"})
                    $("#Edit").hide()
                    $("#allTweets").show()
                    $("#allReTweets").hide()
                    $("#allLikes").hide()
                    $("#followers").hide()
                    $("#followings").hide()
                    break;
                case 2:
                    $(links[link]).css({"background":"rgba(28, 155, 241, .2)"})
                    $(links[1]).css({"background":"none"})
                    $(links[0]).css({"background":"none"})
                    $(links[3]).css({"background":"none"})
                    $(links[4]).css({"background":"none"})
                    $(links[5]).css({"background":"none"})
                    $("#Edit").hide()
                    $("#allTweets").hide()
                    $("#allReTweets").show()
                    $("#allLikes").hide()
                    $("#followers").hide()
                    $("#followings").hide()
                    break;
                case 3:
                    $(links[link]).css({"background":"rgba(28, 155, 241, .2)"})
                    $(links[1]).css({"background":"none"})
                    $(links[2]).css({"background":"none"})
                    $(links[0]).css({"background":"none"})
                    $(links[4]).css({"background":"none"})
                    $(links[5]).css({"background":"none"})
                    $("#Edit").hide()
                    $("#allTweets").hide()
                    $("#allReTweets").hide()
                    $("#allLikes").show()
                    $("#followers").hide()
                    $("#followings").hide()
                    break;
                case 4:
                    $(links[link]).css({"background":"rgba(28, 155, 241, .2)"})
                    $(links[0]).css({"background":"none"})
                    $(links[1]).css({"background":"none"})
                    $(links[2]).css({"background":"none"})
                    $(links[3]).css({"background":"none"})
                    $(links[5]).css({"background":"none"})
                    $("#Edit").hide()
                    $("#allTweets").hide()
                    $("#allReTweets").hide()
                    $("#allLikes").hide()
                    $("#followers").show()
                    $("#followings").hide()
                    break;
                case 5:
                    $(links[link]).css({"background":"rgba(28, 155, 241, .2)"})
                    $(links[0]).css({"background":"none"})
                    $(links[1]).css({"background":"none"})
                    $(links[2]).css({"background":"none"})
                    $(links[3]).css({"background":"none"})
                    $(links[4]).css({"background":"none"})
                    $("#Edit").hide()
                    $("#allTweets").hide()
                    $("#allReTweets").hide()
                    $("#allLikes").hide()
                    $("#followers").hide()
                    $("#followings").show()
                    break;
            
                default:
                    $(links[0]).css({"background":"rgba(28, 155, 241, .2)"})
                    $(links[1]).css({"background":"none"})
                    $(links[2]).css({"background":"none"})
                    $(links[3]).css({"background":"none"})
                    $("#allTweets").show()
                    $("#Edit").hide()
                    $("#allReTweets").hide()
                    $("#allLikes").hide()
                    break;
            }
        })
        // $(link).show()
    })
});