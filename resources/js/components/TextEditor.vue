<script setup>
import Editor from "@toast-ui/editor";
import "@toast-ui/editor/dist/toastui-editor.css";
import { onMounted } from "vue";

onMounted(() => {
    const editor = new Editor({
        el: document.querySelector("#editor"),
        height: "500px",
        initialEditType: "markdown",
        previewStyle: "vertical",
    });

    editor.getMarkdown();
});
</script>

<template>
    <div id="editor"></div>
</template>
