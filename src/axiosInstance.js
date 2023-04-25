import axios from 'axios';

const axiosInstance = axios.create({
    baseURL: 'http://localhost/product-app/server/api',
    headers: {
        "Content-Type": "text/plain",
        "Content-Type": "application/json"
    }
});

export default axiosInstance;
