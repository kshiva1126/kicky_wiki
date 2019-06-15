<template>
  <div class="container">
    <div class="article">
      <div class="article__title">{{ article.title }}</div>
      <div class="article__body">{{ article.body }}</div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      article: ""
    };
  },
  created() {
    const response = axios
      .get(`/api/articles/${this.$route.params.id}`)
      .then(res => {
        this.article = res.data;
      });
  }
};
</script>
