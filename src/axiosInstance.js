import axios from 'axios';

const axiosInstance = axios.create({
    baseURL: 'https://product-app-katiaku.vercel.app',
    headers: {
        "Content-Type": "text/plain",
        "Content-Type": "application/json"
    }
});

export default axiosInstance;
