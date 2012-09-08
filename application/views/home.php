<div class="row">
	<div class="span12">
		
		<div id="searchBox">

	    <h1>Explore the world of ideas</h1>
			<form class="navbar-search" id="srchForm" method="GET">
			  <input type="text" name="q" class="search-query" placeholder="Search Ideas" style="width:420px">
			<div class="hint">
				<a class="btn btn-small srchBtn" href="#"><i class="icon-search"></i></a>
			</div>
			</form>
			<div class="results"></div>
		</div>
	</div>
</div>
<script>
	$(function(){
		$('.srchBtn').click(function(){
			$('#srchForm').submit();
		});
		$('#srchForm').submit(function(){
			if($('#searchBox').css('margin-top') == '150px') {
			$('#searchBox').animate({
				marginTop: '-=150'
			});
			}
			return false;
		});
	});
</script>