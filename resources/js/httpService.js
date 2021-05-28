const { default: axios } = require("axios");

// Setup Headers And Authentication Parameters
axios.defaults.headers.common["X-Requested-With"] = "XMLHttpRequest";
let apitoken = document.head.querySelector('meta[name="api-token"]');
if (apitoken) {
    axios.defaults.headers.common["Authorization"] =
        "Bearer " + apitoken.content;
}

// Handle Get Request
exports.get = (url) => {
    return new Promise((resolve, reject) => {
        axios
            .get(url)
            .then((response) => resolve(response.data))
            .catch((error) => {
                // Display Error Message If Request Failed
                messageHandler.errorMessage(error.response.data.message);
                reject(error);
            });
    });
};

// Handle Post Request
exports.post = (url, body = null) => {
    return new Promise((resolve, reject) => {
        axios
            .post(url, body)
            .then((response) => resolve(response.data))
            .catch((error) => {
                if (error.response.status === 422) {
                    // Handle Validation Errors
                    reject(error.response);
                } else {
                    // Display Error Message If Request Failed
                    messageHandler.errorMessage(error.response.data.message);
                    reject(error);
                }
            });
    });
};

// Handle Put Request
exports.put = (url, body = null) => {
    return new Promise((resolve, reject) => {
        axios
            .post(url, body)
            .then((response) => resolve(response.data))
            .catch((error) => {
                if (error.response.status === 422) {
                    // Handle Validation Errors
                    reject(error.response);
                } else {
                    // Display Error Message If Request Failed
                    messageHandler.errorMessage(error.response.data.message);
                    reject(error);
                }
            });
    });
};

// Handle Delete Request
exports.delete = (url) => {
    return new Promise((resolve, reject) => {
        axios
            .delete(url)
            .then((response) => resolve(response.data))
            .catch((error) => {
                // Display Error Message If Request Failed
                messageHandler.errorMessage(error.response.data.message);
                reject(error);
            });
    });
};

// Base Url Of The API
exports.baseUrl = "/api/v1";