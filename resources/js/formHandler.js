// Handle Save Form Submit
exports.handleReset = (formId, inputs = undefined, suffix = "_create") => {
    $(`#${formId}`).trigger("reset");
    // If File Input Exists Clear The Selected File Name And Add Default Place Holder
    if (inputs.includes("image")) {
        $(`#${formId} #image${suffix}`)
            .next(".custom-file-label")
            .html("Image");
    }

    // Clear Validation Errors
    inputs.forEach((input) => {
        const inputElement = $(`#${formId} #${input}${suffix}`);
        inputElement.removeClass("is-invalid");
        inputElement.next(".invalid-feedback").html("");
        if (inputElement.next(".note-editor").length > 0) {
            inputElement.summernote("code", "");
        }
    });
};

// Handle Save Form Submit
exports.handleSave = (
    formId,
    inputs = undefined,
    callback = undefined,
    modal = undefined,
    suffix = "_create"
) => {
    // Attach Submit Listener To The Form
    $(`#${formId}`).on("submit", (e) => {
        // Avoid Form Submit Over HTTP Request
        e.preventDefault();
        // Remove Any Validation Errors If Exist
        inputs.forEach((input) => {
            const inputElement = $(`#${formId} #${input}${suffix}`);
            inputElement.removeClass("is-invalid");
            inputElement.next(".invalid-feedback").html("");
        });
        // Get Data From The Form
        const formData = new FormData(e.target);
        // Handle Data Saving
        httpService
            .post($(`#${formId}`).attr("action"), formData)
            .then((response) => {
                // If Data Save Success Reset The Form
                this.handleReset(formId, inputs, suffix);
                // Close The Model Window
                if (modal) {
                    $(`#${modal}`).modal("hide");
                }
                // If Call Back Function Provided Trigger It
                if (callback) {
                    callback();
                }
                // Display Success Message
                messageHandler.successMessage(response.message);
            })
            .catch((error) => {
                // Handle Validation Error
                if (error.status == 422) {
                    // Define Alert Message Body as Empty
                    let errorMessage = "";
                    // Get Validation Errors List
                    const errors = error.data.data;
                    // Display Validation Errors On The Form And Append The Message To Alert Message Body
                    Object.keys(errors).forEach((input) => {
                        const inputElement = $(`#${formId} #${input}${suffix}`);
                        errors[input].forEach((inputError) => {
                            inputElement.addClass("is-invalid");
                            inputElement
                                .next(".invalid-feedback")
                                .html(inputError);
                            errorMessage += inputError + " ";
                        });
                    });
                    // Show Validation Error Message
                    messageHandler.warningMessage(
                        error.data.message,
                        errorMessage
                    );
                }
            });
    });
};

// Handle Data Filling To The Edit Form
exports.handleShow = (
    formId,
    inputs = undefined,
    modal = undefined,
    data,
    parameterIndexes,
    suffix = "_edit",
    callback = undefined
) => {
    // Clear Form
    this.handleReset(formId, inputs, suffix);
    inputs.forEach((input) => {
        const inputElement = $(`#${formId} #${input}${suffix}`);
        // if Data Is An Image Preview It
        if (input === "image") {
            $(`#${formId} #image_preview`).attr("src", data[input]);
        } else {
            // Load Data To The Inputs
            if (inputElement.next(".note-editor").length > 0) {
                inputElement.summernote("code", data[input]);
            } else {
                inputElement.val(data[input]);
                inputElement.trigger("change");
            }
        }
    });
    // Prepare Data Edit API Call URL Using Provided Parameter Indexes
    $updateUrl = $(`#${formId}`).data("action");
    Object.keys(parameterIndexes).forEach((urlParameter) => {
        $updateUrl = $updateUrl.replace(`:${urlParameter}`, data[urlParameter]);
    });
    // Set Form Action URL
    $(`#${formId}`).attr("action", $updateUrl);
    // Display Edit Modal
    if (modal) {
        $(`#${modal}`).modal("show");
    }
    if (callback) {
        callback(data);
    }
};

// Handle Data Edit Form Submit
exports.handleEdit = (
    formId,
    inputs = undefined,
    callback = undefined,
    modal = undefined,
    suffix = "_edit"
) => {
    // Attach Submit Listener To The Form
    $(`#${formId}`).on("submit", (e) => {
        // Avoid Form Submit Over HTTP Request
        e.preventDefault();
        // Remove Any Validation Errors If Exist
        inputs.forEach((input) => {
            const inputElement = $(`#${formId} #${input}${suffix}`);
            inputElement.removeClass("is-invalid");
            inputElement.next(".invalid-feedback").html("");
        });
        // Get Data From The Form
        const formData = new FormData(e.target);
        // Handle Data Editing
        httpService
            .put($(`#${formId}`).attr("action"), formData)
            .then((response) => {
                // If Data Edit Success Reset The Form
                this.handleReset(formId, inputs, suffix);
                // Close The Model Window
                if (modal) {
                    $(`#${modal}`).modal("hide");
                }
                // If Call Back Function Provided Trigger It
                if (callback) {
                    callback();
                }
                // Display Success Message
                messageHandler.successMessage(response.message);
            })
            .catch((error) => {
                // Handle Validation Error
                if (error.status == 422) {
                    // Define Alert Message Body as Empty
                    let errorMessage = "";
                    // Get Validation Errors List
                    const errors = error.data.data;
                    // Display Validation Errors On The Form And Append The Message To Alert Message Body
                    Object.keys(errors).forEach((input) => {
                        errors[input].forEach((inputError) => {
                            const inputElement = $(
                                `#${formId} #${input}${suffix}`
                            );
                            inputElement.addClass("is-invalid");
                            inputElement
                                .next(".invalid-feedback")
                                .html(inputError);
                            errorMessage += inputError + " ";
                        });
                    });
                    // Show Validation Error Message
                    messageHandler.warningMessage(
                        error.data.message,
                        errorMessage
                    );
                }
            });
    });
};