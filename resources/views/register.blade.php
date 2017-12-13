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
    <title>Kid City | Register</title>

    <!-- Styles -->
    <link href="css/reset.css" rel="stylesheet">
    <!-- <link href="css/font-awesome.min.css" rel="stylesheet"> -->
    <link href="css/flex.css" rel="stylesheet">
    <link href="css/styles.css" rel="stylesheet">
    <link href="css/login.css" rel="stylesheet">
</head>
<body>
	<div id="loginWrapper">
		<aside style="background-image: url(images/login-image.jpg);">
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
				<div id="message" class="layout vertical center-center flex">
					<div id="testimonials">
						<div class="testimonial current layout vertical center-center">
							<p>
								Shopping with kidcity was really fun; everything was easy to find and their response was very prompt such that it made me want to buy more and more. There's no one like them, check them out.
							</p>
							<h3>Anna Mhando - Ilala</h3>
						</div>

						<div class="testimonial layout vertical center-center">
							<p>
								Kuna siku nilipita hapo kwa haraka ili nipate nguo za mwanangu and nilikua na haraka sana na nilifanikiwa kufanya kila kitu kwa urahisi kabisa na bado nikawahi nilipokua nakwenda.
							</p>
							<h3>Mayanza Kaliua - Mbezi Beach</h3>
						</div>

						<div class="testimonial layout vertical center-center">
							<p>
								Hawa jamaa kazi wanaiweza kusema kweli,
								niliwapa order ya nguo ambazo hawakua nazo at the time and I managed to get them within just a week of my request perfect measurements and all.
							</p>
							<h3>Pius Jeremiah - Kigamboni</h3>
						</div>
					</div>

					<div id="testimonialLinks" class="layout center-center">
						<a href="javascript:void(0);" class="active"
							onclick="setTestimonial(0)"></a>
						<a href="javascript:void(0);"
							onclick="setTestimonial(1)"></a>
						<a href="javascript:void(0);"
							onclick="setTestimonial(2)"></a>
					</div>
				</div>
			</div>
		</aside>
		<main>
			<div id="otherLink" class="layout center end-justified">
				<h3>Already have an account?</h3>
				<a href="login.php" class="btn">
					Sign In
				</a>
			</div>
			<div id="formWrapper" class="layout vertical center-justified">
				<h3 id="pageTitle">
					Register for Kidcity
				</h3>

				<form action="login.php" id="form" method="POST">
					<label>FULL NAME</label>
					<input type="text" class="input" placeholder="Enter your name">

					<label>PHONE NUMBER</label>
					<input type="phone" class="input" placeholder="Enter phone number">

					<label>PASSWORD</label>
					<input type="password" class="input" placeholder="Your Password">

					<button class="btn block large">
						SUBMIT
					</button>
				</form>
			</div>
		</main>
	</div>

	<script>
		var curidx = 0;
		var testimonials = document.querySelectorAll(".testimonial");
		var links = document.querySelectorAll("#testimonialLinks a");

		console.log(testimonials.length, links.length);

		function setTestimonial(i){
			testimonials[curidx].classList.remove("current");
			links[curidx].classList.remove("active");

			testimonials[i].classList.add("current");
			links[i].classList.add("active");
			curidx = i;
		}
	</script>
</body>
</html>