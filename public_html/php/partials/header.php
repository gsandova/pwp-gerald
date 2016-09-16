<?php
/**
 * Get the relative path.
 * @see https://raw.githubusercontent.com/kingscreations/farm-to-you/master/php/lib/_header.php FarmToYou Header
 **/
// include the appropriate number of dirname() functions
// on line 8 to correctly resolve your directory's path
require_once(dirname(dirname(__DIR__)) . "/root-path.php");
$CURRENT_DEPTH = substr_count($CURRENT_DIR, "/");
$ROOT_DEPTH = substr_count($ROOT_PATH, "/");
$DEPTH_DIFFERENCE = $CURRENT_DEPTH - $ROOT_DEPTH;
$PREFIX = str_repeat("../", $DEPTH_DIFFERENCE);
?>

<header>
	<nav class="navbar navbar-inverse navbar-fixed-top">
		<div class="container">
			<!-- Brand and toggle get grouped for better mobile display -->
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="<?php echo $PREFIX;?>">Gerald Sandoval</a></li>
				<!--
				<a class="navbar-brand" href="<?php echo $PREFIX;?>"><?php echo phpinfo() ?></a></li>
				-->
			</div> <!-- navbar-header -->

			<!-- Collect the nav links, forms, and other content for toggling -->
			<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
				<ul class="nav navbar-nav navbar-right">
					<li><a href="<?php echo $PREFIX;?>">Home</a></li>
					<li><a href="<?php echo $PREFIX;?>resume/">Resume</a></li>

					<li><a href="<?php echo $PREFIX;?>portfolio/">Portfolio</a></li>

					<li><a href="<?php echo $PREFIX;?>contact/">Contact</a></li>
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Download Resume <span class="caret"></span></a>
						<ul class="dropdown-menu">
							<li><a href="<?php echo $PREFIX;?>documentation/gsandoval_resume.pdf" download>*.pdf format</a></li>
							<li><a href="<?php echo $PREFIX;?>documentation/gsandoval_resume.doc" download>*.doc format</a></li>
						</ul>
					</li><!-- end dropdown -->
				</ul>
			</div><!-- /.navbar-collapse -->
		</div><!-- /.container-fluid -->
	</nav>
</header>
