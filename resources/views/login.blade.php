<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <!-- CSRF Token -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="keywords" content="Buni,tanzania technology, innovation, girls in innovation">
    <meta name="description" content="A platform that aims to bridge the gap in innovation for women.">
    <meta name="author" content="iPF Softwares ">
    <meta charset="UTF-8">
    <link href="fav.png" rel="shortcut icon" type="image">
    <title>Kid City | Login</title>

    <!-- Styles -->
    <link href="css/reset.css" rel="stylesheet">
    <!-- <link href="css/font-awesome.min.css" rel="stylesheet"> -->
    <link href="css/flex.css" rel="stylesheet">
    <link href="css/styles.css" rel="stylesheet">
    <link href="css/login.css" rel="stylesheet">
</head>
<body>
	<div id="loginWrapper">
		<aside class="light" style="background-image: url(images/login-image2.jpg); background-size: cover; background-position: top center;">
			<div id="text" class="layout vertical">
				<div id="navbar" class="layout center">
					<div id="loginLogo">
						<a href="index.php">
							<img src="images/logo.png" alt="">
						</a>
					</div>

					<a href="index.php">
						HOME
					</a>
				</div>
				<div class="flex"></div>
				<p style="display: none; margin: auto;font-size: 1.6em; padding: 24px 40px 20px 40px; font-family: PT Light; border-top: 1px solid #888;">
					Let your kid shine with us.
				</p>
			</div>
		</aside>
		<main>
			<div id="otherLink" class="layout center end-justified">
				<h3>Don't have an account yet?</h3>
				<a href="register.php" class="btn">
					Register
				</a>
			</div>
			<div id="formWrapper" class="layout vertical center-justified">
				<h3 id="pageTitle">
					Sign In to Kidcity
				</h3>

				<form action="index.php" id="form" method="POST">
					<label>PHONE NUMBER</label>
					<input type="text" class="input" placeholder="Enter phone number">
					<label>PASSWORD</label>
					<input type="password" class="input" placeholder="Your Password">
					<button class="btn block large">
						SUBMIT
					</button>
				</form>
			</div>
		</main>
	</div>
</body>
</html>