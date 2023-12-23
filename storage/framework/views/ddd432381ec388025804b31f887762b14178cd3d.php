<script>
    function set_card_documents(card_documents) {
        home_url = "<?php echo e(url('/')); ?>";
        card_documents_download_url = "<?php echo e(url('card/documents/download')); ?>" + "?card_no=" + $('#card_id').val();

        $('#uploaded_documents').empty();

        for (card_document of card_documents) {
            let document_url = home_url + '/' + card_document.document_path;
            let extension = document_url.substring(document_url.lastIndexOf('.') + 1);
            let thumbnail = '';
            let has_image = '';
            if (extension == 'pdf') {
                thumbnail = `<img src="<?php echo e(asset('img/pdf_icon.png')); ?>" alt="pdf_icon" class="img-thumbnail">`;
            } else {
                has_image = ' has_image';
                thumbnail = `
                    <a href="${document_url}" class="image">
                        <img src="${document_url}" class="img-thumbnail">
                    </a>
                `;
            }
            item =  `<li class="list-group-item d-flex justify-content-between align-items-center${has_image}">
                        ${thumbnail}
                        <span>
                            <a class="btn btn-primary btn-sm" title="Download" href="${document_url}" download><i class="fas fa-download"></i></a>
                            <button class="btn btn-danger btn-sm document_remove_button" data-document-id="${card_document.id}" title="Remove"><i class="fas fa-trash-alt" aria-hidden="true"></i></button>
                        </span>
                    </li>`;
            $('#uploaded_documents').append(item);
        }
        if (card_documents.length > 0) {
            $('.card_documents_download_button').attr('href', card_documents_download_url);
            $('.card_documents_download_button').removeClass('d-none');
        } else {
            $('.card_documents_download_button').addClass('d-none');
            $('.card_documents_download_button').attr('href', '#');
        }

        $('#card_documents').fileinput('reset');
    }

    
    $("#uploaded_documents").on("click", "button.document_remove_button", function () {
        element = $(this);
        document_id = element.data('document-id');

        bootbox.confirm({
            title: "Remove document?",
            message: `Are you sure you want to remove document <strong>${document_id}</strong>? This action cannot be reversed.`,
            buttons: {
                cancel: {
                    label: 'No',
                    className: 'btn-sm btn-primary',
                },
                confirm: {
                    label: 'Yes',
                    className: 'btn-sm btn-danger',
                }
            },
            callback: function (confirmed) {
                console.log('This was logged in the callback: ' + confirmed);
                if (confirmed) {
                    let form_data = new FormData();

                    form_data.append("csrfmiddlewaretoken", '<?php echo e(csrf_field()); ?>');
                    form_data.append("document_id", document_id);

                    axios.post("<?php echo e(route('cards.remove_card_attachment')); ?>", form_data, {})
                        .then(function (response) {
                            if (response.data.length <= 0) {
                                console.log("empty");
                                return false;
                            }
                            data = response.data.data
                            card_documents = data.card_attachments
                            message = data.message

                            toastr.options = {
                                "closeButton" : true,
                                "progressBar" : true
                            }
                            toastr.success(message);
                        })
                        .then(function () {
                            set_card_documents(card_documents);
                        })
                        .catch(function (error) {
                            if(error.response){
                                let status = error.response.status;
                                message = error.response.data.message
                                if(status == 422){
                                    toastr.options = {
                                        "closeButton" : true,
                                        "progressBar" : true
                                    }
                                    toastr.error(message);
                                    return false;
                                }
                                if(status == 404){
                                    toastr.options = {
                                        "closeButton" : true,
                                        "progressBar" : true
                                    }
                                    toastr.error(message);
                                    return false;
                                }
                                if (error instanceof ReferenceError) {
                                    toastr.options = {
                                        "closeButton" : true,
                                        "progressBar" : true
                                    }
                                    toastr.error(error.message);
                                }
                                return false;
                            }
                        });
                }
            }
        });
    });
</script>
<?php /**PATH C:\xampp\htdocs\softolab\resources\views/layouts/pages/common/js/card_attachment_setter_js.blade.php ENDPATH**/ ?>