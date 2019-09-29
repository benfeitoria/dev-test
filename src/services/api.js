import axios from "axios";

const api = axios.create(
    {
       baseURL:"https://protected-dawn-10317.herokuapp.com/"
      //   baseURL:"http://localhost/blogApi/public/"
    }
)


export default api;