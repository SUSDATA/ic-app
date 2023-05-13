<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, useForm } from '@inertiajs/vue3';

const form = useForm({
    code: '',
    segmento: '',
    operacion: '',
    motivo: '',    
});

</script>

<template>
    <Head title="Crear Reclamación" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Crear Reclamación</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="p-4 bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <form @submit.prevent="$event => form.post(route('reclamaciones.store'))"
                        class="mt-6 space-y-6 max-w-xl">
                        <InputLabel for="code" value="Codigo"></InputLabel>
                        <TextInput id="code" v-model="form.code" autofocus required
                            type="text"
                            class="mt-1 block w-full"
                        ></TextInput>
                        <InputLabel for="segmento" value="Segmento"></InputLabel>
                        <TextInput id="segmento" v-model="form.segmento" autofocus required
                            type="text"
                            class="mt-1 block w-full"
                        ></TextInput>
                        <InputLabel for="operacion" value="Operacion"></InputLabel>
                        <TextInput id="operacion" v-model="form.operacion" autofocus
                            type="text"
                            class="mt-1 block w-full"
                        ></TextInput>
                        <InputLabel for="motivo" value="Motivo"></InputLabel>
                        <TextInput id="motivo" v-model="form.motivo" autofocus
                            type="text"
                            class="mt-1 block w-full"
                        ></TextInput>
                    <InputError :message="form.errors.nombre" class="mt2"></InputError>
                    <PrimaryButton :disabled="form.processing"><i class="fa-solid fa-save"></i> Crear</PrimaryButton>
                    </form>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
