$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrfToken"]').attr('content')
    }
});
$(document).ready(function() {
    $('.number').keypress(function(e){
		//this.value = this.value.replace(/[^0-9\.+-]/g,'');
		if(e.which != 8 && e.which != 0 && e.which != 43 && e.which != 45 && (e.which < 48 || e.which > 57)){
			return false;
		}
	});
	
	$('.ordering').keypress(function(e){
		//this.value = this.value.replace(/[^0-9\.+-]/g,'');
		if (!(e.keyCode >= 48 && e.keyCode <= 57)) {
			return false;	
		}
	});
	
	$('.string').keypress(function(e){
		if (e.charCode > 31 && (e.charCode < 65 || e.charCode > 90) && (e.charCode < 97 || e.charCode > 122)) {
			return false;	
		}
	});
	
	$('.float').keypress(function(event) {
		if(event.which < 46 || event.which > 59) {
			event.preventDefault();
		} // prevent if not number/dot
	
		if(event.which == 46 && $(this).val().indexOf('.') != -1) {
			event.preventDefault();
		} // prevent if already dot
	});
});