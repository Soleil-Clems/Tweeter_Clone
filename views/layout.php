<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tweet Académie - Partagez votre expérience Twitter</title>
    <meta name="description" content="Découvrez Tweet Académie pour des tweets exceptionnels. Partagez vos pensées, découvrez de nouveaux sujets et connectez-vous avec d'autres utilisateurs.">
    <meta name="keywords" content="Tweet Académie, tweets, partage, connexion">
    <meta name="author" content="Tweet Académie">
    <meta name="robots" content="index, follow">
    <link rel="shortcut icon" href="./assets/favicon.webp" type="image/x-icon">
    <!-- Metadonnées Open Graph pour Facebook -->
    <meta property="og:title" content="Tweet Académie - Partagez votre expérience Twitter">
    <meta property="og:description" content="Découvrez Tweet Académie pour des tweets exceptionnels. Partagez vos pensées, découvrez de nouveaux sujets et connectez-vous avec d'autres utilisateurs.">
    <meta property="og:type" content="website">
    <meta property="og:url" content="URL_de_votre_site">
    <meta property="og:image" content="URL_de_l'image_à_afficher_sur_les_réseaux_sociaux">
    <!-- Metadonnées Twitter Card -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="Tweet Académie - Partagez votre expérience Twitter">
    <meta name="twitter:description" content="Découvrez Tweet Académie pour des tweets exceptionnels. Partagez vos pensées, découvrez de nouveaux sujets et connectez-vous avec d'autres utilisateurs.">
    <meta name="twitter:image" content="URL_de_l'image_à_afficher_sur_Twitter">
    <!-- Inclure Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer">
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="./css/profil.css">
    <link rel="stylesheet" href="./css/header.css">
    <link rel="stylesheet" href="./css/comment.css">
</head>

<body>

    <body>
        <section id="mainSection">
            <header>

                <div class="proposition">
                    <div class="corner sug">
                        <h2>They have TweetX</h2>
                        <?php foreach ($suggested as $key => $invitation) { ?>
                            <div class="line">
                                <a href="./profil?uid=<?=$suggested[$key]["id"]?>" class="imgProfil">
                                    <img src="<?= $suggested[$key]["profil"] ?>" alt="Profile Picture">
                                </a>
                                <a href="./profil?uid=<?=$suggested[$key]["id"]?>" class="uInfo">
                                    <p><?= $suggested[$key]["pseudo"] ?></p>
                                    <p>@<?= $suggested[$key]["username"] ?></p>
                                </a>
                                <div class="follow">
                                    <div class="followBtn" data-want=true data-target="<?= $suggested[$key]["id"] ?>">Follow</div>
                                </div>
                            </div>
                        <?php } ?>
                        
                    </div>
                    <div class="corner">
                        <h2>All <span id="tag">#hashtag</span></h2>
                        <?php foreach ($hashtags as $key => $hashtag) { ?>

                            <div class="tagParent">
                                <a href="#" class="tags">
                                    <p><?= $key + 1 ?>-Trends</p>
                                    <h4>#<?= $hashtag["name"] ?></h4>
                                    <p>100k posts</p>
                                </a>
                            </div>
                        <?php } ?>
                        <div class="tagParent">
                            <a href="#" class="tags">
                                <p>2-Trends</p>
                                <h4>#Blackclover</h4>
                                <p>100k posts</p>
                            </a>
                        </div>
                        <div class="tagParent">
                            <a href="#" class="tags">
                                <p>3-Trends</p>
                                <h4>#Amapiano</h4>
                                <p>100k posts</p>
                            </a>
                        </div>
                    </div>
                </div>
            </header>
            <aside>
                <div class="logo"><img id="logoImg" src="../assets/logo.webp" alt="Logo"></div>
                <nav>
                    <ul>
                        <li><a href="./"><i class="fa-solid fa-house"></i> <span class="hideLink">Home</span></a></li>
                        <li><a href="./explore"><i class="fa-solid fa-magnifying-glass"></i> <span class="hideLink">Explore</span></a></li>
                        <li><a href="#"><i class="fa-solid fa-bell"></i> <span class="hideLink">Notifications</span></a>
                        </li>
                        <li><a href="#"><i class="fa-solid fa-envelope"></i> <span class="hideLink">Messages</span></a>
                        </li>
                        <li><a href="./profil"><i class="fa-solid fa-user"></i><span class="hideLink">Profil</span></a></li>
                    </ul>
                </nav>
            </aside>
            <main>
                <div class="block">
                    <?= $content ?>
                </div>
            </main>
        </section>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
        <script src="./js/ajax.js"></script>
        <script src="./js/publication.js"></script>
        <script src="./js/profilTweet.js"></script>
        <script src="./js/theme.js"></script>
        <script src="./js/manageReact.js"></script>
        <script src="./js/updateUserPicture.js"></script>
        <script src="./js/updateUserInfo.js"></script>
        <script src="./js/comments.js"></script>
        <script src="./js/follow.js"></script>
        <script src="./js/react.js"></script>
        <?php if ($title == "Profil") { ?>
            <script src="./js/switchTheme.js"></script>
        <?php } ?>
    </body>
</body>

</html>