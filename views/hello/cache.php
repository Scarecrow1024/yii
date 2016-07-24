<?php if($this->beginCache('div1',['duration'=>10])){?>
<div id="div1">
	<h2>被缓存10</h2>
</div>
<?php $this->endCache();}?>
<div id="div2">
	<h2>不缓存la</h2>
</div>