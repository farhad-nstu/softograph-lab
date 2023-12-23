<script>
    function set_card_tasks(card_tasks) {
        $("#added_card_tasks").empty();
        for (card_task of card_tasks) {
            item =  `<li class="list-group-item d-flex justify-content-between align-items-center">
                        <div class="col-5">${card_task.title}</div>
                        <span>
                            <button class="btn btn-primary btn-sm card_task_edit_button" data-task-id="${card_task.id}" title="Edit"><i class="fas fa-pencil-alt" aria-hidden="true"></i></button>
                            <button class="btn btn-danger btn-sm card_task_remove_button" data-task-id="${card_task.id}" title="Remove"><i class="fas fa-trash-alt" aria-hidden="true"></i></button>
                        </span>
                    </li>`;
            $("#added_card_tasks").append(item);
        }
    }

    $("#added_card_tasks").on("click", "button.card_task_edit_button", function () {
        element = $(this);
        element.parents('li').remove();
        axios
            .get("{{ route('cards.get_task_details') }}", {
                params: {
                    task_id: element.data('task-id')
                }
            })
            .then(function (response) {
                if (response.data.length <= 0) {
                    return false;
                }
                task = response.data.data
                $("#task_id").val(task.id);
                $("#task_title").val(task.title);
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

    $("#added_card_tasks").on("click", "button.card_task_remove_button", function () {
        element = $(this);
        task_id = element.data('task-id');

        bootbox.confirm({
            title: "Remove task?",
            message: `Are you sure you want to remove task <strong>${task_id}</strong>? This action cannot be reversed.`,
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

                    form_data.append("csrfmiddlewaretoken", '{{ csrf_field() }}');
                    form_data.append("task_id", task_id);

                    axios.post("{{ route('cards.remove_card_task') }}", form_data, {})
                        .then(function (response) {
                            if (response.data.length <= 0) {
                                console.log("empty");
                                return false;
                            }
                            data = response.data.data
                            card_tasks = data.card_tasks
                            message = data.message

                            toastr.options = {
                                "closeButton" : true,
                                "progressBar" : true
                            }
                            toastr.success(message);
                        })
                        .then(function () {
                            set_card_tasks(card_tasks);
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

    $("#card_task_form").on("submit", function(event) {
        event.preventDefault();
        form = this;
        jquery_form = $(this);
        alert_container = jquery_form.children('.ajax-form-alert-container');

        form_data = new FormData(form);
        form_data.append("card_no", $("#card_id").val());

        axios.post(form.action, form_data, {})
            .then(function (response) {
                clear_form(jquery_form);
                data = response.data.data
                card_tasks = data.card_tasks;
                message = data.message;
                toastr.options = {
                    "closeButton" : true,
                    "progressBar" : true
                }
                toastr.success(message);
                $("#id_task_title_text").text('')
            })
            .then(function () {
                set_card_tasks(card_tasks);
            })
            .catch(function (error) {
                if (error.response) {

                    let status = error.response.status;

                    if (status == 401) {
                        window.location.href = "{{  route('login')  }}";
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
