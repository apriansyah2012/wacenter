<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<meta charset="utf-8" />
		<title><?php if (isset($title)){ echo $title; }?> <?php if (isset($header)){ echo $header; }?></title>
				
		<meta name="description" content="overview &amp; stats" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />

		<!-- bootstrap & fontawesome -->
		<link rel="stylesheet" href="<?php echo base_url();?>assets/css/bootstrap.min.css" />
		<link rel="stylesheet" href="<?php echo base_url();?>assets/font-awesome/4.2.0/css/font-awesome.min.css" />
		<!-- page specific plugin styles -->

		<!-- text fonts -->
		<link rel="stylesheet" href="<?php echo base_url();?>assets/fonts/fonts.googleapis.com.css" />

		<!-- ace styles -->
		<link rel="stylesheet" href="<?php echo base_url();?>assets/css/ace.min.css" class="ace-main-stylesheet" id="main-ace-style" />

		<!--[if lte IE 9]>
			<link rel="stylesheet" href="<?php echo base_url();?>assets/css/ace-part2.min.css" class="ace-main-stylesheet" />
		<![endif]-->

		<!--[if lte IE 9]>
		  <link rel="stylesheet" href="<?php echo base_url();?>assets/css/ace-ie.min.css" />
		<![endif]-->

		<!-- inline styles related to this page -->

		<!-- ace settings handler -->
		<script src="<?php echo base_url();?>assets/js/ace-extra.min.js"></script>

		<!-- HTML5shiv and Respond.js for IE8 to support HTML5 elements and media queries -->

		<!--[if lte IE 8]>
		<script src="<?php echo base_url();?>assets/js/html5shiv.min.js"></script>
		<script src="<?php echo base_url();?>assets/js/respond.min.js"></script>
		<![endif]-->
	</head>

	<body class="no-skin">
		<div id="navbar" class="navbar navbar-default">
			<script type="text/javascript">
				try{ace.settings.check('navbar' , 'fixed')}catch(e){}
			</script>
			<!-- Awal/.navbar-TOP container -->
			<?php if (isset($top_navbar)){ echo  $this->load->view($top_navbar); }?>
			
			<!-- /.navbar-TOP container  Akhir -->
			
		</div>

		<div class="main-container" id="main-container">
			<script type="text/javascript">
				try{ace.settings.check('main-container' , 'fixed')}catch(e){}
			</script>

			<div id="sidebar" class="sidebar                  responsive">
				<script type="text/javascript">
					try{ace.settings.check('sidebar' , 'fixed')}catch(e){}
				</script>

				<div class="sidebar-shortcuts" id="sidebar-shortcuts">
					<div class="sidebar-shortcuts-large" id="sidebar-shortcuts-large">
						<button class="btn btn-success">
							<a href="#"><i class="ace-icon glyphicon glyphicon-home"></i></a>
						</button>

						<button class="btn btn-info">
							<a href="#"><i class="ace-icon glyphicon glyphicon-cog"></i></a>
						</button>

						<button class="btn btn-warning">
							<a href="#"><img class="pull-center" alt=""  src="<?php echo base_url();?>assets/img/suratmasuk.png" width="75%" height="75%"></i>
							</a>
						</button>

						<button class="btn btn-warning">
							<a href="#"><img class="pull-center" alt=""  src="<?php echo base_url();?>assets/img/suratkeluar.png" width="75%" height="75%"></a>
						</button>
					</div>

					<div class="sidebar-shortcuts-mini" id="sidebar-shortcuts-mini">
						<span class="btn btn-success"></span>

						<span class="btn btn-info"></span>

						<span class="btn btn-warning"></span>

						<span class="btn btn-danger"></span>
					</div>
				</div><!-- /.sidebar-shortcuts -->
					
				<!-- Awal /.nav-list -->
				
				<?php if (isset($left_navbar)){ echo  $this->load->view($left_navbar); }?>
				
				<!-- /.nav-list Akhir-->
				
				<div class="sidebar-toggle sidebar-collapse" id="sidebar-collapse">
					<i class="ace-icon fa fa-angle-double-left" data-icon1="ace-icon fa fa-angle-double-left" data-icon2="ace-icon fa fa-angle-double-right"></i>
				</div>

				<script type="text/javascript">
					try{ace.settings.check('sidebar' , 'collapsed')}catch(e){}
				</script>
			</div>

			<div class="main-content">
				<div class="main-content-inner">
					<div class="breadcrumbs" id="breadcrumbs">
						<script type="text/javascript">
							try{ace.settings.check('breadcrumbs' , 'fixed')}catch(e){}
						</script>
						<!-- /.Mulai breadcrumb -->
						<ul class="breadcrumb">
							<li>
								<i class="<?php if (isset($icon)){ echo $icon; }?>"></i>
								<a href="#"><?php if (isset($menu)){ echo $menu; }?></a>
							</li>
							<li class="active"><?php if (isset($submenu)){ echo $submenu; }?></li>
						</ul>
						<!-- /.breadcrumb Akhir -->
						<div class="nav-search" id="nav-search">
							<form class="form-search">
								<span class="input-icon">
									<input type="text" placeholder="Search ..." class="nav-search-input" id="nav-search-input" autocomplete="off" />
									<i class="ace-icon fa fa-search nav-search-icon"></i>
								</span>
							</form>
						</div><!-- /.nav-search -->
					</div>
						<!-- /.MULAI Navigasi BAr -->
						<?php if (isset($navigasi)){ echo  $this->load->view($navigasi); }?>
						
						<!-- /.AKHIR  Navigasi BAr -->
						<!-- /.MULAI page-header -->
						<div class="page-header">
							<h1>
								<?php if (isset($header)){ echo $header; }?>
								<small>
									<i class="ace-icon fa fa-angle-double-right"></i>
									<?php if (isset($subheader)){ echo $subheader; }?>
								</small>
							</h1>
						</div>
						<!-- /.page-header Akhir -->
						
						<div class="row">
							<div class="col-xs-12">
								<!-- MULAI PAGE CONTENT ENDS -->
								<?php if (isset($content)){ echo  $this->load->view($content); }?>
								<!-- PAGE CONTENT ENDS AKHIR  -->
							</div><!-- /.col -->
						</div><!-- /.row -->
					</div><!-- /.page-content -->
				</div>
			</div><!-- /.main-content -->
			
			<!-- MULAI FOOTER -->
			<?php if (isset($footer)){ echo  $this->load->view($footer); }?>
			<!-- FOOTER SELESAI-->
			
			<a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-sm btn-inverse">
				<i class="ace-icon fa fa-angle-double-up icon-only bigger-110"></i>
			</a>
		</div><!-- /.main-container -->

		<!-- basic scripts -->

		<!--[if !IE]> -->
		<script src="<?php echo base_url();?>assets/js/jquery.2.1.1.min.js"></script>

		<!-- <![endif]-->

		<!--[if IE]>
<script src="<?php echo base_url();?>assets/js/jquery.1.11.1.min.js"></script>
<![endif]-->

		<!--[if !IE]> -->
		<script type="text/javascript">
			window.jQuery || document.write("<script src='<?php echo base_url();?>assets/js/jquery.min.js'>"+"<"+"/script>");
		</script>

		<!-- <![endif]-->

		<!--[if IE]>
<script type="text/javascript">
 window.jQuery || document.write("<script src='<?php echo base_url();?>assets/js/jquery1x.min.js'>"+"<"+"/script>");
</script>
<![endif]-->
		<script type="text/javascript">
			if('ontouchstart' in document.documentElement) document.write("<script src='<?php echo base_url();?>assets/js/jquery.mobile.custom.min.js'>"+"<"+"/script>");
		</script>
		<script src="<?php echo base_url();?>assets/js/bootstrap.min.js"></script>

		<!-- page specific plugin scripts -->

		<!--[if lte IE 8]>
		  <script src="<?php echo base_url();?>assets/js/excanvas.min.js"></script>
		<![endif]-->
		<script src="<?php echo base_url();?>assets/js/jquery-ui.custom.min.js"></script>
		<script src="<?php echo base_url();?>assets/js/jquery.ui.touch-punch.min.js"></script>
		<script src="<?php echo base_url();?>assets/js/jquery.easypiechart.min.js"></script>
		<script src="<?php echo base_url();?>assets/js/jquery.sparkline.min.js"></script>
		<script src="<?php echo base_url();?>assets/js/jquery.flot.min.js"></script>
		<script src="<?php echo base_url();?>assets/js/jquery.flot.pie.min.js"></script>
		<script src="<?php echo base_url();?>assets/js/jquery.flot.resize.min.js"></script>

		<!-- ace scripts -->
		<script src="<?php echo base_url();?>assets/js/ace-elements.min.js"></script>
		<script src="<?php echo base_url();?>assets/js/ace.min.js"></script>

		
	</body>

	<style>
.pesan{
display: none;
width: 100%;
}
</style>
<script src="<?php echo base_url();?>assets/js/jquery.min.js"></script>
	<script>
	//angka 500 dibawah ini artinya pesan akan muncul dalam 0,5 detik setelah document ready
			$(document).ready(function(){setTimeout(function(){$(".pesan").fadeIn('slow');}, 500);});
	//angka 3000 dibawah ini artinya pesan akan hilang dalam 3 detik setelah muncul
		setTimeout(function(){$(".pesan").fadeOut('slow');}, 3000);
</script>
</html>
