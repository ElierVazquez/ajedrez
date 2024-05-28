<?php
    require("../infraestructura/api_DataAccess.php");

    class Api_Rules
    {
        private $_materialValorWhite;
        private $_materialValorBlack;
        private $_message;

        function __construct()
        {}

        function init($materialValorWhite, $materialValorBlack, $message)
        {
            $this->_materialValorWhite = $materialValorWhite;
            $this->_materialValorBlack = $materialValorBlack;
            $this->_message = $message;
        }

        function toGet($board)
        {
            $apiDAL = new api_DataAccess();
            $result = $apiDAL->toGet($board);

            return $result;
        }

        function toMove($board, $fromColumn, $fromRow, $toColumn, $toRow)
        {
            $apiDAL = new api_DataAccess();
            $result = $apiDAL->toMove($board, $fromColumn, $fromRow, $toColumn, $toRow);

            return $result;
        }
    }