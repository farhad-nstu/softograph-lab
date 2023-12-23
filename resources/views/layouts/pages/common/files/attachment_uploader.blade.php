<div class="card">
    <div class="card-header py-2">
        <h6>Upload Documents</h6>
    </div>
    <div class="card-body">
        <form id="card_documents_form" action="{{ route('cards.store_card_attachment') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="form-group row">
                <div class="col-sm-12">
                    <div class="custom-file">
                        <input type="file" id="card_documents" name="card_documents[]" multiple>
                    </div>
                    <div class="text-danger">
                    </div>
                    <small style="color: red" id="id_card_documents_text"></small>
                </div>
            </div>
            <button type="submit" class="btn btn-primary btn-sm" name="document_submit_button" class="document_submit_button" id="document_submit_button">Submit</button>
        </form>
    </div>
</div>
