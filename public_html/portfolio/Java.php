<?php
/*grab current directory*/
$CURRENT_DIR = __DIR__;

/*load head-utils.php*/
//require_once("../php/partials/head-utils.php");

// Initialize your autoloader (this example is using composer)
require '../../vendor/autoload.php';
// Instantiate the Highlighter.
$hl = new Highlight\Highlighter();
// Highlight some code.
$r = $hl->highlight("java", file_get_contents("../documentation/Binary.java"));
//$s = $hl->highlight("cpp", file_get_contents("../documentation/binary.h"));
$t = $hl->highlight("cpp", file_get_contents("../documentation/JavaOutput.txt"));

/*load head-utils.php*/
require_once("../php/partials/head-utils.php");

?>
<!--
<head>
	<!-- Link to the stylesheets:
	<link rel="stylesheet" type="text/css" href="../css/hybrid.css">
</head>
-->

<body class="sfooter">
	<div class="sfooter-content">
		<!-- begin header and nav -->
		<?php
		/*load header.php*/
		require_once("../php/partials/header.php");
		?>


		<!-- welcome section
		<section id="welcome">
			<div class="container">
				<div class="jumbotron text-center">
					<h1>Online Portfolio</h1>
					<p>This Portfolio section is currently under construction. </p>
				</div>
			</div>
		</section> <!--welcome-->

		<div class="container pad">




			<div class="well">
				<h2 align="center">Java</h2>
				<p>This is the Java version

				<ul>
					<li><a href="C.php"><b>ANSI C</b></a></li>
					<li><a href="CPP11.php"><b>C++ 11</b></a></li>
					<li><a href="Java.php"><b>Java</b></a></li>
					<li><a href="Python.php"><b>Python</b></a></li>
				</ul>  All 4 programs were written in a Linux environment.  You're welcome to download the <a href="../documentation/tar_file_coming_soon.txt" download><b>'tar' file</b></a>, if you wish to run them yourself.</p>

			</div> <!-- class"well" -->





			<div class="row">
				<div class="col-xs-12 col-md-7 col-md-offset-2">
					<pre class="hljs <?=$r->language?>"><?=$r->value?></pre>
				</div>
			</div>


			<div class="row">
				<div class="col-xs-12 col-md-6 col-md-offset-2">
					<pre class="hljs <?=$s->language?>"><?=$s->value?></pre>
				</div>
			</div>

			<div class="row">
				<div class="col-xs-12 col-md-5 col-md-offset-2">
					<pre class="hljs <?=$t->language?>"><?=$t->value?></pre>
				</div>
			</div>

		</div>





		<!-- image thumbnail section -->
		<!--<section id="thumbnails" class="p-x-10">-->


		<!--</section>thumbnails-->
	</div><!--/.sfooter-content-->

	<!--begin footer -->
	<?php
	/*load footer.php*/
	require_once("../php/partials/footer.php");
	?>

</body>
</html>