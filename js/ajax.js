jQuery(document).ready(function($){	
	$('.track-form').submit(function(e){
		e.preventDefault();
		var form_data = $(this).serialize();
		console.log(form_data);
        $.ajax({
            url: ajax_obj.ajax_url, // or example_ajax_obj.ajaxurl if using on frontend
            type:"POST",
            dataType:"json",
            data: {
                'action': 'order_tracking',
                'form_data' : form_data,
            },
            success: function(result){
                // console.log(result);
                $('.track-output').html(result);
            },
            error: function(errorThrown){
                console.log(errorThrown);
            }
        });
	});
});