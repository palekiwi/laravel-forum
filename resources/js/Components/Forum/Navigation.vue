<template>
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 text-gray-900">
            <nav class="space-y-3">
                <!-- General Filters -->
                <ul class="space-y-2">
                    <li>
                        <Link
                            href="/"
                            :class="{
                                'font-bold':
                                    !query.filter &&
                                    $page.component === 'Forum/Index'
                            }"
                        >
                            All Discussions
                        </Link>
                    </li>
                    <li>
                        <Link
                            href="/?filter[noreplies]=1"
                            :class="{ 'font-bold': query.filter?.noreplies }"
                            >No Replies
                        </Link>
                    </li>
                    <li>
                        <Link
                            href="/?filter[solved]=1"
                            :class="{ 'font-bold': query.filter?.solved }"
                            >Solved
                        </Link>
                    </li>
                    <li>
                        <Link
                            href="/?filter[unsolved]=1"
                            :class="{ 'font-bold': query.filter?.unsolved }"
                            >Unolved
                        </Link>
                    </li>
                </ul>

                <!-- Auth Filters -->
                <ul
                    class="border-t border-t-gray-100 pt-3 space-y-2"
                    v-if="$page.props.auth.user"
                >
                    <li>
                        <Link
                            href="/?filter[mine]=1"
                            :class="{ 'font-bold': query.filter?.mine }"
                        >
                            My Discussions</Link
                        >
                    </li>
                    <li>
                        <Link
                            href="/?filter[participating]=1"
                            :class="{
                                'font-bold': query.filter?.participating
                            }"
                        >
                            Participating
                        </Link>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
</template>

<script setup>
import { Link } from "@inertiajs/vue3";

defineProps({
    query: Object
});
</script>
