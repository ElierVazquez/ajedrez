<?php

    require("../infraestructura/players_DataAccess.php");

    class Players_Rules
    {
        private $_ID;
        private $_Name;

        function __construct()
        {}

        function init($id, $name)
        {
            $this->_ID = $id;
            $this->_Name = $name;
        }

        function getID()
        {
            return $this->_ID;
        }

        function getName()
        {
            return $this->_Name;
        }

        function toGet()
        {
            $playersDAL = new Players_DataAccess();
            $rs = $playersDAL->toGet();
            $playersList = array();
            foreach ($rs as $player)
            {
                $playersRules = new Players_Rules();
                $playersRules->init($player["ID"], $player["name"]);
                array_push($playersList, $playersRules);
            }

            return $playersList;
        }
    }