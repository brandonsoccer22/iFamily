@extends('layout')

@section('content')
<style>
.tab {
	overflow: hidden;
	border: 1px solid #ccc;
	background-color: #f1f1f1;
}

/* Style the buttons that are used to open the tab content */
.tab button {
	background-color: inherit;
	float: left;
	border: none;
	outline: none;
	cursor: pointer;
	padding: 14px 16px;
	transition: 0.3s;
}

/* Change background color of buttons on hover */
.tab button:hover {
	background-color: #ddd;
}

/* Create an active/current tablink class */
.tab button.active {
	background-color: #ccc;
}

/* Style the tab content */
.tabcontent {
	display: none;
	padding: 6px 12px;
	border-top: none;
}
.tabcontent {
	animation: fadeEffect 1s; /* Fading effect takes 1 second */
}

/* Go from zero to full opacity */
@keyframes fadeEffect {
	from {opacity: 0;}
	to {opacity: 1;}
}
</style>
<br>
<center>
	<div class="tab" style='width:60%'>
		<button id="Ongoingbtn" class="tablinks" onclick="openTab('Ongoing')">Groceries</button>
		<button id="Closedbtn" class="tablinks" onclick="openTab('Closed')">Done/Bought Groceries</button>
	</div>
	<div id="Ongoing" class="tabcontent">
		<div style='width:60%'>
			@if (count($groceries) > 0)
			<table>
				<thead><tr><th>Title</th><th>From</th><th>Added by</th><th>Type</th><th>Added at</th></tr></thead>
				<tbody>
					@foreach ($groceries as $grocery)
					<tr id = 'g{{$grocery->id}}' onclick='showDetails(this)'>
						<td>{{$grocery->name}}</td>
						<td>{{$grocery->from}}</td>
						<td>{{$grocery->added_by}}</td>
						<td>{{$grocery->type}}</td>
						<td>{{$grocery->created_at}}</td>
						<td hidden>{!! $grocery->description !!}</td>
						<td>
							<form method='POST' action='/groceries/done' onsubmit="return confirm('Are you sure you want to mark this grocery as done?')">
								{{csrf_field()}}
								<input type="hidden" name="done_by" value="{!! session('user')['id'] !!}">
								<input type="hidden" name="id" value="{{$grocery->id}}">
								<button type='submit' class="btn btn-primary">Done</button>
							</form>
						</td>
						@if (session('user')['id'] === $grocery->created_by || session('user')['is_parent'])
						<td>
							<form method='POST' action='/groceries/delete' onsubmit="return confirm('Are you sure you want to delete this grocery?')">
								{{csrf_field()}}
								<input type="hidden" name="done_by" value="{!! session('user')['id'] !!}">
								<input type="hidden" name="id" value="{{$grocery->id}}">
								<button type='submit' class="btn btn-primary">Delete</button>
							</form>
						</td>
						@endif
					</tr>
					@endforeach
				</tbody>
			</table>
			@else
			No groceries needed right now. Come back later!
			@endif
		</div>
	</div>
	<div id="Closed" class="tabcontent">
		<div style='width:60%'>
			@if (count($done_groceries) > 0)
			<table>
				<thead><tr><th>Title</th><th>From</th><th>Added by</th><th>Type</th><th>Added at</th><th>Bought by</th></tr></thead>
				<tbody>
					@foreach ($done_groceries as $grocery)
					<tr id = 'cg{{$grocery->id}}' onclick='showDetails(this)'>
						<td>{{$grocery->name}}</td>
						<td>{{$grocery->from}}</td>
						<td>{{$grocery->added_by}}</td>
						<td>{{$grocery->type}}</td>
						<td>{{$grocery->created_at}}</td>
						<td hidden>{!! $grocery->description !!}</td>
						<td>{{$grocery->bought_by}}</td>
					</tr>
					@endforeach
				</tbody>
			</table>
			@else
			No groceries needed right now. Come back later!
			@endif
			
		</div>
	</div>
	<form action="/groceries/create">
		<br>
		<br>
		<button type='submit' class="btn btn-primary">Add a grocery</button>
	</form>
</center>

<div id="descriptionWindow" class="modal">

	<!-- Modal content -->
	<div class="modal-content">
		<p id='descriptionText'></p>
	</div>

</div>

<script>
	var myWindow = document.getElementById('descriptionWindow');
	var myText = document.getElementById('descriptionText');
	window.onclick = function(event) {
		if (event.target == myWindow) {
			myWindow.style.display = "none";
		}
	}
	openTab('Ongoing');
	
	function showDetails(caller, value)
	{
		if(event.target.tagName.toLowerCase() === 'button'){
			return;
		}
		var children = document.getElementById(caller.id).getElementsByTagName('td');
		myText.innerHTML =
		"Title: " + children[0].innerHTML +
		"<br>Get it from: " + children[1].innerHTML +
		"<br>Description: " + children[5].innerHTML +
		"<br>Type: " + children[3].innerHTML +
		"<br>Added by: " + children[2].innerHTML +
		" @ " + children[4].innerHTML;
		myWindow.style.display = "block";
	}
	function openTab(tabName)
	{
	    // Declare all variables
	    var i, tabcontent, tablinks;

	    // Get all elements with class="tabcontent" and hide them
	    tabcontent = document.getElementsByClassName("tabcontent");
	    for (i = 0; i < tabcontent.length; i++) {
	    	tabcontent[i].style.display = "none";
	    }

	    // Get all elements with class="tablinks" and remove the class "active"
	    tablinks = document.getElementsByClassName("tablinks");
	    for (i = 0; i < tablinks.length; i++) {
	    	tablinks[i].className = tablinks[i].className.replace(" active", "");
	    }

	    // Show the current tab, and add an "active" class to the button that opened the tab
	    document.getElementById(tabName).style.display = "block";
	    document.getElementById(tabName+'btn').className += " active";
	}
</script>
@endsection