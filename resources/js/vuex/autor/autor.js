const URL_BASE = "api/v1/autor";


const autor = {
    state: {
        autores: {
            data: []
        }
    },
    mutations: {
        LOAD_AUTORES(state, autores) {
            state.autores = autores;
        }
    },
    actions: {
        loadAutores(context){

            return new Promise((resolve, reject) => {
            axios.get(URL_BASE)
                .then((response) => {              
                    
                    context.commit('LOAD_AUTORES', response)

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

export default autor