<script setup>
import FixedFormWrapper from "./FixedFormWrapper.vue";
import InputError from "../InputError.vue";
import InputLabel from "../InputLabel.vue";
import TextArea from "../TextArea.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import Svg from "@/Components/Svg.vue";
import useCreatePost from "@/Composables/useCreatePost";

const { discussion, form, visible, hideCreatePostForm } = useCreatePost();

const createPost = () => {
    form.post(route("discussions.store"), {
        onSuccess: () => {
            form.reset();
            hideCreatePostForm();
        }
    });
};
</script>

<template>
    <div>
        <FixedFormWrapper
            v-if="visible"
            v-on:submit.prevent="createPost"
            :form="form"
        >
            <template #header>
                <div class="flex items-center justify-between">
                    <h1 class="text-lg font-medium">
                        Replying to {{ discussion.title }}
                    </h1>
                    <button type="button" v-on:click="hideCreatePostForm">
                        <Svg name="icon-close" />
                    </button>
                </div>
            </template>
            <template #main="{ markdownPreviewEnabled }">
                <div>
                    <InputLabel for="body" value="Body" class="sr-only" />
                    <TextArea
                        id="body"
                        v-show="!markdownPreviewEnabled"
                        class="w-full h-48 align-top"
                        v-model="form.body"
                    />
                    <InputError class="mt-2" :message="form.errors.body" />
                </div>
            </template>
            <template #button>
                <PrimaryButton>
                    Reply
                </PrimaryButton>
            </template>
        </FixedFormWrapper>
    </div>
</template>
