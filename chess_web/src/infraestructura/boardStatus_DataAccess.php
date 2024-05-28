<?php
ini_set("display_errors", 1);
ini_set("display_startup_errors", 1);
    class BoardStatus_DataAccess
    {
        function __construct()
        {}

        function toGet($idgame)
        {
            $connection = mysqli_connect('localhost', 'root', '12345678');
            if (mysqli_connect_errno())
            {
                echo 'Error connecting to MySQL: '.mysqli_connect_error();
            }

            mysqli_select_db($connection, "chess_game");

            $select_board = mysqli_prepare($connection, "SELECT board FROM T_Board_Status WHERE IDGame = {$idgame} ORDER BY turn;");
            $select_board->execute();
            $result = $select_board->get_result();

            $board = array();

            while ($myrow = $result->fetch_assoc())
            {
                array_push($board, $myrow);
            }

            return $board;
        }

        function toGetLastStatus()
        {
            $connection = mysqli_connect('localhost', 'root', '12345678');
            if (mysqli_connect_errno())
            {
                echo 'Error connecting to MySQL: '.mysqli_connect_error();
            }

            mysqli_select_db($connection, "chess_game");

            $select_board = mysqli_prepare($connection, "SELECT ID, IDGame, board, turn FROM T_Board_Status ORDER BY ID desc limit 1;");
            $select_board->execute();
            $result = $select_board->get_result();

            $board = $result->fetch_assoc();

            return $board ? [$board] : [];
        }

        function toSet($board, $turn)
        {
            $connection = mysqli_connect('localhost', 'root', '12345678');
            if (mysqli_connect_errno())
            {
                echo 'Error connecting to MySQL: '.mysqli_connect_error();
            }

            mysqli_select_db($connection, "chess_game");

            $insert_turn = mysqli_prepare($connection, "INSERT INTO T_Board_Status(IDGame, board, turn) VALUES ((select ID from T_Matches order by ID desc limit 1), \"{$board}\", {$turn});");
            $insert_turn->execute();
        }
    }