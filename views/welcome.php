<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome - Partagez votre expérience Twitter</title>
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
    <link rel="stylesheet" href="./css/welcome.css">
</head>

<body>
    <section class="welcomeSection">
        <div class="switch">
            <div class="same register">
                <h2>Already have an account</h2>
                <button ID="choosedLogin">Login</button>
            </div>
            <div class="same login">
                <h2>Not a member</h2>
                <button ID="choosedRegister">Register</button>
            </div>
            <div class="swipe">
                <div id="login">

                    <h1>Login</h1>
                    <form action="" method="post" id="loginForm">
                        <input type="email" class="samein" id='emaillogin' name="email" placeholder="example@gmail.com">
                        <input type="password" autocomplete="true" class="samein" name="psw" id="pswlogin" placeholder="*********">
                        <div id="responseMessage" class="inerror" hidden></div>
                        <input type="submit" name="login" value="Login" id="loginBtn">
                    </form>
                </div>
                <div id="signIn">
                    <h1>Sign in</h1>
                    <form action="" method="post" id="registerForm">

                        <input class="samein" type="text" name="username" placeholder="Username" id="firstname"><br>
                        <input class="samein" type="text" name="pseudo" placeholder="pseudo" id="lastname"><br>
                        <div class="yourage">
                            <input class="samein" type="date" name="birthday" placeholder="Birthday" id="birthday"><br>
                            <div id="ageVerif" class="error" hidden>Age must be bettween 18 - 70</div>
                        </div>


                        <input class="samein" type="email" name="email" placeholder="yourmail@gmail.com" id="email"><br>
                        <input class="samein" type="password" autocomplete="true" name="psw" placeholder="Password" id="password"><br>
                        <div class="password-criteria error" hidden>
                            <p class="length">Length between 8 to 50</p>
                            <p class="numeric">At least 2 numbers</p>
                            <p class="maj">At least 2 capital letters</p>
                            <p class="min">At least 2 capital lowercase</p>
                            <p class="chars">At least 2 capital special characters</p>
                        </div>
                        <input class="samein" type="password" autocomplete="true" name="cPsw" placeholder="Confirme password" id="confPassword"><br>

                        <div id="response" class="error" hidden></div>
                        <input class="same" type="submit" name="register" value="register" id="registerBtn">
                    </form>
                </div>
            </div>
        </div>
    </section>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="./js/welcome.js"></script>
    <script src="./js/login.js"></script>
    <script src="./js/register.js"></script>
</body>

</html>