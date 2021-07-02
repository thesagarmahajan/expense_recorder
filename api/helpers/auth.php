<?php

class auth{

	public function user_auth($type='')
	{
		$headers = apache_request_headers();
		$tokendata = explode(" ", $headers['Authorization']);
		$creds = explode(":", base64_decode($tokendata[1]));

		$con = new mysqli("localhost", "root", "", "expense_manager");

		$qry = "SELECT id, full_name FROM users WHERE username='".$creds[0]."' AND password='".strrev($creds[1])."';";

		$res = $con->query($qry);

		if($res->num_rows==1){

			if($type=='login'){

				header("Content-type: application/json");
				return json_encode(mysqli_fetch_all($res, MYSQLI_ASSOC));

			}
			else{

				return true;

			}

		}
		else{
			return false;
		}

	}

}