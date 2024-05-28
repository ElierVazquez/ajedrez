<?php
class api_DataAccess {
	function __construct()
	{}

	function toGet($board)
	{
		$url = "https://localhost:7246/ChessGame?board=".$board;
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL,$url);
		curl_setopt($ch,CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch,CURLOPT_CONNECTTIMEOUT,4);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		$json = curl_exec($ch);
		if (!$json)
		{
			echo curl_error($ch);
		}
		curl_close($ch);
		return json_decode($json,true);
	}

	function toMove($board, $fromColumn, $fromRow, $toColumn, $toRow)
	{
		$url = "https://localhost:7246/ValidateMove?board=".$board."&fromColumn=".$fromColumn."&fromRow=".$fromRow."&toColumn=".$toColumn."&toRow=".$toRow;
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL,$url);
		curl_setopt($ch,CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch,CURLOPT_CONNECTTIMEOUT,4);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		$json = curl_exec($ch);
		if (!$json)
		{
			echo curl_error($ch);
		}
		curl_close($ch);
		return json_decode($json,true);
	}
}