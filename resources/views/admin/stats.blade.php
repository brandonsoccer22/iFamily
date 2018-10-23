@extends('layout')

@section('content')

<div class="container childtabnav tab-pane active in" id="stats">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">                
                <div class="card-header"><h3>Statistics(Active)</h3></div>
                  <div class="card-body">
		<div style='width:100%'>
        <table>
        <thead><tr><th>CHORES</th></tr></thead>
                  <thead>
                  <tr><th>Name</th><th>AssignedTo</th><th>CreatedBy</th><th>Repeat</th><th>DBID</th></tr>
                  <tbody>
                  @foreach($chores_active as $chore)
                  <tr>
                  <td>{{$chore->name}}</td>
                  <td>{{$chore->assignedto}}</td>
                  <td>{{$chore->createdby}}</td>
                  <td>{{$chore->repeat}}</td>
                  <td>{{$chore->id}}</td>
                  </tr>
                  @endforeach
                  </tbody>
                  </table>
                  </thead>
        </table>
        </div>
		<div style='width:100%'>
        <table>
        <thead><tr><th>GROCERIES</th></tr></thead>
                  <thead>
                  <tr><th>Name</th><th>Description</th><th>CreatedBy</th><th>DBID</th></tr>
                  <tbody>
                  @foreach($groceries_active as $grocery)
                  <tr>
                  <td>{{$grocery->name}}</td>
                  <td>{{$grocery->description}}</td>
                  <td>{{$grocery->username}}</td>
                  <td>{{$grocery->id}}</td>
                  </tr>
                  @endforeach
                  </tbody>
                  </table>
                  </thead>
        </table>
        </div>
		<div style='width:100%'>
        <table>
        <thead><tr><th>POLLS</th></tr></thead>
                  <thead>
                  <tr><th>Name</th><th>CreatedBy</th><th>Completed</th><th>DBID</th></tr>
                  <tbody>
                  @foreach($polls_active as $poll)
                  <tr>
                  <td>{{$poll->title}}</td>
                  <td>{{$poll->username}}</td>
                  <td>{{$poll->completed}}</td>
                  <td>{{$poll->id}}</td>
                  </tr>
                  @endforeach
                  </tbody>
                  </table>
                  </thead>
        </table>
        </div>
                </div>               
            </div>

                          
            <div class="card">    
                <div class="card-header"><h3>Statistics(History)</h3></div>
                  <div class="card-body">
		<div style='width:100%'>
        <table>
        <thead><tr><th>CHORES</th></tr></thead>
                  <thead>
                  <tr><th>Name</th><th>AssignedTo</th><th>CreatedBy</th><th>Repeat</th><th>DBID</th></tr>
                  <tbody>
                  @foreach($chores_history as $chore)
                  <tr>
                  <td>{{$chore->name}}</td>
                  <td>{{$chore->assignedto}}</td>
                  <td>{{$chore->createdby}}</td>
                  <td>{{$chore->repeat}}</td>
                  <td>{{$chore->id}}</td>
                  <td>
                    <form method='POST' action='/deleteuser' onsubmit="return confirm('Are you sure you want to recover this chore?')">
                    {{csrf_field()}}
                    <button style = "float:right;" type = 'submit' class = "btn btn-primary">Recover</button>
					<input type="hidden" name="id" value="{{$chore->id}}">
                    </form>
                  </td>
                  </tr>
                  @endforeach
                  </tbody>
                  </table>
                  </thead>
        </table>
        </div>
		<div style='width:100%'>
        <table>
        <thead><tr><th>GROCERIES</th></tr></thead>
                  <thead>
                  <tr><th>Name</th><th>Description</th><th>CreatedBy</th><th>DBID</th></tr>
                  <tbody>
                  @foreach($groceries_history as $grocery)
                  <tr>
                  <td>{{$grocery->name}}</td>
                  <td>{{$grocery->description}}</td>
                  <td>{{$grocery->username}}</td>
                  <td>{{$grocery->id}}</td>
                  <td>
                    <form method='POST' action='/deleteuser' onsubmit="return confirm('Are you sure you want to recover this grocery?')">
                    {{csrf_field()}}
                    <button style = "float:right;" type = 'submit' class = "btn btn-primary">Recover</button>
					<input type="hidden" name="id" value="{{$grocery->id}}">
                    </form>
                  </td>
                  </tr>
                  @endforeach
                  </tbody>
                  </table>
                  </thead>
        </table>
        </div>
		<div style='width:100%'>
        <table>
        <thead><tr><th>POLLS</th></tr></thead>
                  <thead>
                  <tr><th>Name</th><th>CreatedBy</th><th>DBID</th></tr>
                  <tbody>
                  @foreach($polls_history as $poll)
                  <tr>
                  <td>{{$poll->title}}</td>
                  <td>{{$poll->username}}</td>
                  <td>{{$poll->id}}</td>
                  <td>
                    <form method='POST' action='/deleteuser' onsubmit="return confirm('Are you sure you want to recover this poll?')">
                    {{csrf_field()}}
                    <button style = "float:right;" type = 'submit' class = "btn btn-primary">Recover</button>
					<input type="hidden" name="id" value="{{$poll->id}}">
                    </form>
                  </td>
                  </tr>
                  @endforeach
                  </tbody>
                  </table>
                  </thead>
        </table>
        </div>
                </div>               
            </div>
            </div>
        </div>
    </div>
</div>

@endsection