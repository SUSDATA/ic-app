<script setup>
    
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import InputLabel from '@/Components/InputLabel.vue';
import SelectInput from '@/Components/SelectInput.vue';
import { ref, onMounted } from 'vue';
import { Head } from '@inertiajs/vue3';
import DataTable from 'datatables.net-vue3';
import 'datatables.net-dt/css/jquery.dataTables.css';
import ButtonsHtml5 from 'datatables.net-buttons/js/buttons.html5';
import 'datatables.net-buttons/js/buttons.html5';
import 'datatables.net-responsive-dt';
import 'datatables.net-responsive-dt/css/responsive.dataTables.min.css';
import JsZip from 'jszip';
import pdfMake from 'pdfmake/build/pdfmake';
import * as pdfFonts from 'pdfmake/build/vfs_fonts';

pdfMake.vfs = pdfFonts.pdfMake ? pdfFonts.pdfMake.vfs : pdfMake.vfs;

window.JSZip = JsZip;
DataTable.use(ButtonsHtml5);

const props = defineProps({
    motivos:{type:Object},
    reclamaciones:{type:Object}
});

const columns1 = ref([]);
const columns2 = ref([]);
const buttons1 = ref([]);
const buttons2 = ref([]);
const report = ref('1');
const types = ref([
    {
        'id': '1',
        'nombre': 'Reclamaciones'   
    },
    {
        'id': '2',
        'nombre': 'Motivos'   
    }
]);

columns1.value = [
    {
        data:null,
        render:function(data,type,row,meta){return (meta.row + 1)}
    },
    {data: 'code'},
    {data: 'segmento'},
    {data: 'operacion'},
    {data: 'motivo'}

]

columns2.value = [
    {
        data:null,
        render:function(data,type,row,meta){return (meta.row + 1)}
    },
    {data: 'nombre'}

]

buttons1.value = [
    {
        title:'Reclamaciones',
        extend: 'excelHtml5', 
        text:'<i class="fa-solid fa-file-excel"></i>Excel',
        className: 'inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700 focus:bg-green-700 active:bg-green-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150'
    },
    {
        title:'Reclamaciones',
        extend: 'pdfHtml5', 
        text:'<i class="fa-solid fa-file-pdf"></i>PDF',
        className: 'inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 active:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition ease-in-out duration-1502'
    },
    {
        title:'Reclamaciones',
        extend: 'copy', 
        text:'<i class="fa-solid fa-file-copy"></i>Copiar',
        className: 'inline-flex items-center px-4 py-2 bg-gray-200 border border-gray-800 rounded-md font-semibold text-xs uppercase tracking-widest hover:bg-gray-500 active:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition ease-in-out duration-1502'
    }
]

buttons2.value = [
    {
        title:'Motivos',
        extend: 'excelHtml5', 
        text:'<i class="fa-solid fa-file-excel"></i>Excel',
        className: 'inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700 focus:bg-green-700 active:bg-green-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150'
    },
    {
        title:'Motivos',
        extend: 'pdfHtml5', 
        text:'<i class="fa-solid fa-file-pdf"></i>PDF',
        className: 'inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 active:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition ease-in-out duration-1502'
    },
    {
        title:'Motivos',
        extend: 'copy', 
        text:'<i class="fa-solid fa-file-copy"></i>Copiar',
        className: 'inline-flex items-center px-4 py-2 bg-gray-200 border border-gray-800 rounded-md font-semibold text-xs uppercase tracking-widest hover:bg-gray-500 active:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition ease-in-out duration-1502'
    }
]


//******* Lifecycle Hooks *********//
onMounted(() => {
  console.log("Component was mounted: ",report);
  //el.value // <div>
})

</script>

<template>
    <Head title="Reportes" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Reportes</h2>
        </template>        
        <div class="py-12">
            <div class="mx-auto sm:px-6 lg:px-8">
                <div class="px-6 py-6 bg-white overflow-hidden shadow-sm sm:rounded-lg text-gray-800">
                   <InputLabel for="rep" value="Reporte:"></InputLabel>
                   <SelectInput 
                        id=rep                
                        v-model="report"
                        class="mt-1 block w-2/4"                    
                        :options="types"
                    ></SelectInput>
                </div>
                <div v-if="report=='1'" class="px-6 py-6 bg-white overflow-hidden shadow-sm sm:rounded-lg text-gray-800">
                    <DataTable 
                        :data="reclamaciones" 
                        :columns="columns1" 
                        class="w-full border border-gray-400"
                        :options="{responsive:true, autoWidth:false, dom:'Bfrtip', buttons:buttons1}"
                    >
                        <thead>
                            <tr class="bg-gray-100">
                                <th class="px-2 py-2">#</th>
                                <th class="px-2 py-2">Code</th>
                                <th class="px-2 py-2">Segmento</th>
                                <th class="px-2 py-2">Operación</th>
                                <th class="px-2 py-2">Motivo</th>
                            </tr>
                        </thead>
                    </DataTable>
                </div>
                <div v-else class="px-6 py-6 bg-white overflow-hidden shadow-sm sm:rounded-lg text-gray-800">
                    <DataTable 
                        :data="motivos" 
                        :columns="columns2" 
                        class="w-full border border-gray-400"
                        :options="{responsive:true, autoWidth:false, dom:'Bfrtip', buttons:buttons2}"
                    >
                        <thead>
                            <tr class="bg-gray-100">
                                <th class="px-2 py-2">#</th>
                                <th class="px-2 py-2">Nombre</th>                                
                            </tr>
                        </thead>
                    </DataTable>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
