<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import NumericInput from '@/Components/NumericInput.vue';
import SelectInput from '@/Components/SelectInput.vue';
import { Switch } from '@headlessui/vue'
import { Head, useForm } from '@inertiajs/vue3';
import { ref ,onMounted } from 'vue';


const form = useForm({
  upload_file: ''
});

onMounted(() => {
   
})

</script>

<template>
    <Head title="Crear Masiva" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Cargar Masiva</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="p-4 bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <form @submit.prevent="$event => form.post(route('reclamaciones.store'))"
                        class="mt-6 space-y-2 flex flex-wrap">   
                            <div class="w-full flex justify-center px-1 py-12">
                                <PrimaryButton :disabled="form.processing">
                                    <i class="fa-solid fa-save"></i> <p class="px-4">Cargar Archivo</p> 
                                </PrimaryButton>
                                
                            </div>
                    </form>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
