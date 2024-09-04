<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>LOGIN MS EXPORT FLOWERS</title>

    <link rel="stylesheet" href="fonts/material-icon/css/material-design-iconic-font.min.css">

    <link rel="stylesheet" href="css/style.css">

    <script src="vendor/jquery/jquery.min.js"></script>

    <script src="js/validation.js"></script>
</head>
<body>

    <div class="main">
        <section class="sign-in">
            <div class="container">
                <div class="signin-content">
                    <div class="signin-image">
						<br><br>
                        <figure><img src="images/logo.jpg" alt="sing up image"></figure>
                    </div>

                    <div class="signin-form">
                        <h2 class="form-title">Iniciar sesión</h2>

                        <form method="POST" action="{{ route('login') }}" id="login-form">
                            @csrf

							<div class="form-group">
								<label for="email"><i class="zmdi zmdi-account material-icons-name"></i></label>
								<input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
								<span class="error-message"></span>
							  </div>
							  

							<div class="form-group">
								<label for="password"><i class="zmdi zmdi-lock"></i></label>
								<input id="password" type="password" name="password" required autocomplete="current-password" />
								<span class="error-message"></span>
							  </div>
							  

                            <div class="form-group">
                                <input type="checkbox" name="remember-me" id="remember-me" class="agree-term" />
                                <label for="remember-me" class="label-agree-term"><span><span></span></span>Recuérdame</label>
                            </div>

                            <div class="form-group">
                                <button type="submit" name="submit" id="submit" class="form-submit submit" value="Log in">Iniciar sesión</button>
								<br><br>
								<a href="{{ route('home.welcome') }}" class="submit-link submit">Cancelar</a>
							</div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <script src="js/main.js"></script>
	  
</body>
</html>
