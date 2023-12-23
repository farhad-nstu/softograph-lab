<script>
    $('#id_card_create_form').on("submit", function(event) {
            event.preventDefault();
            form = this;
            jquery_form = $(this);
            alert_container = jquery_form.children('.ajax-form-alert-container');
            form_data = new FormData(form);

            axios.post(form.action, form_data, {})
                .then(function (response) {
                    {{--  message = response.data.data.message;
                    console.log(response.data)
                    console.log(response.data.data)
                    data = response.data.data  --}}
                    console.log(response)
                    $("#card_items_data").empty().html(response.data);

                    $("#id_name_text").text('')
                    $("#id_status_text").text('')
                    $("#cardCreateModal").modal('hide');
                })
                .catch(function (error) {
                    if (error.response) {
                        console.log(error.response)
                        let status = error.response.status;
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
                    }
                    if (error instanceof ReferenceError) {
                        toastr.options = {
                            "closeButton" : true,
                            "progressBar" : true
                        }
                        toastr.error(error.message);
                        return false;
                    }
                    return false;
                });
        });
</script>
