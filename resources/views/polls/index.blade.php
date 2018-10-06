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
		<button id='Ongoingbtn' class="tablinks" onclick="openTab('Ongoing')">Ongoing Polls</button>
		<button id='Closedbtn' class="tablinks" onclick="openTab('Closed')">Closed Polls</button>
	</div>

	<!-- Tab content -->
	<div id="Ongoing" class="tabcontent" >
		<div style='width:60%'>
			@if (count($polls) > 0)
			<table>
				<thead><tr><th>Title</th><th>By</th></tr></thead>
				<tbody>
					@foreach ($polls as $poll)
					<tr id = 'p{{$poll->id}}' onclick='showDetails(this, "{{$poll->choices}}", "{{$poll->votes}}")'>
						<td>{{$poll->title}}</td>
						<td>{{$poll->username}}</td>
						@if (session('user')['is_parent'])
						<td>
							<form method='POST' action='/polls/done' onsubmit="return confirm('Are you sure you want to close this poll?')">
								{{csrf_field()}}
								<input type="hidden" name="id" value="{{$poll->id}}">
								<button type='submit' class="btn btn-primary">Done</button>
							</form>
						</td>
					</td>
					@endif
				</tr>
				@endforeach
			</tbody>
		</table>
		@else
		No polls needed right now. Come back later!
		@endif
	</div>
</div>
<div id="Closed" class="tabcontent">
	<div style='width:60%'>
		@if (count($closed_polls) > 0)
		<table>
			<thead><tr><th>Title</th><th>By</th></tr></thead>
			<tbody>
				@foreach ($closed_polls as $poll)
				<tr id = 'cp{{$poll->id}}' onclick='showDetails(this, "{{$poll->choices}}", "{{$poll->votes}}")'>
					<td>{{$poll->title}}</td>
					<td>{{$poll->username}}</td>

				</tr>
				@endforeach
			</tbody>
		</table>
		@else
		No polls needed right now. Come back later!
		@endif
	</div>
</div>
<form action="/polls/create">
	<br>
	<br>
	<button type='submit' class="btn btn-primary">Create a poll</button>
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
	function showDetails(caller, value1, value2)
	{
		if(event.target.tagName.toLowerCase() === 'button'){
			return;
		}
		var closed = caller.id[0] == 'c';
		var children = document.getElementById(caller.id).getElementsByTagName('td');
		var content = children[1].innerHTML + ": " +children[0].innerHTML + '<br><br>';

		var choices = value1.split(',');
		var votes = value2.split(',');
		if(!closed)
			content += '<section><form method="POST" action="/polls/vote">'
		for(var i = 0; i < choices.length; i++)
		{
			var count = countOccurances(choices[i], votes);
			if(closed)
				content += '<label>'+choices[i]+' ('+count+' votes)</label><br>';
			else
				content += '<label><input type="radio" name="Poll" value="'+choices[i]+'" id="Poll_'+i+'" />'+choices[i]+' ('+count+' votes)</label><br>';
		}
		if(!closed)
		{
			content += '<input type="hidden" name="poll_id" value="'+caller.id.substring(1)+'">\
			<input type="hidden" name="user_id" value="'+{{session('user')['id']}}+'">\
			<button type="submit" class="btn btn-primary">Vote</button>\
			{{csrf_field()}}\
			';
			content += '</form></section>';
		}
		myText.innerHTML = content

		myWindow.style.display = "block";
	}
	function countOccurances(element, voteList)
	{
		var count = 0;
		for(var i = 0; i < voteList.length; i++)
		{
			if(element === voteList[i])
				count++;
		}
		return count;
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