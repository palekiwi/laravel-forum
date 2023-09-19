<script setup>
defineProps({
    post: Object
});
</script>

<template>
    <div class="space-x-3 flex bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 text-gray-900 items-start">
        <div class="w-7 flex-shrink-0">
            <img :src="post.user?.avatar_url" class="w-7 h-7 rounded-full" v-if="post.user" />
        </div>
        <div class="w-full">
            <div class="">
                <div class="">
                    {{ post.user?.username || "[user deleted]" }}
                </div>
                <div class="text-sm text-gray-500">
                    Posted
                    <time :datetime="post.created_at.dateTime" :title="post.created_at.dateTime">{{ post.created_at.human
                    }}</time>
                </div>
            </div>
            <div class="mt-3">
                <div v-html="post.body_markdown" class="markdown" />
            </div>
        </div>
    </div>
</template>
