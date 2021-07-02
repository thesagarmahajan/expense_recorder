<?php
	
	include '../helpers/auth.php';

	class user_model extends auth{

		function __construct(){
			
			$this->con = new mysqli("localhost", "root", "", "expense_manager");

			// if($con->connect_errno==0){
			// 	echo "Connection Successful";
			// }
			// else{
			// 	echo "<h1>".$con->connect_error."</h1>";
			// }
		}

		public function check_username($potential_username='')
		{
			$qry = "SELECT id FROM users WHERE username='".$potential_username."';";

			$res = $this->con->query($qry);

			if($res->num_rows>0){

				echo "username_not_available";

			}
			else{

				echo "username_available";

			}

		}
		
		function add_user(){

			$qry = "INSERT INTO users(full_name, username, password) VALUES('".$_POST['full_name']."', '".$_POST['username']."', '".$_POST['password']."' )";

			$result = $this->con->query($qry);

			if($result){
				echo "user_added";
			}
			else{
				echo "contact_developer";
			}
		}

		

		public function login()
		{
			echo $this->user_auth("login");
		}

	}
	
?>