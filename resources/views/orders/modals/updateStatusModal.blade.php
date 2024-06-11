<!-- Modal for Updating Order Status -->
<div class="modal fade" id="updateStatusModal" tabindex="-1" aria-labelledby="updateStatusModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="updateStatusModalLabel">{{ __('messages.order_modal_update_status') }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="updateStatusForm">
                    @csrf
                    @method('post')
                    <input type="hidden" id="orderId" name="order_id">
                    <div class="mb-1">
                        <label class="col-form-label" for="updateStatus">{{ __('messages.order_status') }}:</label>
                        <select class="form-select" id="updateStatus" name="status">
                            <option value="0">{{ __('messages.order_modal_non_payé') }}</option>
                            <option value="1">{{ __('messages.order_modal_payé') }}</option>
                            <option value="2">{{ __('messages.order_modal_annulé') }}</option>
                            <option value="3">{{ __('messages.order_modal_modifier') }}</option>
                            <option value="4">{{ __('messages.order_modal_remboursé') }}</option>
                            <option value="5">{{ __('messages.order_modal_payé_cash') }}</option>
                            <option value="6">{{ __('messages.order_modal_encaissé') }}</option>
                        </select>
                    </div>
                    <div class="mb-1">
                        <label class="col-form-label" for="comment">{{ __('messages.order_vior_commentaire') }}:</label>
                        <textarea class="form-control" id="comment" name="comment"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">{{ __('messages.order_modal_modifier') }}</button>
                </form>
            </div>
        </div>
    </div>
</div>
