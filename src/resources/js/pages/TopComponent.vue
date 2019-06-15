<template>
  <div class="container">
    <div class="form"></div>

    <div class="grid">
      <div v-for="(article, index) in articles" class="grid__item grid__item--4" :key="index">
        <router-link :to="detailLink(article.id)">
          <div class="article__card" :class="{ 'border--left': index % 3 !== 0}">
            <div class="article__title">{{ article.title }}</div>
            <div>{{ article.body }}</div>
          </div>
        </router-link>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      articles: []
    };
  },
  created() {
    const response = axios.get(`/api/articles`).then(res => {
      this.articles.push(...res.data);

      console.log(this.articles);
    });
  },
  methods: {
    detailLink(id) {
      return `/detail/${id}`;
    }
  }
};
</script>

<style lang="scss" scoped>
.article__card {
  border-bottom: 1px solid #c0c0c0;
  // border: 1px solid;
  // border-radius: 15px;
  padding: 1.5rem;
  // margin: 0 5px;
  min-height: 250px;
}

.article__title {
  font-size: 2rem;
  margin-bottom: 1rem;
}

.border--left {
  border-left: 1px solid #c0c0c0;
}
</style>
