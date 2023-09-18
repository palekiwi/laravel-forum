<template>
    <Head title="Dashboard" />

    <ForumLayout>
        <div class="space-y-6">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div>
                        <InputLabel for="topic" value="Topic" class="sr-only" />
                        <Select id="topic" v-on:change="filterTopic">
                            <option value="">
                                All Topics
                            </option>
                            <option
                                :value="topic.slug"
                                v-for="topic in $page.props.topics"
                                :key="topic.id"
                                :selected="query.filter?.topic === topic.slug"
                            >
                                {{ topic.name }}
                            </option>
                        </Select>
                    </div>
                </div>
            </div>
            <div class="space-y-3">
                <template v-if="discussions.data.length">
                    <Discussion
                        v-for="discussion in discussions.data"
                        :key="discussion.id"
                        :discussion="discussion"
                    />
                    <Pagination :pagination="discussions.meta" />
                </template>
            </div>
        </div>

        <template #side>
            <Navigation :query="query" />
        </template>
    </ForumLayout>
</template>

<script setup>
import ForumLayout from "@/Layouts/ForumLayout.vue";
import Select from "@/Components/Select.vue";
import Pagination from "@/Components/Pagination.vue";
import Discussion from "@/Components/Forum/Discussion.vue";
import Navigation from "@/Components/Forum/Navigation.vue";
import InputLabel from "@/Components/InputLabel.vue";
import { Head, router } from "@inertiajs/vue3";
import _omitby from "lodash.omitby";
import _isempty from "lodash.isempty";

defineProps({
    discussions: Object,
    query: Object
});

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
</script>
