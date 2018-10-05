@extends('layout')

@section('content')
<style>
table {
    border-collapse: collapse;
    width: 100%;
}

th, td {
    text-align: center;
    padding: 8px;
}

tr:nth-child(even){background-color: #f2f2f2}

th {
    background-color: #4CAF50;
    color: white;
}
.modal {
    display: none; /* Hidden by default */
    position: fixed; /* Stay in place */
    z-index: 1; /* Sit on top */
    left: 0;
    top: 0;
    width: 100%; /* Full width */
    height: 100%; /* Full height */
    overflow: auto; /* Enable scroll if needed */
    background-color: rgb(0,0,0); /* Fallback color */
    background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
}

/* Modal Content/Box */
.modal-content {
    background-color: #fefefe;
    margin: 15% auto; /* 15% from the top and centered */
    padding: 20px;
    border: 1px solid #888;
    width: 50%; /* Could be more or less, depending on screen size */
}
</style>
<br>
<center>
<div style='width:60%'>
	<table>
	<thead><tr><th>Title</th><th>From</th><th>Added by</th><th>Type</th><th>Added at</th></tr></thead>
	<tbody>
	@foreach ($groceries as $grocery)
	<tr id = 'g{{$grocery->id}}' onclick='showDetails(this, "{{$grocery->description}}")'>
		<td>{{$grocery->name}}</td>
		<td>{{$grocery->from}}</td>
		<td>{{$grocery->username}}</td>
		<td>{{$grocery->type}}</td>
		<td>{{$grocery->created_at}}</td>
	</tr>
	@endforeach
	</tbody>
	</table>
</div>
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
	function showDetails(caller, value)
	{
	    console.log(caller.id);
	    var children = document.getElementById(caller.id).getElementsByTagName('td');
	    myText.innerHTML =
	    "Title: " + children[0].innerHTML +
	    "<br>Get it from: " + children[1].innerHTML +
	    "<br>Description: " + value +
	    "<br>Type: " + children[3].innerHTML +
	    "<br>Added by: " + children[2].innerHTML +
	    " @ " + children[4].innerHTML;
	    myWindow.style.display = "block";
	}
</script>
@endsection