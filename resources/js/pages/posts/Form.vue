<script setup>
import Container from "@/components/Container.vue";
import SkeletonContent from "@/components/SkeletonContent.vue";
import { onMounted, watch } from "vue";
import { useRoute, useRouter } from "vue-router";
import FormControl from "@/components/FormControl.vue";
import { apiBasePath, slugify } from "@/utils";
import { useForm } from "laravel-precognition-vue";
import { useLoadData } from "@/composables/loadData";
import TextEditor from "@/components/TextEditor.vue";

const route = useRoute();
const router = useRouter();
const post = useLoadData();
const tagsDropdown = useLoadData();

document.title = "Add new Post - Ngeblog Administration";

onMounted(() => {
    tagsDropdown.fetchData(apiBasePath(`tags/dropdown`));

    if (route.params.id) {
        populateForm();
    }
});

const postForm = useForm("post", apiBasePath("posts"), {
    title: "",
    slug: "",
    is_visible: true,
    excerpt: "",
    content: "",
    tags: [],
});

const populateForm = () => {
    post.fetchData(apiBasePath(`posts/${route.params.id}`), (data) => {
        document.title = `Edit Post ${data.title} - Ngeblog Administration`;

        let tagsIds = [];
        if (data.tags.length > 0) {
            tagsIds = data.tags.map((t) => t.id);
        }

        postForm.setData({
            title: data.title,
            slug: data.slug,
            is_visible: data.is_visible,
            excerpt: data.excerpt,
            content: data.content,
            tags: tagsIds,
        });
    });
};

watch(
    () => route.params.id,
    (val) => {
        if (val) {
            populateForm();
        } else {
            postForm.reset();
        }
    },
);

watch(
    () => postForm.title,
    (val) => {
        postForm.slug = slugify(val);
    },
);

const submit = () => {
    const handleSuccess = () => {
        return router.push({ name: "posts-index" });
    };

    if (route.params.id) {
        postForm.submit({
            method: "put",
            url: apiBasePath(`posts/${post.data.id}/update`),
            onSuccess() {
                return handleSuccess();
            },
        });
    } else {
        postForm.submit({
            onSuccess() {
                return handleSuccess();
            },
        });
    }
};
</script>

<template>
    <div>
        <Container>
            <div class="mb-8">
                <h1
                    class="flex items-center gap-2 text-2xl font-bold tracking-wide"
                >
                    <router-link
                        :to="{ name: 'posts-index' }"
                        class="btn btn-sm"
                    >
                        &larr; Posts List
                    </router-link>

                    <span
                        v-if="post.loading"
                        class="loading loading-bars loading-lg"
                    ></span>

                    <template v-else>
                        <span v-if="$route.params.id && post.data">
                            Edit Post {{ post.data.title }}
                        </span>
                        <span v-else>Add new Post</span>
                    </template>
                </h1>
            </div>

            <SkeletonContent v-if="post.loading" class="mx-auto max-w-xl" />

            <form
                v-else
                @submit.prevent="() => submit()"
                class="mx-auto flex max-w-5xl flex-col gap-4"
            >
                <FormControl
                    label="Post Title"
                    :required="true"
                    :error-message="postForm.errors['title']"
                >
                    <div class="flex flex-col gap-2">
                        <input
                            type="text"
                            v-model="postForm.title"
                            placeholder="e.g: Awesome Technology"
                            class="input input-bordered"
                            :class="{
                                'input-error': postForm.errors['title'],
                            }"
                        />
                    </div>
                </FormControl>

                <div class="form-control">
                    <label class="input input-bordered flex items-center gap-2">
                        <span
                            class="-ml-4 flex items-center self-stretch rounded-l-lg bg-gray-100 px-2 text-sm"
                        >
                            {{
                                false ? "https://your-url.test/posts/" : "Slug:"
                            }}
                        </span>
                        <input
                            type="text"
                            v-model="postForm.slug"
                            class="w-full"
                            placeholder="e.g: awesome-technology"
                        />
                    </label>
                    <div class="label flex flex-col items-start md:flex-row">
                        <p
                            v-if="postForm.errors['slug']"
                            v-text="postForm.errors['slug']"
                            class="text-error"
                        />
                    </div>
                </div>

                <FormControl label="Post Tags">
                    <select
                        v-if="!tagsDropdown.loading"
                        v-model="postForm.tags"
                        placeholder="Select tags"
                        class="select select-bordered"
                        style="height: 150px"
                        multiple
                    >
                        <option
                            v-for="tag in tagsDropdown?.data?.data"
                            :value="tag.id"
                            v-text="tag.title"
                        />
                    </select>
                </FormControl>

                <div>
                    <label class="label inline-flex cursor-pointer gap-4">
                        <span class="label-text">Visibility</span>
                        <input
                            type="checkbox"
                            class="toggle"
                            v-model="postForm.is_visible"
                        />
                    </label>
                </div>

                <FormControl label="Post Excerpt">
                    <textarea
                        v-model="postForm.excerpt"
                        class="textarea textarea-bordered h-24"
                        :class="{
                            'input-error': postForm.errors['excerpt'],
                        }"
                        placeholder="Describe the post introduction."
                    ></textarea>
                </FormControl>

                <FormControl
                    as="div"
                    label="Post Content"
                    :required="true"
                    :error-message="postForm.errors['content']"
                >
                    <TextEditor
                        :initial-value="postForm.content"
                        @on-change="(val) => (postForm.content = val)"
                    />
                </FormControl>

                <div
                    class="flex items-center justify-between gap-4 border-t py-4"
                >
                    <router-link :to="{ name: 'posts-index' }" class="btn px-8">
                        &larr; Cancel
                    </router-link>
                    <button
                        type="submit"
                        class="btn btn-primary px-8"
                        :disabled="postForm.processing"
                    >
                        {{ postForm.processing ? "Saving..." : "Save" }}
                    </button>
                </div>
            </form>
        </Container>
    </div>
</template>
