<?php

require("../infraestructura/users_DataAccess.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $u = new Users_DataAccess();
    $u->toInsert($_POST['username'], $_POST['email'], $_POST['user_psw'], $_POST['premium']);

    header("Location: mainPage.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Chess</title>
    <link rel="stylesheet" href="../../css/chess_game_styles.css">
    <script src="../../js/menu_config.js"></script>
    <script src="../../js/psw_button.js"></script>
</head>
<body id="special_body">
    <header>
        <img src="../../img/gear.png" alt="Config" onclick="show_config()" id="config" class="">
        <h1>Chess</h1>
        <nav id="buttons">
            <a href="index.php"><button>Login page</button></a>
        </nav>
    </header>
    <div id="config_menu" class="config_hide">
        <ul id="config_list" class="hide_list">
            <li>In maintenance</li>
        </ul>
    </div>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" id="register_form">
        <label for="username">Username</label>
        <input type="text" name="username" id="username" class="register_form">

        <label for="email">Email</label>
        <input type="email" name="email" id="email" class="register_form">

        <label for="user_psw">Password</label>
        <input type="password" name="user_psw" id="user_psw" class="register_form" minlength="8">

        <img src="../../img/show.svg" alt="Show/hide password" id="psw_button" onclick="show()">

        <input type="checkbox" name="premium" id="premium">
        <label for="premium">Premium</label>

        <input type="submit" value="Register" id="form_button">
    </form>
    <footer>
        <a href="privacyPolicies.php" id="link_policies">Privacy policy</a>
    </footer>
</body>
</html>