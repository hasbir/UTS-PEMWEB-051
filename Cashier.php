<?php 
	class Cashier{
		function __construct(){
			$this->conn = mysqli_connect('localhost', 'root', '', 'db_foodcourt');

			if (mysqli_connect_errno()) {
				echo mysqli_connect_error();
			}
		}

		function getCharge($paid, $orderid){
			return $paid - getOrderBill($orderid);
		}

		function getActiveOrder($id){
			$data = mysqli_query($this->conn, "SELECT * FROM tb_order WHERE status = 1");
			while ($row = mysqli_fetch_array($data)) {
				$res = $row;
			}
			return $res;
		}

		function getOrderDetail($id){
			$data = mysqli_query($this->conn, "SELECT tb_menu.menu_name as menu, tb_order_item.quantity as quantity, (tb_menu.price * tb_order_item.quantity) AS price FROM tb_menu, tb_order_item, tb_order WHERE tb_menu.id_menu = tb_order_item.id_menu AND tb_order_item.id_order = tb_order.id_order AND tb_order.id_order = $id");

			while ($row = mysqli_fetch_array($data)) {
				$res = $row;
			}
			return $res;
		}

		function getOrderBill($id){
			$data = mysqli_query($this->conn, "SELECT (tb_menu.price * tb_order_item.quantity) AS price FROM tb_menu, tb_order_item, tb_order WHERE tb_menu.id_menu = tb_order_item.id_menu AND tb_order_item.id_order = tb_order.id_order AND tb_order.id_order = $id");

			$bill = 0;
			while ($row = mysqli_fetch_array($data)) {
				$bill += $row['price'];
			}

			return $bill;
		}


	}
 ?>