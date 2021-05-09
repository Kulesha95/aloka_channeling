const { default: axios } = require("axios");

axios.defaults.headers.common["X-Requested-With"] = "XMLHttpRequest";

let apitoken = document.head.querySelector('meta[name="api-token"]');

if (apitoken) {
    axios.defaults.headers.common["Authorization"] =
        "Bearer " + apitoken.content;
}

exports.get = (url, body = null) => {
    return new Promise((resolve, reject) => {
        axios
            .get(url, { body })
            .then((response) => resolve(response.data))
            .catch((error) => {
                messageHandler.errorMessage(error.response.data.message);
            });
    });
};
exports.post = (url, body = null) => {
    return new Promise((resolve, reject) => {
        axios
            .post(url, body)
            .then((response) => resolve(response.data))
            .catch((error) => {
                if (error.response.status === 422) {
                    reject(error.response);
                } else {
                    messageHandler.errorMessage(error.response.data.message);
                }
            });
    });
};
exports.put = (url, body = null) => {
    return new Promise((resolve, reject) => {
        axios
            .post(url, body)
            .then((response) => resolve(response.data))
            .catch((error) => {
                if (error.response.status === 422) {
                    reject(error.response);
                } else {
                    messageHandler.errorMessage(error.response.data.message);
                }
            });
    });
};
exports.delete = (url, body = null) => {
    return new Promise((resolve, reject) => {
        axios
            .delete(url, { body })
            .then((response) => resolve(response.data))
            .catch((error) => {
                messageHandler.errorMessage(error.response.data.message);
            });
    });
};