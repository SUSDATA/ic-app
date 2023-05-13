<script setup>

import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, usePage } from '@inertiajs/vue3';
import { ref, onMounted } from 'vue';

const props = defineProps({
    currentUser: {type:Object}    
});

//******* Lifecycle Hooks *********//
onMounted(() => {
  console.log("Component was mounted user object passed through props from controller is: ",props.currentUser);  
  console.log("Exploring UsePage() Method: ",usePage().props.auth.user);   
})

</script>

<template>
    <Head title="Test" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Page for Testing Purposes</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">Hola, nombre del usuario loggeado por props: <strong>{{ currentUser.name }}</strong></div>
                    <div class="p-6 text-gray-900">Hola, obtenemos el nombre del usuario loggeado por la propiedad de instancia: <strong>{{ $page.props.auth.user.name }}</strong></div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
