import axios from "axios";

const api = axios.create({
    baseURL: "http://127.0.0.1:8000/api",
    headers: {
        "Content-Type": "application/json",
        Accept: "application/json",
    },
    timeout: 10000,
});

api.interceptors.response.use(
    (response) => response,
    (error) => {
        if (error.response) {
            switch (error.response.status) {
                case 400:
                    console.error("Bad Request (400)");
                    break;

                case 404:
                    console.error("Data tidak ditemukan (404)");
                    break;

                case 422:
                    console.error("Validasi gagal (422)");
                    console.error(error.response.data.errors);
                    break;

                case 500:
                    console.error("Internal Server Error (500)");
                    break;

                default:
                    console.error(error.response.data);
            }
        } else {
            console.error("Tidak dapat terhubung ke server.");
        }

        return Promise.reject(error);
    }
);

export default api;