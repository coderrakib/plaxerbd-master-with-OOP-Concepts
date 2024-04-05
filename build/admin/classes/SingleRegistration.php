<?php
	
	require_once ('Database.php');

	class SingleRegistration extends Database{

		public $query, $error;

		public function running($name,$freefire,$t_id,$t_name,$level,$trxid,$bkash,$count_code){

			if($this->Insert('single_registration',['name','free_fire_id','tournament_id','tournament_name','tournament_level','trxid','bkash','counter_code'],[$name,$freefire,$t_id,$t_name,$level,$trxid,$bkash,$count_code])){
				return true;
			}

			$this->errors = $this->errors;
			return false;
		}

		public function getrunning($where = null){

			if($this->Select(['*'], 'single_registration', $where)){

				$this->query = $this->query;
				return true;
			}

			return false;
		}

		/*public function updatetournament($table, $columnValue, $where){

			if($this->Update($table, $columnValue, $where)){

				$this->query = $this->query;
				return true;
			}

			return false;
		}

		public function deletetournament($table, $where){

			if($this->Delete($table,['id','=', $where])){

				$this->query = $this->query;
				return true;
			}

			return false;
		}*/
	}
?>