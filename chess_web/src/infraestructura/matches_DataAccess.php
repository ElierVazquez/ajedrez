<?php
    class Matches_DataAccess 
    {
        function __construct()
        {}

        function toSet($title, $whitePlayer, $blackPlayer)
        {
            $connection = mysqli_connect('localhost', 'root', '12345678');
            if (mysqli_connect_errno())
            {
                echo 'Error connecting to MySQL: '.mysqli_connect_error();
            }

            mysqli_select_db($connection, "chess_game");

            $sanitized_white = mysqli_real_escape_string($connection, $whitePlayer);
            $sanitized_black = mysqli_real_escape_string($connection, $blackPlayer);
            $sanitized_title = mysqli_real_escape_string($connection, $title);
            $insert_match = mysqli_prepare($connection, "INSERT INTO T_Matches(title, white, black, startDate, state) VALUES (?, ?, ?, NOW(), \"En curso\");");
            $insert_match->bind_param("sii", $sanitized_title, $sanitized_white, $sanitized_black);
            $insert_match->execute();
        }

        function toGet()
        {
            $connection = mysqli_connect('localhost', 'root', '12345678');
            if (mysqli_connect_errno())
            {
                echo 'Error connecting to MySQL: '.mysqli_connect_error();
            }

            mysqli_select_db($connection, "chess_game");

            $whitePlayer = "SELECT name FROM T_Players WHERE ID = TM.white";
            $blackPlayer = "SELECT name FROM T_Players WHERE ID = TM.black";

            $select_matches = mysqli_prepare($connection, "SELECT TM.ID, title, DATE(startDate) startDate, TIME(startDate) startHour, state, winner, DATE(endDate) endDate, TIME(endDate) endHour, ({$whitePlayer}) white, ({$blackPlayer}) black FROM T_Matches TM INNER JOIN T_Players TPW ON (TPW.ID = TM.white) INNER JOIN T_Players TPB ON (TPB.ID = TM.black);");
            $select_matches->execute();
            $result = $select_matches->get_result();

            $matches = array();

            while ($myrow = $result->fetch_assoc())
            {
                array_push($matches, $myrow);
            }

            return $matches;
        }
    }