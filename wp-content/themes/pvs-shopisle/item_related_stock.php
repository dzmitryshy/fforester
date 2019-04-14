<?php
$pvs_theme_content[ 'related_content' ] = '<li class="product">
		<div class="prod-img-wrap" style="background:url(\'' . @$related_preview . '\');background-size:cover;background-repeat:no-repeat;background-position:center center">
			<a href="' . @$related_url . '"><img alt="' . @$related_title . '" src="' . pvs_plugins_url(). '/assets/images/e.gif" ' . @$related_lightbox . '></a>
		</div>
		<a href="' . @$related_url . '"><h3>#' . $related_id . '</h3></a>
</li>';
?>