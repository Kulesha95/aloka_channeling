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
            inputElement.next(".invalid-feedback").html("");
        });
        const formData = new FormData(e.target);
        httpService
            .post($(`#${formId}`).attr("action"), formData)
            .then((response) => {
                $(`#${formId}`).trigger("reset");
                if (inputs.includes("image")) {
                    $(`#${formId} #image_create`)
                        .next(".custom-file-label")
                        .html("Image");
                }
                if (modal) {
                    $(`#${modal}`).modal("hide");
                }
                if (callback) {
                    callback();
                }
                $(document).Toasts("create", {
                    title: response.message,
                    icon: "success",
                    position: "bottomRight",
                    autohide: true,
                    icon: "fas fa-check-circle",
                    class: "bg-success",
                    delay: 2000,
                });
            })
            .catch((error) => {
                if (error.status == 422) {
                    let errorMessage = "";
                    const errors = error.data.data;
                    const inputElement = $(`#${formId} #${input}_create`);
                    Object.keys(errors).forEach((input) => {
                        const inputElement = $(`#${formId} #${input}_create`);
                        errors[input].forEach((inputError) => {
                            inputElement
                                .parent()
                                .children(".invalid-feedback")
                                .html(inputError);
                                errorMessage += inputError + " ";
                        });
                    });
                    $(document).Toasts("create", {
                        title: error.data.message,
                        body: errorMessage,
                        position: "bottomRight",
                        autohide: true,
                        icon: "fas fa-times-circle",
                        class: "bg-danger",
                        delay: 2000,
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
        inputElement.next(".invalid-feedback").html("");
        if (input === "image") {
            $(`#${formId} #image_preview`).attr("src", data[input]);
        } else {
            inputElement.val(data[input]);
        }
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
            inputElement.next(".invalid-feedback").html("");
        });
        const formData = new FormData(e.target);
        httpService
            .put($(`#${formId}`).attr("action"), formData)
            .then((response) => {
                $(`#${formId}`).trigger("reset");
                if (inputs.includes("image")) {
                    $(`#${formId} #image_edit`)
                        .next(".custom-file-label")
                        .html("Image");
                }
                if (modal) {
                    $(`#${modal}`).modal("hide");
                }
                if (callback) {
                    callback();
                }
                $(document).Toasts("create", {
                    title: response.message,
                    position: "bottomRight",
                    autohide: true,
                    icon: "fas fa-check-circle",
                    class: "bg-success",
                    delay: 2000,
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
                                .next(".invalid-feedback")
                                .html(inputError);
                                errorMessage += inputError + " ";v
                        });
                    });
                    $(document).Toasts("create", {
                        title: error.data.message,
                        text: errorMessage,
                        body: errorMessage,
                        position: "bottomRight",
                        autohide: true,
                        icon: "fas fa-times-circle",
                        class: "bg-danger",
                        delay: 2000,
                    });
                }
            });
    });
};