import { ref } from "vue";
import { useForm } from "@inertiajs/vue3";

const visible = ref(false);

const user = ref(false);
const discussion = ref(null);

const form = useForm({
    body: ""
});

export default () => {
    const showCreatePostForm = (discussionContext, userContext = null) => {
        discussion.value = discussionContext;
        user.value = userContext;
        visible.value = true;
    };

    const hideCreatePostForm = () => {
        visible.value = false;
    };

    return {
        discussion,
        user,
        form,
        visible,
        showCreatePostForm,
        hideCreatePostForm
    };
};
