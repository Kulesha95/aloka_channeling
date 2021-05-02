const { default: axios } = require("axios");

exports.get = (url, body = null) => {
    return new Promise((resolve, reject) => {
        axios
            .get(url, { body })
            .then((response) => resolve(response.data))
            .catch((error) => reject(error.response));
    });
};
exports.post = (url, body = null) => {
    return new Promise((resolve, reject) => {
        axios
            .post(url, body)
            .then((response) => resolve(response.data))
            .catch((error) => reject(error.response));
    });
};
exports.put = (url, body = null) => {
    return new Promise((resolve, reject) => {
        axios
            .post(url, body)
            .then((response) => resolve(response.data))
            .catch((error) => reject(error.response));
    });
};
exports.delete = (url, body = null) => {
    return new Promise((resolve, reject) => {
        axios
            .delete(url, { body })
            .then((response) => resolve(response.data))
            .catch((error) => reject(error.response));
    });
};