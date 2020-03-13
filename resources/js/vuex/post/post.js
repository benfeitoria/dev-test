const URL_BASE = "api/v1/post";


const post = {
    state: {
        posts: {
            data: {}
        }
    },
    mutations: {
        LOAD_POSTS(state, posts) {
            state.posts = posts;
        }
    },
    actions: {
        loadPosts(context , params){

            return new Promise((resolve, reject) => {
                if(params){
                    axios.get(URL_BASE + `?categorias_id=${params.categorias_id}&autor_id=${params.autor_id}&page=${params.page}`)
                        .then((response) => {
                            
                            context.commit('LOAD_POSTS', response)

                        }).catch((erro) => {
                            reject(erro)
                        })
                        .finally(() =>  {});
                
                }else{
                    axios.get(URL_BASE)
                    .then((response) => {              
                        
                        context.commit('LOAD_POSTS', response)

                    }).catch((erro) => {
                        reject(erro)
                    })
                    .finally(() =>  {});
                }
            });
        },
        carregarPost(context, id_post){
            
            return new Promise((resolve, reject) => {
                axios.get(URL_BASE + `/showPost/${id_post}`)
                    .then((response) => resolve(response.data))
                    .catch((error) => reject(error))
                    .finally(() => {});
            });
        },
    },
    getters: {

    }
}

export default post