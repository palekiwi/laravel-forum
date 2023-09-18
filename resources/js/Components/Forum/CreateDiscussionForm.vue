<script setup>
import FixedFormWrapper from "./FixedFormWrapper.vue";
import TextInput from "../TextInput.vue";
import InputError from "../InputError.vue";
import InputLabel from "../InputLabel.vue";
import TextArea from "../TextArea.vue";
import Select from "../Select.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import useCreateDiscussion from "@/Composables/useCreateDiscussion";

const { visible, hideCreateDiscussionForm } = useCreateDiscussion();
</script>

<template>
    <div>
        <FixedFormWrapper v-if="visible">
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

                            <TextInput id="title" type="text" class="w-full" />

                            <!-- <InputError class="mt-2" /> -->
                        </div>
                    </div>
                    <div>
                        <Select id="topic">
                            <option disabled>
                                Choose a topic
                            </option>
                            <option
                                :value="topic.slug"
                                v-for="topic in $page.props.topics"
                                :key="topic.id"
                            >
                                {{ topic.name }}
                            </option>
                        </Select>
                    </div>
                </div>
                <div class="mt-4">
                    <TextArea class="w-full" rows="6" />
                </div>
            </template>
            <template #button>
                <PrimaryButton>
                    Create
                </PrimaryButton>
            </template>
        </FixedFormWrapper>
    </div>
</template>
