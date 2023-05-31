import axios, { type AxiosInstance } from 'axios'

export const http: AxiosInstance = axios.create({
  baseURL: 'https://v6.exchangerate-api.com/v6/ab9ff72f6d2285d1c2133e09/latest',
})
