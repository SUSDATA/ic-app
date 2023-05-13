<script setup>

import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import DangerButton from '@/Components/DangerButton.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import Swal from 'sweetalert2';

const props = defineProps({
	servicios: {type:Object},
	test: {type:String}
});
const form = useForm({
	id: ''
});

const ok = (msj) => {
    form.reset();
    //closeModal(); // comment this line if you want to keep modal open after create a Reclamacion
    Swal.fire({
        title:msj,
        icon:'success'
    })
}

const deleteServicio = (id,name) => {
		const alerta = Swal.mixin({
			buttonsStyling: true
		});
		alerta.fire({
			title: 'Estas seguro de eliminar el servicio: '+name+'?',
			icon: 'question', 
			showCancelButton: true,
			confirmButtonText: '<i class="fa-solid fa-check"><i> Si, eliminar',
			cancelButtonText: '<i class="fa-solid fa-ban"><i> Cancelar'			
		}).then((result) => {
			if(result.isConfirmed){
				form.delete(route('sercivio.destroy',id),{
                    onSuccess: () => ok('servicio eliminado!')
                });
			}
		});
}
</script>

<template>
    <Head title="Servicio" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Servicio</h2>
        </template>

        <div class="py-12">
            <div class="mx-auto sm:px-6 lg:px-8">
            	<div class="px-6 py-6 bg-white overflow-hidden shadow-sm sm:rounded-lg text-gray-800">
            		<div class="mt-3 mb-3 flex">
	                    <Link 
							:href="route('servicio.create')" 
							:class="'px-4 py-2 bg-green-800 text-white border rounded-md font-semibold text-xs'"
						> 
							<i class="fa-solid fa-plus-circle"></i>Crear Servicio
						</Link>					
	                </div>
            	</div>        
            
				<div class="px-6 py-6 bg-white overflow-hidden shadow-sm sm:rounded-lg text-gray-800">
	                <table class="table-auto border border-gray-400 w-full">
					<thead>
						<tr class="bg-gray-100">
							<th class="px-2 py-2">#</th>
							<th class="px-2 py-2">Servicio</th>
							<th class="px-2 py-2">Descripción</th>
							<th class="px-2 py-2"></th>
							<th class="px-2 py-2"></th>
						</tr>
					</thead>
					<tbody>					
						<tr v-for="serv, i in servicios" :key="serv.id">
							<td class="border border-gray-400 px-2 py-2">{{ i+1 }}</td>
							<td class="border border-gray-400 px-2 py-2">{{ serv.nombre_a_mostrar }}</td>
							<td class="border border-gray-400 px-2 py-2">{{ serv.descripcion }}</td>
							<td class="border border-gray-400 px-2 py-2">
								<Link 
									:href="route('servicio.edit',serv.id)" 
									:class="'px-4 py-2 bg-yellow-800 text-white border rounded-md font-semibold text-xs'"
								> 
									<i class="fa-solid fa-edit"></i> 
								</Link>
							</td>				
							<td class="border border-gray-400 px-2 py-2">
								<DangerButton @click="$event => deleteServicio(serv.id,serv.nombre_a_mostrar)">
									<i class="fa-solid fa-trash"></i> 
								</DangerButton>
							</td>						
						</tr>
					</tbody>
					</table>
	            </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
