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
  <div class="panel-heading clearfix"><div class="pull-left">Create new Translate</div> <div class="pull-right"><i class="fa fa-spinner fa-spin loading"></i></div></div>
  <div class="panel-body">
	<div class="form-horizontal" role="form">
	  <div class="form-group">
		<label for="english" class="col-sm-2 control-label">English</label>
		<div class="col-sm-10">
		  <textarea class="form-control" id="english" name="english"></textarea>
		</div>
	  </div>
	  <div class="form-group">
		<label for="arabic" class="col-sm-2 control-label">Arabic</label>
		<div class="col-sm-10">
		  <textarea class="form-control rtl-text" id="arabic" name="arabic"></textarea>
		</div>
	  </div>
	  <div class="form-group">
		<div class="col-sm-offset-2 col-sm-10">
		  <button id="createWord" type="submit" class="btn btn-primary">Get embed code</button>
		</div>
	  </div>
	</form>
  </div>
</div>

<div class="panel panel-default">
  <div class="panel-heading clearfix"><div class="pull-left">Find a word</div> <div class="pull-right"><i class="fa fa-spinner fa-spin loading"></i></div></div>
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
	
	<table id="results" class="table table-striped table-hover">
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
#results td hr:last-child{
	display:none
}
</style>
<script>
$(function(){
	// $(document).ajaxStart(function () {
		// $('.loading').show();
	// });
	// $(document).ajaxStop(function () {
		// $('.loading').hide();
	// });

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
		}else{
			$('#results tbody').html('');
		}
	});
	
	$('.deleteBtn').live('click', function(){
		if (confirm("Are you sure you want to delete this translate ?")) {
			var id = $(this).closest('tr').attr('id');
			var row = $(this).closest('tr');
			row.addClass('deleting');
			$.ajax({
				type: 'POST',
				url: baseUrl+'/message/delete/',
				data: {id:id},
				success: function(data){
					row.fadeOut('slow');
				},
				error:function(){
					row.removeClass('deleting');
					alert('Deleteing Failed! Please refresh this page');
				}
			});
		}
		return false;
	});
	
	$('#createWord').on('click',function(){
		$.ajax({
			type : 'POST',
			data : {en:$('#english').val(),ar:$('#arabic').val()},
			url: baseUrl+"/message/create",
		}).success(function(data) {
			alert(data);
		}).error(function(data){
			alert(data);
		});
	});
	
});
</script>