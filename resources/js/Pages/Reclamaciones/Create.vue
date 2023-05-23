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
import flatpickr from "flatpickr";
import 'flatpickr/dist/themes/light.css';

const enabled = ref(false)

const props = defineProps({    
    motivos: {type:Object},
    servicios: {type:Object},
    redes: {type:Object},
    segmentos: {type:Object},
    operaciones: {type:Object}
});

const form = useForm({
    code: '',
    ot: '',
    id_venta: '',
    segmento: '',
    operacion: '',
    motivo_id: '',
    servicio_id: '',
    red_id: '',
    fecha: '',
    nit_rut: '',
    razon_social: '',
    comercial_id: '',
    aplica_min: enabled.value,
    min:'',
    valor_a_reclamar: '',
});

onMounted(() => {
    console.log("Motivos: ",props.motivos);
    console.log("Servicios: ",props.servicios);
    console.log("Redes: ",props.redes);
    console.log("Segmentos: ",props.segmentos);
    console.log("Operaciones: ",props.operaciones);

    flatpickr(".flatpickr",{});
})

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
                        class="mt-6 flex flex-wrap space-y-4">  
                            <div class="w-1/3 px-4 mt-4">
                                <InputLabel for="motivo_id" value="Motivo"></InputLabel>
                                <SelectInput 
                                    id=motivo_id                     
                                    v-model="form.motivo_id"
                                    class="mt-1 block w-full"                    
                                    :options="motivos"
                                ></SelectInput>
                                <InputError :message="form.errors.motivo_id" class="mt-2"></InputError>  
                            </div>                         
                            <div class="w-1/3 px-4">
                                <InputLabel for="operacion" value="Operación"></InputLabel>
                                <SelectInput 
                                    id=operacion                     
                                    v-model="form.operacion"
                                    class="mt-1 block w-full"                    
                                    :options="operaciones"
                                ></SelectInput>
                                <InputError :message="form.errors.operacion" class="mt-2"></InputError>
                            </div>

                            <div class="w-1/3 px-4">
                                <InputLabel for="segmento" value="Segmento"></InputLabel>
                                <SelectInput 
                                    id=segmento                     
                                    v-model="form.segmento"
                                    class="mt-1 block w-full"                    
                                    :options="segmentos"    
                                ></SelectInput>
                                <InputError :message="form.errors.segmento" class="mt-2"></InputError>  
                            </div>                                                                         

                            <div class="w-1/3 px-4">
                                <InputLabel for="razon_social" value="Razon Social"></InputLabel>
                                <TextInput id="razon_social" v-model="form.razon_social" autofocus
                                    type="text"
                                    class="mt-1 block w-full"
                                ></TextInput>
                                <InputError :message="form.errors.razon_social" class="mt-2"></InputError>
                             </div>                              

                             <div class="w-1/3 px-4">
                                <InputLabel for="servicio_id" value="Servicio"></InputLabel>
                                <SelectInput 
                                    id=servicio_id                     
                                    v-model="form.servicio_id"
                                    class="mt-1 block w-full"                    
                                    :options="servicios"
                                ></SelectInput>
                                <InputError :message="form.errors.servicio_id" class="mt-2"></InputError> 
                            </div>

                            <div class="w-1/3 px-4">
                                <InputLabel for="red_id" value="Red"></InputLabel>
                                <SelectInput 
                                    id=red_id                     
                                    v-model="form.red_id"
                                    class="mt-1 block w-full"                    
                                    :options="redes"
                                ></SelectInput>
                                <InputError :message="form.errors.red_id" class="mt-2"></InputError> 
                            </div>
                            
                            <div class="w-1/3 px-4">
                                <InputLabel for="fecha" value="Fecha"></InputLabel>
                                <input type="date" id=fecha v-model="form.fecha" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full flatpickr">
                                <InputError :message="form.errors.fecha" class="mt-2"></InputError>
                            </div>                            

                             <div class="w-1/3 px-4">
                                <InputLabel for="nit_rut" value="NIT/RUT"></InputLabel>
                                <TextInput id="nit_rut" v-model="form.nit_rut" autofocus
                                    type="text"
                                    class="mt-1 block w-full"
                                ></TextInput>
                                <InputError :message="form.errors.nit_rut" class="mt-2"></InputError>  
                            </div>                            

                            <div class="w-1/3 px-4">
                                <InputLabel for="ot" value="OT"></InputLabel>
                                <TextInput id="ot" v-model="form.ot" autofocus
                                    type="text"
                                    class="mt-1 block w-full"
                                ></TextInput>
                                <InputError :message="form.errors.nit_rut" class="mt-2"></InputError>  
                            </div>

                            <div class="w-1/3 px-4">
                                <InputLabel for="id_venta" value="ID Venta"></InputLabel>
                                <TextInput id="id_venta" v-model="form.id_venta" autofocus
                                    type="text"
                                    class="mt-1 block w-full"
                                ></TextInput>
                                <InputError :message="form.errors.nit_rut" class="mt-2"></InputError>  
                            </div>

                             <div class="w-1/3 px-4">
                                <InputLabel for="valor_a_reclamar" value="Valor a Reclamar"></InputLabel>
                                <input id="valor_a_reclamar" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-full" type="number" v-model="form.valor_a_reclamar" />
                            </div>                           


                            <div class="w-1/5 px-4 flex flex-row items-center min-h-[75px]">                                
                                <Switch
                                    id="aplica_min"
                                    v-model="enabled"
                                    :class="enabled ? 'bg-blue-600' : 'bg-gray-200'"
                                    class="relative inline-flex h-6 w-11 items-center rounded-full mt-2 mr-2"
                                  >
                                    <span class="sr-only">Enable notifications</span>
                                    <span
                                      :class="enabled ? 'translate-x-6' : 'translate-x-1'"
                                      class="inline-block h-4 w-4 transform rounded-full bg-white transition"
                                    />
                                </Switch>
                                <InputLabel for="aplica_min" value="Aplica Min" class=""></InputLabel>
                            </div>
                            <div v-if="enabled"  class="w-2/3 px-4">
                                <InputLabel for="min" value="Min"></InputLabel>
                                <TextInput id="min" v-model="form.min" autofocus 
                                    type="text"
                                    class="mt-1 block w-full"
                                ></TextInput>
                                <InputError :message="form.errors.min" class="mt-2"></InputError> 
                            </div>
                            <div class="w-full flex justify-center px-1 py-12">
                                <PrimaryButton :disabled="form.processing">
                                    <i class="fa-solid fa-save"></i> <p class="px-4">Crear</p> 
                                </PrimaryButton>
                            </div>
                    </form>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
