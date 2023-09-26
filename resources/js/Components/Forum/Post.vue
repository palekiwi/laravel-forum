<script setup>
import TextArea from "../TextArea.vue";
import InputLabel from "@/Components/InputLabel.vue";
import InputError from "@/Components/InputError.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import useCreatePost from "@/Composables/useCreatePost";
import { useForm } from "@inertiajs/vue3";
import { ref } from "vue";
import { router } from "@inertiajs/vue3";

const props = defineProps({
    post: Object,
    isSolution: Boolean
});

const { showCreatePostForm } = useCreatePost();

const editing = ref(false);
const editForm = useForm({
    body: props.post.body
});

const editPost = () => {
    editForm.patch(route("posts.patch", props.post), {
        preserveScroll: true,
        onSuccess: () => {
            editing.value = false;
        }
    });
};

const deletePost = () => {
    if (window.confirm("Are you sure?")) {
        router.delete(route("posts.destroy", props.post), {
            preserveScroll: true
        });
    }
};

const markAsSolution = post_id => {
    router.patch(
        route("discussions.solution.patch", props.post.discussion),
        {
            post_id: props.isSolution ? null : post_id
        },
        {
            preserveScroll: true
        }
    );
};
</script>

<template>
    <div
        :id="`post-${post.id}`"
        class="relative space-x-3 flex bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 text-gray-900 items-start border-2 border-transparent"
        :class="{
            'border-gray-800': isSolution,
            'border-transparent': !isSolution
        }"
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
                <form @submit.prevent="editPost" v-if="editing">
                    <InputLabel for="body" value="Body" class="sr-only" />
                    <TextArea
                        v-model="editForm.body"
                        id="body"
                        class="w-full"
                        rows="8"
                    />
                    <InputError class="mt-2" :message="editForm.errors.body" />
                    <div class="mt-2 flex items-center space-x-3">
                        <PrimaryButton>
                            Confirm
                        </PrimaryButton>
                        <button
                            type="button"
                            @click="editing = false"
                            class="text-sm"
                        >
                            Cancel
                        </button>
                    </div>
                </form>
                <div v-else v-html="post.body_markdown" class="markdown" />
            </div>
            <ul class="flex items-center space-x-3 mt-6">
                <li v-if="post.discussion.user_can.reply">
                    <button
                        @click="showCreatePostForm(post.discussion, post.user)"
                        class="text-indigo-500 text-sm"
                    >
                        Reply
                    </button>
                </li>
                <li v-if="post.user_can.edit">
                    <button
                        @click="editing = true"
                        class="text-indigo-500 text-sm"
                    >
                        Edit
                    </button>
                </li>
                <li v-if="post.user_can.delete">
                    <button @click="deletePost" class="text-indigo-500 text-sm">
                        Delete
                    </button>
                </li>
                <li v-if="post.discussion.user_can.solve">
                    <button
                        @click="markAsSolution(post.id)"
                        class="text-indigo-500 text-sm"
                    >
                        {{ isSolution ? "Unmark" : "Mark" }} as solution
                    </button>
                </li>
            </ul>
        </div>
        <div
            v-if="isSolution"
            class="shadow-sm absolute right-0 top-0 bg-gray-800 text-gray-100 px-3 py-1 text-xs uppercase tracking-wide font-semibold"
        >
            Best Answer
        </div>
    </div>
</template>
