<script setup>
import FixedFormWrapper from "./FixedFormWrapper.vue";
import TextInput from "../TextInput.vue";
import InputError from "../InputError.vue";
import InputLabel from "../InputLabel.vue";
import TextArea from "../TextArea.vue";
import Select from "../Select.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import Svg from "@/Components/Svg.vue";
import { Mentionable } from "vue-mention";

import useCreateDiscussion from "@/Composables/useCreateDiscussion";
import useMentionSearch from "@/Composables/useMentionSearch";

const { form, visible, hideCreateDiscussionForm } = useCreateDiscussion();

const { mentionSearch, mentionSearchResults } = useMentionSearch();

const createDiscussion = () => {
    form.post(route("discussions.store"), {
        onSuccess: () => {
            form.reset();
            hideCreateDiscussionForm();
        }
    });
};
</script>

<template>
    <div>
        <FixedFormWrapper v-if="visible" v-on:submit.prevent="createDiscussion" :form="form">
            <template #header>
                <div class="flex items-center justify-between">
                    <h1 class="text-lg font-medium">
                        New Discussion
                    </h1>
                    <button type="button" v-on:click="hideCreateDiscussionForm">
                        <Svg name="icon-close" />
                    </button>
                </div>
            </template>
            <template #main="{ markdownPreviewEnabled }">
                <div class="flex items-start space-x-3">
                    <div class="flex-grow">
                        <div>
                            <InputLabel for="title" value="Title" class="sr-only" />

                            <TextInput id="title" type="text" class="w-full" placeholder="Discussion Title"
                                v-model="form.title" />

                            <InputError class="mt-2" :message="form.errors.title" />
                        </div>
                    </div>
                    <div>
                        <InputLabel for="topic" value="Topic" class="sr-only" />
                        <Select id="topic" v-model="form.topic_id">
                            <option value="">
                                Choose a topic
                            </option>
                            <option :value="topic.id" v-for="topic in $page.props.topics" :key="topic.id">
                                {{ topic.name }}
                            </option>
                        </Select>
                        <InputError class="mt-2" :message="form.errors.topic_id" />
                    </div>
                </div>
                <div class="mt-4">
                    <InputLabel for="body" value="Body" class="sr-only" />
                    <Mentionable :keys="['@']" offset="6" @search="mentionSearch" :items="mentionSearchResults">
                        <TextArea id="body" v-show="!markdownPreviewEnabled" class="w-full h-48 align-top"
                            v-model="form.body" />
                    </Mentionable>
                    <InputError class="mt-2" :message="form.errors.body" />
                </div>
            </template>
            <template #button>
                <PrimaryButton>
                    Start Discussion
                </PrimaryButton>
            </template>
        </FixedFormWrapper>
    </div>
</template>
