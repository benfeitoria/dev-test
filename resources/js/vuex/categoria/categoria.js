const URL_BASE = "api/v1/categoria";


const categoria = {
    state: {
        categorias: {
            data: []
        }
    },
    mutations: {
        LOAD_CATEGORIAS(state, categorias) {
            state.categorias = categorias;
        }
    },
    actions: {
        loadCategorias(context){

            return new Promise((resolve, reject) => {
            axios.get(URL_BASE)
                .then((response) => {              
                    
                    context.commit('LOAD_CATEGORIAS', response)

                }).catch((erro) => {
                    reject(erro)
                })
                .finally(() =>  {});
            });
        },
    },
    getters: {

    }
}

export default categoria