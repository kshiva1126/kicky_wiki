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
      height: "900px",
      editorOptions: {
        hooks: {
          addImageBlobHook: async function(blob, callback) {
            const formData = new FormData();
            formData.append('image', blob);
            const config = {
              header: {
                'Content-Type': 'multipart/form-data'
              }
            };

            try {
              const response = await axios.post('api/articles/image-upload', formData, config);
              callback(response.data.fileName, '');
            } catch(err) {
              alert('画像アップロードに失敗しました', err);
            }
          },
        }
      }
    };
  },
  methods: {
    async submit() {
      const formData = new FormData();

      formData.append("title", this.article.title);
      formData.append("body", this.article.body);

      console.log(formData);

      const response = await axios.post("/api/articles", formData);

      this.$router.push("/");
    }
  }
};
</script>
