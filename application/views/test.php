<html>
<body>
<div class="show showTop f">
	<a href="<?php echo site_url('pictures/'.$newestpic[0]['posts_id']);?>">
		<img src="<?php echo site_url('thumb/'.'2/'. str_replace('/','_',$newestpic[0]['posts_thumb'])); ?>"  alt="<?php echo $newestpic[0]['posts_title']?>" title="<?php echo $newestpic[0]['posts_title']?>" />
		<div class="dj">
			<p>[图集]<?php echo $newestpic[0]['posts_title']?></p>
			<p>点击:<?php echo $newestpic[0]['posts_hit'];?></p>
		</div>
	</a>
</div>
</body>
</html>