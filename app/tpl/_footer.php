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
<!-- Editor JS -->
<script src="{$site_url}/assets/home/js/wangEditor.min.js"></script>

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