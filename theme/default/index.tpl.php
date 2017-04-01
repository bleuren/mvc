<!doctype html>
<!--[if IE 8 ]>
<html class="ie ie8" lang="en">
<![endif]-->
<!--[if (gte IE 9)|!(IE)]>
<html lang="en" class="no-js">
<![endif]-->
<html lang="en">
<head>
<!--<base href="<?php echo 'http://localhost/mvc/'.basename(APP_REAL_PATH).'/'; ?>"> -->
<!-- Basic -->
<title><?php echo $this->lang['siteTitle']; ?></title>
<!-- Define Charset -->
<meta charset="utf-8">
<!-- Responsive Metatag -->
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<!-- Page Description and Author -->
<meta name="description" content="系統設計:任家輝">
<meta name="author" content="任家輝,Jia-Huei Ren">
<script type="text/javascript" src="libs/ckfinder/ckfinder.js"></script>
<script type="text/javascript" src="libs/ckeditor/ckeditor.js"></script>
<script type="text/javascript" src="libs/chart.js"></script>
<!-- Bootstrap CSS  -->
<link rel="stylesheet" href="theme/default/css/bootstrap.min.css" type="text/css" media="screen">
<!-- Font Awesome CSS -->
<link rel="stylesheet" href="theme/default/css/font-awesome.min.css" type="text/css" media="screen">
<!-- Slicknav -->
<link rel="stylesheet" type="text/css" href="theme/default/css/slicknav.min.css" media="screen">
<!-- Margo CSS Styles  -->
<link rel="stylesheet" type="text/css" href="theme/default/css/style.min.css" media="screen">
<!-- Responsive CSS Styles  -->
<link rel="stylesheet" type="text/css" href="theme/default/css/responsive.min.css" media="screen">
<!-- Css3 Transitions Styles  -->
<link rel="stylesheet" type="text/css" href="theme/default/css/animate.min.css" media="screen">
<!-- Color CSS Styles  -->
<link rel="stylesheet" type="text/css" href="theme/default/css/colors/red.css" title="red" media="screen"/>
<link rel="stylesheet" type="text/css" href="theme/default/css/colors/jade.css" title="jade" media="screen"/>
<link rel="stylesheet" type="text/css" href="theme/default/css/colors/green.css" title="green" media="screen"/>
<link rel="stylesheet" type="text/css" href="theme/default/css/colors/blue.css" title="blue" media="screen"/>
<link rel="stylesheet" type="text/css" href="theme/default/css/colors/beige.css" title="beige" media="screen"/>
<link rel="stylesheet" type="text/css" href="theme/default/css/colors/cyan.css" title="cyan" media="screen"/>
<link rel="stylesheet" type="text/css" href="theme/default/css/colors/orange.css" title="orange" media="screen"/>
<link rel="stylesheet" type="text/css" href="theme/default/css/colors/peach.css" title="peach" media="screen"/>
<link rel="stylesheet" type="text/css" href="theme/default/css/colors/pink.css" title="pink" media="screen"/>
<link rel="stylesheet" type="text/css" href="theme/default/css/colors/purple.css" title="purple" media="screen"/>
<link rel="stylesheet" type="text/css" href="theme/default/css/colors/sky-blue.css" title="sky-blue" media="screen"/>
<link rel="stylesheet" type="text/css" href="theme/default/css/colors/yellow.css" title="yellow" media="screen"/>
<!-- Margo JS  -->
<script type="text/javascript" src="theme/default/js/angular.min.js"></script>
<script type="text/javascript" src="theme/default/js/jquery-2.1.4.min.js"></script>
<script type="text/javascript" src="theme/default/js/jquery.migrate.min.js"></script>
<script type="text/javascript" src="theme/default/js/bootstrap.min.js"></script>
<!--檢測瀏覽器-->
<script type="text/javascript" src="theme/default/js/modernizrr.min.js"></script>
<!--switch-->
<script type="text/javascript" src="theme/default/js/jquery.fitvids.min.js"></script>
<script type="text/javascript" src="theme/default/js/owl.carousel.min.js"></script>
<script type="text/javascript" src="theme/default/js/nivo-lightbox.min.js"></script>
<!--slider-->
<script type="text/javascript" src="theme/default/js/jquery.isotope.min.js"></script>
<!--switch-->
<script type="text/javascript" src="theme/default/js/jquery.appear.min.js"></script>
<script type="text/javascript" src="theme/default/js/count-to.min.js"></script>
<script type="text/javascript" src="theme/default/js/jquery.textillate.min.js"></script>

<!--
  process letter
  <script type="text/javascript" src="theme/default/js/jquery.lettering.js"></script>
  chart
<script type="text/javascript" src="theme/default/js/jquery.easypiechart.min.js"></script>
-->
<!--switch-->
<script type="text/javascript" src="theme/default/js/jquery.nicescroll.min.js"></script>
<!--
  背景移動
  <script type="text/javascript" src="theme/default/js/jquery.parallax.js"></script>
<script type="text/javascript" src="theme/default/js/mediaelement-and-player.js"></script>
-->
<!--mobile-menu-->
<script type="text/javascript" src="theme/default/js/jquery.slicknav.min.js"></script>
<script type="text/javascript" src="theme/default/js/dirPagination.min.js"></script>
<!--[if IE 8]>
<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->
<!--[if lt IE 9]>
<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->
</head>
<body>
<!-- Full Body Container -->
<div id="container" class="boxed-page">
	<!-- Start Header Section -->
	<div class="hidden-header">
	</div>
	<header class="clearfix">
	<!-- Start Top Bar -->
	<div class="top-bar dark-bar">
		<div class="container">
			<div class="row">
				<div class="col-md-7">
					<!-- Start Contact Info -->
					<ul class="contact-details">
						<li><a href="#"><i class="fa fa-map-marker"></i> 632 雲林縣虎尾鎮文化路64號 </a>
						</li>
						<li><a href="mailto:rsh4@nfu.edu.tw"><i class="fa fa-envelope-o"></i> rsh4@nfu.edu.tw</a>
						</li>
						<li><a href="#"><i class="fa fa-phone"></i> (05)-631-5564</a>
						</li>
					</ul>
					<!-- End Contact Info -->
				</div>
			</div>
			<!-- .row -->
		</div>
		<!-- .container -->
	</div>
	<!-- .top-bar -->
	<!-- End Top Bar -->
	<!-- Start  Logo & Naviagtion  -->
	<div class="navbar navbar-default navbar-top">
		<div class="container">
			<div class="navbar-header">
				<!-- Stat Toggle Nav Link For Mobiles -->
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
				<i class="fa fa-bars"></i>
				</button>
				<!-- End Toggle Nav Link For Mobiles -->
				<a class="navbar-brand" href="index.php">
				<img alt="" src="theme/default/images/logo.png">
				</a>
			</div>
			<div class="navbar-collapse collapse">
				<!-- Stat Search -->
				<div class="search-side">
					<a class="show-search"><i class="fa fa-search"></i></a>
					<div class="search-form">
						<form autocomplete="off" role="search" method="post" class="searchform" action="#">
                            <input type="hidden" name="csrf" value="<?php echo $this->token; ?>" />
							<input type="text" value="" name="keyword" id="keyword" placeholder="Search the site (Constructing)">
						</form>
					</div>
				</div>
				<!-- End Search -->
				<!-- Start Navigation List -->
				<ul class="nav navbar-nav navbar-right">
					<li><a class="active" href="index.php"><?php echo $this->lang['home']; ?></a></li>
					<?php foreach ($this->pages as $i => $v): ?>
					<?php if ($v->display!=0): ?>
						<?php if (empty($v->sub)): ?>
						<li><a href="<?php if (!empty($v->url)): ?><?php echo $v->url; ?><?php else:?>
						index.php?mod=pages&act=show&id=<?php echo $v->id; ?><?php endif; ?>
						"><?php echo $v->name; ?></a></li>
						<?php else: ?>
						<li><a href="<?php if (!empty($v->url)): ?><?php echo $v->url; ?><?php else:?>
						index.php?mod=pages&act=show&id=<?php echo $v->id; ?><?php endif; ?>
						"><?php echo $v->name; ?></a>
						<ul class="dropdown">
							<?php foreach ($v->sub as $j => $k): ?>
							<?php if ($k->display!=0): ?>
							<li><a href="<?php if (!empty($k->url)): ?><?php echo $k->url; ?><?php else:?>
							index.php?mod=pages&act=show&id=<?php echo $k->id; ?><?php endif; ?>
							"><?php echo $k->name; ?></a></li>
							<?php endif; ?>
							<?php endforeach; ?>
						</ul>
						</li>
						<?php endif; ?>
					<?php endif; ?>
					<?php endforeach; ?>
				</ul>
				<!-- End Navigation List -->
			</div>
		</div>
		<!-- Mobile Menu Start -->
		<ul class="wpb-mobile-menu">
			<?php foreach ($this->pages as $i => $v): ?>
			<?php if (empty($v->sub)): ?>
			<li><a href="<?php if (!empty($v->url)): ?><?php echo $v->url; ?><?php else:?>
			index.php?mod=pages&act=show&id=<?php echo $v->id; ?><?php endif; ?>
			"><?php echo $v->name; ?></a></li>
			<?php else: ?>
			<li><a href="<?php if (!empty($v->url)): ?><?php echo $v->url; ?><?php else:?>
			index.php?mod=pages&act=show&id=<?php echo $v->id; ?><?php endif; ?>
			"><?php echo $v->name; ?></a>
			<ul class="dropdown">
				<?php foreach ($v->sub as $j => $k): ?>
				<li><a href="<?php if (!empty($k->url)): ?><?php echo $k->url; ?><?php else:?>index.php?mod=pages&act=show&id=<?php echo $k->id; ?><?php endif; ?>"><?php echo $k->name; ?></a></li>
				<?php endforeach; ?>
			</ul>
			</li>
			<?php endif; ?>
			<?php endforeach; ?>
		</ul>
		<!-- Mobile Menu End -->
	</div>
	<!-- End Header Logo & Naviagtion -->
	</header>
	<!-- End Header Section -->
	<!-- Start Home Page Slider -->
	<section id="home">
	<!-- Carousel -->
	<div id="main-slide" class="carousel slide" data-ride="carousel">
		<!-- Indicators -->
		<ol class="carousel-indicators">
			<li data-target="#main-slide" data-slide-to="0" class="active"></li>
			<li data-target="#main-slide" data-slide-to="1"></li>
			<li data-target="#main-slide" data-slide-to="2"></li>
		</ol>
		<!--/ Indicators end-->
		<!-- Carousel inner -->
		<div class="carousel-inner">
			<div class="item active">
				<img class="img-responsive" src="theme/default/images/slider/bg1.jpg" alt="slider">
				<div class="slider-content">
					<div class="col-md-12 text-center">
						<!--
                <h2 class="animated2">
						<span>Welcome to <strong>Margo</strong></span>
						</h2>
						<h3 class="animated3">
						<span>The ultimate aim of your business</span>
						</h3>
						<p class="animated4">
							<a href="#" class="slider btn btn-system btn-large">Check Now</a>
						</p>
                -->
					</div>
				</div>
			</div>
			<!--/ Carousel item end -->
			<div class="item">
				<img class="img-responsive" src="theme/default/images/slider/bg1.jpg" alt="slider">
				<div class="slider-content">
					<div class="col-md-12 text-center">
					</div>
				</div>
			</div>
			<!--/ Carousel item end -->
			<div class="item">
				<img class="img-responsive" src="theme/default/images/slider/bg1.jpg" alt="slider">
				<div class="slider-content">
					<div class="col-md-12 text-center">
					</div>
				</div>
			</div>
			<!--/ Carousel item end -->
		</div>
		<!-- Carousel inner end-->
		<!-- Controls -->
		<a class="left carousel-control" href="#main-slide" data-slide="prev">
		<span><i class="fa fa-angle-left"></i></span>
		</a>
		<a class="right carousel-control" href="#main-slide" data-slide="next">
		<span><i class="fa fa-angle-right"></i></span>
		</a>
	</div>
	<!-- /carousel -->
	</section>
	<!-- End Home Page Slider -->
	<!-- Start Content -->
	<div id="content">
		<div class="container">
			<div class="row blog-page">
				<!--Sidebar-->
				<div class="col-md-3 sidebar left-sidebar">
					<!-- Categories Widget -->
					<!--add pjax class under this quote-->
					<div class="widget widget-categories">
						<h4><?php echo $this->lang['sidebar']; ?> <span class="head-line"></span></h4>
						<ul>
							<?php foreach ($this->sidebar as $i => $v): ?>
							<li><a href="<?php echo $v->url; ?>" target="<?php echo $v->target; ?>"><?php echo $v->name; ?></a></li>
							<?php endforeach; ?>
                            <?php foreach ($this->links as $link): ?>
							<li><a href="<?php echo $link->url; ?>" target="_blank"><img class="img-fluid" src="<?php echo $link->logo; ?>" width="180px" alt="<?php echo $link->name; ?>" /></a></li>
							<?php endforeach; ?>
						</ul>
					</div>
					<div class="widget widget-categories">
						<h4><?php echo $this->lang['userSidebar']; ?> <span class="head-line"></span></h4>
						<ul>
							<?php if (!isset($_SESSION['user'])): ?>
                            <li><a href="index.php?mod=users"><?php echo $this->lang['users.signIn']; ?></a></li>
							<?php else: ?>
							<li>
							<?php foreach ($this->module_menu as $v): ?>
							<?php $this->render($v); ?>
							<?php endforeach; ?>
							</li>
							<?php endif; ?>
						</ul>
					</div>
				</div>
				<!--End sidebar-->
				<!-- Start Blog Posts -->
				<div id="main" class="col-md-9 blog-box">
					<!-- End Toggle -->
					<?php $this->render($this->content); ?>							
				</div>
				<!-- End Blog Posts -->
			</div>
		</div>
	</div>
	<!-- End Content -->
	<!-- Start Footer -->
	<footer>
	<div class="container">
		<!-- Start Copyright -->
		<div class="copyright-section">
			<div class="row">
				<div class="col-md-6">
					<p>
						<?php echo $this->lang['browserSupport']; ?>
					</p>
				</div>
				<div class="col-md-6">
					<ul class="footer-nav">
						<li><a href="mailto:paste.ren@gmail.com"><?php echo $this->lang['copyright']; ?></a></li>
					</ul>
				</div>
			</div>
		</div>
		<!-- End Copyright -->
	</div>
	</footer>
	<!-- End Footer -->
</div>
<!-- End Container -->
<!-- Go To Top Link -->
<a href="#" class="back-to-top"><i class="fa fa-angle-up"></i></a>
<!-- Style Switcher -->
<div class="switcher-box">
	<a class="open-switcher show-switcher"><i class="fa fa-cog fa-2x"></i></a>
	<h4>Style Switcher</h4>
	<span>12 Predefined Color Skins</span>
	<ul class="colors-list">
		<li>
		<a onclick="setActiveStyleSheet('blue'); return false;" title="Blue" class="blue"></a>
		</li>
		<li>
		<a onclick="setActiveStyleSheet('sky-blue'); return false;" title="Sky Blue" class="sky-blue"></a>
		</li>
		<li>
		<a onclick="setActiveStyleSheet('cyan'); return false;" title="Cyan" class="cyan"></a>
		</li>
		<li>
		<a onclick="setActiveStyleSheet('jade'); return false;" title="Jade" class="jade"></a>
		</li>
		<li>
		<a onclick="setActiveStyleSheet('green'); return false;" title="Green" class="green"></a>
		</li>
		<li>
		<a onclick="setActiveStyleSheet('purple'); return false;" title="Purple" class="purple"></a>
		</li>
		<li>
		<a onclick="setActiveStyleSheet('pink'); return false;" title="Pink" class="pink"></a>
		</li>
		<li>
		<a onclick="setActiveStyleSheet('red'); return false;" title="Red" class="red"></a>
		</li>
		<li>
		<a onclick="setActiveStyleSheet('orange'); return false;" title="Orange" class="orange"></a>
		</li>
		<li>
		<a onclick="setActiveStyleSheet('yellow'); return false;" title="Yellow" class="yellow"></a>
		</li>
		<li>
		<a onclick="setActiveStyleSheet('peach'); return false;" title="Peach" class="peach"></a>
		</li>
		<li>
		<a onclick="setActiveStyleSheet('beige'); return false;" title="Biege" class="beige"></a>
		</li>
	</ul>
	<span>Top Bar Color</span>
	<select id="topbar-style" class="topbar-style">
		<option value="2">Dark (Default)</option>
		<option value="1">Light</option>
		<option value="3">Color</option>
	</select>
	<span>Layout Style</span>
	<select id="layout-style" class="layout-style">
		<option value="2">Boxed</option>
		<option value="1">Wide</option>
	</select>
	<span>Patterns for Boxed Version</span>
	<ul class="bg-list">
		<li>
		<a href="#" class="bg1"></a>
		</li>
		<li>
		<a href="#" class="bg2"></a>
		</li>
		<li>
		<a href="#" class="bg3"></a>
		</li>
		<li>
		<a href="#" class="bg4"></a>
		</li>
		<li>
		<a href="#" class="bg5"></a>
		</li>
		<li>
		<a href="#" class="bg6"></a>
		</li>
		<li>
		<a href="#" class="bg7"></a>
		</li>
		<li>
		<a href="#" class="bg8"></a>
		</li>
		<li>
		<a href="#" class="bg9"></a>
		</li>
		<li>
		<a href="#" class="bg10"></a>
		</li>
		<li>
		<a href="#" class="bg11"></a>
		</li>
		<li>
		<a href="#" class="bg12"></a>
		</li>
		<li>
		<a href="#" class="bg13"></a>
		</li>
		<li>
		<a href="#" class="bg14"></a>
		</li>
	</ul>
</div>

<script type="text/javascript" src="theme/default/js/script.js"></script>
<script>
var elem_textarea = document.getElementsByTagName("textarea");
for (var i = 0; i < elem_textarea.length; i++) {
	elem_textarea[i].id = 'ckeditor'
}
if (elem_textarea.length > 0) {
	var editor = CKEDITOR.replace('ckeditor', {language: '<?php echo LANG; ?>'});
	CKFinder.setupCKEditor(editor);
}
</script>
</body>
</html>