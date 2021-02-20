<?php die('Access Denied');?>
<!-- jQuery -->
<script src="{$site_url}/assets/home/js/jquery.min.js"></script>
<!-- Bootstrap Core JS -->
<script src="{$site_url}/assets/js/popper.min.js"></script>
<script src="{$site_url}/assets/bootstrap/bootstrap.min.js"></script>
<!-- jQuery Validation -->
<script src="{$site_url}/assets/home/js/jquery.validate.min.js"></script>
<!-- Owl Carousel -->
<script src="{$site_url}/assets/home/js/owl.carousel.min.js"></script>
<!-- Animate Scroll -->
<script src="{$site_url}/assets/home/js/jquery.easing.min.js"></script>
<script src="{$site_url}/assets/home/js/aos.js"></script>
<!-- Custom JS -->
<script src="{$site_url}/assets/home/js/main.js"></script>
<!-- Qrcode JS -->
<script src="{$site_url}/assets/jquery/jquery.qrcode.min.js"></script>

<script>
	// Qrcode
	$('#Qrcode').qrcode({
		render: "canvas",
		width: 256,
		height: 256,
		correctLevel: 3, // L,7% M,15% Q,25% H,30%
		text: $(location).attr('href'),
		background: "#FFFFFF",
		foreground: "#000000",
		src: "{$site_url}/assets/img/qrcode.png", // 120px, 120px
	});
</script>

<script>
	$(function() {
		$('#contact-form').on('submit', function(e) {
			//console.log('contact');
			if (!e.isDefaultPrevented()) {
				//console.log('messages');
				var re = /^(("[\w-\s]+")|([\w-]+(?:\.[\w-]+)*)|("[\w-\s]+")([\w-]+(?:\.[\w-]+)*))(@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$)|(@\[?((25[0-5]\.|2[0-4][0-9]\.|1[0-9]{2}\.|[0-9]{1,2}\.))((25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\.){2}(25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\]?$)/;
				var emailFormat = re.test($("#form_email").val()); // this return result in boolean type
				if (emailFormat) {
					$('#alert_message').css({
						'display': 'none'
					})
					var url = "{$site_url}/contact";
					$.ajax({
						type: "POST",
						url: url,
						data: $(this).serialize(),
						success: function(data) {
							var messageAlert = 'alert-' + data.type;
							var messageText = data.message;
							var alertBox = '<div class="alert ' + messageAlert + ' alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>' + messageText + '</div>';
							if (messageAlert && messageText) {
								$('#contact-form').find('.messages').html(alertBox);
								$('#contact-form')[0].reset();
							}
						}
					});
				} else {
					$('#alert_message').css({
						'display': 'block'
					});
					$('#form_email').focus();
					return false;
				}
				return false;
			}
		})
	});
</script>