<template>
    <div>
        <Container>
            <Suspense>
                <div class="grid grid-cols-6 gap-8">
                    <CounterWidget
                        type="tag"
                        label="Total Tag"
                        class="col-span-3"
                    />

                    <CounterWidget
                        type="post"
                        label="Total Post"
                        class="col-span-3"
                    />

                    <!-- <PostsByAuthorWidget class="col-span-2" /> -->
                </div>
            </Suspense>
        </Container>
    </div>
</template>

<script setup>
import Container from "@/components/Container.vue";
import CounterWidget from "@/components/Widgets/CounterWidget.vue";
// import PostsByAuthorWidget from "@/components/Widgets/PostsByAuthorWidget.vue";
</script>
