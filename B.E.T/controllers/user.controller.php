<?php 

class UserController extends Controller {

	protected $modelUser;
	public $errors = [];
	public $success = [];

	public function __construct() {
		parent::__construct();
		$this->modelUser = $this->loadModel('user');
		$this->errors = [];
		$this->success = [];
	}

	public function _home() {
		$scope['events'] = $this->modelUser->all();
		$this->render("home", lcfirst(str_replace("Controller", '', get_class($this))), $scope);
	}

	public function show($id) {
		$scope['user'] = $this->modelUser->get($id);
		$this->render('show', 'user', $scope);
	}

	function get_event($id) {
		$catch['event'] = $this->modelUser->get($id);
		$catch['user'] = $this->modelUser->get_user($_SESSION['id']);
		$int_a = intval($catch['event']->bet_a);
		$int_b = intval($catch['event']->bet_b);
		$prov_A = $int_a/($int_a + $int_b)*100;
		$prov_B = $int_b/($int_a + $int_b)*100;
		$stat_A = explode("." , $prov_A);
		$stat_B = explode("." ,$prov_B);
		$catch['cote_A'] = $stat_A;
		$catch['cote_B'] = $stat_B;
		if (!empty($catch)){
			$this->render("bet", "user", $catch);
		}
	}

	public function market() {
		$scope['user'] = $this->modelUser->all();
		$this->render("market", 'user', $scope);
	}

	public function bet() {
		$this->render("bet", 'user');
	}

	public function inscription() {
		if($_SERVER['REQUEST_METHOD'] == 'POST') {
			if(empty($_POST["login"]) || strlen($_POST["login"]) < 4 || !preg_match("/^[a-zA-Z ]*$/",$_POST['login'])){
				$this->errors['login'] = "Veuillez remplir le champ de votre pseudo correctement, votre pseudo doit faire plus de 4 caracteres et ne doit être composer que de lettres.";
			} 
			if(empty($_POST['pwd']) || strlen($_POST['pwd']) < 5){
				$this->errors['password'] = "Veuillez choisir un mot de passe, votre mot de passe doit faire plus de 5 caractères.";
			}
			if(empty($_POST['email']) || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
				$this->errors['email'] = "Veuillez remplir le champ de votre email correctement, l'email doit être valide.";
			}
			if(empty($this->errors)) {
				$scope['success'] = $this->modelUser->inscription();
				echo json_encode($scope);
			} else {
				http_response_code(400);
				echo json_encode($this->errors);
			}
		}
	}

	public function connexion() {
		$check = $this->user_check();
		if($_POST['login'] != "" || $_POST['pwd'] != "") {
			if ($this->password_check($_POST['pwd'])) {
				$this->modelUser->connexion();
				echo json_encode($this->user_check());
			} else {
				$this->errors['pwd'] = "Mauvais mot de passe ou mauvais nom d'utilisateur";
				http_response_code(400);
				echo json_encode($this->errors);
			}
		} else {
			$this->errors['pwd'] = "Vous devez remplir les champs";
			http_response_code(400);
			echo json_encode(($this->errors));
		}
	}

	public function password_check($password) {
		$salt =  "vive la MVC";
		$hashMDP = hash_hmac("ripemd160", $password, $salt);
		$sql_pass = $this->modelUser->check();
		if($hashMDP == $sql_pass['pwd']) {
			return true;
		} else {
			return false;
		}
	}

	public function user_check() {
		$sql_check = $this->modelUser->check_session();
		if($sql_check["role"] == 0){
			return "user";
		} else {
			return "admin";
		}
	}


	public function bet_make($id) {
		if($_SERVER['REQUEST_METHOD'] == 'POST') {
			if(empty($_POST["bet_a"]) && empty($_POST["bet_b"])){
				$this->errors['bet_'] = "Veuillez choisir une équipe.";
			}
			if(isset($_POST['bet_a']) && isset($_POST['bet_b'])) {
				$this->errors['bet_b'] = "Vous ne pouvez choisir qu'une seule équipe.";
			} 
			if(empty($_POST['range'])){
				$this->errors['password'] = "Veuillez definir un nombre de jetons à parier.";
			}
			if(empty($this->errors)) {
				echo json_encode("true");
				$this->modelUser->substract_coin($_POST['range']);
				if (empty($_POST['bet_a']) && isset($_POST['bet_b'])) {
					$this->modelUser->bet_model_bet_b(intval($id));
					$coin = $this->modelUser->count_bet(intval($id));
					$total = 0;
					foreach ($coin as $key => $value) {
						foreach ($value as $kerbal => $jimbo) {
							if ($kerbal == "bet_b") {
								$total += $jimbo;
							}
						}
					}
					$this->modelUser->update_bet_number(intval($id), "bet_b", $total);
				}
				if (empty($_POST['bet_b']) && isset($_POST['bet_a'])) {
					$this->modelUser->bet_model_bet_a(intval($id));
					$coin = $this->modelUser->count_bet(intval($id));
					$total = 0;
					foreach ($coin as $key => $value) {
						foreach ($value as $kerbal => $jimbo) {
							if ($kerbal == "bet_a") {
								$total += $jimbo;
							}
						}
					}
					$this->modelUser->update_bet_number(intval($id), "bet_a", $total);
				}
			} else {
				http_response_code(400);
				echo json_encode($this->errors);
			}
		}
	}

	public function date_check() {
		$today = date("Y-m-d H:i:s");
		$sql_date = $this->modelUser->allFetch();
		for ($i = 0; $i < count($sql_date) ; $i++) { 
			if ($sql_date[$i]["ongame"] == 0) {
				if ($sql_date[$i]['date_fin'] < $today) {
					$this->success = "L'event " . $sql_date[$i]["event_name"] . " est terminé !";
					echo json_encode($this->success);
					$this->modelUser->eventRetreat($sql_date[$i]['id_event']);
				}
			}
		}
	}

	public function deconnexion() {
		session_unset();
		require_once(ROOT);
	}

	public function achat() {
		if($_SERVER['REQUEST_METHOD'] == 'POST') {
			if(empty($_POST["token"])){
				$this->errors['token'] = "Veuillez definir le nombre de jetons que vous voulez acheter.";
			} 
			if($_POST["token"] <= 0){
				$this->errors['token'] = "Vous ne pouvez pas achetez 0 ou moins de jetons.";
			} 
			if(empty($this->errors)) {
				$this->modelUser->achatToken();
				$this->success['token'] = "Vous avez acheter " . $_POST['token'] . " jetons.";
				echo json_encode($this->success);
			} else {
				http_response_code(400);
				echo json_encode($this->errors);
			}
		}
	}

	// public function cote_calcul($id) {
	// 	$catch = $this->get_event($id);
	// 	$stat_A = $catch['bet_a']/($catch['bet_a'] + $catch['bet_b'] x 100);
	// 	$stat_B = $catch['bet_b']/($catch['bet_a'] + $catch['bet_b'] x 100);
	// 	echo $stat_A;
	// 	echo $stat_B;
	// } 
}