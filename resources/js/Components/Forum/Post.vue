<script setup>
defineProps({
    post: Object
});
</script>

<template>
    <div class="block bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 text-gray-900 flex items-center space-x-6">
            <div class="flex-grow">
                <div class="flex items-center space-x-3">
                    <span
                        class="inline-flex items-center rounded-lg bg-gray-100 px-3 py-0.5 text-sm text-gray-600"
                        >{{ post.id }}</span
                    >
                    <h1 class="text-lg font-medium">
                        {{ post.body }}
                    </h1>
                </div>
            </div>
            <div>
                avatars
            </div>
        </div>
    </div>
</template>
