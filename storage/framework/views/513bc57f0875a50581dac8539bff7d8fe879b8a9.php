<script>
    function set_card_checklists(card_checklists) {
        $("#added_card_checklists").empty();
        for (card_checklist of card_checklists) {
            item =  `<li class="list-group-item d-flex justify-content-between align-items-center">
                        <div class="col-5">${card_checklist.title}</div>
                        <span>
                            <button class="btn btn-primary btn-sm card_checklist_edit_button" data-checklist-id="${card_checklist.id}" title="Edit"><i class="fas fa-pencil-alt" aria-hidden="true"></i></button>
                            <button class="btn btn-danger btn-sm card_checklist_remove_button" data-checklist-id="${card_checklist.id}" title="Remove"><i class="fas fa-trash-alt" aria-hidden="true"></i></button>
                        </span>
                    </li>`;
            $("#added_card_checklists").append(item);
        }
    }

    $("#added_card_checklists").on("click", "button.card_checklist_edit_button", function () {
        element = $(this);
        element.parents('li').remove();
        axios
            .get("<?php echo e(route('cards.get_checklist_details')); ?>", {
                params: {
                    checklist_id: element.data('checklist-id')
                }
            })
            .then(function (response) {
                if (response.data.length <= 0) {
                    return false;
                }
                checklist = response.data.data
                $("#checklist_id").val(checklist.id);
                $("#checklist_title").val(checklist.title);
            })
            .catch(function (error) {
                if (error.response) {
                    let status = error.response.status;
                    let message = error.response.data.message;
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
            });
    });

    $("#added_card_checklists").on("click", "button.card_checklist_remove_button", function () {
        element = $(this);
        checklist_id = element.data('checklist-id');

        bootbox.confirm({
            title: "Remove checklist?",
            message: `Are you sure you want to remove checklist <strong>${checklist_id}</strong>? This action cannot be reversed.`,
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
                if (confirmed) {
                    let form_data = new FormData();

                    form_data.append("csrfmiddlewaretoken", '<?php echo e(csrf_field()); ?>');
                    form_data.append("checklist_id", checklist_id);

                    axios.post("<?php echo e(route('cards.remove_card_checklist')); ?>", form_data, {})
                        .then(function (response) {
                            if (response.data.length <= 0) {
                                console.log("empty");
                                return false;
                            }
                            data = response.data.data
                            card_checklists = data.card_checklists
                            message = data.message

                            toastr.options = {
                                "closeButton" : true,
                                "progressBar" : true
                            }
                            toastr.success(message);
                        })
                        .then(function () {
                            set_card_checklists(card_checklists);
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

    $("#card_checklist_form").on("submit", function(event) {
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
                card_checklists = data.card_checklists;
                message = data.message;
                toastr.options = {
                    "closeButton" : true,
                    "progressBar" : true
                }
                toastr.success(message);
                $("#id_checklist_title_text").text('')
            })
            .then(function () {
                set_card_checklists(card_checklists);
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
                }
                if (error instanceof ReferenceError) {
                    toastr.options = {
                        "closeButton" : true,
                        "progressBar" : true
                    }
                    toastr.error(error.message);
                    return false;
                }
            });
    });
</script>
<?php /**PATH C:\xampp\htdocs\softolab\resources\views/layouts/pages/common/js/card_checklist_setter_js.blade.php ENDPATH**/ ?>