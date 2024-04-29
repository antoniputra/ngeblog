<script setup>
import Container from "@/components/Container.vue";
import SkeletonContent from "@/components/SkeletonContent.vue";
import { onMounted, watch } from "vue";
import { useRoute, useRouter } from "vue-router";
import FormControl from "@/components/FormControl.vue";
import { apiBasePath, slugify } from "@/utils";
import { useForm } from "laravel-precognition-vue";
import { useLoadData } from "@/composables/loadData";

const route = useRoute();
const router = useRouter();
const tag = useLoadData();
document.title = "Add new Tag - Ngeblog Administration";

onMounted(() => {
    if (route.params.id) {
        populateForm();
    }
});

const tagForm = useForm("post", apiBasePath("tags"), {
    title: "",
    slug: "",
    is_visible: true,
    description: "",
});

const populateForm = () => {
    tag.fetchData(apiBasePath(`tags/${route.params.id}`), (data) => {
        document.title = `Edit Tag ${data.title} - Ngeblog Administration`;

        tagForm.setData({
            title: data.title,
            slug: data.slug,
            is_visible: data.is_visible,
            description: data.description,
        });
    });
};

watch(
    () => route.params.id,
    (val) => {
        if (val) {
            populateForm();
        } else {
            tagForm.reset();
        }
    },
);

watch(
    () => tagForm.title,
    (val) => {
        tagForm.slug = slugify(val);
    },
);

const submit = () => {
    const handleSuccess = () => {
        return router.push({ name: "tags-index" });
    };

    if (route.params.id) {
        tagForm.submit({
            method: "put",
            url: apiBasePath(`tags/${tag.data.id}/update`),
            onSuccess() {
                return handleSuccess();
            },
        });
    } else {
        tagForm.submit({
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
                        :to="{ name: 'tags-index' }"
                        class="btn btn-sm"
                    >
                        &larr; Tags List
                    </router-link>

                    <span
                        v-if="tag.loading"
                        class="loading loading-bars loading-lg"
                    ></span>

                    <template v-else>
                        <span v-if="$route.params.id && tag.data">
                            Edit Tag {{ tag.data.title }}
                        </span>
                        <span v-else>Add new Tag</span>
                    </template>
                </h1>
            </div>

            <SkeletonContent v-if="tag.loading" class="mx-auto max-w-xl" />

            <form
                v-else
                @submit.prevent="() => submit()"
                class="mx-auto flex max-w-xl flex-col gap-4"
            >
                <FormControl
                    label="Tag Title"
                    :required="true"
                    :error-message="tagForm.errors['title']"
                >
                    <div class="flex flex-col gap-2">
                        <input
                            type="text"
                            v-model="tagForm.title"
                            placeholder="e.g: Awesome Technology"
                            class="input input-bordered"
                            :class="{
                                'input-error': tagForm.errors['title'],
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
                            v-model="tagForm.slug"
                            class="w-full"
                            placeholder="e.g: awesome-technology"
                        />
                    </label>
                    <div class="label flex flex-col items-start md:flex-row">
                        <p
                            v-if="tagForm.errors['slug']"
                            v-text="tagForm.errors['slug']"
                            class="text-error"
                        />
                    </div>
                </div>

                <div>
                    <label class="label inline-flex cursor-pointer gap-4">
                        <span class="label-text">Visibility</span>
                        <input
                            type="checkbox"
                            class="toggle"
                            v-model="tagForm.is_visible"
                        />
                    </label>
                </div>

                <FormControl label="Tag Description">
                    <textarea
                        v-model="tagForm.description"
                        class="textarea textarea-bordered h-24"
                        :class="{
                            'input-error': tagForm.errors['description'],
                        }"
                        placeholder="Content that related with technology."
                    ></textarea>
                </FormControl>

                <div
                    class="flex items-center justify-between gap-4 border-t py-4"
                >
                    <router-link :to="{ name: 'tags-index' }" class="btn px-8">
                        &larr; Cancel
                    </router-link>
                    <button
                        type="submit"
                        class="btn btn-primary px-8"
                        :disabled="tagForm.processing"
                    >
                        {{ tagForm.processing ? "Saving..." : "Save" }}
                    </button>
                </div>
            </form>
        </Container>
    </div>
</template>
