<script setup>

import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import DangerButton from '@/Components/DangerButton.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import Swal from 'sweetalert2';

const props = defineProps({
	motivos: {type:Object},
	test: {type:String}
});
const form = useForm({
	id: ''
});
const deleteMotivoReclamacion = (id,name) => {
		const alerta = Swal.mixin({
			buttonsStyling: true
		});
		alerta.fire({
			title: 'Estas seguro de eliminar '+name+'?',
			icon: 'question', 
			showCancelButton: true,
			confirmButtonText: '<i class="fa-solid fa-check"><i> Si, eliminar',
			cancelButtonText: '<i class="fa-solid fa-ban"><i> Cancelar'			
		}).then((result) => {
			if(result.isConfirmed){
				form.delete(route('motivosReclamaciones.destroy',id));
			}
		});
}

</script>

<template>
    <Head title="Motivos" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Motivos de Reclamaciones</h2>
        </template>

        <div class="py-12">
            <div class="bg-white grid v-screen place-items-center">
                <div class="mt-3 mb-3 flex">
                    <Link 
						:href="route('motivosReclamaciones.create')" 
						:class="'px-4 py-2 bg-green-800 text-white border rounded-md font-semibold text-xs'"
					> 
						<i class="fa-solid fa-plus-circle"></i> Crear Motivo de Reclamación
					</Link>
					
					
                </div>
            </div>
			<div class="bg-white grid v-screen place-items-center">
                <table class="table-auto border border-gray-400">
				<thead>
					<tr class="bg-gray-100">
						<th class="px-4 py-4">#</th>
						<th class="px-4 py-4">Motivo de Reclamación</th>
						<th class="px-4 py-4"></th>
						<th class="px-4 py-4"></th>
					</tr>
				</thead>
				<tbody>					
					<tr v-for="motiv, i in motivos" :key="motiv.id">
						<td class="border border-gray-400 px-4 py-4">{{ i+1 }}</td>
						<td class="border border-gray-400 px-4 py-4">{{ motiv.nombre }}</td>
						<td class="border border-gray-400 px-4 py-4">
							<Link 
								:href="route('motivosReclamaciones.edit',motiv.id)" 
								:class="'px-4 py-2 bg-yellow-800 text-white border rounded-md font-semibold text-xs'"
							> 
								<i class="fa-solid fa-edit"></i> 
							</Link>
						</td>				
						<td class="border border-gray-400 px-4 py-4">
							<DangerButton @click="$event => deleteMotivoReclamacion(motiv.id,motiv.nombre)">
								<i class="fa-solid fa-trash"></i> 
							</DangerButton>
						</td>						
					</tr>
				</tbody>
				</table>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
