<div id="webroot" hidden="true"><?php echo WEBROOT ?></div>
<div class="container-fluid">
	<div class="container error success">
	</div>
	<div class="container">
		<div class="col-md-12">
			<form method="post" class="breadcrumb">
				<h1>Création d'Evenement</h1>
				<div class="form-group">
					<label class="col-md-4">Nom de l'event</label>
					<input type="text" class="form-control" id="event_name" name="event_name" placeholder="Nom de l'evenement">
				</div>
				<div class="form-group">
					<label class="col-md-4">Equipe A</label>
					<input type="text" class="form-control" id="team_A" name="team_A" placeholder="Equipe A">
				</div>
				<div class="form-group">
					<label class="col-md-4">Equipe B</label>
					<input type="text" class="form-control" id="team_B" name="team_B" placeholder="Equipe B">
				</div>
				<div class="form-group">
					<label class="col-md-4">Debut d'evenement</label>
					<input type="text" class="form-control" id="date_debut" name="date_debut" placeholder="YYYY-MM-DD HH:MM">
				</div>
				<div class="form-group">
					<label class="col-md-4">Fin d'evenement</label>
					<input type="text" class="form-control" id="date_fin" name="date_fin" placeholder="YYYY-MM-DD HH:MM">
				</div>
				<div class="form-group">
					<label class="col-md-4">Descriptif</label>
					<textarea  rows="4" cols="10" class="form-control" id="descrp" name="descrp" placeholder="Ecrire votre impression sur l'evenement"></textarea>
				</div>
				<button type="submit" id="event" name="submit" class="btn btn-primary">Submit</button>
			</form>
		</div>
		<div class="col-md-12">
			<form method="post" class="breadcrumb">
				<h1>Evenement(s) Terminé(s)</h1>
				<? foreach($events as $event) {
					if ($event->ongame == 1) {?>
					<div class="container">
						<div class="row">
							<div class="col-md-10 text-center">
								<strong><?php echo $event->event_name;?></strong>
								<article><?php echo $event->team_a. " VS " . $event->team_b;?></article>
							</div>
						</div>
						<div class="row">
							<h3><span>Paris en cours</span></h3>
							<div class="col-md-5">
								<label class="btn btn-default form-control"><?php echo $event->team_a . " : " . $event->bet_b . " jetons"; ?><input type="checkbox" id="bet_a" class="badgebox" name="bet_a"><span class="badge">&check;</span></label>
							</div>
							<div class="col-md-5">
								<label class="btn btn-default form-control"><?php echo $event->team_b . " : " . $event->bet_b . " jetons"; ?><input type="checkbox" id="bet_b" class="badgebox" name="bet_b"><span class="badge">&check;</span></label>
							</div>
						</div>
						<br>
						<div class="row">
							<button type="button" class="btn btn-info text-center col-md-4" id="distrib">Who won ?</button>
						</div>
					</div>
				</div>
				<?}
			}?>
		</form>