@extends('local.default_calander')

@section('css')

<style type="text/css">
	
	.calander{
		padding: 20px;
	}

	.calander  .panel{
		border: 10px solid #eee;
	}



	.fc-unthemed th span {
	    color: #fff;
	}

	.fc-unthemed th {
	    background: #151515;
	    border: unset;
	    padding: 4px 0;
	}

	.fc-button {
	    background: #e94e27;
	    border: 0;
	    border-radius: 0 !important;
	    box-shadow: unset;
	    text-shadow: unset;
	    color: white;
	    margin: 0 1px !important;
	    text-transform: capitalize;
	}

	.panel-heading .title{
	    margin: 0 0 10px 0;
	    text-align: center;
	    padding: 5px 0px 10px 0px;
	    text-transform: uppercase;
	}

	div#calendar {
	    padding: 0 15px 15px 15px;
	}
	.fc-day-grid.fc-unselectable {
	    background: white;
	}
	.fc-event, .fc-event-dot {
	    background-color: #e94e27;
	    border-color: #e94e27;
	}
</style>

@endsection


@section('content')

<meta name="csrf-token" content="{{ csrf_token() }}">

<div class="row">
	<div class="container calander">
		<div class="col-sm-12 col-md-12">
			<div class="panel">
				<div class="panel-heading">
					<h2 class="title">Events</h2>
				</div>
			    @hasanyrole('Talents|Web Master|Admin')
			    	<div id='calendar'></div>
			    @endhasanyrole				
			</div>
		</div>
	</div>
</div>

<div id="add_calander_modal" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      	<div class="modal-header">
        	<button type="button" class="close" data-dismiss="modal">&times;</button>
        	<h4 class="modal-title" id="add_calander_title"></h4>
      	</div>
      	<form id="add_calander_form">
		    <div class="modal-body">
		    	<input type="hidden" name="start" id="a_start">
		    	<input type="text" class="form-control" name="title">
		    </div>	     
		    <div class="modal-footer">
		        <button type="submit" class="btn btn-default"><i class="fa fa-plus"></i>&nbsp;Add Event</button>
		    </div>      		
      	</form>
    </div>
  </div>
</div>

<div id="update_calander_modal" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      	<div class="modal-header">
        	<button type="button" class="close" data-dismiss="modal">&times;</button>
        	<h4 class="modal-title" id="update_calander_title"></h4>
      	</div>
      	<form id="update_calander_form">
		    <div class="modal-body">
		    	<input type="hidden" name="start" id="u_start">
		    	<input type="text" class="form-control" id="u_title" name="title">
		    </div>	     
		    <div class="modal-footer">
		        <button type="button" id="removeEvent" class="btn btn-danger"><i class="fa fa-trash"></i>&nbsp;Remove Event</button>
		        <button type="button" id="updateEvent" class="btn btn-default"><i class="fa fa-refresh"></i>&nbsp;Update Event</button>
		    </div>      		
      	</form>
    </div>
  </div>
</div>

@endsection


@section('js')

<!-- full calander Js -->
<script type="text/javascript">
	
	$.ajaxSetup({
	  headers: {
	    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	  }
	});

	function formatDate(date) {
	    var d = new Date(date),
	        month = '' + (d.getMonth() + 1),
	        day = '' + d.getDate(),
	        year = d.getFullYear();

	    if (month.length < 2) month = '0' + month;
	    if (day.length < 2) day = '0' + day;

	    return [year, month, day].join('-');
	}

    $(document).ready(function(){

    		var user_id = "{{ auth()->user()->id }}";

    		var event = <?php if(isset($events)){ echo json_encode($events); } ?>

    		//console.log(event);

    		var event_id;

            $('#calendar').fullCalendar({
                selectable: true,  
                dayClick: function(start) {
                	$('#add_calander_title').text(new Date(start.format()).toDateString('yyyy-MM-dd'));
                	$('#a_start').val(start.format());
					$('#add_calander_modal').modal('toggle');
                },
                eventClick: function(event, element) {
                	//console.log(event.title+" "+event.start.format()+"  "+event.id);
                	
                	$('#update_calander_title').text(new Date(event.start.format()).toDateString('yyyy-MM-dd'));
				    $('#u_start').val(event.start.format());
				    $('#u_title').val(event.title);
				   	$('#update_calander_modal').modal('toggle');

				   	event_id = event.id;


				    $('#updateEvent').on('click',function(){
				    	var new_title = $('#u_title').val();
				    	event.title = new_title;
				    	var jsObj = {
				    		'user_id': user_id,
				    		'title': new_title,
				    		'start': event.start.format()
				    	};
				    	$.ajax({
				    		url: "{{ route('talent.events.update',['']) }}/"+event.id,
				    		type: "PUT",
				    		data: jsObj
				    	}).done(function(response){
				    		if(response.status == 'success')
				    		{
				    			$('#calendar').fullCalendar('updateEvent', event );
				   				$('#update_calander_modal').modal('toggle');
				    			alert(response.message);
				    		}
				    	});
				    });


				},
				events: event
            });

            $('#add_calander_form').submit(function(e){
            	var jsObj = $(this).serializeArray();
            	$.ajax({
            		url: "{{ route('talent.events.store') }}",
            		type: "POST",
            		data : jsObj
            	}).done(function(response){
            		if(response.hasOwnProperty('message'))
            		{
            			alert(response.message);
            		}
            		else
            		{
            			var eventObj = {
            				'title' : response.event.title,
            				'start' : formatDate(response.event.start),
            				'id'	: response.event.id
            			};
            			var event = [eventObj];
		                $('#calendar').fullCalendar( 'addEventSource', event );
		                $(this).trigger("reset");
		                $('#add_calander_modal').modal('toggle');
            		}
            	});
            	e.preventDefault();
            });

    		$('#removeEvent').on('click',function(){
    			if(confirm('Are you sure.?'))
    			{
			    	$.ajax({
			    		url: "{{ route('talent.events.delete',['']) }}/"+event_id,
			    		type: "DELETE"
			    	}).done(function(response){
			    		if(response.status == 'success')
			    		{
			    			$('#calendar').fullCalendar( 'removeEvents' , [ event_id] );
			    			$('#update_calander_modal').modal('toggle');
			    			alert(response.message);
			    		}
			    	});
    			}
		    });
        
        });

</script>
<script src="{{ asset('/theme/js/bootstrap.min.js') }}"></script>

@endsection

