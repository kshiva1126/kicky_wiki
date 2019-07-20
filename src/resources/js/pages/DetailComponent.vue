<template>
  <div class="container">
    <div class="article">
      <h1 class="article__title border-bottom">{{ article.title }}</h1>
      <div class="article__body" v-html="article.body"></div>
      <div class="toEdit">
        <router-link :to="editLink()">
          <div>編集する</div>
        </router-link>
      </div>
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
<style lang="scss" scoped>
  .article__body {
    margin-top: 5%;
    margin-bottom: 5%;
  }
  .toEdit {
    position: fixed;
    right: 0;
    bottom:0;
    height: 3rem;
    line-height: 3rem;
    color: white;
    text-align: center;
    width: 100px;
    cursor: pointer;
    transition: all .3s ease;
    background: black;
  }
</style>