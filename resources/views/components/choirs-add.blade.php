<div class="container childtabnav tab-pane active in" id="choirs-add2">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">                
                <div class="card-header"><h3>Add a Choir</h3></div>
                  <div class="card-body">
                    <form method="POST" action="/submit-new-choir" id="add-choir">
                        @csrf
                        
                        Name:<br>
  						<input type="text" name="name" ><br>

  						<br>Type:<br>
  						<input type="radio" name="is_static" value="daily" checked>Reoccurring: Daily<br>
  						<input type="radio" name="is_static" value="weekly" checked>Reoccurring: Weekly<br>
  						<input type="radio" name="is_static" value="monthly" checked>Reoccurring: Monthly<br>
  						<input type="radio" name="is_static" value="none"> One-time<br>

  						<br>Assign to:<br>
                        @foreach(session('user')['family'] as $key=>$value)
                        <input type="radio" name="user_id" value="{!! $value['id'] !!}" > {!! $value['name'] !!}<br>

                        <input type="hidden" name="created_by" value="{!! session('user')['id'] !!}">

                        @endforeach

                        <br>Note:<br>
                        <textarea rows="4" cols="50" name="note" form="add-choir"></textarea>
						<br>


                        <br>
                        <button type="submit" class="btn btn-primary">
                            {{ __('Submit') }}
                        </button>
                            
                        

                    </form>
                </div>               
            </div>
        </div>
    </div>
</div>