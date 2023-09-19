<script setup>
import FixedFormWrapper from "./FixedFormWrapper.vue";
import TextInput from "../TextInput.vue";
import InputError from "../InputError.vue";
import InputLabel from "../InputLabel.vue";
import TextArea from "../TextArea.vue";
import Select from "../Select.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import useCreateDiscussion from "@/Composables/useCreateDiscussion";

const { form, visible, hideCreateDiscussionForm } = useCreateDiscussion();

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
        <FixedFormWrapper v-if="visible" v-on:submit.prevent="createDiscussion">
            <template #header>
                <div class="flex items-center justify-between">
                    <h1 class="text-lg font-medium">
                        New Discussion
                    </h1>
                    <button v-on:click="hideCreateDiscussionForm">
                        &times;
                    </button>
                </div>
            </template>
            <template #main>
                <div class="flex items-start space-x-3">
                    <div class="flex-grow">
                        <div>
                            <InputLabel
                                for="title"
                                value="Title"
                                class="sr-only"
                            />

                            <TextInput
                                id="title"
                                type="text"
                                class="w-full"
                                placeholder="Discussion Title"
                                v-model="form.title"
                            />

                            <InputError
                                class="mt-2"
                                :message="form.errors.title"
                            />
                        </div>
                    </div>
                    <div>
                        <InputLabel for="topic" value="Topic" class="sr-only" />
                        <Select id="topic" v-model="form.topic_id">
                            <option value="">
                                Choose a topic
                            </option>
                            <option
                                :value="topic.id"
                                v-for="topic in $page.props.topics"
                                :key="topic.id"
                            >
                                {{ topic.name }}
                            </option>
                        </Select>
                        <InputError
                            class="mt-2"
                            :message="form.errors.topic_id"
                        />
                    </div>
                </div>
                <div class="mt-4">
                    <InputLabel for="body" value="Body" class="sr-only" />
                    <TextArea class="w-full" rows="6" v-model="form.body" />
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
