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

                        <InputError
                            v-if="errors"
                            v-for="error in errors"
                            :key="error.name"
                            :message="error">
                            {{ error }}
                        </InputError>

                        <form @submit.prevent="submit">
                            <div class="mt-4">
                                <jet-label value="Nome" />
                                <jet-input type="text" placeholder="Ex: https://brasilapi.com.br/api/cep/v1/39800019" class="mt-1 block w-full" v-model="form.name" />
                            </div>

                            <jet-button type="submit" class="ma-4 mt-3">Salvar</jet-button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>

<script setup>
import AppLayout from "../../Layouts/AppLayout"
import JetInput from "@/Jetstream/Input.vue"
import JetLabel from "@/Jetstream/Label.vue"
import JetButton from "@/Jetstream/Button.vue"
import InputError from "../../Jetstream/InputError"
import {Inertia} from "@inertiajs/inertia";

defineProps({
    errors: Object
})

const form = {
    name: ''
}

function submit() {
    Inertia.post(route('url.store'), form)
}

</script>
