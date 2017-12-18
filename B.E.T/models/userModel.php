<?php

class UserModel extends Model {

	protected $table = 'event';

	public function get($id) {
		$sql = "SELECT * FROM " . $this->table . " WHERE id_event=:id";
		$query = self::$_pdo->prepare($sql);
		$query->bindparam(":id" , $id, PDO::PARAM_INT);
		$query->execute();
		return $query->fetch(PDO::FETCH_OBJ);
	}

	public function get_user($id) {
		$sql = "SELECT * FROM user WHERE id=:id";
		$query = self::$_pdo->prepare($sql);
		$query->bindparam(":id" , $id, PDO::PARAM_INT);
		$query->execute();
		return $query->fetch(PDO::FETCH_OBJ);
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


	public function inscription() {
		$salt =  "vive la MVC";
		$hashMDP = hash_hmac("ripemd160", $_POST['pwd'], $salt);
		$register = self::$_pdo->prepare("INSERT INTO user(login, email, pwd) VALUES(?, ?, ?)");
		$register->execute([
			$_POST["login"],
			$_POST["email"],
			$hashMDP
			]);
	}

	public function connexion() {
		$salt =  "vive la MVC";
		$hashMDP = hash_hmac("ripemd160", $_POST['pwd'], $salt);
		$verification = self::$_pdo->prepare("SELECT * FROM user WHERE login = ?");
		$verification -> execute([
			$_POST['login']
			]);
		$result = $verification->fetch();
		$_SESSION['login'] = $result['login'];
		$_SESSION['email'] = $result['email'];
		$_SESSION['id'] = $result['id'];
	}

	public function check(){
		$check = self::$_pdo->prepare("SELECT * FROM user WHERE login = ?");
		$check->execute([
			$_POST['login']
			]);
		return $check->fetch();
	}

	public function check_session(){
		$check = self::$_pdo->prepare("SELECT * FROM user WHERE login = ?");
		$check->execute([
			$_SESSION['login']
			]);
		return $check->fetch();
	}

	public function bet_model_bet_a($id) {
		$bet = self::$_pdo->prepare("INSERT INTO token(bet_a, id, id_event) VALUES(?, ?, ?)");
		$bet->execute([
			$_POST['range'],
			$_SESSION['id'],
			$id
			]);
	}

	public function bet_model_bet_b($id) {
		$bet = self::$_pdo->prepare("INSERT INTO token(bet_b,id, id_event) VALUES(?, ?, ?)");
		$bet->execute([
			$_POST['range'],
			$_SESSION['id'],
			$id
			]);
	}

	public function substract_coin($coin) {
		$substract = self::$_pdo->prepare('UPDATE user SET token_count = token_count -:coin WHERE id=:id');
		$substract->bindValue(":coin", $coin, PDO::PARAM_INT);
		$substract->bindValue(":id", $_SESSION['id']);
		$substract->execute();
	}

	public function count_bet($id) {
		$query = self::$_pdo->prepare("SELECT * FROM token WHERE id_event LIKE :id");
		$query->bindValue(":id", $id);
		$query->execute();
		return $query->fetchAll(PDO::FETCH_ASSOC);
	}

	public function update_bet_number($id, $bet, $total) {
		$query = ($bet == "bet_a") ? self::$_pdo->prepare("UPDATE event SET bet_a = :num WHERE id_event LIKE :id") : self::$_pdo->prepare("UPDATE event SET bet_b = :num WHERE id_event LIKE :id");
		$query->bindValue(":num", $total, PDO::PARAM_INT);
		$query->bindValue(":id", $id, PDO::PARAM_INT);
		return $query->execute();
	}

	public function eventRetreat($id) {
		$retreat = self::$_pdo->prepare("UPDATE event SET ongame = 1 WHERE id_event = :id");
		$retreat->bindValue(":id", $id);
		$retreat->execute();
	}


	public function achatToken() {
		$achat = self::$_pdo->prepare("UPDATE user SET token_count = :token WHERE user.id = :id ");
		$achat->bindValue(":token" , $_POST['token']);
		$achat->bindValue(":id" , $_SESSION['id']);
		$achat->execute();
	}
}