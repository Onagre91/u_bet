<div id="webroot" hidden="true"><?php echo WEBROOT ?></div>
<div class="container-fluid">
	<div class="container error">
	</div>
	<div class="col-md-6">
		<form method="post" class="breadcrumb">
			<h1>Inscription</h1>
			<div class="form-group">
				<label class="col-md-4">Login</label>
				<input type="text" class="form-control" id="name" name="login" placeholder="Login">
			</div>
			<div class="form-group">
				<label class="col-md-4">E-mail</label>
				<input type="text" class="form-control" id="email" name="email" placeholder="Email">
			</div>
			<div class="form-group">
				<label class="col-md-4">Mot de passe</label>
				<input type="password" class="form-control" id="subject" name="pwd" placeholder="password">
			</div>
			<button type="submit" id="inscription" name="submit" class="btn btn-primary">Submit</button>
		</form>
	</div>

	<div class="col-md-6">
		<form method="post" class="breadcrumb">
			<h1>Connexion</h1>
			<div class="form-group">
				<label class="col-md-4">Login</label>
				<input type="text" class="form-control" id="name" name="login" placeholder="Login">
			</div>
			<div class="form-group">
				<label class="col-md-4">Mot de passe</label>
				<input type="password" class="form-control" id="subject" name="pwd" placeholder="password">
			</div>
			<button type="submit" id="connexion" name="submit" class="form btn btn-primary">Submit</button>
		</form>
	</div>
</div>
</div>