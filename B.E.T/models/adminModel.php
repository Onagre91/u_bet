<?php

class AdminModel extends Model {

	protected $table = "event";
	
	public function event_set() {
		$register = self::$_pdo->prepare("INSERT INTO event(id, team_A, team_B, event_name, date_debut, date_fin, descrp) VALUES(?, ?, ?, ? , ?, ?, ?)");
		$register->execute([
			$_SESSION['id'],
			$_POST["team_A"],
			$_POST["team_B"],
			$_POST['event_name'],
			$_POST['date_debut'],
			$_POST['date_fin'],
			$_POST['descrp']
			]);
	}

	public function all() {
		$sql = "SELECT * FROM ". $this->table . " WHERE 1";
		$query = self::$_pdo->prepare($sql);
		$query->execute();
		return $query->fetchAll(PDO::FETCH_OBJ);
	}

	public function allFetch() {
		$sql = "SELECT * FROM ". $this->table ;
		$query = self::$_pdo->prepare($sql);
		$query->execute();
		return $query->fetchAll();
	}


	public function check() {
		$check = self::$_pdo->prepare("SELECT * FROM event WHERE login = ?");
		$check->execute([
			$_POST['login']
			]);
		return $check->fetch();
	}

	public function check_session() {
		$check = self::$_pdo->prepare("SELECT * FROM event WHERE login = ?");
		$check->execute([
			$_SESSION['login']
			]);
		return $check->fetch();
	}

	public function deleteEvent($id) {
		$delete = self::$_pdo->prepare("DELETE FROM event WHERE event.id_event = ?");
		$delete->execute([
			$id
			]);
	}

	public function eventRetreat($id) {
		$retreat = self::$_pdo->prepare("UPDATE event SET ongame = 1 WHERE id_event = :id");
		$retreat->bindValue(":id", $id);
		$retreat->execute();
	}
}