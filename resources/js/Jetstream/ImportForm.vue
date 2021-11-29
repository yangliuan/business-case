<template>
    <div>
        <form @submit.prevent="importExcelNormalCollection">
            <label>
                <span>excel文件</span>
                <input type="file" @input="form.excel = $event.target.files[0]" />
            </label>
            <progress v-if="form.progress" :value="form.progress.percentage" max="100">
            {{ form.progress.percentage }}%
            </progress>
            <button type="submit">普通导入excel</button>
        </form>
        <br>
        <br>
        <form @submit.prevent="queueImportExcel">
            <label>
                <span>excel文件</span>
                <input type="file" @input="form1.excel = $event.target.files[0]" />
            </label>
            <progress v-if="form1.progress" :value="form1.progress.percentage" max="100">
            {{ form1.progress.percentage }}%
            </progress>
            <button type="submit">队列导入excel</button>
        </form>
    </div>
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
            excel: null
        })

        function importExcelNormalCollection() {
            form.post('/api/excel/import/normal-collection')
        }

        const form1 = useForm({
            excel: null
        })

        function queueImportExcel() {
            form1.post('/api/doc/word/word-to-html')
        }

        return { form, importExcelNormalCollection, form1, queueImportExcel }
    },
}
</script>
