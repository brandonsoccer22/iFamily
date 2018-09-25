<div class="container tab-pane" id='choirs-edit2'>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card" style="width:1000px;">                
                <div class="card-header"><h3>Modify Choirs</h3></div>
                  <div class="card-body">
                     {{-- First Check --}}
    	@if(!empty((array)$choirs))
        <table id="edit_choirs_table_id" class="table" data-mobile-responsive="true"> {{--Note sure if data-mobile-responsive="true" does anything--}}
            <thead>
            <tr>
                <th style="text-align:left;width: 20px;">Name</th>
                <th style="text-align:left;width: 20px;">Assigned To</th>
                <th style="text-align:left;width: 20px;">Created By</th>
                <th style="text-align:left;width: 20px;">Due</th>
                <th style="text-align:left;width: 20px;">Note</th>
                <th style="text-align:left;width: 20px;">Status</th>
                <th style="text-align:left;width: 20px;">Created At</th>           
            </tr>
            </thead>
            <tbody>
            @endif

            @forelse((array)$choirs as $key => $value)

                <tr>

                    <td>{!! $value['name'] !!}</td>

                    <td>{!! $value['user_name'] !!}</td>

                    <td>{!! $value['created_by_name'] !!}</td>

                    <td>@if(isset($value['repeat'])){!! $value['repeat'] !!} @else NA @endif</td>

                    <td style="text-align:left">@if(isset($value['note'])){!! $value['note'] !!} @else none @endif</td>

                    <td>{!! $value['status'] !!}</td>

                    <td style="text-align:left">{!! $value['created_at'] !!}</td>                   

                </tr>

                {{-- Second Check --}}
            @empty
                <div>
                    You do not have any choirs.
                </div>

            @endforelse

            {{-- Third Check --}}
            @if(!empty((array)$choirs))
            </tbody>
        </table>
    		@endif
                </div>               
            </div>
        </div>
    </div>
</div>

<script>
@if(isset($choirs))
	console.log({!! json_encode($choirs) !!})
@else
	console.log("No Choirs found :/")
@endif
</script>