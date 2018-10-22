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
                  <thead>
                  <tr>
                  <th>User</th><th>Email</th><th>Role</th>
                  </tr>
                  <tbody>
                  @foreach($users as $user)
                  <tr>
                  <td>{{$user->name}}</td>
                  <td>{{$user->email}}</td>
                  @if($user ->is_parent == 1)
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
                  </tr>
                  @endforeach
                  </tbody>
                  </table>
                  </thead>
        </table>
        </div>
		<div style='width:60%'>
        <table>
                  <thead>
                  <tr><th>User</th><th>Email</th><th>ParentOrChild</th></tr>
                  <tbody>
                  @foreach($users as $user)
                  <tr>
                  <td>{{$user->name}}</td>
                  <td>{{$user->email}}</td>
                  <td>{{$user->is_parent}}</td>
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
                  </tr>
                  @endforeach
                  </tbody>
                  </table>
                  </thead>
        </table>
        </div>
		<div style='width:60%'>
        <table>
                  <thead>
                  <tr><th>User</th><th>Email</th><th>ParentOrChild</th></tr>
                  <tbody>
                  @foreach($users as $user)
                  <tr>
                  <td>{{$user->name}}</td>
                  <td>{{$user->email}}</td>
                  <td>{{$user->is_parent}}</td>
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