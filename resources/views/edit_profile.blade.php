
@extends('layout')

@section('content')

<div class="container childtabnav tab-pane active in" id="choirs-add2">
    <div class="row justify-content-center">
        <div class="col-md-8">
        	<br>
            <div class="card">                
                <div class="card-header"><h3>Edit Profile</h3></div>
                  <div class="card-body">
                    <form method="POST" action="/user-patch" id="edit-profile-submit">
                        @csrf
                        <input type="hidden" name="id"  value="{!! session()->get('user')['id'] !!}"><br><br>

                        Email:<br>
  						<input type="email" name="email"  value="{!! session()->get('user')['email'] !!}"><br><br>
  						
  						Name:<br>
  						<input type="text" name="name"  value="{!! session()->get('user')['name'] !!}"><br>	

                        <br>
                        <button type="submit" class="btn btn-primary">
                            {{ __('Submit') }}
                        </button>
                      	<a href="/">Cancel</a>  
                        

                    </form>

                    @if (isset($error))
                        <div class="alert alert-danger" role="alert" style="margin-top: 20px;">
                            {!! $error !!}
                        </div> 
                    @endif

                    @if (isset($success))
                        <div class="alert alert-success" role="alert" style="margin-top: 20px;">
                            {!! $success !!}
                        </div> 
                    @endif
                    
                </div>               
            </div>
        </div>
    </div>
</div>

@endsection
