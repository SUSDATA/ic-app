<script setup>

import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { ref, onMounted } from 'vue';
import { Head } from '@inertiajs/vue3';
import { Bar } from 'vue-chartjs';
import {Chart as ChartJS, Title, Tooltip, Legend, BarElement, CategoryScale, LinearScale, ArcElement} from 'chart.js';

ChartJS.register(Title, Tooltip, Legend, BarElement, CategoryScale, LinearScale, ArcElement);

const props= defineProps({
    data:{type:Object}
});

const reclamaciones = ref([]);
const motivos = ref([]);
const chartData = ref([]);
const chartOptions = ref([]);
const colors = ref([]);

const random = () => {
    return Math.floor(Math.random() * 256)
};

props.data.map( (row) => {
    motivos.value.push(row.nombre),
    reclamaciones.value.push(row.count),
    colors.value.push("rgb(" + random() +","+ random() +","+ random() +")")
});

chartOptions.value = {
    responsive: true,
    scales: {
        y: {
            suggestedMin: 0,
            suggestedMax: 15
        }
    }
};

chartData.value = {
    labels: motivos.value,
    datasets: [{label: 'Reclamaciones', data: reclamaciones.value, backgroundColor:colors}]
};

//******* Lifecycle Hooks *********//
onMounted(() => {
  console.log("Component was mounted: ",props.data);
  //el.value // <div>
})

</script>

<template>
    <Head title="Graficas" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Grafica</h2>
        </template>

        <div class="py-12">
            <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                   <Bar :data="chartData" :options="chartOptions"></Bar>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
