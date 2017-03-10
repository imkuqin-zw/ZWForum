<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<title>Error 500 - Internal Server Error</title>
	<meta name="viewport" content="width=device-width">
	<style type="text/css">
		body
		{
			font-family:'Droid Sans', sans-serif;
			font-size:10pt;
			color:#555;
			line-height: 25px;
		}

		.wrapper
		{
			width:90%;
			margin:0 auto 5em auto;
		}

		.main
		{
			overflow:hidden;
		}

		.error-spacer
		{
			height:4em;
		}

		a, a:visited
		{
			color:#2972A3;
		}

		a:hover
		{
			color:#72ADD4;
		}
	</style>
</head>
<body>
	<div class="wrapper">
		<div class="error-spacer"></div>
		<div role="main" class="main">
			<?php $messages = array('Ouch.', 'Oh no!', 'Whoops!'); ?>

			<h1><?php echo $messages[mt_rand(0, 2)]; ?></h1>

			<h2>Server Error: 500 (Internal Server Error)</h2>

			<hr>

			<h3>What does this mean?</h3>

			<p>
				Something went wrong on our servers while we were processing your request.
				We're really sorry about this, and will work hard to get this resolved as
				soon as possible.
			</p>

			<p>
				Perhaps you would like to go to our <a href="{{{ URL::to('/') }}}">home page</a>?
			</p>
		</div>
	</div>
</body>
</html>
