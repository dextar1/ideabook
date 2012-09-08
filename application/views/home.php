<div class="row">
	<div class="span12">
		
		<div id="searchBox">
		<div class="alert alert-error" style="display:none; position:absolute;margin-top:-62px;width:396px;">
  <button type="button" class="close" data-dismiss="alert">x</button>
  Text field is empty.
</div>
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
			if($('input[name=q]').text().trim() == '') {
				$('#searchBox .alert').stop(true,true).fadeIn().delay(2000).fadeOut();
				return false;
			}
			$('#searchBox').animate({
				marginTop: '-=150'
			});
			}
			return false;
		});
	});
</script>