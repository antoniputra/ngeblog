<template>
    <div class="flex flex-col border pb-8">
        <div
            v-if="editorElement"
            class="sticky top-0 z-10 mb-8 flex flex-wrap gap-1 border-b bg-white p-2"
        >
            <button
                type="button"
                class="border px-2 py-1"
                @click="editorElement.chain().focus().toggleBold().run()"
                :disabled="
                    !editorElement.can().chain().focus().toggleBold().run()
                "
                :class="{ 'is-active': editorElement.isActive('bold') }"
            >
                bold
            </button>
            <button
                type="button"
                class="border px-2 py-1"
                @click="editorElement.chain().focus().toggleItalic().run()"
                :disabled="
                    !editorElement.can().chain().focus().toggleItalic().run()
                "
                :class="{ 'is-active': editorElement.isActive('italic') }"
            >
                italic
            </button>
            <button
                type="button"
                class="border px-2 py-1"
                @click="editorElement.chain().focus().toggleStrike().run()"
                :disabled="
                    !editorElement.can().chain().focus().toggleStrike().run()
                "
                :class="{ 'is-active': editorElement.isActive('strike') }"
            >
                strike
            </button>
            <button
                type="button"
                class="border px-2 py-1"
                @click="editorElement.chain().focus().toggleCode().run()"
                :disabled="
                    !editorElement.can().chain().focus().toggleCode().run()
                "
                :class="{ 'is-active': editorElement.isActive('code') }"
            >
                code
            </button>
            <button
                type="button"
                class="border px-2 py-1"
                @click="editorElement.chain().focus().setParagraph().run()"
                :class="{ 'is-active': editorElement.isActive('paragraph') }"
            >
                paragraph
            </button>
            <button
                type="button"
                class="border px-2 py-1"
                @click="
                    editorElement
                        .chain()
                        .focus()
                        .toggleHeading({ level: 1 })
                        .run()
                "
                :class="{
                    'is-active': editorElement.isActive('heading', {
                        level: 1,
                    }),
                }"
            >
                h1
            </button>
            <button
                type="button"
                class="border px-2 py-1"
                @click="
                    editorElement
                        .chain()
                        .focus()
                        .toggleHeading({ level: 2 })
                        .run()
                "
                :class="{
                    'is-active': editorElement.isActive('heading', {
                        level: 2,
                    }),
                }"
            >
                h2
            </button>
            <button
                type="button"
                class="border px-2 py-1"
                @click="
                    editorElement
                        .chain()
                        .focus()
                        .toggleHeading({ level: 3 })
                        .run()
                "
                :class="{
                    'is-active': editorElement.isActive('heading', {
                        level: 3,
                    }),
                }"
            >
                h3
            </button>
            <button
                type="button"
                class="border px-2 py-1"
                @click="
                    editorElement
                        .chain()
                        .focus()
                        .toggleHeading({ level: 4 })
                        .run()
                "
                :class="{
                    'is-active': editorElement.isActive('heading', {
                        level: 4,
                    }),
                }"
            >
                h4
            </button>
            <button
                type="button"
                class="border px-2 py-1"
                @click="
                    editorElement
                        .chain()
                        .focus()
                        .toggleHeading({ level: 5 })
                        .run()
                "
                :class="{
                    'is-active': editorElement.isActive('heading', {
                        level: 5,
                    }),
                }"
            >
                h5
            </button>
            <button
                type="button"
                class="border px-2 py-1"
                @click="
                    editorElement
                        .chain()
                        .focus()
                        .toggleHeading({ level: 6 })
                        .run()
                "
                :class="{
                    'is-active': editorElement.isActive('heading', {
                        level: 6,
                    }),
                }"
            >
                h6
            </button>
            <button
                type="button"
                class="border px-2 py-1"
                @click="editorElement.chain().focus().toggleBulletList().run()"
                :class="{ 'is-active': editorElement.isActive('bulletList') }"
            >
                bullet list
            </button>
            <button
                type="button"
                class="border px-2 py-1"
                @click="editorElement.chain().focus().toggleOrderedList().run()"
                :class="{ 'is-active': editorElement.isActive('orderedList') }"
            >
                ordered list
            </button>
            <button
                type="button"
                class="border px-2 py-1"
                @click="editorElement.chain().focus().toggleCodeBlock().run()"
                :class="{ 'is-active': editorElement.isActive('codeBlock') }"
            >
                code block
            </button>
            <button
                type="button"
                class="border px-2 py-1"
                @click="editorElement.chain().focus().toggleBlockquote().run()"
                :class="{ 'is-active': editorElement.isActive('blockquote') }"
            >
                blockquote
            </button>
            <button
                type="button"
                class="border px-2 py-1"
                @click="editorElement.chain().focus().setHorizontalRule().run()"
            >
                horizontal rule
            </button>
            <button
                type="button"
                class="border px-2 py-1"
                @click="editorElement.chain().focus().unsetAllMarks().run()"
            >
                clear marks
            </button>
            <button
                type="button"
                class="border px-2 py-1"
                @click="editorElement.chain().focus().clearNodes().run()"
            >
                clear nodes
            </button>
        </div>
        <editor-content :editor="editorElement" />
    </div>
</template>

<script setup>
import StarterKit from "@tiptap/starter-kit";
import { Editor, EditorContent } from "@tiptap/vue-3";
import { onBeforeUnmount, onMounted, ref } from "vue";

const props = defineProps({
    modelValue: String,
});

const emits = defineEmits(["update:modelValue"]);

const editorElement = ref();

onMounted(() => {
    editorElement.value = new Editor({
        extensions: [StarterKit],
        editorProps: {
            attributes: {
                class: "prose prose-sm sm:prose-base lg:prose-lg mx-auto focus:outline-none dark:prose-invert",
            },
        },
        content: props.modelValue || defaultContent,
        onUpdate: ({ editor }) => {
            // HTML
            emits("update:modelValue", editor.getHTML());

            // JSON
            // this.$emit('update:modelValue', editor.getJSON())
        },
    });

    emits("update:modelValue", editorElement.value.getHTML());
});

onBeforeUnmount(() => {
    editorElement.value.destroy();
});

const defaultContent = `
        <h2>
          Hi there,
        </h2>
        <p>
          This is a <strong>basic example of tiptap</strong>. Sure, there are all kind of basic text styles you'd probably expect from a text editorElement. But wait until you see the lists:
        </p>
        <ul>
          <li>
            That's a bullet list with one …
          </li>
          <li>
            … or two list items.
          </li>
        </ul>
        <p>
          Isn't that great? And all of that is editable. But wait, there's more. Let's try a code block:
        </p>
        <pre><code class="language-css">body {
  display: none;
}</code></pre>
        <p>
          I know, I know, this is impressive. It's only the tip of the iceberg though. Give it a try and click a little bit around. Don't forget to check the other examples too.
        </p>
        <blockquote>
          Wow, that's amazing. Good work, boy! 👏
          <br />
          — Mom
        </blockquote>
      `;
</script>

<style lang="postcss" scoped>
.is-active {
    @apply bg-secondary text-white;
}
</style>
