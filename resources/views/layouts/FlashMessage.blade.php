
		@if ($message = Session::get('success'))
		<div class="alert alert-success alert-block fade in">
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">&times;</button>	
		        <strong>{{ $message }}</strong>
		</div>
		@endif


		@if ($message = Session::get('error'))
		<div class="alert alert-danger alert-block fade in">
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">&times;</button>	
		        <strong>{{ $message }}</strong>
		</div>
		@endif


		@if ($message = Session::get('warning'))
		<div class="alert alert-warning alert-block fade in">
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">&times;</button>	
			<strong>{{ $message }}</strong>
		</div>
		@endif


		@if ($message = Session::get('info'))
		<div class="alert alert-info alert-block fade in">
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">&times;</button>	
			<strong>{{ $message }}</strong>
		</div>
		@endif


		@guest
		@else
			@if ($errors->any())
			<div class="alert alert-danger fade in">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">&times;</button>	
				Please check the form below for errors
			</div>
			@endif
		@endguest

