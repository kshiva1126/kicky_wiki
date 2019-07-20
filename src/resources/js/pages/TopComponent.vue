<template>
  <div class="container">
    <div class="form"></div>
    <div>
      <input type="text" class="freeword" v-model="freeword" placeholder="freeword">
      <button class="search" @click="search()">検索する</button>
    </div>
    <div>
      <div v-for="(article, index) in articles" :key="index">
        <button class="btn btn-primary" @click="deleteArticle(article.id)">X</button>
        <router-link :to="detailLink(article.id)">
          <b-card v-bind:title="article.title">
            <b-card-text>
              {{ article.body }}
            </b-card-text>
          </b-card>
        </router-link>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      freeword: "",
      articles: []
    };
  },
  created() {
    this.get();
  },
  methods: {
    detailLink(id) {
      return `/detail/${id}`;
    },
    async get() {
      await axios.get(`/api/articles`).then(res => {
        this.articles.push(...res.data);
      });
    },
    async search() {
      if (this.freeword) {
        await axios.get(`/api/articles/search/${this.freeword}`)
          .then(res => {
            this.articles = [];
            this.articles.push(...res.data);
          })
          .catch(err => {
            alert('検索に失敗しました', err);
          })
      } else {
        this.articles = [];
        await this.get();
      }
    },
    async deleteArticle(id) {
      const result = confirm("こちらの記事を削除しますか?");
      if (result) {
        await axios.delete(`/api/articles/${id}`)
          .then(res => {
            this.articles = [];
            this.get();
          })
          .catch(err => {
            alert('記事削除に失敗しました', err)
          })
      }
    }
  }
};
</script>

<style lang="scss" scoped>
.freeword {
  position: relative;
  display: block;
  width: 300px;
}

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
