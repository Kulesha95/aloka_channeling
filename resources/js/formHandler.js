exports.handleSave = (
    formId,
    inputs = undefined,
    callback = undefined,
    modal = undefined
) => {
    $(`#${formId}`).on("submit", (e) => {
        e.preventDefault();
        inputs.forEach((input) => {
            const inputElement = $(`#${formId} #${input}_create`);
            inputElement.removeClass("is-invalid");
            inputElement.parent().children(".invalid-feedback").html("");
        });
        const formData = new FormData(e.target);
        httpService
            .post($(`#${formId}`).attr("action"), formData)
            .then((response) => {
                $(`#${formId}`).trigger("reset");
                if (modal) {
                    $(`#${modal}`).modal("hide");
                }
                if (callback) {
                    callback();
                }
                sweetAlert.fire({
                    title: response.message,
                    icon: "success",
                });
            })
            .catch((error) => {
                if (error.status == 422) {
                    let errorMessage = "";
                    const errors = error.data.data;
                    Object.keys(errors).forEach((input) => {
                        errors[input].forEach((inputError) => {
                            const inputElement = $(
                                `#${formId} #${input}_create`
                            );
                            inputElement.addClass("is-invalid");
                            inputElement
                                .parent()
                                .children(".invalid-feedback")
                                .html(inputError);
                            errorMessage = inputError + " ";
                        });
                    });
                    sweetAlert.fire({
                        title: error.data.message,
                        text: errorMessage,
                        icon: "error",
                    });
                }
            });
    });
};

exports.handleShow = (
    formId,
    inputs = undefined,
    modal = undefined,
    data,
    parameterIndexes
) => {
    inputs.forEach((input) => {
        const inputElement = $(`#${formId} #${input}_edit`);
        inputElement.removeClass("is-invalid");
        inputElement.parent().children(".invalid-feedback").html("");
        inputElement.val(data[input]);
    });
    $updateUrl = $(`#${formId}`).data("action");
    Object.keys(parameterIndexes).forEach((urlParameter) => {
        
        $updateUrl = $updateUrl.replace(`:${urlParameter}`, data[urlParameter]);
    });
    $(`#${formId}`).attr("action", $updateUrl);
    if (modal) {
        $(`#${modal}`).modal("show");
    }
};

exports.handleEdit = (
    formId,
    inputs = undefined,
    callback = undefined,
    modal = undefined
) => {
    $(`#${formId}`).on("submit", (e) => {
        e.preventDefault();
        inputs.forEach((input) => {
            const inputElement = $(`#${formId} #${input}_edit`);
            inputElement.removeClass("is-invalid");
            inputElement.parent().children(".invalid-feedback").html("");
        });
        const formData = new FormData(e.target);
        httpService
            .put($(`#${formId}`).attr("action"), formData)
            .then((response) => {
                $(`#${formId}`).trigger("reset");
                if (modal) {
                    $(`#${modal}`).modal("hide");
                }
                if (callback) {
                    callback();
                }
                sweetAlert.fire({
                    title: response.message,
                    icon: "success",
                });
            })
            .catch((error) => {
               
                if (error.status == 422) {
                    let errorMessage = "";
                    const errors = error.data.data;
                    Object.keys(errors).forEach((input) => {
                        errors[input].forEach((inputError) => {
                            const inputElement = $(`#${formId} #${input}_edit`);
                            inputElement.addClass("is-invalid");
                            inputElement
                                .parent()
                                .children(".invalid-feedback")
                                .html(inputError);
                            errorMessage = inputError + " ";
                        });
                    });
                    sweetAlert.fire({
                        title: error.data.message,
                        text: errorMessage,
                        icon: "error",
                    });
                }
            });
    });
};