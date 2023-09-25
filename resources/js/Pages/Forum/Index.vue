<script setup>
import ForumLayout from "@/Layouts/ForumLayout.vue";
import Select from "@/Components/Select.vue";
import Pagination from "@/Components/Pagination.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import Discussion from "@/Components/Forum/Discussion.vue";
import Navigation from "@/Components/Forum/Navigation.vue";
import InputLabel from "@/Components/InputLabel.vue";
import TextInput from "@/Components/TextInput.vue";
import { Head, router } from "@inertiajs/vue3";
import { ref, watch } from "vue";
import _omitby from "lodash.omitby";
import _isempty from "lodash.isempty";
import _debounce from "lodash.debounce";
import useCreateDiscussion from "@/Composables/useCreateDiscussion";

const props = defineProps({
    discussions: Object,
    query: Object
});

const { showCreateDiscussionForm } = useCreateDiscussion();

const filterTopic = e => {
    router.visit("/", {
        data: _omitby(
            {
                "filter[topic]": e.target.value
            },
            _isempty
        ),
        preserveScroll: true
    });
};
const searchQuery = ref(props.query.search || "");

const handleSearchInput = _debounce(query => {
    router.reload({
        data: { search: query },
        preserveScroll: true
    });
}, 500);

watch(searchQuery, query => {
    handleSearchInput(query);
});
</script>

<template>
    <Head title="Dashboard" />

    <ForumLayout>
        <div class="space-y-6">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 flex items-center space-x-3">
                    <div class="flex-grow">
                        <InputLabel for="search" value="Search" class="sr-only" />
                        <TextInput v-model="searchQuery" type="search" id="search" class="w-full"
                            placeholder="Search discussions..." />
                    </div>
                    <div>
                        <InputLabel for="topic" value="Topic" class="sr-only" />
                        <Select id="topic" v-on:change="filterTopic">
                            <option value="">
                                All Topics
                            </option>
                            <option :value="topic.slug" v-for="topic in $page.props.topics" :key="topic.id"
                                :selected="query.filter?.topic === topic.slug">
                                {{ topic.name }}
                            </option>
                        </Select>
                    </div>
                </div>
            </div>
            <div class="space-y-3">
                <template v-if="discussions.data.length">
                    <Discussion v-for="discussion in discussions.data" :key="discussion.id" :discussion="discussion" />
                    <Pagination :pagination="discussions.meta" />
                </template>
            </div>
        </div>

        <template #side>
            <PrimaryButton class="w-full flex justify-center h-10" v-on:click="showCreateDiscussionForm"
                v-if="$page.props.auth.user">Start a discussion
            </PrimaryButton>
            <Navigation :query="query" />
        </template>
    </ForumLayout>
</template>
