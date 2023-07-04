<script setup>

import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import DangerButton from '@/Components/DangerButton.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import SelectInput from '@/Components/SelectInput.vue';
import WarningButton from '@/Components/WarningButton.vue';
import SecondaryButton from '@/Components/PrimaryButton.vue';
import Modal from '@/Components/Modal.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import { nextTick,ref,onMounted } from 'vue';
import Swal from 'sweetalert2';
import VueTailwindPagination from '@ocrv/vue-tailwind-pagination';
import Button from 'primevue/button';
import InputText from 'primevue/inputtext';
import DataTable from 'primevue/datatable';
import Column from 'primevue/column';
import ColumnGroup from 'primevue/columngroup';   // optional
import Row from 'primevue/row';  
import Paginator from 'primevue/paginator';
import { FilterMatchMode } from 'primevue/api';

const codeInput = ref(null);
const modal = ref(false);
const title = ref('');
const operation = ref(1);
const id = ref('');
const reclamacionesObj = ref();
const paginatorPerPage = ref();
const paginatorTotal = ref();
const offset = ref(props.reclamaciones.per_page * props.reclamaciones.current_page - props.reclamaciones.per_page);

const filters = ref({
    global: { value: null, matchMode: FilterMatchMode.CONTAINS },
    codigo: { value: null, matchMode: FilterMatchMode.CONTAINS },    
    operacion: { value: null, matchMode: FilterMatchMode.CONTAINS },
    segmento: { value: null, matchMode: FilterMatchMode.CONTAINS },
    motivo: { value: null, matchMode: FilterMatchMode.CONTAINS },
    'country.name': { value: null, matchMode: FilterMatchMode.STARTS_WITH }
});


const columns = [
    { field: 'code', header: 'Code' },
    { field: 'segmento', header: 'Segmento' },
    { field: 'operacion', header: 'Operacion' },
    { field: 'motivo', header: 'Motivo' }
];

// Custom functions

const onPaginatePrimeVue = (e) => {
    console.log("paginating with PrimeVue",e);    
    formPage.get(route('reclamaciones.index',{page:e.page+1}));
    //offset.value = e.rows * e.page;
};

const test = (e) => {
    console.log("Testing Emit Events with PrimeVue",e);        
};

//
const props = defineProps({
    reclamaciones: {type:Object},
    motivos: {type:Object},
    perPagePagination : {type:Number}
});

const form = useForm({
    code: '',
    segmento: '',
    operacion: '',
    motivo_id: ''
});

const onPageClick = (event) => {
    formPage.get(route('reclamaciones.index',{page:event}));
};

const openModal = (op,code,segmento,operacion,motivo,reclamacion) => {
    
    modal.value = true;
    nextTick( () => codeInput.value.focus());
    operation.value = op;
    id.value = reclamacion;
    
    if(op == 1){

        title.value = 'Crear Reclamación';
    }else{
        title.value = 'Editar Reclamación';
        form.code = code;
        form.segmento = segmento;
        form.operacion = operacion;
        form.motivo_id = motivo;
    }

};

const closeModal = () => {
    modal.value = false;
    form.reset();
};

const save = () => {

    if(operation.value == 1){
        
        form.post(route('reclamaciones.store'),{
            onSuccess: () => {ok('Reclamacion creada correctamente!')}
        });

    }else{
        form.put(route('reclamaciones.update',id.value),{
            onSuccess: () => {ok('Reclamacion actualizada correctamente!')}
        });
    }
};

const ok = (msj) => {
    form.reset();
    closeModal(); // comment this line if you want to keep modal open after create a Reclamacion
    Swal.fire({
        title:msj,
        icon:'success'
    })
}

const formPage = useForm({});

const deleteReclamacion = (id,name) => {    
        const alerta = Swal.mixin({
            buttonsStyling: true
        });
        alerta.fire({
            title: 'Estas seguro de eliminar la reclamación: '+name+'?',
            icon: 'question', 
            showCancelButton: true,
            confirmButtonText: '<i class="fa-solid fa-check"><i> Si, eliminar',
            cancelButtonText: '<i class="fa-solid fa-ban"><i> Cancelar'         
        }).then((result) => {
            if(result.isConfirmed){
                form.delete(route('reclamaciones.destroy',id),{
                    onSuccess: () => {
                        products.value = props.reclamaciones.data;
                        ok('Reclamacion eliminada!');
                    }
                });
            }
        });
}


//******* Lifecycle Hooks *********//
onMounted(() => {
  reclamacionesObj.value = props.reclamaciones.data;
  paginatorPerPage.value = props.reclamaciones.per_page;
  paginatorTotal.value = props.reclamaciones.total;
  console.log("Component was mounted: ",props.reclamaciones.data);
  console.log("Component was mounted: ",props.reclamaciones);
  console.log("Motivos: ",props.motivos);
  console.log("Filtros: ",filters);  
  console.log("Reclamaciones: ",reclamacionesObj.value);  
  console.log("Pagination Info: ",props.reclamaciones.per_page);  
  console.log("offset: ",offset.value);
})



</script>

<template>

    <Head title="Reclamaciones" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Reclamaciones</h2>
        </template>
        <!--<div><Button label="Click To Get Started" icon="pi pi-check" iconPos="right"/></div>-->
        <div class="py-12">
            <div class="mx-auto sm:px-6 lg:px-8"> 

                <div class="px-6 py-6 bg-white overflow-hidden shadow-sm sm:rounded-lg text-gray-800 flex">
                    <div class="mt-3 mb-3 mr-3 flex">
                        <Link 
                            :href="route('reclamaciones.create')" 
                            :class="'px-4 py-2 bg-green-800 text-white border rounded-md font-semibold text-xs'"
                        >
                            <i class="fa-solid fa-plus-circle px-1"></i> Crear Reclamación
                        </Link>                 
                    </div>                  
                     <div class="mt-3 mb-3 flex">
                        <Link 
                            :href="route('reclamaciones.masiva')" 
                            :class="'px-4 py-2 bg-green-800 text-white border rounded-md font-semibold text-xs'"
                        >
                                <i class="fa-solid fa fa-upload px-1"></i> Carga Masiva
                        </Link>                 
                    </div>                       
                    <!--
                    <div class="mt-3 mb-3 flex"> 
                        <PrimaryButton @click="$event => openModal(1)" class="px-4 py-2 bg-green-800 text-white border rounded-md font-semibold text-xs">
                            <i class="fa-solid fa-plus-circle"></i> Carga masiva
                       </PrimaryButton>                   
                    </div>
                    -->
                </div>
                <!-- VUE PRIME -->
                 <div class="card">
                    <DataTable 
                        v-model:filters="filters" 
                        :value="reclamacionesObj"                         
                        dataKey="id" 
                        filterDisplay="row" 
                        :globalFilterFields="['code','operacion','segmento','motivo']">
                        <template #header>
                            <div class="flex justify-end">
                                <span class="p-input-icon-left">
                                    <i class="pi pi-search" />
                                    <InputText v-model="filters['global'].value" placeholder="Buscar" />
                                </span>
                            </div>
                        </template>

                        <template #empty> No existen reclamaciones en la busqueda. </template>
                                    
                                   
                        <Column header="Codigo" filterField="codigo" :showFilterMenu="false" :filterMenuStyle="{ width: '14rem' }" style="min-width: 14rem">
                            <template #body="{ data }">
                                <div class="flex align-items-center gap-2">                        
                                    <span>{{ data.code }}</span>
                                </div>
                            </template>                
                        </Column>        
                        <Column header="Operación" filterField="operacion" :showFilterMenu="false" :filterMenuStyle="{ width: '14rem' }" style="min-width: 14rem">
                            <template #body="{ data }">
                                <div class="flex align-items-center gap-2">                        
                                    <span>{{ data.operacion }}</span>
                                </div>
                            </template>                
                        </Column>        

                        <Column header="Segmento" filterField="segmento" :showFilterMenu="false" :filterMenuStyle="{ width: '14rem' }" style="min-width: 14rem">
                            <template #body="{ data }">
                                <div class="flex align-items-center gap-2">                        
                                    <span>{{ data.segmento }}</span>
                                </div>
                            </template>                
                        </Column> 

                        <Column header="Motivo" filterField="motivo" :showFilterMenu="false" :filterMenuStyle="{ width: '14rem' }" style="min-width: 14rem">
                            <template #body="{ data }">
                                <div class="flex align-items-center gap-2">                        
                                    <span>{{ data.motivo }}</span>
                                </div>
                            </template>                
                        </Column>      

                        <Column field="accion" header="">
                             <template #body="slotProps">
                              <WarningButton @click="$event => openModal(2,slotProps.data.code,slotProps.data.segmento,slotProps.data.operacion,slotProps.data.motivo_id,slotProps.data.id)">
                                    <i class="fa-solid fa-edit"></i>
                                </WarningButton>
                            </template>
                          </Column>  

                          <Column field="accion" header="">
                            <template #body="slotProps">
                                <DangerButton @click="$event => deleteReclamacion(slotProps.data.id,slotProps.data.code)">
                                    <i class="fa-solid fa-trash"></i> 
                                </DangerButton>                         
                            </template>
                            
                          </Column>    

                    </DataTable>
                    <Paginator
                        :rows="paginatorPerPage"
                        @page="onPaginatePrimeVue"
                        :totalRecords="paginatorTotal"  
                        :alwaysShow="false"
                        v-model:first="offset"
                      /> 
                </div>
                <!--
                <div id="primevue">
                   
                    <DataTable 
                        :value="products"
                        dataKey="id"
                        lazy                                           
                        :filters="filters"
                        tableStyle="max-width:100%;margin:auto;"
                    >
                        <template #header>
                            <div class="flex justify-end">
                                <span class="p-input-icon-left">
                                    <i class="pi pi-search" />
                                    <InputText v-model="filters['global'].value" placeholder="Keyword Search" />
                                </span>
                            </div> 
                        </template>                        
                        <Column :key="columns[0].field" :field="columns[0].field" :header="columns[0].header"></Column>
                        <Column v-for="col of columns" :key="col.field" :field="col.field" :header="col.header"></Column>
                        
                        <Column field="accion" header="">
                             <template #body="slotProps">
                              <WarningButton @click="$event => openModal(2,slotProps.data.code,slotProps.data.segmento,slotProps.data.operacion,slotProps.data.motivo_id,slotProps.data.id)">
                                    <i class="fa-solid fa-edit"></i>
                                </WarningButton>
                            </template>
                          </Column>                     
                          <Column field="accion" header="">
                            <template #body="slotProps">
                                <DangerButton @click="$event => deleteReclamacion(slotProps.data.id,slotProps.data.code)">
                                    <i class="fa-solid fa-trash"></i> 
                                </DangerButton>                         
                            </template>
                            
                          </Column>                     
                    </DataTable>
                     <Paginator
                        :rows="reclamaciones.per_page"                        
                        @page="onPaginatePrimeVue"
                        :totalRecords="reclamaciones.total"                    
                        :alwaysShow="false"
                        v-model:first="offset"
                      /> 
                </div>
                -->
                <!-- END VUE PRIME -->                            
            </div>
        </div>
        <Modal 
            :show="modal" 
            @close="closeModal"             
        >
            <h2 class="p-3 text-lg font.medium text-hray-900">{{title}}</h2>
            <div class="p-3 ">
                <InputLabel for="code" value="Codigo"></InputLabel>
                <TextInput 
                    id=name 
                    ref="codeInput"
                    v-model="form.code"
                    class="mt-1 block w-3/4"
                    type="text"
                    placeholder="Codigo"
                ></TextInput>
                <InputError :message="form.errors.name" class="mt-2"></InputError>
            </div>
            <div class="p-3 ">
                <InputLabel for="segmento" value="Segmento"></InputLabel>
                <TextInput 
                    id=segmento      
                    v-model="form.segmento"
                    class="mt-1 block w-3/4"
                    type="text"
                    placeholder="Segmento"
                ></TextInput>
                <InputError :message="form.errors.name" class="mt-2"></InputError>
            </div>
            <div class="p-3 ">
                <InputLabel for="operacion" value="Operación"></InputLabel>
                <TextInput 
                    id=operacion                     
                    v-model="form.operacion"
                    class="mt-1 block w-3/4"
                    type="text"
                    placeholder="Operación"
                ></TextInput>
                <InputError :message="form.errors.name" class="mt-2"></InputError>
            </div>
             <div class="p-3 ">                
                <InputLabel for="motivo_id" value="Motivo"></InputLabel>
                <SelectInput 
                    id=motivo_id                     
                    v-model="form.motivo_id"
                    class="mt-1 block w-3/4"                    
                    :options="motivos"
                ></SelectInput>
                <InputError :message="form.errors.name" class="mt-2"></InputError>
            </div>
             <div class="p-3 mt-6">                
                <PrimaryButton 
                    :disabled="form.processing"
                    @click="save"                                    
                >
                    <i class="fa-solid fa-save">Guardar</i>
                </PrimaryButton>                
            </div>
            <div class="p-3 mt-6 flex justify-end">                
                <SecondaryButton 
                    :disabled="form.processing"
                    class="ml-3"
                    @click="closeModal"
                >
                    Cancelar
                </SecondaryButton>                
            </div>
        </Modal>
    </AuthenticatedLayout>
</template>


