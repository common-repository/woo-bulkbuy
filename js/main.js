jQuery( function( $ ) {
	
	if ($("body").hasClass("post-type-archive-product")) {
 
		jQuery(document).on("change", "input.qty", function() {
			var button 		= $(this.form).attr("id");
			var quantity 	= this.value;
			$(document).trigger('woo-ws-input-change', [ button, quantity ]);

		});
		//multiple functions for extension of the plugin
	}
	
	$(document).on('woo-ws-input-change', function(event, button, quantity){
		
		setQuantitiy(button, quantity);

	});
	setQuantitiy = (button, quantity) => {
		console.log($("form#"+button).find("button"));
		console.log(quantity);
		$("form#"+button).find("button").attr("data-quantity", quantity);

	}
});