<?php 
	class User{
		function __construct(){
			$this->conn = mysqli_connect('localhost', 'root', '', 'db_foodcourt');

			if (mysqli_connect_errno()) {
				echo mysqli_connect_error();
			}
		}

		function login($username, $password){
			$data = mysqli_query($this->conn, "SELECT * FROM tb_user WHERE username = '".$username."' AND $password = '".md5($password)."'");

			if (mysqli_num_rows($data) > 0) {
				while ($row = mysqli_fetch_array($data)) {
					$_SESSION['id_user'] = $row['id_user'];
					$_SESSION['name'] = $row['name'];
					$_SESSION['username'] = $row['username'];
					$_SESSION['level'] = $row['level'];
				}

				switch ($_SESSION['level']) {
					case '1':
						header('location:admin_dashboard.php');
						break;
					case '2':
						header('location:stand_dashboard.php');
						break;
					case '3':
						header('location:customer_dashboard.php');
						break;	
					case '4':
						header('location:cashier_dashboard.php');
						break;	
				}
			}else{
				echo "Username & Password tidak sesuai";
			}
		}

		function logout(){
			session_destroy();
			header('location:login.php');
		}
	}
 ?>