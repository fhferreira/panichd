<!-- Modal Dialog -->
<div class="modal fade jquery_panel_hightlight" id="modal-comment-delete" role="dialog" tabindex="-1">
  <div class="modal-dialog model-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">{{ trans('ticketit::lang.flash-x') }}</button>
        <h4 class="modal-title">{{ trans('ticketit::lang.show-ticket-delete-comment') }}</h4>
      </div>
      <div class="modal-body">
        <p>{{ trans('ticketit::lang.show-ticket-delete-comment-msg') }}</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">{{ trans('ticketit::lang.btn-cancel') }}</button>
        <button type="button" class="btn btn-danger" id="delete-comment-submit">{{ trans('ticketit::lang.btn-delete') }}</button>
      </div>
    </div>
  </div>
</div>