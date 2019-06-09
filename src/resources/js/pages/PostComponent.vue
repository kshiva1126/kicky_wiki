<template>
  <div class="container">
    <form class="article__form">
      <div class="article__title">
        <input type="text" name id>
      </div>
      <div class="article__body">
        <ckeditor :editor="editor" v-model="article.body" :config="editorConfig"></ckeditor>
      </div>
      <div class="article__button"></div>
    </form>
  </div>
</template>

<script>
import ClassicEditor from "@ckeditor/ckeditor5-editor-classic/src/classiceditor";

import Autoformat from "@ckeditor/ckeditor5-autoformat/src/autoformat";
import EssentialsPlugin from "@ckeditor/ckeditor5-essentials/src/essentials";
import BoldPlugin from "@ckeditor/ckeditor5-basic-styles/src/bold";
import ItalicPlugin from "@ckeditor/ckeditor5-basic-styles/src/italic";
import ParagraphPlugin from "@ckeditor/ckeditor5-paragraph/src/paragraph";
import LinkPlugin from "@ckeditor/ckeditor5-link/src/link";
import GFMDataProcessor from "@ckeditor/ckeditor5-markdown-gfm/src/gfmdataprocessor";

export default {
  data() {
    return {
      article: {
        title: "",
        body: ""
      },
      editor: ClassicEditor,
      editorConfig: {
        // The configuration of the editor.
        plugins: [
          Autoformat,
          EssentialsPlugin,
          BoldPlugin,
          ItalicPlugin,
          LinkPlugin,
          ParagraphPlugin,
          GFMDataProcessor
        ],
        toolbar: {
          items: ["bold", "italic", "link", "undo", "redo"]
        }
      }
    };
  }
};
</script>
