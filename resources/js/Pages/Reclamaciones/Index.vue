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

const codeInput = ref(null);
const modal = ref(false);
const title = ref('');
const operation = ref(1);
const id = ref('');

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
                    onSuccess: () => ok('Reclamacion eliminada!')
                });
            }
        });
}
//******* Lifecycle Hooks *********//
onMounted(() => {
  console.log("Component was mounted: ",props.reclamaciones.data);
})


</script>

<template>

    <Head title="Reclamaciones" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Reclamaciones</h2>
        </template>

        <div class="py-12">
            <div class="mx-auto sm:px-6 lg:px-8">            
                <div class="px-6 py-6 bg-white overflow-hidden shadow-sm sm:rounded-lg text-gray-800">
                    <div class="mt-3 mb-3 flex">
                        <Link 
                            :href="route('reclamaciones.create')" 
                            :class="'px-4 py-2 bg-green-800 text-white border rounded-md font-semibold text-xs'"
                        >
                            <i class="fa-solid fa-plus-circle"></i> Crear Reclamación
                        </Link>                 
                    </div>
                    <div class="mt-3 mb-3 flex"> 
                        <PrimaryButton @click="$event => openModal(1)" class="px-4 py-2 bg-green-800 text-white border rounded-md font-semibold text-xs">
                            <i class="fa-solid fa-plus-circle"></i> Crear Reclamación
                       </PrimaryButton>                   
                    </div>
                </div>
                <div class="px-6 py-6 bg-white overflow-hidden shadow-sm sm:rounded-lg text-gray-800">
                    <table class="table-auto border border-gray-400 w-full">
                    <thead>
                        <tr class="bg-gray-100">
                            <th class="px-2 py-2">#</th>
                            <th class="px-2 py-2">Code</th>
                            <th class="px-2 py-2">Segmento</th>
                            <th class="px-2 py-2">Operación</th>
                            <th class="px-2 py-2">Motivo</th>
                            <th class="px-2 py-2"></th>
                            <th class="px-2 py-2"></th>
                        </tr>
                    </thead>
                    <tbody>                 
                        <tr v-for="rec, i in reclamaciones.data" :key="rec.id">
                            <td class="border border-gray-400 px-2 py-2">{{ i+1 }}</td>
                            <td class="border border-gray-400 px-2 py-2">{{ rec.code }}</td>
                            <td class="border border-gray-400 px-2 py-2">{{ rec.segmento }}</td>
                            <td class="border border-gray-400 px-2 py-2">{{ rec.operacion }}</td>
                            <td class="border border-gray-400 px-2 py-2">{{ rec.motivo }}</td>
                            <td class="border border-gray-400 px-2 py-2">
                                <WarningButton @click="$event => openModal(2,rec.code,rec.segmento,rec.operacion,rec.motivo_id,rec.id)">
                                    <i class="fa-solid fa-edit"></i>
                                </WarningButton>
                            </td>               
                            <td class="border border-gray-400 px-2 py-2">
                                <DangerButton @click="$event => deleteReclamacion(rec.id,rec.code)">
                                    <i class="fa-solid fa-trash"></i> 
                                </DangerButton>
                            </td>                       
                        </tr>
                    </tbody>
                    </table>
                </div>
                <div class="bg-white grid v-screen place-items-center">                
                    <VueTailwindPagination                    
                        :current="reclamaciones.currentPage" 
                        :total="reclamaciones.total"      
                        :per-page="reclamaciones.data.length"
                        @page-changed="$event => onPageClick($event)"
                    ></VueTailwindPagination>                
                </div>                
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


