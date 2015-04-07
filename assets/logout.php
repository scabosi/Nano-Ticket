<?php
     session_start();
     session_destroy();

?>
<html>

	<header>
	</heaer>
	<body>
		<script>


			(function() {
 				document.cookie = "username=; expires=Thu, 01 Jan 1970 00:00:00 UTC";
		        window.location.replace('/');
			})();
		</script>
	</body>
</html>
