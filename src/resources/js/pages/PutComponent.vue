<template>
  <div class="container">
    <div class="article__form">
      <input type="text" class="article__title" v-model="article.title">
      <editor v-model="article.body" :height="height"/>
    </div>

    <div class="article__button" @click="submit()">編集する</div>
  </div>
</template>

<script>
import "tui-editor/dist/tui-editor.css";
import "tui-editor/dist/tui-editor-contents.css";
import "codemirror/lib/codemirror.css";
import { Editor } from "@toast-ui/vue-editor";

export default {
  components: {
    editor: Editor
  },
  data() {
    return {
      article: {
        title: "",
        body: ""
      },
      height: "900px"
    };
  },
  created() {
    const response = axios
      .get(`/api/articles/edit/${this.$route.params.id}`)
      .then(res => {
        this.article = res.data;
    });
  },
  methods: {
    async submit() {
      const params = new URLSearchParams();

      params.append("title", this.article.title);
      params.append("body", this.article.body);

      await axios.put(`/api/articles/${this.$route.params.id}`, params)
        .then(response => {
          this.$router.push(`/detail/${response.data.Id}`);
        })
        .catch(err => {
          alert('編集に失敗しました。', err);
        })
    }
  }
};
</script>
