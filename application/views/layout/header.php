<!DOCTYPE html>
<html>
  <head>
	<base href="<?php echo base_url();?>" />
	<style type="text/css" media="screen">
		body {
			background-image:url('assets/img/high_res_img.jpg');
			background-attachment:fixed;
			background-size:cover;
			background-position:50% 50%;
		}
		.container {
			width:960px;
		}
	</style>
	<meta charset="utf-8">
    <title>ideabook - a service to keep ideas</title>
	<script src="http://code.jquery.com/jquery-latest.js"></script>
    <!-- Bootstrap -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
		<link href="assets/css/customstyle.css" rel="stylesheet">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
  </head>
  <body>
	<div class="container">
		<!-- Navbar
		    ================================================== -->
		    <div class="navbar navbar-inverse navbar-fixed-top">
		      <div class="navbar-inner" style="max-height:40px">
		        <div class="container">
		          <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
		            <span class="icon-bar"></span>
		            <span class="icon-bar"></span>
		            <span class="icon-bar"></span>
		          </button>
		          <a class="brand" style="padding-bottom:8px; padding-top:8px" href="./index.html"><i class="icon-home icon-white" style="margin-top:5px"></i> ideabook</a>
		          <div class="nav-collapse collapse">
		            <ul class="nav">
		              <li class="active">
		                <?php echo anchor('idea/search','<i class="icon-search icon-white"></i> Explore Ideas')?>
		              </li>
		              <li class="">
		                <a href="./getting-started.html"><i class="icon-pencil icon-white"></i> New Idea</a>
		              </li>
		              
		              <li class="">
		                <a href="./scaffolding.html"><i class="icon-book icon-white"></i> My ideabook</a>
		              </li>
		            </ul>
								<?php if($search) {?>
								<form class="navbar-search pull-right" method="GET">
								  <input type="text" name="q" class="search-query" placeholder="Search Ideas">
								</form>
								<?php } ?>
								<ul class="nav pull-right">
									
									<?php echo $user_name;?>
									<li><?php echo $url;?></li>
								</ul>
		          </div>
		        </div>
		      </div>
		    </div>
	
		<div class="blankSpace">
			
		</div>