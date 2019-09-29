
  module.exports = {
    devServer: {
      proxy: {
        "/route": {
          target: "https://protected-dawn-10317.herokuapp.com/",
        //  target: "http://localhost/blogApi/public/",
        }
      }
    }
  }