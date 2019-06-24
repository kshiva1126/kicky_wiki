<template>
  <div class="container">
    <div class="article__form">
      <input type="text" class="article__title" v-model="article.title">
      <editor v-model="article.body" :height="height" :options="editorOptions"/>
    </div>

    <div class="article__button" @click="submit()">投稿する</div>
  </div>
</template>

<script>
import "tui-editor/dist/tui-editor.css";
import "tui-editor/dist/tui-editor-contents.css";
import "codemirror/lib/codemirror.css";
import { Editor } from "@toast-ui/vue-editor";
import util from '../utils/util'

export default {
  mixins: [util],
  components: {
    editor: Editor
  },
  data() {
    return {
      article: {
        title: "",
        body: "",
        images: [],
      },
      height: "900px",
      editorOptions: {
        hooks: {
          addImageBlobHook: this.addImageBlobHook,
        }
      }
    };
  },
  methods: {
    async submit() {
      const formData = new FormData();

      formData.append("title", this.article.title);
      formData.append("body", this.article.body);
      formData.append("images", this.article.images);

      await axios.post("/api/articles", formData)
        .then(response => {
          this.$router.push(`/detail/${response.data.Id}`);
        })
        .catch(err => {
          alert('投稿に失敗しました。', err);
        })
    }
  }
};
</script>
