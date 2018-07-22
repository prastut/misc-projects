<html>
	
	<head>
		<title></title>
		<script  src="HTTP://code.jquery.com/jquery-1.9.1.min.js"></script>
	<script type="text/javascript">
		$(document).ready(function(){
			$(".fuck").on('submit',function(){
				//var text=document.childNodes[0].childNodes[2].childNodes[1].childNodes[1].nodeName;
				var text=$(this).children("#hello").val();
				alert(text);
			});
		});
	</script>
	</head>
	<body>
		<form class='fuck'>
		<input type="text" value="fucktext" id="hello"/>
		<input type="submit"/>
		</form>
	</body>
</html>