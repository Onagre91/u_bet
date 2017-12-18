<?php

class AdminController extends Controller {

	protected $modelAdmin;
	public $errors = [];
	public $success = [];


	public function __construct() {
		parent::__construct();
		$this->modelAdmin = $this->loadModel('admin');
		$this->errors = [];
		$this->success = [];
	}

	public function _home() {
		$scope['events'] = $this->modelAdmin->all();
		$this->render("home", lcfirst(str_replace("Controller", '', get_class($this))), $scope);
	}

	public function index() {
		$this->render('index', 'home');
	}

	public function event() {
		$scope['events'] = $this->modelAdmin->all();
		$this->render("event", 'admin', $scope);
	}

	public function create_event() {
		if($_SERVER['REQUEST_METHOD'] == 'POST') {
			if(empty($_POST["team_A"]) || strlen($_POST["team_A"]) < 4 || !preg_match("/^[a-zA-Z ]*$/",$_POST['team_A'])){
				$this->errors['team_A'] = "Veuillez remplir le champ de l'équipe A correctement, le nom de l'équipe doit faire plus de 4 caractères.";
			} 
			if(empty($_POST["team_B"]) || strlen($_POST["team_B"]) < 4 || !preg_match("/^[a-zA-Z ]*$/",$_POST['team_B'])){
				$this->errors['team_B'] = "Veuillez remplir le champ de l'équipe B correctement, le nom de l'équipe doit faire plus de 4 caractères.";
			} 
			if(empty($_POST['event_name']) || strlen($_POST['event_name']) < 5){
				$this->errors['event_name'] = "Veuillez remplir le champ du nom de l'evenement correctement, le nom de l'evenement doit faire plus de 5 caractères.";
			}
			if(empty($_POST['date_debut']) || !preg_match("/^(\d{4})-(\d{2})-(\d{2}) (\d{2}):(\d{2})$/", $_POST["date_debut"])){
				$this->errors['date_debut'] = "Veuillez remplir le champ de l'event debut correctement, La date et l'heure doivent être sous ce format YYYY-MM-DD HH:MM.";
			}
			if(empty($_POST['date_fin']) || !preg_match("/^(\d{4})-(\d{2})-(\d{2}) (\d{2}):(\d{2})$/", $_POST["date_fin"])){
				$this->errors['date_fin'] = "Veuillez remplir le champ de l'event fin correctement, La date et l'heure doivent être sous ce format YYYY-MM-DD HH:MM.";
			}
			if(empty($_POST["descrp"]) || strlen($_POST["descrp"]) < 4 || !preg_match("/^[a-zA-Z ]*$/",$_POST['team_B'])){
				$this->errors['descrp'] = "Veuillez remplir le champ du descriptif correctement, vous devez ecrire plus de 4 caractères.";
			} 
			if(empty($this->errors)) {
				$scope['success'] = $this->modelAdmin->event_set();
				echo json_encode($scope);
			} else {
				http_response_code(400);
				echo json_encode($this->errors);
			}
		}
	}
	
	public function date_check() {
		$today = date("Y-m-d H:i:s");
		$sql_date = $this->modelAdmin->allFetch();
		for ($i = 0; $i < count($sql_date) ; $i++) { 
			if ($sql_date[$i]["ongame"] == 0) {
				if ($sql_date[$i]['date_fin'] < $today) {
					$this->success = "L'event " . $sql_date[$i]["event_name"] . " est terminé !";
					echo json_encode($this->success);
					$this->modelAdmin->eventRetreat($sql_date[$i]['id_event']);
				}
			}
		}
	}

	public function delete_event($id) {
		$this->modelAdmin->deleteEvent($id);
		var_dump("expression");
	}
}
