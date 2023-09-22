<script setup>
import ForumLayout from "@/Layouts/ForumLayout.vue";
import Pagination from "@/Components/Pagination.vue";
import Post from "@/Components/Forum/Post.vue";
import Navigation from "@/Components/Forum/Navigation.vue";
import { Head, router } from "@inertiajs/vue3";
import pluralize from "pluralize";
import useCreatePost from "@/Composables/useCreatePost";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import { onMounted, onUpdated, nextTick } from "vue";
import VueScrollTo from "vue-scrollto";

const props = defineProps({
    discussion: Object,
    posts: Object,
    query: Object,
    postId: Number
});

const { showCreatePostForm } = useCreatePost();

const scrollToPost = postId => {
    if (!postId) {
        return;
    }
    nextTick(() => {
        VueScrollTo.scrollTo(`#post-${postId}`, 500, { offset: -50 });
    });
};

const deleteDiscussion = () => {
    if (window.confirm("Are you sure?")) {
        router.delete(route("discussions.destroy", props.discussion));
    }
};

onMounted(() => {
    scrollToPost(props.postId);
});

//onUpdated(() => {
//    scrollToPost(props.postId);
//});
</script>

<template>
    <Head :title="discussion.title" />

    <ForumLayout>
        <div class="space-y-3">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div
                    class="p-6 text-gray-900 flex items-center justify-between"
                >
                    <div class="flex items-center space-x-3">
                        <span
                            class="inline-flex items-center rounded-lg bg-gray-100 px-3 py-0.5 text-sm text-gray-600"
                            >{{ discussion.topic.name }}</span
                        >
                        <h1 class="text-lg font-medium">
                            <template v-if="discussion.is_pinned">
                                [Pinned]
                            </template>
                            {{ discussion.title }}
                        </h1>
                        <ul>
                            <li v-if="discussion.user_can.delete">
                                <button
                                    type="button"
                                    @click="deleteDiscussion"
                                    class="text-indigo-500 text-sm"
                                >
                                    Delete
                                </button>
                            </li>
                        </ul>
                    </div>
                    <div class="text-sm">
                        {{ pluralize("reply", discussion.replies_count, true) }}
                    </div>
                </div>
            </div>
            <template v-if="posts.data.length">
                <Post
                    v-for="post in posts.data"
                    :post="post"
                    :key="post.id"
                    :isSolution="discussion.solution?.id === post.id"
                />
                <Pagination :pagination="posts.meta" />
            </template>
        </div>

        <template #side>
            <PrimaryButton
                class="w-full flex justify-center h-10"
                v-on:click="showCreatePostForm(discussion)"
                v-if="discussion.user_can.reply"
                >Reply to discussion
            </PrimaryButton>
            <Navigation :query="query" />
        </template>
    </ForumLayout>
</template>
