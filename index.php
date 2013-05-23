<?php session_start(); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
    	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js" type="text/javascript"></script>
    	<script src="https://browserid.org/include.js" type="text/javascript"></script>

        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Ejemplo BrowserID</title>
    </head>

    <body>
        <script type="text/javascript">
			function gotAssertion(assertion) {
				if (assertion !== null) {
					$.ajax({
					type: 'POST',
					url: 'login.php',
					data: { assertion: assertion, browserid: true },
					success: function(res, status, xhr) {
						if (res !== null) {
							var oJson = jQuery.parseJSON(res);

							if(oJson.status == 'okay'){
								if(oJson.action == 'new') location.reload(true);
							}
						}
					},
					error: function(res, status, xhr) {
						alert("Error de conexion");
					}});
				}
			}

			$(document).ready(function(){
				$('#browserid').click(function() {
					navigator.id.get(gotAssertion, {allowPersistent: true});
					return false;
				});
			})
		</script>
    	<?php if(!isset($_SESSION['email'])): ?>
        <div id="login">
            <a href="#" id="browserid" title="Sign-in with BrowserID">
                Iniciar Session con Mozilla
            </a>
        </div>
        <?php else: ?>
        	hola <?php echo $_SESSION['email']; ?>
        <?php endif; ?>
    </body>
</html>