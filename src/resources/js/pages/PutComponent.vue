<template>
  <div class="container">
    <div class="article__form">
      <b-input-group prepend="title" class="mt-3">
        <b-form-input class="article__title" v-model="article.title"></b-form-input>
      </b-input-group><br>
      <editor v-model="article.body" :height="height" :options="editorOptions"/>
    </div>

    <div class="edit">
      <div class="article__button" @click="submit()">
        編集する
        <font-awesome-icon icon="paper-plane" />
      </div>
    </div>
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
        body: "",
        images: [],
      },
      height: "900px",
      editorOptions: {
        hooks: {
          addImageBlobHook: async (blob, callback) => {
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
          },
        }
      }
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

<style lang="scss" scoped>
  .container {
    margin-bottom: 5%
  }
  .edit {
    position: fixed;
    right: 0;
    bottom: 0;
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
