$(function() {
	$(".navigation button.close").click(function() {
		$(this).closest(".navigation").hide();
		$(".slide").removeClass("with-nav");
	});
});