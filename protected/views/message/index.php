<?php
/* @var $this MessageController */

$this->breadcrumbs=array(
	'Message',
);
?>
<div class="page-header">
  <h1>Messages</h1>
</div>

<div class="panel panel-default">
  <div class="panel-heading">Find a word <a href="" class="btn btn-success btn-xs">Create</a></div>
  <div class="panel-body">
  
    <div id="wordFinder">
		<div class="form-group">
			<div id="ajaxFind" class="input-group">
			  <input type="text" class="form-control" />
			  <span class="input-group-btn">
				<button class="btn btn-primary" type="button">Search</button>
			  </span>
			</div>
		</div>
	</div>
	
	<hr/>
	
	<table id="results" class="table table-striped">
	<colgroup>
		<col span="1" style="width:10%">
		<col span="1" style="width:55%">
	</colgroup>
      <thead>
        <tr>
          <th>Key</th>
          <th>Translate (EN/AR)</th>
          <th>Embed</th>
          <th></th>
        </tr>
      </thead>
      <tbody>

      </tbody>
    </table>
	
  </div>
</div>
<style>
#results hr{
	margin:5px 0
}
</style>
<script>
$(function(){
	$('#ajaxFind input[type="text"]').on('keyup',function(){
		if($(this).val().length >= 3){
			$.ajax({
				type : 'POST',
				data : {term:$(this).val()},
				url: baseUrl+"/message/find",
			}).success(function(data) {
				$('#results tbody').html(data);
			}).error(function(data){
				$('#results tbody').html(data);
			});
		}
	});
});
</script>