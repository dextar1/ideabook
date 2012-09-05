<html>
	<head>
		
	<head>
	<body>
		<?php if($inserted){?>
			data is inserted
		<?php } else if($error){?>
			Unable to insert
		<?php  } ?>
		<br />Add New idea
		<form method="POST" action="idea/addIdea">
			<table>
				<tr>
					<td>Title</td>
					<td><input type="text" name="newidea_title" /></td>
				</tr>
				<tr>
					<td>Idea</td>
					<td><input type="text" name="newidea_idea" /></td>
				</tr>
				<tr>
					<td>Category</td>
					<td>
						<select name="newidea_category" style="width:155px;">
							<?php foreach($categories as $category){?>
								<option value="<?php echo $category['id']; ?>"><?php echo $category['name']; ?></option>
							<?php } ?>
						</select>
					</td>
				</tr>
				<tr>
					<td>Keywords</td>
					<td><input type="text" name="newidea_keywords" /></td>
				</tr>
				<tr>
					<td>Tags</td>
					<td><input type="text" name="newidea_tags" /></td>
				</tr>
				<tr>
					<td></td>
					<td><input type="submit" name="submit" value="submit" /></td>
				</tr>
			</table>
		</form>
		<?php echo anchor('idea/viewIdeas','Ideas');?>
		
	</body>
</html>