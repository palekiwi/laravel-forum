<script setup>
import useCreatePost from "@/Composables/useCreatePost";

defineProps({
    post: Object
});

const { showCreatePostForm } = useCreatePost();
</script>

<template>
    <div
        class="space-x-3 flex bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 text-gray-900 items-start"
    >
        <div class="w-7 flex-shrink-0">
            <img
                :src="post.user?.avatar_url"
                class="w-7 h-7 rounded-full"
                v-if="post.user"
            />
        </div>
        <div class="w-full">
            <div class="">
                <div class="">
                    {{ post.user?.username || "[user deleted]" }}
                </div>
                <div class="text-sm text-gray-500">
                    Posted
                    <time
                        :datetime="post.created_at.dateTime"
                        :title="post.created_at.dateTime"
                        >{{ post.created_at.human }}</time
                    >
                </div>
            </div>
            <div class="mt-3">
                <div v-html="post.body_markdown" class="markdown" />
            </div>
            <ul class="flex items-center space-x-3 mt-6">
                <li
                    v-if="post.discussion.user_can.reply"
                    @click="showCreatePostForm(post.discussion)"
                >
                    <button class="text-indigo-500 text-sm">Reply</button>
                </li>
            </ul>
        </div>
    </div>
</template>
