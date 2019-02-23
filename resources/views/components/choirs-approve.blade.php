<div class="container tab-pane" id='choirs-approve2'>
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">                
                <div class="card-header"><h3>Approve Chores</h3></div>
                  <div class="card-body">
                    <div class="wrapper">
                     {{-- First Check --}}
    	@if(!empty((array)$pendingChoirs))
        <table id="approve_choirs_table_id" class="table" data-mobile-responsive="true"> {{--Note sure if data-mobile-responsive="true" does anything--}}
            <thead>
            <tr>
                <th style="text-align:left;width: 20px;">Name</th>
                <th style="text-align:left;width: 20px;">Assigned To</th>
                <th style="text-align:left;width: 20px;">Created By</th>
                <th style="text-align:left;width: 20px;">Due</th>
                <th style="text-align:left;width: 20px;">Note</th>
                <th style="text-align:left;width: 20px;">Status</th>
                <th style="text-align:left;width: 20px;">Created At</th>    
                <th style="text-align:left;width: 20px;">Action</th>         
            </tr>
            </thead>
            <tbody>
            @endif

            @forelse((array)$pendingChoirs as $key => $value)

                <tr >

                    <td style="text-align:left;">{!! $value['name'] !!}</td>

                    <td style="text-align:left;">{!! $value['user_name'] !!}</td>

                    <td style="text-align:left;">{!! $value['created_by_name'] !!}</td>

                    <td style="text-align:left;">@if(isset($value['repeat'])){!! $value['repeat'] !!} @else NA @endif</td>

                    <td style="text-align:center">@if(isset($value['note']))
                    
                     <button id="choir-note-get"  type="button" class="btn btn-sm btn-primary pull-center" onclick="showChoirNotes('{!!$value['note']!!}');"><i  class="fa">&#xf24a;</i></button>@else None @endif</td>

                    <td style="text-align:left;">{!! $value['status'] !!}</td>

                    <td style="text-align:left">{!! $value['created_at'] !!}</td>   
                     <td style="text-align:left">                     	
                        <a  href="/edit-choir/?id={!! $value['id'] !!}&status=rejected" class="btn btn-sm btn-danger " ><span class="fa fa-remove"></span></a>
                        <button type="button" class="btn btn-sm btn-success pull-right" onclick="approveChoir({!! $value['id'] !!})"><i class="fa fa-check"></i></button>
                     </td>                 

                </tr>

                {{-- Second Check --}}
            @empty
                <div>
                    You do not have any pending Chores to review.
                </div>

            @endforelse

            {{-- Third Check --}}
            @if(!empty((array)$pendingChoirs))
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
@if(isset($choirs))
	console.log({!! json_encode($choirs) !!})
@else
	console.log("No Choirs found :/")
@endif

function approveChoir(choir_id){	
                $('#choir-delete-href').attr("href", "/delete-choir/?id="+choir_id+"&status=approved").text("Approve").removeClass('btn-danger').addClass('btn-success');
                $('#choir-delete-modal').modal('show');
                $('#modal-choir-body').text('Are you sure you want to approve this choir?');
            }


//could add date sorting for DataTable sorting, the needed delcarations are in the head as https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/moment.min.js and in MailChimp.blade.php as the function in the script before the tabs
        //$.fn.dataTable.moment( 'd-M-Y' ); 
		//DataTable
        $(document).ready(function() {
            $('#approve_choirs_table_id').DataTable({
                //"paging": false,
                //"order": [[ 1, "desc" ]], //set default sorting to specific column
                //aaSorting:[],//disables initial sorting,
                //scrollY: 500,
                //searching: false, //disable searching
                //"lengthMenu": [[5, 10, 25, -1], [5, 10, 25, "All"]], //customize paging length options
                //"bLengthChange": false, //disable changing paging length
                //"iDisplayLength": 5, //default paging length
                //"responsive": true,
                /*
                "columnDefs": [
                    { //removes sorting from specific column
                        "targets": [6],
                        "orderable": false
                    },
                    //{ "type": "datetime-moment", targets: [7] } //auto detection seems to work better
                ]
                */
            })
        });

</script>

@include('modals.confirm-action-choir')