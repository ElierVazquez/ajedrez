<?php

class Users_DataAccess
{
	
	function __construct()
    {
    }

	function toInsert($user,$email,$pssw,$premium)
	{
		$connexion = mysqli_connect('localhost','root','12345678');
        $corrected_premium_valor = false;
		if (mysqli_connect_errno())
		{
				echo "Error while connecting to MySQL: ". mysqli_connect_error();
		}

        if ($premium == "on")
        {
            $corrected_premium_valor = true;
        } else {
            $corrected_premium_valor = false;
        }
 		
        mysqli_select_db($connexion, 'chess_game');
		$insert = mysqli_prepare($connexion, "insert into T_Players(name,password,email,premium) values (?,?,?,?);");
        $hash = password_hash($pssw, PASSWORD_DEFAULT);
        $insert->bind_param("sssi", $user,$hash,$email,$corrected_premium_valor);
        $res = $insert->execute();
        
		return $res;
	}

    function toVerify($user,$pssw)
    {
        $connexion = mysqli_connect('localhost','root','12345678');
		if (mysqli_connect_errno())
		{
				echo "Error while connecting to MySQL: ". mysqli_connect_error();
		}
        mysqli_select_db($connexion, 'chess_game');
        $select = mysqli_prepare($connexion, "select name,password,email,premium from T_Players where name = ?;");
        $sanitized_user = mysqli_real_escape_string($connexion, $user);       
        $select->bind_param("s", $sanitized_user);
        $select->execute();
        $res = $select->get_result();


        if ($res->num_rows==0)
        {
            return 'NOT_FOUND';
        }

        if ($res->num_rows>1)
        {
            return 'NOT_FOUND';
        }

        $myrow = $res->fetch_assoc();
        $x = $myrow['password'];
        if (password_verify($pssw, $x))
        {
            return $myrow;
        } 
        else 
        {
            return 'NOT_FOUND';
        }
    }
}