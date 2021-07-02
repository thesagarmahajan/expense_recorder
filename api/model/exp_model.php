<?php

/**
 * 
 */
include '../helpers/auth.php';

class exp_model extends auth
{
	
	function __construct()
	{
		$this->con = new mysqli("localhost", "root", "", "expense_manager");
	}

	public function add_expense()
	{
		if($this->user_auth()){
			$qry = "INSERT INTO expenses(curdate, payee, amount, exp_type_id, uid) VALUES(curdate(), '".$_POST['payee']."', ".$_POST['amount'].", ".$_POST['exp_type_id'].", ".$_GET['uid'].")";

			 $res = $this->con->query($qry);

			 if($res){
			 	echo "exp added";
			 }
			 else{
			 	echo "Contact Developer";
			 }
		}
		else{
			echo "Auth Failed";
		}
	}

	public function list_all_expenses($uid='')
	{
		if($this->user_auth()){
			$qry = "SELECT * FROM expenses WHERE uid=".$uid;

			$res = $this->con->query($qry);

			header("Content-type:application/json");
			echo json_encode(mysqli_fetch_all($res, MYSQLI_ASSOC));
		}
		else{
			echo "Auth Failed";
		}
	}

	public function select_daterange_data($from='', $to='', $uid='')
	{
		if($this->user_auth()){
			$qry = "SELECT * FROM expenses WHERE curdate between '".$from."' and '".$to."' and uid=".$uid;

			$res = $this->con->query($qry);

			header("Content-type:application/json");
			echo json_encode(mysqli_fetch_all($res, MYSQLI_ASSOC));
		}
		else{
			echo "Auth Failed";
		}
	}

	public function update_exp()
	{
		if($this->user_auth()){

			$qry = "UPDATE expenses SET payee='".$_POST['payee']."', amount='".$_POST['amount']."' WHERE id=".$_POST['exp_id'];

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

	public function delete_exp($exp_id='')
	{
		if($this->user_auth()){
			$qry = "DELETE FROM expenses WHERE id=".$exp_id;

			$res = $this->con->query($qry);

			if( mysqli_affected_rows($this->con) == 1){
				echo "Deleted Successfully";
			}
			else{
				echo "Contact Developer";
			}
		}
		else{
			echo "Auth Failed";
		}
	}

	public function piechart_data($uid)
	{
		if($this->user_auth()){

			$qry = "SELECT * FROM exp_type WHERE uid=".$uid;
			$res = $this->con->query($qry);
			$rows = mysqli_fetch_all($res, MYSQLI_ASSOC);

			$pres = array();

			for($i=0;$i<sizeof($rows);$i++){

				$qry2 = "SELECT SUM(amount) as ".$rows[$i]['title']."  FROM piechartdata WHERE title='".$rows[$i]['title']."'";
				$res2 = $this->con->query($qry2);
				$rows2 = mysqli_fetch_all($res2, MYSQLI_ASSOC);

				array_push($pres, array("label"=>$rows[$i]['title'], "y"=>$rows2[0][ $rows[$i]['title'] ]));
			}

			echo json_encode($pres);


		}
		else{
			echo "Auth Failed";
		}
	}
}
