<script setup>
defineProps({
    post: Object
});
</script>

<template>
    <div class="space-x-3 flex bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 text-gray-900 items-start">
        <div class="w-7 flex-shrink-0">
            <img :src="post.user.avatar_url" class="w-7 h-7 rounded-full" />
        </div>
        <div class="w-full">
            <div class="">
                <div class="">
                    {{ post.user.username }}
                </div>
                <div class="text-sm text-gray-500">
                    {{ post.created_at.human }}
                </div>
            </div>
            <div class="mt-3">
                {{ post.body }}
            </div>
        </div>
    </div>
</template>