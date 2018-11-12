@extends('layout')

@section('content')

<div class="container childtabnav tab-pane active in" id="delete_user">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">                
                <div class="card-header"><h3>Users(Active)</h3></div>
                  <div class="card-body">
		<div style='width:100%'>
        <table>
                  <tbody>
                  @php
                  $lastid = "";
                  @endphp
                  @foreach($users as $user)
                  @if($user->family_id != $lastid)
                  <td> </td>
                  <thead>
                  <tr><th>Family_id</th><th>User</th><th>Email</th><th>Role</th><th>Actions</th>
                  <td>
                    <form method='POST' action='/deletefamily' onsubmit="return confirm('Are you sure you want to delete this family?')">
                    {{csrf_field()}}
                    <button type = 'submit' class = "btn btn-primary">Delete<br>Family</button>
					<input type="hidden" name="id" value="{{$user->family_id}}">
                    </form>
                  </td></tr>
                  @endif
                  <tr>
                  <td>{{$user->family_id}}</td>
                  <td>{{$user->name}}</td>
                  <td>{{$user->email}}</td>
                  @if($user->is_parent == 1)
                  <td>{{"parent"}}</td>
                  @else
                  <td>{{"child"}}</td>
                  @endif
                  @if($user->is_admin == 1)
                  <td>
                    <form>
                    {{csrf_field()}}
                    <label>Admin</label>
                    </form>
                  @else
                  <td>
                    <form method='POST' action='/deleteuser' onsubmit="return confirm('Are you sure you want to delete this user?')">
                    {{csrf_field()}}
                    <button type = 'submit' class = "btn btn-primary">Delete</button>
					<input type="hidden" name="id" value="{{$user->id}}">
                    </form>
                  </td>
                  @endif
                  @php
                  $lastid = $user->family_id;
                  @endphp
                  </tr>
                  @endforeach
                  </tbody>
                  </table>
                  </thead>
        </table>
        </div>
                </div>               
            </div><div class="card-header"><h3>Users(Deleted)</h3></div>
                  <div class="card-body">
		<div style='width:100%'>
        <table>
                  <tbody>
                  @php
                  $lastid = "";
                  @endphp
                  @foreach($hiddenusers as $user)
                  @if($user->family_id != $lastid)
                  <td> </td>
                  <thead>
                  <tr><th>Family_id</th><th>User</th><th>Email</th><th>Role</th><th>Actions</th></tr>
                  @endif
                  <tr>
                  <td>{{$user->family_id}}</td>
                  <td>{{$user->name}}</td>
                  <td>{{$user->email}}</td>
                  @if($user->is_parent == 1)
                  <td>{{"parent"}}</td>
                  @else
                  <td>{{"child"}}</td>
                  @endif
                  @if($user->is_admin == 1)
                  <td>
                    <form>
                    {{csrf_field()}}
                    <label>Admin</label>
                    </form>
                  @else
                  <td>
                    <form method='POST' action='/recoveruser' onsubmit="return confirm('Are you sure you want to delete this user?')">
                    {{csrf_field()}}
                    <button type = 'submit' class = "btn btn-primary">Recover</button>
					<input type="hidden" name="id" value="{{$user->id}}">
                    </form>
                  </td>
                  @endif
                  @php
                  $lastid = $user->family_id;
                  @endphp
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