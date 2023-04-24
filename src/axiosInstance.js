import axios from 'axios';

const axiosInstance = axios.create({
    baseURL: 'http://localhost/product-app/server/api',
    headers: {
        "Access-Control-Allow-Headers": "*",
        "Access-Control-Allow-Origin": "*",
        "Access-Control-Allow-Methods": "*" 
    }
});

export default axiosInstance;
