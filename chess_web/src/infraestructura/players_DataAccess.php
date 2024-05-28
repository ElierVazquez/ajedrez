<?php
    class Players_DataAccess
    {
        function __construct()
        {}

        function toGet()
        {
            $connection = mysqli_connect('localhost', 'root', '12345678');
            if (mysqli_connect_errno())
            {
                echo 'Error connecting to MySQL: '.mysqli_connect_error();
            }

            mysqli_select_db($connection, 'chess_game');
            $select_players = mysqli_prepare($connection, "SELECT ID, name FROM T_Players;");
            $select_players->execute();
            $result = $select_players->get_result();

            $players =  array();

            while ($myrow = $result->fetch_assoc()) 
            {       
	        	array_push($players,$myrow);
            }
		
	        return $players;
        }
    }