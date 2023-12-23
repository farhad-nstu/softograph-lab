<script>
    $('#card_documents_form').on("submit", function(event) {
        event.preventDefault();
        form = this; // the form
        jquery_form = $(this); // for selecting different element in the form using jquery
        alert_container = jquery_form.children('.ajax-form-alert-container');

        form_data = new FormData(form);
        form_data.append("card_no", $("#card_id").val());

        axios.post(form.action, form_data, {})
            .then(function (response) {
                clear_form(jquery_form);

                data = response.data.data
                card_attachments = data.card_attachments;
                message = data.message;

                toastr.options = {
                    "closeButton" : true,
                    "progressBar" : true
                }
                toastr.success(message);
            })
            .then(function () {
                set_card_documents(card_attachments);
            })
            .catch(function (error) {
                if (error.response) {

                    let status = error.response.status;

                    if (status == 401) {
                        window.location.href = "<?php echo e(route('login')); ?>";
                        return false;
                    }
                    let message = error.response.data.message;
                    let errors = error.response.data.errors;

                        if (errors) {
                            for (let [field_name, field_errors] of Object.entries(errors)) {
                                $("#id_"+field_name+"_text").text(field_errors[0])
                            }
                            return false;
                        }

                        if (status == 422) {
                            toastr.options = {
                                "closeButton" : true,
                                "progressBar" : true
                            }
                            toastr.error(message);
                            return false;
                        }
                    if (error instanceof ReferenceError) {
                        console.log(error.message)
                        toastr.options = {
                            "closeButton" : true,
                            "progressBar" : true
                        }
                        toastr.error(error.message);
                        return false;
                    }
                }
                return false;
            });
    });
</script>
<?php /**PATH C:\xampp\htdocs\softolab\resources\views/layouts/pages/common/js/card_attachment_uploader_js.blade.php ENDPATH**/ ?>