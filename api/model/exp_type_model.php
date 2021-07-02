<?php

include '../helpers/auth.php';

class exp_type_model extends auth{

	function __construct(){
		$this->con = new mysqli("localhost", "root", "", "expense_manager");
	}

	public function add_exp_type()
	{
		if($this->user_auth()){
			
			$qry = "INSERT INTO exp_type(curdate, title, uid) VALUES(CURDATE(),'".$_POST['title']."', ".$_POST['uid'].")";

			$res = $this->con->query($qry);

			if($res){
				echo "expense type added";
			}

			else{
				echo "contact developer";
			}

		}
		else{
			echo "Auth Failed";
		}
		
	}

	public function list_exp_type($uid='')
	{
		if($this->user_auth()){

			$qry = "SELECT * FROM exp_type WHERE uid=".$uid.";";

			$res = $this->con->query($qry);

			if($res->num_rows>0){

				$data = mysqli_fetch_all($res, MYSQLI_ASSOC);
				header("Content-type:application/json");
				echo json_encode($data);

			}

			else{
				echo "no data found";
			}
			

		}
		else{
			echo "Auth Failed";
		}
	}

	public function edit_exp_type_title()
	{
		if($this->user_auth()){

			$qry = "UPDATE exp_type SET title='".$_POST['title']."' WHERE id=".$_POST['exp_type_id'];

			$res = $this->con->query($qry);

			if(mysqli_affected_rows($this->con)==1){
				echo "Updated Successfully";
			}
			else{
				echo "Contact Developer";
			}


		}
		else{
			echo "Auth Failed";
		}
	}

}