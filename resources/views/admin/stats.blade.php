@extends('layout')

@section('content')

<div class="container childtabnav tab-pane active in" id="stats">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">                
                <div class="card-header"><h3>Statistics</h3></div>
                  <div class="card-body">
		<div style='width:60%'>
        <table>
        <thead><tr><th>USERS</th></tr></thead>
                  <thead>
                  <tr>
                  <!--<th>FamilyID</th>--><th>Username</th><th>Email</th><th>Role</th><th>DBID</th>
                  </tr>
                  <tbody>
                  @foreach($users as $user)
                  <tr>
                  <!--<td>{{$user->family_id}}</td>-->
                  <td>{{$user->name}}</td>
                  <td>{{$user->email}}</td>
                  @if($user ->is_parent == 1)
                  <td>{{"parent"}}</td>
                  @else
                  <td>{{"child"}}</td>
                  @endif
                  <td>{{$user->id}}</td>
                  </tr>
                  @endforeach
                  </tbody>
                  </table>
                  </thead>
        </table>
        </div>
		<div style='width:60%'>
        <table>
        <thead><tr><th>CHORES</th></tr></thead>
                  <thead>
                  <tr><th>Name</th><th>AssignedTo</th><th>CreatedBy</th><th>Repeat</th><th>DBID</th></tr>
                  <tbody>
                  @foreach($chores as $chore)
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
		<div style='width:60%'>
        <table>
        <thead><tr><th>GROCERIES</th></tr></thead>
                  <thead>
                  <tr><th>Name</th><th>Description</th><th>CreatedBy</th><th>DBID</th></tr>
                  <tbody>
                  @foreach($groceries as $grocery)
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
		<div style='width:60%'>
        <table>
        <thead><tr><th>POLLS</th></tr></thead>
                  <thead>
                  <tr><th>Name</th><th>CreatedBy</th><th>DBID</th></tr>
                  <tbody>
                  @foreach($polls as $poll)
                  <tr>
                  <td>{{$poll->title}}</td>
                  <td>{{$poll->username}}</td>
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
        </div>
    </div>
</div>

@endsection