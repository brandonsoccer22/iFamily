@extends('layout')

@section('content')
<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-8">
			<br>
			<br>
			<div class="card">
				<div class="card-header"><h3>Create a Poll</h3></div>
				<div class="card-body">
					<form method='POST' action="/polls">
						{{csrf_field()}}
						<div>
							<label for='title'>Title</label><br>
							<input type='text' id='title' name='title'>
						</div>
						<br>
						<div>
							<label for='choice1'>Choice #1</label><br>
							<input type='text' id='choice1' name='choice1'>
						</div>
						<br>
						<div>
							<label for='choice2'>Choice #2</label><br>
							<input type='text' id='choice2' name='choice2'>
						</div>
						<br>
						<div>
							<label for='choice3'>Choice #3</label><br>
							<input type='text' id='choice3' name='choice3'>
						</div>
						<br>
						<div>
							<label for='choice4'>Choice #4</label><br>
							<input type='text' id='choice4' name='choice4'>
						</div>
						<br>
						<input type="hidden" name="created_by" value="{!! session('user')['id'] !!}">

						<button type='submit' class="btn btn-primary">Create</button>
					</form>           
				</div>
			</div>
		</div>
	</div>
</div>

@endsection