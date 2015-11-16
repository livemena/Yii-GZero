<?php
/* @var $this MessageController */
$this->layout = '/layouts/column1';

$this->breadcrumbs=array(
	'Message',
);
?>
<div style="max-width:700px;margin:50px auto 100px">
<div style="overflow:hidden">
	<a id="createBtn" class="btn btn-link"><i class="fa fa-pencil"></i> Create new Translate</a>
	<a class="btn btn-link pull-right" target="_blank" href="<?php echo $this->createUrl('message/ReGenerateMessages'); ?>"><i class="fa fa-refresh"></i> Re-Generate Files</a>
</div>

<div id="createPanel" class="panel panel-default hid" style="overflow:hidden">
  <div class="panel-heading clearfix"><div class="pull-left">Create new Translate</div> <div class="pull-right"><i class="fa fa-spinner fa-spin loading loading-1"></i></div></div>
  <div class="panel-body">
	<div class="form-horizontal" role="form">
		<div id="input">
		  <div class="form-group">
			<label for="english" class="col-sm-2 control-label">English</label>
			<div class="col-sm-10">
			  <input type="text" class="form-control" id="english" name="english" placeholder="English">
			</div>
		  </div>
		  <div class="form-group">
			<label for="arabic" class="col-sm-2 control-label">Arabic</label>
			<div class="col-sm-10">
			  <input type="text" class="form-control rtl-text" id="arabic" name="arabic" placeholder="عربي">
			</div>
		  </div>
		  <div class="form-group">
			<label for="arabic" class="col-sm-2 control-label">Key</label>
			<div class="col-sm-10">
			  <input type="text" class="form-control autoselect" id="key" name="key" placeholder="Optional" />
			</div>
		  </div>
		  <div class="form-group">
			<div class="col-sm-offset-2 col-sm-10">
			  <button id="createWord" type="submit" class="btn btn-primary">Save & Get embed code</button>
			</div>
		  </div>
		</div>
		<div id="output">
		  <div class="form-group">
			<label for="arabic" class="col-sm-2 control-label">Embed</label>
			<div class="col-sm-10">
			  <input type="text" class="form-control autoselect" id="embedOutput" name="embedOutput" />
			</div>
		  </div>
		</div>
	</div>
  </div>
</div>

<div class="panel panel-default" style="overflow:hidden">
  <div class="panel-heading clearfix"><div class="pull-left">Find a word</div> <div class="pull-right"><i class="fa fa-spinner fa-spin loading loading-2"></i></div></div>
  <div class="panel-body">
  
    <div id="wordFinder">
		<div id="ajaxFind" class="form-group">
			 <input type="text" class="form-control" />
		</div>
	</div>
	
	<table id="results" class="table table-striped table-hover hid">
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

<div id="updateModal" class="modal" tabindex="-1" role="dialog" aria-labelledby="updateModal" aria-hidden="true">
<div class="modal-dialog">
  <div class="modal-content">
  </div>
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
	$('#createBtn').click(function (){
		$('#createPanel').slideToggle();
	});
	
	$('#ajaxFind input[type="text"]').on('keyup',function(){
		if($(this).val().length >= 2){
		$('.loading.loading-2').show();
			$.ajax({
				type : 'POST',
				data : {term:$(this).val()},
				url: "<?php echo $this->createUrl('message/find'); ?>",
			}).success(function(data) {
				$('#results').fadeIn();
				$('#results tbody').html(data);
				$('.loading.loading-2').hide();
				$('.autoselect').click(function() {
					$(this).select();
				});
				
				$("a.editBtn").on('click',function(ev) {
					ev.preventDefault();
					
					var modal = $(this).data('target');
					var url = $(this).prop('href');

					$('#updateModal').modal({
						remote: url,
						show: true
					}); 
				});
				
				$('.deleteBtn').on('click', function(){
					if (confirm("Are you sure you want to delete this translate ?")) {
						$('.loading.loading-2').show();
						var id = $(this).closest('tr').attr('id');
						var row = $(this).closest('tr');
						row.addClass('deleting');
						$.ajax({
							type: 'POST',
							url: "<?php echo $this->createUrl('message/delete'); ?>",
							data: {id:id},
							success: function(data){
								row.fadeOut('slow');
								$('.loading.loading-2').hide();
							},
							error:function(){
								row.removeClass('deleting');
								alert('Deleteing Failed! Please refresh this page');
								$('.loading.loading-2').hide();
							}
						});
					}
					return false;
				});
				
			}).error(function(data){
				$('#results').fadeOut();
				$('#results tbody').html(data);
				$('.loading.loading-2').hide();
			});
		}else{
			$('#results').fadeOut();
			$('#results tbody').html('');
			$('.loading.loading-2').hide();
		}

	});

	$('#createWord').on('click',function(){
		$('.loading.loading-1').show();
		$.ajax({
			type : 'POST',
			data : {en:$('#english').val(),ar:$('#arabic').val(),key:$('#key').val()},
			url: "<?php echo $this->createUrl('message/create'); ?>",
		}).success(function(data) {
			$('.loading.loading-1').hide();
			$('#embedOutput').val("Yii::t('app','"+data+"')");
			$('#embedOutput').select();
		}).error(function(xhr, ajaxOptions, thrownError){
			$('.loading.loading-1').hide();
			alert(thrownError);
		});
	});
	
$('body').on('hidden.bs.modal', '#updateModal', function () {
  $(this).removeData('bs.modal');
});
	
$('#updateModal').on('loaded.bs.modal', function(e) {
// alert('shown');
	$('#msgAr, #msgEn').on('keypress',function(e){
		if (e.keyCode == 13) {
				$('.loading.loading-3').show();
				var msgEn = $('#msgEn').val();
				var msgAr = $('#msgAr').val();
				$.ajax({
					type : 'POST',
					data : {msgEn:msgEn,msgAr:msgAr},
					url: "<?php echo $this->createUrl('message/update'); ?>/?id="+$('#sourceId').val(),
				}).success(function(data) {
				
					$('#updateModal').modal('hide');
					$('.loading.loading-3').hide();
					var tr_id = $('#tr_id').val();
					$('#'+tr_id).find('.en').text(msgEn);
					$('#'+tr_id).find('.ar').text(msgAr);
					
				}).error(function(xhr, ajaxOptions, thrownError){
					$('.loading.loading-3').hide();
					alert(thrownError);
				});
				return false;
		}
	});
	
	$('#updateModal #save').on('click',function(){
		$('.loading.loading-3').show();
		var msgEn = $('#msgEn').val();
		var msgAr = $('#msgAr').val();
		$.ajax({
			type : 'POST',
			data : {msgEn:msgEn,msgAr:msgAr},
			url: "<?php echo $this->createUrl('message/update'); ?>/?id="+$('#sourceId').val(),
		}).success(function(data) {
		
			$('#updateModal').modal('hide');
			$('.loading.loading-3').hide();
			var tr_id = $('#tr_id').val();
			$('#'+tr_id).find('.en').text(msgEn);
			$('#'+tr_id).find('.ar').text(msgAr);
			
		}).error(function(xhr, ajaxOptions, thrownError){
			$('.loading.loading-3').hide();
			alert(thrownError);
		});
	});
	
	// alert('sss');
})
	
	
});
</script>
</div>