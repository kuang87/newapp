import axios from 'axios'

const instance = axios.create({
    baseURL: '/',
    withCredentials: true,
    timeout: 10000
});

export default instance;
