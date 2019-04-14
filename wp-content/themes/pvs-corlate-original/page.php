<?php 
get_header(); 

$textpage=get_post();
?>
<div class="container">
		<h1><?php echo($textpage -> post_title);?></h1>
		<?php 
		$content = $textpage -> post_content;
		$content = apply_filters('the_content', $content);
		$content = str_replace(']]>', ']]&gt;', $content);
		echo $content;
		?>
</div>
<?php 
get_footer(); 
?>