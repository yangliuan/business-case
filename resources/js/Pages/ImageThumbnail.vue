<template>
<app-layout title="Dashboard">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                <Link href="/image">Image</Link>
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
                        <div>
                            <jet-application-logo class="block h-12 w-auto" />
                        </div>

                        <div class="mt-8 text-2xl">
                            Intervention Image
                        </div>

                        <div class="mt-6 text-gray-500">
                            图片适配生成缩略图
                        </div>
                    </div>

                    <div class="bg-gray-200 bg-opacity-25 grid grid-cols-1 md:grid-cols-2">
                        <div class="p-6">
                            <div class="ml-12">
                                <div class="antialiased text-gray-900 px-6">
                                    <form @submit.prevent="submit">
                                        <label class="block">
                                            <span class="text-gray-700">图片文件</span>
                                            <input type="file" @input="form.image = $event.target.files[0]" />
                                        </label>
                                        <progress v-if="form.progress" :value="form.progress.percentage" max="100">
                                        {{ form.progress.percentage }}%
                                        </progress>
                                        <button type="submit">提交图片</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </app-layout>
</template>

<script>
import { useForm } from '@inertiajs/inertia-vue3'
import AppLayout from '@/Layouts/AppLayout.vue'
import JetApplicationLogo from '@/Jetstream/ApplicationLogo.vue'
import { Link } from '@inertiajs/inertia-vue3'

export default {
    components: {
        AppLayout,
        JetApplicationLogo,
        Link
    },
    setup () {
        const form = useForm({
            compress: null,
            image: null,
        })

        function submit() {
            form.post('/api/image/intervertion/thumbnail')
        }

        return { form, submit }
    },
}
</script>
