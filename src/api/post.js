import api from './axios';

export const getPost = async () => {
  return await api.get('/v1/posts');
};

export const storePost = async (data) => {
  return await api.post('/v1/posts', data);
};