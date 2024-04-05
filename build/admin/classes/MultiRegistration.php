<?php
	
	require_once ('Database.php');

	class MultiRegistration extends Database{

		public $query, $error;

		public function collectData($team_name,$email_or_phone,$leder,$p_2,$p_3,$p_4,$start_time,$reg_date){

			if($this->Insert('team_registration',['team_name','email_or_phone','team_ledar_id','p_2_id','p_3_id','p_4_id','start_date','registration_date'],[$team_name,$email_or_phone,$leder,$p_2,$p_3,$p_4,$start_time,$reg_date])){
				return true;
			}

			$this->errors = $this->errors;
			return false;
		}

		public function getrunning($where = null){

			if($this->Select(['*'], 'team_registration', $where)){

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