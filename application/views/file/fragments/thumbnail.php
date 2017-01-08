<!-- Comment markers background: http://stackoverflow.com/a/14776780/953022 -->
<div class="container-wide">
<?php
$base_url = site_url();
if (substr($base_url, -1) !== "/") {
	$base_url .= "/";
}
$counter = 0;
?>
<div class="upload_thumbnails"><!--
	<?php foreach($items as $key => $item):
		$counter++;
	 ?>
		--><a
			<?php if (strpos($item["mimetype"], "image/") === 0) {?>rel="gallery" class="colorbox"<?php } ?>
			data-orientation="<?php echo $item["orientation"]; ?>"
			href="<?php echo $base_url.$item["id"]."/"; ?>"
			title="<?php echo htmlentities($item["filename"], ENT_QUOTES); ?>"
			data-content="<?php echo htmlentities($item["tooltip"], ENT_QUOTES); ?>"
			data-id="<?php echo $item["id"]; ?>"><!--
			--><?php if ($counter > 42) {
				?><img
					class="thumb lazyload"
					data-original="<?php echo $base_url."file/thumbnail/".$item["id"]; ?>"
				><?php
			} else {
				 ?><img
					class="thumb"
					src="<?php echo $base_url."file/thumbnail/".$item["id"]; ?>"><?php
			} ?><!--
			--><noscript><img class="thumb" src="<?php echo $base_url."file/thumbnail/".$item["id"]; ?>"></noscript></a><!--
	<?php endforeach; ?>
	-->
</div>
</div>
