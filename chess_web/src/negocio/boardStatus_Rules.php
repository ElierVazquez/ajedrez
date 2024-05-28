<?php
    require("../infraestructura/boardStatus_DataAccess.php");

    class BoardStatus_Rules
    {
        private $_ID;
        private $_IDGame;
        private $_board;
        private $_turn;

        function __construct()
        {}

        function getBoard()
        {
            return $this->_board;
        }

        function init($board)
        {
            $this->_board = $board;
        }

        function fullInit($id, $idgame, $board, $turn)
        {
            $this->_ID = $id;
            $this->_IDGame = $idgame;
            $this->_board = $board;
            $this->_turn = $turn;
        }

        function toGet($id)
        {
            $boardDAL = new BoardStatus_DataAccess();
            $result = $boardDAL->toGet($id);

            $boardList = array();

            foreach ($result as $board)
            {
                $boardRules = new BoardStatus_Rules();
                $boardRules->init($board["board"]);
                array_push($boardList, $boardRules);
            }

            return $boardList;
        }

        function toGetLastStatus()
        {
            $boardDAL = new BoardStatus_DataAccess();
            $result = $boardDAL->toGetLastStatus();

            $boardList = array();

            foreach ($result as $board)
            {
                $boardRules = new BoardStatus_Rules();
                $boardRules->fullInit($board["ID"], $board["IDGame"], $board["board"], $board["turn"]);
                array_push($boardList, $boardRules);
            }

            return $boardList;
        }

        function toSet($board, $turn)
        {
            $boardDAL = new BoardStatus_DataAccess();
            $boardDAL->toSet($board, $turn);
        }
    }