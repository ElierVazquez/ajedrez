<?php
    session_start();

    if (!isset($_SESSION['name']))
    {
        header("Location: index.php");
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Chess</title>
    <link rel="stylesheet" href="../../css/chess_game_styles.css">
    <script src="../../js/menu_config.js"></script>
</head>
<body>
    <header>
        <img src="../../img/gear.png" alt="Config" onclick="show_config()" id="config" class="">
        <a href="logout.php"><img src="../../img/logout.png" alt="Logout" id="logout"></a>
        <?php
            echo "<p id=\"username_view\">".$_SESSION['name']."</p>";
            $_SESSION["turn"] = 0;
            if ($_SESSION['premium'] == 1)
            {
                echo "<img id=\"premium_sign\" src=\"../../img/premium.png\" alt=\"premium_sign\">";
            }
        ?>
        <h1>Chess</h1>
        <nav id="buttons">
            <a href="mainPage.php"><button>Main page</button></a>
            <?php
                if ($_SESSION['premium'] == 1)
                {
                    echo "<a href=\"gameListView.php\"><button>Game list</button></a>";
                }
            ?>
        </nav>
    </header>
    <div id="config_menu" class="config_hide">
        <ul id="config_list" class="hide_list">
            <li>In maintenance</li>
        </ul>
    </div>
    <?php
        require("../negocio/players_Rules.php");
        $playersBL = new Players_Rules();
        $playersInfo = $playersBL->toGet();

        $_SESSION["turn"] = 0;
    ?>
    <form action="chessView.php" method="post" id="form">
        <label for="whitePlayer">White player</label>
        <select name="whitePlayer" id="whitePlayer">
            <?php
                foreach ($playersInfo as $player)
                {
                    echo "<option value=\"{$player->getID()}\">{$player->getName()}</option>";
                }
            ?>
        </select> <br>
        <label for="blackPlayer">Black player</label>
        <select name="blackPlayer" id="blackPlayer">
            <?php
                foreach ($playersInfo as $player)
                {
                    echo "<option value=\"{$player->getID()}\">{$player->getName()}</option>";
                }
            ?>
        </select> <br> <br>
        <label for="title">Title of the game</label>
        <input type="text" name="title" id="title"> <br> <br>
        <input type="submit" value="Submit" id="submit_button">
    </form>
    <footer>
        <a href="privacyPolicies.php" id="link_policies">Privacy policy</a>
    </footer>
</body>
</html>