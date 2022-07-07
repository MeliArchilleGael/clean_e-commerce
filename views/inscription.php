<div class="container ">
		<div class="row">
			<!--  <div class="col-md-4 offset-md-4">  -->
			<div class="login-form bg-light mt-4 p-4">
				<form action="<?=  URL.'/Inscription/inscrire' ?>" method="post" class="row g-3 " enctype="multipart/form-data">
					<h4>INSCRIPTION</h4>

					<div class="col-md-6 col-sm">
						<div class="col-md-12">
							<label for="inputNom" class="form-label">Nom</label>
							<input type="text" class="form-control" name="nom" id="inputNom" placeholder="Veuillez entrer votre nom">
						</div>

						<div class="col-md-12">
							<label for="inputPrenom" class="form-label">Prenom</label>
							<input type="text" class="form-control" name="prenom" id="inputPrenom" placeholder="Veuillez entrer votre prenom">
						</div>

						<div class="col-md-12">
							<label for="inputEmail" class="form-label">Email</label>
							<input type="text" class="form-control" name="email" id="inputEmail" placeholder="Veuillez entrer votre email">
						</div>

						<div class="col-md-12">
							<label for="inputPassword" class="form-label">Password</label>
							<input type="password" class="form-control" name="password" id="inputPassword" placeholder="Veuillez entrer votre password">
						</div>

						<div class="col-md-12">
							<label for="inputTelephone" class="form-label">Telephone</label>
							<input type="text" class="form-control" name="telephone" id="inputtelephone" placeholder="Veuillez entrer votre phone number">
						</div>

						<div class="col-md-12">
							<label for="FormFile" class="form-label">Image</label>
							<input type="file" class="form-control" name="image" id="FormFile" placeholder="Veuillez importer une image">
						</div>
						<br>
						<select class="form-select" name="type">
							<option selected>Choisir</option>
							<option value="PRESTATAIRE">PRESTATAIRE</option>
							<option value="CLIENT">CLIENT</option>
						</select>
					</div>
					<div class="col-md-6 col-sm">
						<div class="col-md-12">
							<label for="rue" class="form-label">Entrez le nom de la rue</label>
							<input type="text" class="form-control" id="rue" name="nomrue" placeholder="nom de la rue" />
						</div>
						<div class="col-md-12">
							<label for="code" class="form-label">Entrez le code postal</label>
							<input type="text" class="form-control" id="code" name="codepostal" placeholder="code postal" />
						</div>
						<div class="col-md-12">
							<label for="ville" class="form-label">Entrez la ville</label>
							<input type="text" class="form-control" id="ville" name="ville" placeholder="Votre ville" />
						</div>

						<br>
						<div class="col-md-12">
							<div class="d-flex  justify-content-center">
								<button type="submit" class="btn btn-primary" value="valider" name="sinscrire" class="btn btn-default pull-right">valider</button>
							</div>
						</div>
				</form>
			</div>
		</div>
	</div>