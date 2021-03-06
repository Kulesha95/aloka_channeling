// Remove Validation Errors From The Form
exports.removeValidationErrors = (
    formId,
    inputs = undefined,
    suffix = "_create"
) => {
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
        inputElement.next(".select2-container").removeClass("is-invalid");
        inputElement.next(".note-editor").removeClass("is-invalid");
        inputElement.siblings(".invalid-feedback").html("");
    });
};

// Add Validation Errors To The Form
exports.addValidationErrors = (formId, suffix = "_create", error) => {
    // Define Alert Message Body as Empty
    let errorMessage = "";
    // Get Validation Errors List
    const errors = error.data;
    // Display Validation Errors On The Form And Append The Message To Alert Message Body
    Object.keys(errors).forEach((input) => {
        const inputElement = $(`#${formId} #${input}${suffix}`);
        errors[input].forEach((inputError) => {
            inputElement.addClass("is-invalid");
            inputElement.next(".select2-container").addClass("is-invalid");
            inputElement.next(".note-editor").addClass("is-invalid");
            inputElement.siblings(".invalid-feedback").html(inputError);
            errorMessage += inputError + " ";
        });
    });
    // Show Validation Error Message
    messageHandler.warningMessage(error.message, errorMessage);
};

// Handle Save Form Submit
exports.resetForm = (formId, inputs = undefined, suffix = "_create") => {
    $(`#${formId}`).trigger("reset");
    this.removeValidationErrors(formId, inputs, suffix);
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
        this.removeValidationErrors(formId, inputs, suffix);
        // Get Data From The Form
        const formData = new FormData(e.target);
        // Handle Data Saving
        httpService
            .post($(`#${formId}`).attr("action"), formData)
            .then((response) => {
                // If Data Save Success Reset The Form
                this.resetForm(formId, inputs, suffix);
                // Close The Model Window
                if (modal) {
                    $(`#${modal}`).modal("hide");
                }
                // If Call Back Function Provided Trigger It
                if (callback) {
                    callback(response.data);
                }
                // Display Success Message
                messageHandler.successMessage(response.message);
            })
            .catch((error) => {
                // Handle Validation Error
                if (error.status == 422) {
                    this.addValidationErrors(formId, suffix, error.data);
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
    this.resetForm(formId, inputs, suffix);
    inputs.forEach((input) => {
        const inputElement = $(`#${formId} #${input}${suffix}`);
        // if Data Is An Image Preview It
        if (input === "image") {
            $(`#${formId} #image_preview`).attr("src", data[input]);
        } else {
            // Load Data To The Inputs
            if (inputElement.next(".note-editor").length > 0) {
                inputElement.summernote("code", data[input]);
            } else if (inputElement.attr("type") === "checkbox") {
                inputElement.attr("checked", data[input] == "1");
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
        this.removeValidationErrors(formId, inputs, suffix);
        // Get Data From The Form
        const formData = new FormData(e.target);
        // Handle Data Editing
        httpService
            .put($(`#${formId}`).attr("action"), formData)
            .then((response) => {
                // If Data Edit Success Reset The Form
                this.resetForm(formId, inputs, suffix);
                // Close The Model Window
                if (modal) {
                    $(`#${modal}`).modal("hide");
                }
                // If Call Back Function Provided Trigger It
                if (callback) {
                    callback(response.data);
                }
                // Display Success Message
                messageHandler.successMessage(response.message);
            })
            .catch((error) => {
                // Handle Validation Error
                if (error.status == 422) {
                    this.addValidationErrors(formId, suffix, error.data);
                }
            });
    });
};