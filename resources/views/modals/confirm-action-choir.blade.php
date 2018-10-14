<!-- Modal -->
<div class="modal fade"  tabindex="-1" role="dialog" id=choir-delete-modal>
  <div class="modal-dialog" >
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Confirmation</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="modal-choir-body">
        <p id="modal-choir-body">Are you sure you want to delete this choir?</p>
      </div>
      <div class="modal-footer">
        <a id='choir-delete-href' href="#" class="btn btn-secondary btn-danger pull-right" >
		Delete</a>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
      </div>
    </div>
  </div>
</div>

<style>
	.modal-backdrop {
    /* bug fix - no overlay */    
    display: none;    
}
</style>