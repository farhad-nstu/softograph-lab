<div class="modal fade" id="cardCreateModal" tabindex="-1" role="dialog" aria-labelledby="cardCreateModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form method="POST" id="id_card_create_form" action="{{ route('cards.store_card') }}">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="cardCreateModalLabel">Modal title</h5>
                    <button type="button" class="close modalCloseBtn" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md">
                            <div class="mb-3">
                                <label for="card_title">Title</label>
                                <input type="text" name="name" id="card_title" class="form-control">
                            </div>
                            <small id="id_name_text" style="color: red"></small>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md">
                            <div class="mb-3">
                                <label for="status1">Status</label>
                                <select name="status" id="status1"
                                    class="form-control">
                                    <option value="">-------</option>
                                    @foreach ($statuses as $status)
                                        <option value="{{ $status }}">{{ $status }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <small id="id_status_text" style="color: red"></small>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary modalCloseBtn" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" name="submit_button">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
