import { ref } from "vue";
import { useForm } from "@inertiajs/vue3";

const visible = ref(false);
const discussion = ref(null);

const form = useForm({
    body: ""
});

export default () => {
    const showCreatePostForm = discussionContext => {
        discussion.value = discussionContext;
        visible.value = true;
    };

    const hideCreatePostForm = () => {
        visible.value = false;
    };

    return {
        discussion,
        form,
        visible,
        showCreatePostForm,
        hideCreatePostForm
    };
};
