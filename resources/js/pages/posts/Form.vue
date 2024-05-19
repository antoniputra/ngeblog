<script setup>
import Container from "@/components/Container.vue";
import SkeletonContent from "@/components/SkeletonContent.vue";
import { watch } from "vue";
import { useRoute, useRouter } from "vue-router";
import FormControl from "@/components/FormControl.vue";
import { apiBasePath, slugify } from "@/utils";
import { useForm } from "laravel-precognition-vue";
import ContentEditor from "@/components/ContentEditor.vue";
// import FormMetas from "@/components/FormMetas.vue";
import ComboboxField from "@/components/Fields/ComboboxField.vue";
import { useAxiosFetch } from "@/composables/useAxiosFetch";
import NotFound from "@/components/NotFound.vue";

const route = useRoute();
const router = useRouter();

document.title = "Add new Post - Ngeblog Administration";

const { state: postState, fetchData: fetchPostData } = useAxiosFetch();
const { state: tagsState, fetchData: fetchTagData } = useAxiosFetch();

const searchableTags = async (q) => {
    const data = await fetchTagData(
        apiBasePath(`tags/dropdown`) + `?search=${q}`,
    );
    return data;
};

const postForm = useForm("post", apiBasePath("posts"), {
    title: "",
    slug: "",
    is_visible: true,
    excerpt: "",
    content: "",
    metas: [],
    tags: [],
});

const loadPageData = async () => {
    if (route.params.id) {
        await fetchPostData(apiBasePath(`posts/${route.params.id}`));

        if (postState.error) {
            return;
        }

        document.title = `Edit Post ${postState.data.title} - Ngeblog Administration`;

        let tagsIds = [];
        if (postState.data.tags.length > 0) {
            tagsIds = postState.data.tags;
        }

        postForm.setData({
            title: postState.data.title,
            slug: postState.data.slug,
            is_visible: postState.data.is_visible,
            excerpt: postState.data.excerpt,
            content: postState.data.content,
            tags: tagsIds,
            metas: postState.data.metas,
        });
    } else {
        postForm.reset();
    }
};

watch(() => route.params.id, loadPageData, { immediate: true });

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
            url: apiBasePath(`posts/${postState.data.id}/update`),
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
        <NotFound v-if="postState.error?.response?.status === 404" />
        <Container v-else>
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
                        v-if="postState.loading"
                        class="loading loading-bars loading-lg"
                    ></span>

                    <template v-else>
                        <span v-if="$route.params.id && postState.data">
                            Edit Post {{ postState.data.title }}
                        </span>
                        <span v-else>Add new Post</span>
                    </template>
                </h1>
            </div>

            <SkeletonContent
                v-if="postState.loading"
                class="mx-auto max-w-xl"
            />

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
                    <input
                        type="text"
                        v-model="postForm.title"
                        placeholder="e.g: Awesome Technology"
                        class="input input-bordered"
                        :class="{
                            'input-error': postForm.errors['title'],
                        }"
                    />
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

                <FormControl as="div" label="Post Tags">
                    <ComboboxField
                        v-model="postForm.tags"
                        placeholder="Select tags..."
                        :searchable="searchableTags"
                        :searchable-lazy="false"
                        :loading="tagsState.loading"
                        label-attribute="title"
                        by="id"
                        multiple
                    >
                        <template #selected>
                            <div class="mb-4 flex flex-wrap items-center gap-2">
                                <div
                                    v-for="tag in postForm.tags"
                                    type="button"
                                    class="badge"
                                >
                                    {{ tag.title }}
                                </div>
                            </div>
                        </template>
                    </ComboboxField>
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

                <div class="flex flex-col gap-4">
                    <ContentEditor v-model="postForm.content" />
                    <p
                        v-if="postForm.errors.content"
                        class="label-text-alt text-sm text-error"
                    >
                        {{ postForm.errors.content }}
                    </p>
                </div>

                <!-- <div class="py-8">
                    <FormMetas v-model="postForm.metas" />
                </div> -->

                <div
                    v-if="Object.keys(postForm.errors).length"
                    class="self-center"
                >
                    <div
                        role="alert"
                        class="alert alert-error flex flex-col text-white"
                    >
                        <div class="flex items-center gap-2">
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                class="h-6 w-6 shrink-0 stroke-current"
                                fill="none"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"
                                />
                            </svg>
                            <span class="text-lg font-medium">
                                Whoops! Validation failed.
                            </span>
                        </div>
                        <ul>
                            <li v-for="err in postForm.errors">{{ err }}</li>
                        </ul>
                    </div>
                </div>

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
