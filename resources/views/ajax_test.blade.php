<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta name="token" content="{{ csrf_token() }}">
	<title>HTML 5 complete</title>
	<!--[if IE]>
	<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>

	<![endif]-->
	<style>
		#stocks {
			width: 50%;
		}
	</style>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
</head>

<body>
	<p>Hello World</p>
	<div>
		<button type="button" id="get_stock">表示！</button>
		<input type="text" id="stocks" name="stocks">
		<p>{{ $print }}</p>
	</div>

	<script>
		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="token"]').attr('content')
			}
		});

		$('#get_stock').on('click', function(){
			var request = $.ajax({
				type: 'POST',
				url: '/ajaxtest/' + 'aaa',
				cache: false,
				dataType: 'json',
				timeout: 300
			});
			request.done(function(data){
				$('#stocks').val(data[0]['id']);
			});
			request.fail(function(XMLHttpRequest, textStatus, errorThrown){
				alert('通信に失敗しました');
				console.log("XMLHttpRequest : " + XMLHttpRequest.status);
				console.log("textStatus     : " + textStatus);
				console.log("errorThrown    : " + errorThrown.message);
			});
		});
	</script>

</body>

</html>