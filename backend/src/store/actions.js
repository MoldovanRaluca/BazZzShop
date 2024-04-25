import axiosClient from "../axios";

export function getCurrentUser({commit}, data) {
    return axiosClient.get('/user', data)
        .then(response => {
            if (!response) {
                throw new Error('Empty response received from server');
            }
            commit('setUser', response.data);
            return response.data;
        })
        .catch(error => {
            console.error('Error fetching current user:', error);
            throw error; // Optionally re-throw the error to propagate it further
        });
}


export function login({commit},data){
    return axiosClient.post('/login',data)
        .then(({data}) => {
            commit('setUser', data.user);//din AuthController luam datele
            commit('setToken', data.token)
            return data;
        })
}
export function logout({commit}) {
    return axiosClient.post('/logout')
        .then((response) => {
            commit('setToken', null)

            return response;
        })
}

export function getProducts({commit},{url=null,search ='',perPage = 10, sort_field, sort_direction}= {}){
    commit('setProducts', [true])
    url = url ||'/product';
    return axiosClient.get(url, {
        params: {
            search,
            per_page: perPage,
            sort_field,
            sort_direction,
        }
    })
        .then(res=> {
         commit('setProducts',[false, response.data])
    })
    .catch(()=>{
        commit('setProducts',[false])
    })
}
