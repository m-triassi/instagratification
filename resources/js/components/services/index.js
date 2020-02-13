import axios from 'axios'

// Internal API post requests
export async function postPicture(payload) {
    return axios.post('post/create', payload)
}

export async function likePhoto(payload) {
    return axios.post('post/like', payload)
}

export async function commentPhoto(payload) {
    return axios.post('comment/create', payload)
}

