$(document).ready(function () {
    let tweetTxt = $("#postContent")
    let tweetFile = $("#postFile")
    let numberCaracter = $("#numberCaracter")
    const tweetContainer = $('#allContent');
    const imgPreview = $("#imgPreview")

    $("#formPost").submit((e) => {
        e.preventDefault()
        let formData = new FormData();
        if (tweetFile.val() !== "" || tweetTxt.val().trim() !== "") {
            if (tweetFile.val() !== "") {
                let file = $.fn.ConvertFiles(tweetFile, false)

                formData.append("media", file);
            }
            if (tweetTxt.val() !== "") {

                formData.append("content", tweetTxt.val());
            }


            $.ajax({
                type: "POST",
                url: "http://localhost/Tweeter_Clone/post",
                data: formData,
                contentType: false,
                processData: false,
                success: (success) => {
                    tweetTxt.val("")
                    tweetFile.val("")
                    imgPreview.empty();

                    if (success.success) {
                        tweetContainer.empty();
                        let posts = success.message.reverse()
                        posts.forEach(post => {
                            const tweetDiv = $('<div class="tweet"></div>');
                            const cardDiv = $('<div class="card"></div>');
                            const headerDiv = $('<div class="headerCard"></div>');
                            const userInfoDiv = $('<div class="userInfo"></div>');
                            const imgProfilDiv = $('<div class="imgProfil"><img src="./assets/favicon.webp" alt=""></div>');
                            const infoTextDiv = $('<div class="infoText"></div>');
                            const userNameDiv = $('<div class="userName">The ripper</div>');
                            const userPostDiv = $(`<div class="userPost">${post.content}</div>`);
                            const mediaCardDiv = $('<div class="mediaCard"></div>');
                            const mediaDiv = $('<div class="media"></div>');
                            const mediaImg = $(`<img src="${post.media}" alt="">`);
                            const footCardDiv = $('<div class="footCard"></div>');
                            const innerFootDiv = $('<div class="innerFoot"></div>');
                            const commentaireDiv = $('<div class="commentaire"><i class="fa-regular fa-comment"></i><span class="commentStat">233</span></div>');
                            const shareDiv = $('<div class="commentaire"><i class="fa-solid fa-retweet"></i><span class="shareStat">233</span></div>');
                            const reactDiv = $('<div class="commentaire"><i class="fa-regular fa-heart"></i><span class="reactStat">233</span></div>');


                            mediaDiv.append(mediaImg);
                            mediaCardDiv.append(mediaDiv);
                            infoTextDiv.append(userNameDiv);
                            infoTextDiv.append(userPostDiv);
                            userInfoDiv.append(imgProfilDiv);
                            userInfoDiv.append(infoTextDiv);
                            headerDiv.append(userInfoDiv);
                            footCardDiv.append(innerFootDiv);
                            innerFootDiv.append(commentaireDiv);
                            innerFootDiv.append(shareDiv);
                            innerFootDiv.append(reactDiv);
                            tweetDiv.append(cardDiv);
                            cardDiv.append(headerDiv);
                            cardDiv.append(mediaCardDiv);
                            cardDiv.append(footCardDiv);
                            tweetContainer.append(tweetDiv);


                            commentaireDiv.on('click', function () {

                                $('.commentSection').not($(this).closest('.card').find('.commentSection')).hide();


                                $(this).closest('.card').find('.commentSection').toggle();
                            });
                        });

                    }
                },
                error: function (xhr, status, error) {
                    console.error(error);
                }
            });
        }

    })


    let limitText;
    tweetTxt.on("input", () => {
        const max = 142;
        let size = tweetTxt.val().length
        if (max >= size) {
            numberCaracter.text(`${size}/142`)
            limitText = tweetTxt.val()

            let op= tweetTxt.val().split(' ')
            let at = op[op.length-1].startsWith('@')
            let hash = op[op.length-1].startsWith('#')
            

            if (at || hash) {
                $(".tag").show();
                let txt =op.pop()
                let array = txt.split('')
                let tag = array.shift()
                let seems = array.join("")
                
                $.ajax({
                    type: "POST",
                    url:"http://localhost/Tweeter_Clone/tag",
                    data: { tag: tag, seems: seems },
                    success: function(response) {
                        if (response.success) {
                            $("#tagUl").empty()
                            console.log(response.message);
                            response.message.forEach(suggested => {
                            
                                let li = $(`<li data-suggest="${suggested.id}">${tag}${suggested.pseudo}</li>`)
                                $("#tagUl").append(li)
                                li.click(()=>{
                                    let content = tweetTxt.val().replace(txt, li.text())
                                    tweetTxt.val(content)
                                })
                            });
                            
                        }
                    },
                    error: function(xhr, status, error) {
                        
                        console.error("Erreur lors de la requête POST :", error);
                    }
                });

            } else {
                $(".tag").hide();
                $("#tagUl").empty()
            }
        } else {
            tweetTxt.val(limitText)
        }

        if (tweetTxt.val() !== "") {
            tweetTxt.css({ "background": "#E8F0FE" })
        } else {
            tweetTxt.css({ "background": "inherit" })

        }
    })

    tweetFile.on("change", () => {
        $.fn.ConvertFiles(tweetFile, true)
    })

    $.fn.ConvertFiles = (imgId, simple = true) => {
        const file = imgId[0].files;
        let fileName = file[0].name;
        let allowedExtension = ['jpg', 'jpeg', 'png', 'gif', 'avi', 'mov', 'mpg', 'mp2', 'mp3', 'mp4', 'webp'];
        let extension = fileName.split(".").pop().toLowerCase();
        if (allowedExtension.includes(extension)) {


            if (simple) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    $('#preview').attr('src', e.target.result).show();
                }
                reader.readAsDataURL(file[0]);

            }

            return file[0];
        }
    }


})

