export default {
  methods: {
    async addImageBlobHook(blob, callback) {
      const formData = new FormData();
      formData.append('image', blob);
      const config = {
        header: {
          'Content-Type': 'multipart/form-data'
        }
      };

      await axios.post('/api/articles/image-upload', formData, config)
        .then(response => {
          callback(response.data.fileName, '');
          this.article.images.push(response.data.fileName);
        })
        .catch(err => {
          alert(err);
        });
    }
  }
}