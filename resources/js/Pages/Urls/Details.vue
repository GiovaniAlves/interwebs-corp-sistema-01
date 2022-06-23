<template>
    <AppLayout title="CreateUrl">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Cadastro URL
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <div class="p-6 sm:px-20 bg-white border-b border-gray-200">

                        <div v-if="model.hasOwnProperty('status_code')">
                            <div v-if="model.status_code === '200'">
                                <div class="flex">
                                    <p class="font-bold">Status da Requisição:</p>
                                    <p class="text-green-600 font-bold ml-2 mb-2"> {{ model.status_code }}</p>
                                </div>
                            </div>
                            <div v-else-if="model.status_code === '404'">
                                <div class="flex">
                                    <p class="font-bold">Status da Requisição:</p>
                                    <p class="text-red-600 font-bold ml-2 mb-2"> {{ model.status_code }}</p>
                                </div>
                            </div>
                            <div v-else class="font-semibold">
                                Não foi possível encontrar essa url!
                            </div>
                            <div v-if="model.body !== null" class="inline-block">
                                <p class="font-bold">Corpo da Requisição:</p>
                                {{model.body}}
                            </div>
                        </div>
                        <p v-else class="flex justify-center">Carregando...</p>

                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>

<script setup>
import AppLayout from "../../Layouts/AppLayout"
import {onMounted, ref} from "vue"
import axios from "axios"

const props = defineProps({
    url: Object
})

// Re-create the whole url data to avoid unintentional reference change
const model = ref(Object.assign({}, props.url))
onMounted(() => {
    axios.get(`http://localhost:8888/api/url-answer/${model.value.id}`).then((response) => {
        model.value = response.data.urlAnswer
    })
})

</script>
