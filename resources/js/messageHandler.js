const showMessage = (title, body, icon, type) => {
    $(document).Toasts("create", {
        title,
        body,
        position: "bottomRight",
        autohide: true,
        icon,
        class: type,
        delay: 3000,
    });
};

exports.successMessage = (title, body = undefined) => {
    showMessage(title, body, "fas fa-check-circle", "bg-success");
};

exports.warningMessage = (title, body = undefined) => {
    showMessage(title, body, "fas fa-exclamation-triangle", "bg-warning");
};

exports.errorMessage = (title, body = undefined) => {
    showMessage(title, body, "fas fa-times-circle", "bg-danger");
};