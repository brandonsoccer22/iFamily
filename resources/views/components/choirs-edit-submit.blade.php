
@extends('layout')

@section('content')

<div class="container childtabnav tab-pane active in" id="choirs-add2">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">                
                <div class="card-header"><h3>Edit a Chorez</h3></div>
                  <div class="card-body">
                    <form method="POST" action="/submit-edit-choir" id="edit-choir-submit">
                        @csrf
                        
                        Name:<br>
  						<input type="text" name="name" required="required" value="{!! $choir['name'] !!}"><br>

  						<br>Type:<br>
  						<input type="radio" name="is_static" value="daily" required="required" @if($choir['repeat']=="daily") checked @endif>Reoccurring: Daily<br>
  						<input type="radio" name="is_static" value="weekly" @if($choir['repeat']=="weekly") checked @endif>Reoccurring: Weekly<br>
  						<input type="radio" name="is_static" value="monthly" @if($choir['repeat']=="monthly") checked @endif>Reoccurring: Monthly<br>
  						<input type="radio" name="is_static" value="none" @if((bool)strtotime($choir['repeat'])) checked @endif> One-time<br>

  						<br>Due Date (if not reoccuring):<br>
  						<input type="date" name="duedate" value="@if((bool)strtotime($choir['repeat'])){!! date("Y-m-d", strtotime($choir['repeat'])) !!}@endif"><br>

  						<br>Assign to:<br>
                        @foreach(session('user')['family'] as $key=>$value)
                        <input type="radio" name="user_id" value="{!! $value['id'] !!}" required="required" @if($choir['user_id']==$value['id']) checked @endif> {!! $value['name'] !!}<br>                      

                        @endforeach

                        <input type="hidden" name="created_by" value="{!! session('user')['id'] !!}">
                        <input type="hidden" name="id" value="{!! $choir['id'] !!}">
                        <input type="hidden" name="status" value="{!! $choir['status'] !!}">


                        <br>Note:<br>
                        <textarea rows="4" cols="35" style="width:100%;" name="note" form="edit-choir-submit" >{!! $choir['note'] !!}</textarea>
						<br>


                        <br>
                        <button type="submit" class="btn btn-primary">
                            {{ __('Submit') }}
                        </button>
                            
                        

                    </form>
                    <a href="/">Cancel</a>
                </div>               
            </div>
        </div>
    </div>
</div>

<script type="text/javascript"> console.log({!! json_encode($choir) !!})</script>

@endsection
