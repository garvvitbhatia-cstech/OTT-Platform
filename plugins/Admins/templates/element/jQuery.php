<script type="text/javascript">
function changeStatus(modal,rowId,status){	
	$('#myProgress').show();
	$('#myBar').css("background-color","#F0AD4E").animate({"width":"100%"}, 500, function(){
		
		var current_status = $('#current_status'+rowId).val();
		$.ajax({
			type: 'POST',
			dataType: 'JSON',
			url:'<?php echo $this->Url->build('/admins/ajax/changeStatus/'); ?>',
			data: {modal:modal,id:rowId,status:status},				
			headers:{
				'X-CSRF-TOKEN': $('meta[name="csrfToken"]').attr('content')
			},				
			success: function(){
				if(current_status == 1){			
					$('#buttonId_'+rowId).removeClass('btn btn-info').addClass('btn btn-warning');
					$('#buttonId_'+rowId).html('<i class="fa fa-times"></i>');
					$('#buttonId_'+rowId).attr('onclick',"changeStatus('"+modal+"',"+rowId+","+2+")");
					$('#current_status' + rowId).val(2);
				}else{
					$('#buttonId_'+rowId).removeClass('btn btn-warning').addClass('btn btn-info');
					$('#buttonId_'+rowId).html('<i class="fa fa-check"></i>');
					$('#buttonId_'+rowId).attr('onclick',"changeStatus('"+modal+"',"+rowId+","+1+")");
					$('#current_status' + rowId).val(1);
				}
			}				
		});
		$('#myBar').animate({width: '0'});
		$('#myProgress').hide();
	});
}
/*************Save Ordering***************/
function saveOrder(rowId,order,model,currVal){
	if(rowId != '' && order != '' && model != '' && currVal != '' && $.isNumeric(rowId) && $.isNumeric(order) && $.isNumeric(currVal)){
		$('#myProgress').show();
		$('#myBar').css("background-color","#F0AD4E").animate({"width":"100%"}, 500, function(){	
			$.ajax({
				type:'POST',
				url:'<?php echo $this->Url->build('/admins/ajax/updateOrder/'); ?>',
				async:false,
				headers:{
					'X-CSRF-TOKEN': $('meta[name="csrfToken"]').attr('content')
				},
				data:{id:rowId,prev:order,curval:currVal,modal:model},
				success: function(response){
					searchData();
					//window.location.href='';
				},error: function(ts){
					$('#error500').modal('show');
				}							
			});
			$('#myBar').animate({width: '0'});
			$('#myProgress').hide();
		});
	}else{
		window.location.href="";
	}	
}
/**************delete record*****************/
function deleteRecord(model,rowId,permission){
	var a = confirm('Do you want to delete this record?');
	if(a == true){
		$.ajax({
				type: 'POST',
				url:'<?php echo $this->Url->build('/admins/ajax/deleteRecord/'); ?>',
				async:false,
				data: {model:model, rowId:rowId},
				headers:{
					'X-CSRF-TOKEN': $('meta[name="csrfToken"]').attr('content')
				},
				success: function(msg){

					searchData();
				},error: function(ts) { 
					$('#error500').modal('show');
				}
			})
	}
	return false;
	
}
</script>