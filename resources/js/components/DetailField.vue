<template>
    <div>
        <div
            v-for="media in field.media"
            :key="media.id"
            class="flex items-center"
        >
            <img
                :src="media.url"
                class="w-48 mr-4"
            >
            <div class="w-full">
                <p
                    v-if="media.used"
                    class="font-semibold text-success"
                >
                    Used in the content
                </p>
                <p
                    v-else
                    class="font-semibold text-danger"
                >
                    Not used in the content
                </p>
                <input
                    type="text"
                    class="w-full form-control form-input form-input-bordered"
                    :value="media.snippet"
                    onclick="select()"
                >
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: ['resource', 'resourceName', 'resourceId', 'field'],
}
</script>
