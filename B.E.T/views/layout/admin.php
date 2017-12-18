<!doctype html>
<html lang="fr">
<head>
	<meta charset="utf-8">
	<title>GameBet</title>
	<link rel="stylesheet" href=<?php echo WEBROOT. "assets/CSS/bootstrap.css"?>>
	<link rel="stylesheet" href=<?php echo WEBROOT. "assets/CSS/app.css"?>>
	<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
</head>
<body>
	<div class="navbar navbar-inverse navbar-fixed-top bg-primary">
		<div class="container-fluid">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href=<?php echo WEBROOT. "admin/_home"?>>Game Bet</a>
			</div>
			<div class="collapse navbar-collapse">
				<ul class="nav navbar-nav">
					<li class="active"><a href=<?php echo WEBROOT. "admin/_home"?>>Admin</a></li>
				</ul>
				<ul class="nav navbar-nav navbar-right">
					<li><a href=<?php echo WEBROOT. "admin/event"?>>Gestion Evenement</a></li>
					<li><a href=<?php echo WEBROOT?>>Deconnexion</a></li>
				</ul>
			</div>
		</div>
	</div>
	<div class="wide">
	</div>
	<div class="container-fluid">
		<?php echo $content_for_layout;?>
	</div>
	<div class="footer">
		<div class="container bottom">
			<a href='#'><i class="fa fa-twitch fa-3x fa-fw"></i></a>
			<a href='#'><i class="fa fa-facebook fa-3x fa-fw"></i></a>
			<a href='#'><i class="fa fa-twitter fa-3x fa-fw"></i></a>
			<a href='#'><i class="fa fa-youtube-play fa-3x fa-fw"></i></a>
			<a href='#'><i class="fa fa-rss fa-3x fa-fw"></i></a>
			<a href='#'><i class="fa fa-vine fa-3x fa-fw"></i></a>
			<a href='#'><i class="fa fa-flickr fa-3x fa-fw"></i></a>
			<a href='#'><i class="fa fa-linkedin fa-3x fa-fw"></i></a>
		</span>
	</div>
</div>
</body>
<script src=<?php echo WEBROOT. "assets/JS/jquery.js"?>></script>
<script src=<?php echo WEBROOT. "assets/JS/event.js"?>></script>
<script src=<?php echo WEBROOT. "assets/JS/date_event.js"?>></script>
</html>