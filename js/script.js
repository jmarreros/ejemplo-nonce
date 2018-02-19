(function($){

	$(document).on('click','#link-ajax',function(e){
	 	e.preventDefault();

		$.ajax({
			url : dcms_vars.ajaxurl,
			type: 'post',
			data: {
				action : 'dcms_ajax_insertar',
				title: $('#title').val(),
				nonce: dcms_vars.nonce,
				description: $('#description').val()
			},
			success: function(res){
				alert(res);
			}

		});

	});

})(jQuery);