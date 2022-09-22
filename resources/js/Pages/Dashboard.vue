<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import Welcome from '@/Components/Welcome.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import axios from 'axios';
import { onMounted, ref, watch } from 'vue';
import { Head, Link, useForm } from '@inertiajs/inertia-vue3';
import ModalInver from './Inversionistas/Components/ModalInver.vue';
import SecondaryButton from '../../../vendor/laravel/jetstream/stubs/inertia/resources/js/Components/SecondaryButton.vue';
import TextInput from '../../../vendor/laravel/jetstream/stubs/inertia/resources/js/Components/TextInput.vue';
import InputLabel from '../../../vendor/laravel/jetstream/stubs/inertia/resources/js/Components/InputLabel.vue';
//import ButtonCalendar from './Inversionistas/Components/ButtonCalendar.vue';

var props = defineProps({
    users:Object,
    tipoArchivos:Object,
    archivos:Object
});

for (let index = 0; index < props.archivos.length; index++) {
        console.log(props.archivos[index]);
        props.archivos[index].archivo
        props.archivos[index].archivo = "storage/archivos/"+props.archivos[index].archivo.slice(16);
    }

const filtro = (id,nombre) =>
{
    props.archivos = [];
    
}


const cat = useForm
    ({
      nombreTipoArchivo: '',
    });



const enviatCat = () =>
{
    cat.post(route('tipoArchivo.store'), 
       {
         onSuccess: () => closeModal(),
         onFinish: () => cat.reset(),
       }); 
}

 //MODALES
const agregarCategoria = ref(false);

const abrirModalAdd = () =>
{
    agregarCategoria.value = true;
}
const closeModal = () => 
{
  agregarCategoria.value = false; 
}

</script>
<template>
    <AppLayout title="Dashboard" :users="users">
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                Proyecto camiones de patio
            </h2>
        </template>
        
        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="overflow-hidden bg-white shadow-xl sm:rounded-lg">
                    <div class="row" style="flex-direction: row-reverse;">
                        <PrimaryButton @click="abrirModalAdd" style="float:right; margin:2rem; width: auto;" > Agregar nueva categoria</PrimaryButton>
                    </div>
                    
                    <div class="row">
                        <div class="col-2" style="float:left;margin-left: 1rem;" v-for="item in tipoArchivos" :key="item.id">
                          <PrimaryButton @click="filtro(item.id,item.nombreTipoArchivo)" >
                            {{item.nombreTipoArchivo}}
                          </PrimaryButton>
                        </div>  
                    </div> 

                    <div class="card" style="width: 18rem; margin:2rem; margin-top: 2rem; float:left" v-for="item in archivos" :key="item.id">  
                       <div class="card-body">
                         <h5 class="card-title" style="font-weight: bold;font-size: 2rem;">{{item.nombreArchivo}}</h5>
                         <p class="card-text">
                            <strong>Descripcion: </strong>{{item.descripcion}}
                         </p>
                         <PrimaryButton>
                            <a :href="item.archivo">Descargar Archivo</a>
                        </PrimaryButton>
                      </div>
                   </div>
                
                </div>
            </div>
        </div>
    </AppLayout>

    <ModalInver :show="agregarCategoria" @close="closeModal">
                <template #title>
                    Agregar nueva categoria
                </template>

                <template #content>
                    <form @submit.prevent="enviatCat()">
                        <InputLabel >Nombre de categoria</InputLabel>
                        <TextInput style="border:1px solid black" v-model="cat.nombreTipoArchivo" required></TextInput>
                        <PrimaryButton style="float:right;" class="mb-3 btn btn-primary" type="submit">Enviar</PrimaryButton>
                    </form>
                    
                     <SecondaryButton  @click="closeModal">
                        Cerrar
                     </SecondaryButton>
                </template>
        </ModalInver>
</template>
