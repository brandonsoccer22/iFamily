@extends('layout')

@section('content')
<div class='container' style="display: all;">    
        <ul class='nav nav-tabs childnav' id="timeline">
            
            <li class="active">
                <a href='#choirs-add2' data-toggle="tab">Add Choir</a>
            </li>                
            <li  >
                <a href='#choirs-edit2' data-toggle="tab">Edit Choirs</a>
            </li>                
            <li  >
                <a href='#choirs-approve2' data-toggle="tab">Approve Choirs</a>
            </li>                
        </ul>    
</div>
    <br>

<div class='tab-content'>
    @include('components.choirs-add')
    @include('components.choirs-edit')
    @include('components.choirs-approve')
</div>

<script>

	 $(document).ready(function() {
		/*
		$('.nav-tabs').on('shown.bs.tab', 'a', function (e) {
		    if (e.relatedTarget) {
		        $(e.relatedTarget).removeClass('active');
		    }
		})

		*/

		$('#timeline a').click(function (e) {
		  $('#timeline li').removeClass('active');
		  e.preventDefault();
		  $(this).tab('show');
		});
		

	});

</script>			


@endsection

