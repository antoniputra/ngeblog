<script setup>
import Editor from "@toast-ui/editor";
import { onMounted } from "vue";

const props = defineProps({
    initialValue: String,
});
const emits = defineEmits(["onChange"]);

onMounted(() => {
    const editor = new Editor({
        el: document.querySelector("#editor"),
        height: "500px",
        initialEditType: "markdown",
        initialValue: props.initialValue,
        previewStyle: "tab",
        // previewStyle: "vertical",
    });

    editor.on("change", function (mode) {
        emits("onChange", editor.getMarkdown());
    });
});
</script>

<template>
    <div id="editor"></div>
</template>

<style>
@import "@toast-ui/editor/dist/toastui-editor.css";
</style>
