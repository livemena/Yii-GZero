<?php 
	$cs = Yii::app()->clientScript;
?>
<style>
.toplink {
	position: fixed;
	bottom: 50px;
	right: 50px;
	padding: 5px 8px 0 5px;
	border: solid 1px #ddd;
	border-radius: 5px;
	background: #fff;
}
.panel{
	padding:0 20px 20px;
	border:1px solid #eee
}
.toplink a {
	color: #bbb;
	text-decoration: none;
}
.toplink a:hover {
	color: #888;
}

#nav-side .affix{
	top:10px;
}
#nav-side ul.affix{
	width:263px
}
</style>
<div class="page-header">
	<h1>Documentation</h1> 
</div>
<div class="toplink"><a href="#" class="h1" title="go to top"><span class="glyphicon glyphicon-arrow-up"></span></a></div>

<div class="row">
<div class="col-md-3">

<nav id="nav-side" class="hidden-sm hidden-xs">
	<ul class="nav nav-pills nav-stacked" data-spy="affix" data-offset-top="190">
		<li class="active"><a href="#mobile_detection">Mobile detection</a></li>
		<li><a href="#css_js">CSS & Javascript</a></li>
		<li><a href="#og">Open graph protocol</a></li>
		<li><a href="#text">Text helper</a></li>
		<li><a href="#img">Image helper</a></li>
		<li><a href="#useful_links">Useful links</a></li>
	</ul>
</nav>

</div>
	<script>
		$(function(){
			$('body').attr('data-spy','scroll');
			$('body').attr('data-target','#nav-side');
		});
	</script>
<div class="col-md-9">

	<div class="panel" name="mobile_detection" id="mobile_detection">
	<h3>Mobile detection</h3>
<p>Mobile::isMobileBrowser() == boolean(true/false)
<br>
<br>
<b>Example:</b></p>
<pre>if(Mobile::isMobileBrowser()):
	// Do something ex: select mobile theme Yii::app()->theme = 'Mobile_Theme';
else:
	// Do something ex: select mobile theme Yii::app()->theme = 'Desktop_Theme';
</pre>
	</div>

	<div class="panel" name="css_js" id="css_js">
		<h3>CSS & Javascript</h3>
		<p>
			This function is included bootstrap, jquery, main_LANG.php, main.js and optional packages.
			<br>
			<br>
			<b>Available packages</b>
			<ul>
				<li>jQuery <small class="text-muted">CDN</small></li>
				<li>Bootstrap <small class="text-muted">CDN + RTL</small></li>
				<li>FontAwesome (optional) <small class="text-muted">CDN</small></li>
			</ul>
		</p>
		<br>
		<p>Copy this code to main.php layout or any page:</p>
<pre>GZero::registerPackage( cdn(boolean) , $ga_id(Google Analytics ID) ,array(
	'fontawesome',
));</pre>
	</div>
	<div class="panel" name="og" id="og">
		<h3>Open Graph Protocol</h3>
<pre>
GZero::registerOpenGraph(array(
	'site_name'=>Yii::app()->name,
	'title'=>$this->pageTitle,
	'description'=>null,
	'thumbnail'=>null, // uri
	'url'=>null
));
</pre>
	<p>For more information visit: <a href="http://ogp.me/">ogp.me</a></p>
	</div>

	<div class="panel" name="text" id="text">
		<h3>Text Helper</h3>
		<table class="table">
		<tbody><tr>
			<td><code>teaser</code></td>
			<td><pre>Text::teaser( TEXT (string) , Length (int) = 250 , $etc="..." , $strip_tags = true , $fullwords=true )</pre></td>
		</tr>
		</tbody></table>
		<a href="https://github.com/livemena/Yii-GZero/blob/master/protected/components/Text.php">components / Text.php</a>
	</div>
	
	<div class="panel" name="img" id="img">
		<h3>Image Helper</h3>

		<p>Copy this code to your model:</p>
		
<pre>
public function img($w=false, $h=false, $htmlOptions=array()) {
	$img = 0;
	$htmlOptions['title']=$this->title;
	if ($this->image_uri != NULL){ $img = $this->image_uri; }
	return Img::embed('/news/'.$img, $w, $h, 'default.png',$htmlOptions);
}
</pre>
<p>Example: <a href="http://www.yiiframework.com/wiki/366/create-image-thumbnails-with-php_img_preview/">yiiframework.com/wiki/366/create-image-thumbnails-with-php_img_preview/</a></p>
	
	</div>

	<div class="panel" name="useful_links" id="useful_links">
		<h3>Useful links</h3>
		<ul>
			<li><a href="http://bootsnipp.com/" target="_blank" >Bootsnipp</a> Design elements, playground and code snippets for <a href="http://getbootstrap.com" target="_blank">Bootstrap</a> HTML/CSS/JS framework.</li>
			<li><a href="http://yiiwheels.2amigos.us/" target="_blank" >YiiWheels</a> Wheels is an extension library for the <a href="http://yiiwheels.2amigos.us/" target="_blank" >YiiStrap</a> extension.</li>
			<li><a href="http://www.yiiframework.com/doc/api/" target="_blank" >Yii API</a></li>
			<li><a href="http://www.yiiframework.com/wiki/" target="_blank" >Yii wiki</a></li>
			<li><a href="http://www.yiiframework.com/extensions/" target="_blank" >Yii Extensions</a></li>
			<li><a href="http://yiidemos.gopagoda.com/index.php/site/index" target="_blank" >yiidemos.gopagoda.com</a></li>
		</ul>
	</div>

</div>
</div>