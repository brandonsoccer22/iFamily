@extends('layout')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <br>
            <div class="card">                
                <div class="card-header"><h3>Add a Family Member</h3></div>
                  <div class="card-body">
                    <form method="POST" action="/submit-new-user" id="add-user">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>

                                @if (isset($error))
                                    <div class="alert alert-danger" role="alert" style="margin-top: 20px;">
			                            {!! $error !!}
			                        </div> 
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                <div style="margin-top: 20px;">
                                    <span class="invalid-feedback" role="alert" >
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                </div>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>                        

                        <div class="form-group row">
                            <label for="user-type" class="col-md-4 col-form-label text-md-right">{{ __('User Type') }}</label>

                            <div class="col-md-6">
                            	<div class="styled-select slate">
	                                <select name="user-type" form="add-user">
										  <option value="parent">Parent</option>
										  <option value="child">Child</option>									  
									</select>
								</div>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Add') }}
                                </button>
                            </div>
                        </div>

                        <input id="parent-email" name="parent-email" type="hidden" value="{!! session('user')->family_id !!}">

                    </form>
                </div>               
            </div>

            <br>

            <!-- show current users -->
            <div class="card">                
                <div class="card-header"><h3>Current Family Members</h3></div>
                    <div class="card-body">
                        
                        @if(!empty((array)session('user')['family']))
                        <table id="view_family_members_table_id" class="table" data-mobile-responsive="true"> {{--Note sure if data-mobile-responsive="true" does anything--}}
                            <thead>
                            <tr>
                                <th style="text-align:left;width: 20px;">Name</th>
                                <th style="text-align:left;width: 20px;">Email</th>                        
                            </tr>
                            </thead>
                            <tbody>
                            @endif

                            @forelse((array)session('user')['family'] as $key => $value)

                                <tr >

                                    <td style="text-align:left;">{!! $value['name'] !!}</td>

                                    <td style="text-align:left;">{!! $value['email'] !!}</td>
                                    
                                </tr>

                                {{-- Second Check --}}
                            @empty
                                <div>
                                    You do not have any family members yet.
                                </div>

                            @endforelse

                            {{-- Third Check --}}
                            @if(!empty((array)session('user')['family']))
                            </tbody>
                        </table>
                            @endif

                       
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



<script>
    @if(session()->has('user'))
    console.log({!! session('user') !!});
    @endif
</script>

@endsection