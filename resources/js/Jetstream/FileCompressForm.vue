<template>
    <form @submit.prevent="fileCompress">
        <label>
            <span>待压缩文件</span>
            <input type="file" @input="form.comporess = $event.target.files[0]" />
        </label>
        <progress v-if="form.progress" :value="form.progress.percentage" max="100">
        {{ form.progress.percentage }}%
        </progress>
        <button type="submit">上传待压缩文件</button>
    </form>
    <br>
</template>

<script>
import AppLayout from '@/Layouts/AppLayout.vue'
import JetApplicationLogo from '@/Jetstream/ApplicationLogo.vue'
import { useForm } from '@inertiajs/inertia-vue3'

export default {
    components: {
        AppLayout,
        JetApplicationLogo,
    },
    setup () {
        const form = useForm({
            comporess: null
        })

        function fileCompress() {
            form.post('/api/files/download-zip')
        }

        return { form, fileCompress }
    },
}
</script>
