<div class="modal fade jquery_panel_hightlight" id="email-resend-modal" tabindex="-1" role="dialog" >
    <div class="modal-dialog model-lg" role="document">
        <div class="modal-content">			
			{!! CollectiveForm::open(['method' => 'POST', 'route' => $setting->grab('main_route').'-notification.resend', 'class' => 'form-horizontal']) !!}
			{!! CollectiveForm::hidden('comment_id', $comment->id, ['id'=>'comment_id']) !!}
			<div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">{{ trans('panichd::lang.flash-x') }}</span></button>
                <h4 class="modal-title">{{ trans('panichd::lang.show-ticket-email-resend') }}</h4>
            </div>
            <div class="modal-body">
				<fieldset>
					<div class="form-group">
						<div class="col-lg-12">
						<label><input type="checkbox" name="to_agent" value="yes"> {{ trans('panichd::lang.show-ticket-email-resend-agent') . $ticket->agent->name}}</label>
						</div>
					</div>
					@if(!$ticket->hidden)
						<div class="form-group">
							<div class="col-lg-12">
							<label><input type="checkbox" name="to_owner" value="yes" checked="checked"> {{ trans('panichd::lang.show-ticket-email-resend-user') }}<span id="owner"></span></label>
							</div>
						</div>
					@endif
					<div class="text-right col-md-12">
						{!! CollectiveForm::submit( trans('panichd::lang.btn-submit'), ['class' => 'btn btn-primary']) !!}
					</div>

				</fieldset>
			</div>
			{!! CollectiveForm::close() !!}
        </div>
    </div>
</div>