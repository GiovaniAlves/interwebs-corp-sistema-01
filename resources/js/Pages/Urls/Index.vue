<template>
    <AppLayout title="CreateUrl">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                URLs
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <div class="p-6 sm:px-20 bg-white border-b border-gray-200">

                        <InertiaLink
                            class="btn btn-secondary inline-flex"
                            :href="route('url.create')">
                            Cadastrar Url
                        </InertiaLink>

                        <table class="table-auto w-full">
                            <thead>
                            <tr>
                                <th class="p-3">Id</th>
                                <th class="p-3">Nome</th>
                                <th class="p-3" style="width: 400px;">Ações</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr
                                v-for="url in model"
                                :key="url.id">
                                <td class="p-3 border">{{ url.id }}</td>
                                <td class="p-3 border">{{ url.name }}</td>
                                <td class="p-3 border">
                                    <InertiaLink
                                        class="btn btn-primary mr-2 inline-block disabled"
                                        :href="route('url.show', {'id': url.id})">
                                        <div class="flex">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                                 viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                      d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                      d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                            </svg>
                                            Detalhes

                                            <span v-if="url.status_code === '200'"
                                                  class=" ml-1 w-2 h-2 bg-green-500 rounded-full"></span>
                                            <span v-else-if="url.status_code === '404'"
                                                  class=" ml-1 w-2 h-2 bg-red-500 rounded-full"></span>
                                            <span v-else class=" ml-1 w-2 h-2 bg-gray-500 rounded-full"></span>

                                        </div>
                                    </InertiaLink>
                                    <InertiaLink
                                        class="btn btn-success mr-2 inline-block"
                                        :href="route('url.edit', {'id': url.id})">
                                        <div class="flex">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                                 viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                      d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/>
                                            </svg>
                                            Editar
                                        </div>
                                    </InertiaLink>
                                    <InertiaLink
                                        class="btn btn-danger align-top"
                                        type="button"
                                        @click="deleteUrl(url)">
                                        <div class="flex">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                                 viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                      d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                            </svg>
                                            Excluir
                                        </div>
                                    </InertiaLink>
                                </td>
                            </tr>
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>

<script setup>
import AppLayout from "../../Layouts/AppLayout"
import {InertiaLink} from "@inertiajs/inertia-vue3"
import {Inertia} from "@inertiajs/inertia"
import {onBeforeMount, onBeforeUnmount, ref} from 'vue'
import axios from "axios"

const props = defineProps({
    urls: Array,
    urlSystem02: String
})

let timer = ref({})

onBeforeMount(() => {
    timer = setInterval(fetchUrlAnswers, 5000)
})

// Re-create the whole url data to avoid unintentional reference change
const model = ref(Object.assign({}, props.urls))
function fetchUrlAnswers() {
    axios.get(`${props.urlSystem02}/url-answers-list`).then((res) => {
        model.value = res.data.urlAnswers
    })
}

function deleteUrl(url) {
    if (confirm('Deseja realmente excluir este registro?')) {
        Inertia.delete(route('url.destroy', {'id': url.id}))
    }
}

onBeforeUnmount(() => {
    clearInterval(timer)
})

</script>

