//前端上传 https://inertiajs.com/file-uploads
<template>
    <form @submit.prevent="wordConvertHtml">
        <label>
            <span>word文件</span>
            <input type="file" @input="form.word = $event.target.files[0]" />
        </label>
        <progress v-if="form.progress" :value="form.progress.percentage" max="100">
        {{ form.progress.percentage }}%
        </progress>
        <button type="submit">word转html</button>
    </form>
    <br>
    <form @submit.prevent="htmlConvertWord">
        <label>
        <span>url</span>
            <input type="text" v-model="form1.url" />
        </label>
        <button type="submit">html转word</button>
    </form>
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
            word: null
        })

        function wordConvertHtml() {
            form.post('/api/doc/word/word-to-html')
        }

        const form1 = useForm({
            url: null
        })

        function htmlConvertWord() {
            form1.post('/api/doc/word/html-to-word')
        }

        return { form, wordConvertHtml, form1, htmlConvertWord }
    },
}
</script>
