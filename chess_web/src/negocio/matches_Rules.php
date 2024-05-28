<?php

    require("../infraestructura/matches_DataAccess.php");

    class Matches_Rules
    {
        private $_ID;
        private $_title;
        private $_white;
        private $_black;
        private $_startDate;
        private $_startHour;
        private $_endDate;
        private $_endHour;
        private $_winner;
        private $_state;

        function __construct()
        {}

        function init($title, $white, $black)
        {
            $this->_title = $title;
            $this->_white = $white;
            $this->_black = $black;
        }

        function initFull($id, $title, $white, $black, $startDate, $startHour, $endDate, $endHour, $winner, $state)
        {
            $this->_ID = $id;
            $this->_title = $title;
            $this->_white = $white;
            $this->_black = $black;
            $this->_startDate = $startDate;
            $this->_startHour = $startHour;
            $this->_endDate = $endDate;
            $this->_endHour = $endHour;
            $this->_winner = $winner;
            $this->_state = $state;
        }

        function getID()
        {
            return $this->_ID;
        }

        function getTitle()
        {
            return $this->_title;
        }

        function getWhite()
        {
            return $this->_white;
        }

        function getBlack()
        {
            return $this->_black;
        }

        function getStartDate()
        {
            return $this->_startDate;
        }

        function getStartHour()
        {
            return $this->_startHour;
        }

        function getEndDate()
        {
            return $this->_endDate;
        }

        function getEndHour()
        {
            return $this->_endHour;
        }

        function getWinner()
        {
            return $this->_winner;
        }

        function getState()
        {
            return $this->_state;
        }

        function toSet($title, $white, $black)
        {
            $matchesDAL = new Matches_DataAccess();
            $matchesDAL->toSet($title, $white, $black);
        }

        function toGet()
        {
            $matchesDAL = new Matches_DataAccess();
            $rs = $matchesDAL->toGet();

            $matchesList = array();

            foreach ($rs as $match)
            {
                $matchesRules = new Matches_Rules();
                $matchesRules->initFull($match["ID"], $match["title"], $match["white"], $match["black"], $match["startDate"], $match["startHour"], $match["endDate"], $match["endHour"], $match["winner"], $match["state"]);
                array_push($matchesList, $matchesRules);
            }

            return $matchesList;
        }
    }