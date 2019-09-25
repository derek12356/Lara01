@extends('layouts.default')
@section('title','API test')
@section('content')
<div style="display:none" class="alert alert-success" role="alert">
  You have confirmed it!
</div>
<button class="btn btn-primary" id="confirm">confirm</button>


<script>
	$(document).ready(function(){

		// $('#confirm').on('click', sendCounter);
		sendCounter();
		function sendCounter(){
			var today = new Date();
			var date = today.getFullYear()+'-'+(today.getMonth()+1)+'-'+today.getDate();
			var time = today.getHours() + ":" + today.getMinutes() + ":" + today.getSeconds();
			var dateTime = date+' '+time;
			$.ajax({
				headers: {
				    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				  },
				url: '/api/counter',
				data:{
					'counter' : 1,
					'dateTime' : dateTime
				},
				type: 'POST',
				success:function(data){
					if(data = "success"){
						$('.alert').show(200).delay(2000).hide(200);
					}
				}
			});
		}

	});

</script>
@endsection