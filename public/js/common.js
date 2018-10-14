//display note

function showChoirNotes(choir_note) {
		$("#choir_note_modal_body").empty();
		$("#choir_note_modal_body").append("<div>"+choir_note+"</div>");
	    $('#choir_note_modal').modal('show');
	}