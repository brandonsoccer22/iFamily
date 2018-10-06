@extends('layout')

@section('content')
<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-8">
			<br>
			<br>
			<div class="card">
				<div class="card-header"><h3>Add a Grocery</h3></div>
				<div class="card-body">
					<form method='POST' action="/groceries">
						{{csrf_field()}}
						<div>
							<label for='name'>Name</label><br>
							<input type='text' id='name' name='name'>
						</div>
						<br>
						<div>
							<label for='description'>Description</label><br>
							<textarea id='description' name='description'></textarea>
						</div>
						<br>
						<div>
							<label for='from'>From</label><br>
							<input type='text' id='from' name='from'>
						</div>
						<br>
						<div>
							<label for='type'>Type</label><br>
							<select id='type' name='type'>
								<option value='type1' selected="selected">Type1</option>
								<option value='type2'>Type2</option>
								<option value='type3'>Type3</option>
								<option value='type4'>Type4</option>
							</select>
						</div>
						<br>
						<input type="hidden" name="created_by" value="{!! session('user')['id'] !!}">

						<button type='submit' class="btn btn-primary">Add</button>
					</form>           
				</div>
			</div>
		</div>
	</div>
</div>

@endsection