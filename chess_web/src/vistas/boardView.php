<?php
    // ini_set("display_errors", "On");
    // ini_set("html_errors", 0);

    session_start();

    if (!isset($_SESSION['name']))
    {
        header("Location: index.php");
    }

    if ($_SESSION['premium'] == 0)
    {
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
</head>
<body>
    <header>
        <img src="../../img/gear.png" alt="Config" onclick="show_config()" id="config" class="">
        <a href="logout.php"><img src="../../img/logout.png" alt="Logout" id="logout"></a>
        <?php
            echo "<p id=\"username_view\">".$_SESSION['name']."</p>";

            if ($_SESSION['premium'] == 1)
            {
                echo "<img id=\"premium_sign\" src=\"../../img/premium.png\" alt=\"premium_sign\">";
            }
        ?>
        <h1>Chess</h1>
        <nav id="buttons">
            <a href="new_gameView.php"><button>New Game</button></a>
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
        function AssembleBoard($game)
        {
            echo "<div id=\"board\">";
            
            for ($row = 0; $row < 8; $row++)
            {
                for ($column = 0; $column < 8; $column++)
                {
                    if (($row + $column) % 2 == 0)
                    {
                        $sectionColor = "White";
                    }
                    else
                    {
                        $sectionColor = "Black";
                    }

                    echo "<div id=\"section$row|$column\" class=\"{$sectionColor} section\">";
                        if ($game[$row][$column] != 0)
                        {
                            echo "<img src=\"../../img/{$game[$row][$column]}.png\" class=\"piece\">";
                        }
                    echo "</div>";
                }
            }

            echo "</div>";
        }

        function AssembleBlackCatches($boardPieces, $contPieces) {
            echo "<div id=\"blackCatches\">";

            for ($i = 0; $i < ($boardPieces["PAWH"] - $contPieces["PAWH"]); $i++)
            {
                echo "<div class=\"deathZone\">";
                    echo "<img src=\"../../img/PAWH.png\">";
                echo "</div>";
            }
            for ($i = 0; $i < ($boardPieces["ROWH"] - $contPieces["ROWH"]); $i++)
            {
                echo "<div class=\"deathZone\">";
                    echo "<img src=\"../../img/ROWH.png\">";
                echo "</div>";
            }
            for ($i = 0; $i < ($boardPieces["KNWH"] - $contPieces["KNWH"]); $i++)
            {
                echo "<div class=\"deathZone\">";
                    echo "<img src=\"../../img/KNWH.png\">";
                echo "</div>";
            }
            for ($i = 0; $i < ($boardPieces["BIWH"] - $contPieces["BIWH"]); $i++)
            {
                echo "<div class=\"deathZone\">";
                    echo "<img src=\"../../img/BIWH.png\">";
                echo "</div>";
            }
            for ($i = 0; $i < ($boardPieces["QUWH"] - $contPieces["QUWH"]); $i++)
            {
                echo "<div class=\"deathZone\">";
                    echo "<img src=\"../../img/QUWH.png\">";
                echo "</div>";
            }
            for ($i = 0; $i < ($boardPieces["KIWH"] - $contPieces["KIWH"]); $i++)
            {
                echo "<div class=\"deathZone\">";
                    echo "<img src=\"../../img/KIWH.png\">";
                echo "</div>";
            }

            echo "</div>";
        }

        function AssembleWhiteCatches($boardPieces, $contPieces)
        {
            echo "<div id=\"whiteCatches\">";

            for ($i = 0; $i < ($boardPieces["PABL"] - $contPieces["PABL"]); $i++)
            {
                echo "<div class=\"deathZone\">";
                    echo "<img src=\"../../img/PABL.png\">";
                echo "</div>";
            }
            for ($i = 0; $i < ($boardPieces["ROBL"] - $contPieces["ROBL"]); $i++)
            {
                echo "<div class=\"deathZone\">";
                    echo "<img src=\"../../img/ROBL.png\">";
                echo "</div>";
            }
            for ($i = 0; $i < ($boardPieces["KNBL"] - $contPieces["KNBL"]); $i++)
            {
                echo "<div class=\"deathZone\">";
                    echo "<img src=\"../../img/KNBL.png\">";
                echo "</div>";
            }
            for ($i = 0; $i < ($boardPieces["BIBL"] - $contPieces["BIBL"]); $i++)
            {
                echo "<div class=\"deathZone\">";
                    echo "<img src=\"../../img/BIBL.png\">";
                echo "</div>";
            }
            for ($i = 0; $i < ($boardPieces["QUBL"] - $contPieces["QUBL"]); $i++)
            {
                echo "<div class=\"deathZone\">";
                    echo "<img src=\"../../img/QUBL.png\">";
                echo "</div>";
            }
            for ($i = 0; $i < ($boardPieces["KIBL"] - $contPieces["KIBL"]); $i++)
            {
                echo "<div class=\"deathZone\">";
                    echo "<img src=\"../../img/KIBL.png\">";
                echo "</div>";
            }

            echo "</div>";
        }

        function DrawChessGame($board)
        {
            $contPieces = array
            (
                "PABL" => 0,
                "ROBL" => 0,
                "KNBL" => 0,
                "BIBL" => 0,
                "QUBL" => 0,
                "KIBL" => 0,
                "PAWH" => 0,
                "ROWH" => 0,
                "KNWH" => 0,
                "BIWH" => 0,
                "QUWH" => 0,
                "KIWH" => 0
            );

            $boardPieces = array
            (
                "PABL" => 8,
                "ROBL" => 2,
                "KNBL" => 2,
                "BIBL" => 2,
                "QUBL" => 1,
                "KIBL" => 1,
                "PAWH" => 8,
                "ROWH" => 2,
                "KNWH" => 2,
                "BIWH" => 2,
                "QUWH" => 1,
                "KIWH" => 1
            );

            $rowsGame = explode("_", $board);
            $gameboard = array();

            for ($i = 0; $i < count($rowsGame); $i++)
            {
                $gameboard[$i] = explode(",", $rowsGame[$i]);
            }

            echo "<div id=\"game\">";

            for ($row = 0; $row < 8; $row++)
            {
                for ($column = 0; $column < 8; $column++)
                {
                    switch ($gameboard[$row][$column])
                    {
                        case "PAWH":
                            $contPieces["PAWH"]++;
                            break;
                        case "ROWH":
                            $contPieces["ROWH"]++;
                            break;
                        case "KNWH":
                            $contPieces["KNWH"]++;
                            break;
                        case "BIWH":
                            $contPieces["BIWH"]++;
                            break;
                        case "QUWH":
                            $contPieces["QUWH"]++;
                            break;
                        case "KIWH":
                            $contPieces["KIWH"]++;
                            break;
                        case "PABL":
                            $contPieces["PABL"]++;
                            break;
                        case "ROBL":
                            $contPieces["ROBL"]++;
                            break;
                        case "KNBL":
                            $contPieces["KNBL"]++;
                            break;
                        case "BIBL":
                            $contPieces["BIBL"]++;
                            break;
                        case "QUBL":
                            $contPieces["QUBL"]++;
                            break;
                        case "KIBL":
                            $contPieces["KIBL"]++;
                            break;
                    }
                }
            }

            AssembleBlackCatches($boardPieces, $contPieces);

            AssembleBoard($gameboard);

            AssembleWhiteCatches($boardPieces, $contPieces);

            echo "</div>";

            require("../negocio/api_Rules.php");
            $apiBL = new Api_Rules();
    
            $scoreboard = $apiBL->toGet($board);

            $whiteScore = $scoreboard["getMaterialValorWhite"];
            $blackScore = $scoreboard["getMaterialValorBlack"];
            $distance = $scoreboard["getMessageDist"];

            echo "<div id=\"scoreboard\">";

                echo "<h3>Scoreboard</h3>";
                echo "<br>";
                echo "<p><b>White: </b>".$whiteScore."</p>";
                echo "<br>";
                echo "<p><b>Black: </b>".$blackScore."</p>";
                echo "<br>";
                echo "<p>".$distance."</p>";

            echo "</div>";
        }

        $id = $_GET["game_id"];

        require("../negocio/boardStatus_Rules.php");
        $boardBL = new BoardStatus_Rules();
        $boardStatusList = $boardBL->toGet($id);

        $turn = $_GET['turn'];
        $lastTurn = count($boardStatusList)-1;
        $prevTurn = 0;
        $nextTurn = $lastTurn;

        if ($turn != 0)
        {
            $prevTurn = $turn - 1;
        }

        if ($turn != $lastTurn)
        {
            $nextTurn = $turn + 1;
        }
    ?>
    <div id="navigate">
        <?php
            echo "<b>Turn: ".($_GET["turn"]+1)."</b>";
            echo "<a href=\"boardView.php?game_id={$id}&turn=0\" id=\"start\">First</a>";
            echo "<a href=\"boardView.php?game_id={$id}&turn={$prevTurn}\" id=\"previous\">Previous</a>";
            echo "<a href=\"boardView.php?game_id={$id}&turn={$nextTurn}\" id=\"next\">Next</a>";
            echo "<a href=\"boardView.php?game_id={$id}&turn={$lastTurn}\" id=\"end\">Last</a>";
        ?>
    </div>
    <?php
        DrawChessGame($boardStatusList[$turn]->getBoard());
    ?>
    <footer>
        <a href="privacyPolicies.php" id="link_policies">Privacy policy</a>
    </footer>
</body>
</html>