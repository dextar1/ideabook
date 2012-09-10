<div class="transparent_bg">
	<div class="navbar">
		<div class="navbar-inner">
			<span class="brand" >Search Results for "<?php echo $value;?>"</span>
		</div>
	</div>
	<div class="searchResult">
		
		<?php if (!$noRecords) {
			foreach ($queryResult as $result) { ?>
			<div class="searchItem">
				<div class="leftBox">
					<img src="<?php echo $result['images'];?>" alt="no image"/>
				</div>
				<div class="rightBox">
					<h4><?php echo $result['tstamp'];?></h4>
					<h5><?php echo $result['user_id'];?></h5>
					<h2><?php echo anchor('#', $result['title'], array('title' => 'View this idea!')); ?></h2>
					<p><?php echo $result['description'];?></p>
				</div>
			</div>
			<div class="clear"></div>
			<hr class="seperator"/>
			<?php }	?>
		<div class="pagination pagination-right"><?php echo $links; ?></div>
		<?php }else {?>
			 <h2>No Result Found!</h2>
		<?php } ?>
		
	</div>
</div>