<template>
  <div class="container">
    <div class="article">
      <div class="article__title">{{ article.title }}</div>
      <div class="article__body" v-html="article.body"></div>
      <router-link :to="editLink()">
        <div>編集する</div>
      </router-link>
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
  },
  methods: {
    editLink() {
      return `/put/${this.$route.params.id}`;
    }
  }
};
</script>
