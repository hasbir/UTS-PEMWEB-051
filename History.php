<?php 
	class History{
		function __construct(){
			$this->conn = mysqli_connect('localhost', 'root', '', 'db_foodcourt');

			if (mysqli_connect_errno()) {
				echo mysqli_connect_error();
			}
		}

		function getAllTransaction(){
			$data = mysqli_query($this->conn, "SELECT * FROM tb_order ORDER BY datetime DESC");
			while ($row = mysqli_fetch_array($data)) {
				$res = $row;
			}

			return $res;
		}

		function getStandTransaction($id){
			$data = mysqli_query($this->conn, "SELECT * FROM tb_order WHERE id_stand = ".$id." ORDER BY datetime DESC");
			while ($row = mysqli_fetch_array($data)) {
				$res = $row;
			}

			return $res;
		}
	}
 ?>