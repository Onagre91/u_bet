 <h1>Les événements à venir !</h1>
 <div class="container success">
 </div>
 <?php foreach($events as $event) {
  if ($event->ongame == 0)  { ?>
 <div class="container">
 	<div class="col-md-12">
 		<div class="thumbnail">
 			<div class="overlay">
 			</div>
 			<img class="img-responsive" alt="a" src=<?php echo WEBROOT ."/assets/images/test.jpg"?>>
 		</div>
 		<div class="row">
 			<div class="col-md-12 text-center">
 				<strong><?php echo $event->event_name;?></strong>
 				<article><?php echo $event->team_a. " VS " . $event->team_b;?></article>
 			</div>
 		</div>
 		<div class="row">
 			<div class="col-md-6">
 				<article class="text-center"><span class="label label-info">Début d'évenement : <?php echo $event->date_debut ?></span></article>
 			</div>
 			<div class="col-md-6">
 				<article class="text-center"><span class="label label-info">Fin d'évenement : <?php echo $event->date_fin ?></span></article>
 			</div>
 		</div>
 		<div class="row">
 			<div class="col-md-12">
 				<h3><span>Description de l'évenement :</span></h3>
 				<article class="text-center"><?php echo $event->descrp ?></article>
 			</div>
 			<div class="row">
 				<h3><span>Paris en cours</span></h3>
 				<article class="col-md-6 text-center"><?php echo $event->team_a . " : " . $event->bet_a . "  jetons" ;?></article>
 				<article class="col-md-6 text-center"><?php echo $event->team_b . " : " . $event->bet_b . "  jetons" ; ?></article>
 			</div>
 		</div>
 		<div class="row">
 			<button type="button" class="btn btn-danger text-center col-md-4" id="delete">Supprimer cet événement</button>
 			<div class="id_event"  hidden="true"><?php echo $event->id_event ?></div>
 		</div>
 	</div>
 </div>
 <?php }
 }
 ?>