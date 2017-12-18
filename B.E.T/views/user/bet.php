<div id="webroot" hidden="true"><?php echo WEBROOT ?></div>
<h2 class="text-center"><?php echo $scope['event']->event_name;?></h2>
<div class="container error">
</div>
<h1><?php echo $scope['event']->team_a . " VS " . $scope['event']->team_b;?></h1>
<div class="container">
<div class="row">
<h3>Rappel du descriptif :</h3>
<article class="col-md-12"><?php echo $scope['event']->descrp; ?></article>
</div>
<div class="row">
	<div class="col-md-6">
		<article class="text-center"><span class="label label-info">Votre nombre de jetons : <?php echo $scope['user']->token_count ?></span></article>
	</div>
	<div class="col-md-6">
		<article class="text-center"><span class="label label-warning">Fin d'évenement : <?php echo $scope['event']->date_fin ?></span></article>
	</div>
	<h4 class="text-center"><span class="label label-success">La côte actuelle de l'équipe A est de : <?php echo $scope['cote_A'][0] . " %.";?></span></h4>
	<h4 class="text-center"><span class="label label-success">La côte actuelle de l'équipe B est de : <?php echo $scope['cote_B'][0] . " %.";?></span></h4>
</div>
<form method="post" class="breadcrumb">
	<div class="row">
		<h3 class="text-center">Sur quelle équipe souhaitez vous bet ?</h3>
		<div class="col-md-6">
			<label class="btn btn-default form-control"><?php echo $scope['event']->team_a; ?><input type="checkbox" id="bet_a" class="badgebox" name="bet_a"><span class="badge">&check;</span></label>
		</div>
		<div class="col-md-6">
			<label  class="btn btn-default form-control"><?php echo $scope['event']->team_b; ?><input type="checkbox" id="bet_b" class="badgebox" name="bet_b"><span class="badge">&check;</span></label>
		</div>
	</div>
	<div class="row">
		<h3 class="text-center">Combien de jetons souhaitez vous miser ?</h3>
		<div class="value">0</div>
		<input type="range" min="0" max=<?php echo $scope['user']->token_count?> step="1" value="0" name="range">
	</div>
	<button type="submit" id="betting" name="submit" class="btn btn-danger">Game on</button>
</form>
</div>

