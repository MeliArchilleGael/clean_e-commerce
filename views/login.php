<div class="wrapper">
		<section class="login-container">
		   <div>
				<header>
					<h2>IDENTIFICATION</h2>
				</header>
               
            <form action="<?= URL.'/login/checkLogin' ?> " method="post">
				<label for="email">Email</label>
                <input type="text" name="email" placeholder="email" required="required"/>
                
				<label for="password">Mot de Passe</label>
				<input type="password" name="password" placeholder="Mot de passe" required="required"/>
                <button type="submit"  name="connexion">Connexion</button>
                <button type="submit"><a href="inscription.php">S'inscrire</a></button>
            </form>
          </div>
        </section>
    </div>