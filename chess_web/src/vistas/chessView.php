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
</head>
<body id="special_body">
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

        require("../negocio/api_Rules.php");
        require("../negocio/matches_Rules.php");
        require("../negocio/boardStatus_Rules.php");

        if (isset($_POST["title"]))
        {
            $_SESSION["title"] = $_POST["title"];
            $_SESSION["whitePlayer"] = $_POST["whitePlayer"];
            $_SESSION["blackPlayer"] = $_POST["blackPlayer"];
        }
        
        if (!isset($_SESSION["turn"]) || $_SESSION["turn"] == 0)
        {
            $matchesBL = new Matches_Rules();
            $boardStatusBL = new BoardStatus_Rules();
            $board = "ROBL,KNBL,BIBL,QUBL,KIBL,BIBL,KNBL,ROBL_PABL,PABL,PABL,PABL,PABL,PABL,PABL,PABL_0,0,0,0,0,0,0,0_0,0,0,0,0,0,0,0_0,0,0,0,0,0,0,0_0,0,0,0,0,0,0,0_PAWH,PAWH,PAWH,PAWH,PAWH,PAWH,PAWH,PAWH_ROWH,KNWH,BIWH,QUWH,KIWH,BIWH,KNWH,ROWH";
            $matchesBL->toSet($_SESSION["title"], $_SESSION["whitePlayer"], $_SESSION["blackPlayer"]);
            $boardStatusBL->toSet($board, $_SESSION['turn']);
        }
        else
        {
            $boardStatusBL = new BoardStatus_Rules();
            $lastState = $boardStatusBL->toGetLastStatus();

            foreach ($lastState as $state)
            {
                $board = $state->getBoard();
            }
        }

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
            if (isset($_POST['fromRow']))
            {
                $board = toMove($board);
            }

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
            $game = array();

            for ($i = 0; $i < count($rowsGame); $i++)
            {
                $game[$i] = explode(",", $rowsGame[$i]);
            }

            echo "<div id=\"game\">";

            for ($row = 0; $row < 8; $row++)
            {
                for ($column = 0; $column < 8; $column++)
                {
                    switch ($game[$row][$column])
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

            $apiBL = new Api_Rules();
    
            $scoreboard = $apiBL->toGet($board);

            $whiteScore = $scoreboard["getMaterialValorWhite"];
            $blackScore = $scoreboard["getMaterialValorBlack"];
            $distance = $scoreboard["getMessageDist"];

            AssembleBlackCatches($boardPieces, $contPieces);

            AssembleBoard($game);

            AssembleWhiteCatches($boardPieces, $contPieces);

            echo "</div>";

            echo "<div id=\"movement_board\">";

                echo "<h3>Movement</h3>";
                echo "<form action=\"chessView.php\" method=\"post\">";
                    echo "<label for=\"fr\">From row: </label>";
                    echo "<input type=\"text\" id=\"fr\" name=\"fromRow\">";
                    echo "<br />";

                    echo "<label for=\"fc\">From column: </label>";
                    echo "<input type=\"text\" id=\"fc\" name=\"fromColumn\">";
                    echo "<br />";

                    echo "<label for=\"tr\">To row: </label>";
                    echo "<input type=\"text\" id=\"tr\" name=\"toRow\">";
                    echo "<br />";

                    echo "<label for=\"tc\">To column: </label>";
                    echo "<input type=\"text\" id=\"tc\" name=\"toColumn\">";
                    echo "<br />";
                    echo "<br />";

                    echo "<input type=\"submit\" value=\"Submit\">";
                echo "</form>";
                
            echo "</div>";

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

        DrawChessGame($board);

        function toMove($board)
        {
            $_SESSION["turn"] = $_SESSION["turn"] + 1;

            $fromColumn = $_POST['fromColumn'];
            $fromRow = $_POST['fromRow'];
            $toColumn = $_POST['toColumn'];
            $toRow = $_POST['toRow'];

            $boardStatusBL = new BoardStatus_Rules();
            $apiBL = new Api_Rules();

            try
            {
                $move = $apiBL->toMove($board, $fromColumn, $fromRow, $toColumn, $toRow); 

                if ($move["valid"] == true)
                {
                    $boardStatusBL->toSet($move["board"], $_SESSION["turn"]);
                    $board = $move["board"];
                    
                    return $board;
                }
            }
            catch (Exception $ex)
            {
                $_SESSION["turn"] = $_SESSION["turn"] - 1;
                return $board;
            }

            return $board;
        }
    ?>
    <?php
        if (isset($error))
        {
            print("<div>Unexpected error</div>");
        }
    ?>
    <footer>
        <a href="privacyPolicies.php" id="link_policies">Privacy policy</a>
    </footer>
</body>
</html>