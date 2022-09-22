<script setup>
    import AppLayout from '@/Layouts/AppLayout.vue';
    import Welcome from '@/Components/Welcome.vue';
    import PrimaryButtonVue from '../../Components/PrimaryButton.vue';
    import PrimaryButton from './Components/PrimaryButton.vue';
    import { Head, Link, useForm } from '@inertiajs/inertia-vue3';
    import { onMounted, ref, watch } from 'vue';
    import ModalInver from './Components/ModalInver.vue';
    import InputLabel from '../../../../vendor/laravel/jetstream/stubs/inertia/resources/js/Components/InputLabel.vue';
    import TextInput from '../../../../vendor/laravel/jetstream/stubs/inertia/resources/js/Components/TextInput.vue';
    import * as axios from 'axios';
    import SecondaryButton from '../../../../vendor/laravel/jetstream/stubs/inertia/resources/js/Components/SecondaryButton.vue';
    import DataTable from 'datatables.net-vue3';

    var props = defineProps({
        tipoArchivos:Object,
        archivos: Object
    });
    
    //sincro
    const archivo = useForm
    ({
    nombreArchivo: '',
    descripcion: '',
    status: '1',
    archivo:null,
    autor:'',
    tipo_archivo:''
    });

    for (let index = 0; index < props.archivos.length; index++) {
        console.log(props.archivos[index]);
        props.archivos[index].archivo
        props.archivos[index].archivo = "storage/archivos/"+props.archivos[index].archivo.slice(16);
    }

    const fileUpload = ref(null);

    const selectNewFile = () => 
    {
        fileUpload.value.click();
    };

    const uploadFile = () =>
    {
      const file = fileUpload.value.files[0];
      archivo.archivo = file;
      console.log(archivo);
    };

    const enviarArchivo =   () => 
    {
        let fields = new FormData();
        for (let key in archivo)
        {
            console.log(archivo[key]);
            fields.append(key, archivo[key]);     
        }
        archivo.post(route('archivo.store'), 
       {
         onSuccess: () => closeModal(),
         onFinish: () => archivo.reset(),
       }); 
   }
   
   //MODALES
    const nuevoArchivo = ref(false);
    const  verModal1 =() => 
    {
        nuevoArchivo.value = true;
    };

    const closeModal = () => 
    {
        nuevoArchivo.value = false;
    }
</script>
    
    <template>
        <AppLayout title="Dashboard">
            <template #header>
                <h2 class="text-xl font-semibold leading-tight text-gray-800">
                    Subida de archvios
                </h2>
            </template>
    
            <div class="py-12">
                <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                    <div class="overflow-hidden bg-white shadow-xl sm:rounded-lg">
                        <PrimaryButton @click="verModal1" style="float:right; margin:2rem">
                            Nuevo documento
                        </PrimaryButton>
                        <DataTable id="table_id" class="display" style="margin:2rem;">
                             <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nombre de archivo</th>
                                <th>Descripcion</th>
                                <th>Autor</th>
                                <th>Archivo</th>
                                <th>Editar</th>
                            </tr>
                        </thead>
                        <tbody>
                           <tr v-for="item in archivos" :key="item.id">
                             <td>{{item.id}}</td>
                             <td>{{item.nombreArchivo}}</td>
                             <td>{{item.descripcion}}</td>
                             <td>{{item.autor}}</td>
                             <td>
                                <PrimaryButton>
                                    <a :href="item.archivo">Descargar Archivo</a>
                                </PrimaryButton>
                                
                             </td>
                             <td>
                                <PrimaryButton @click="editarUser(item.id)">Editar</PrimaryButton>
                             </td>
                           </tr>
                        </tbody>
                    </DataTable>
                    </div>
                </div>
            </div>
        </AppLayout>
        
        <ModalInver :show="nuevoArchivo" @close="closeModal">
                <template #title>
                    Agregar nuevo documento
                </template>

                <template #content>
                    <form @submit.prevent="enviarArchivo">
                        <InputLabel >Nombre de archivo</InputLabel>
                        <TextInput style="border:1px solid black" v-model="archivo.nombreArchivo" required></TextInput>
                        <InputLabel  >Descripcion</InputLabel>
                        <TextInput style="border:1px solid black" required v-model="archivo.descripcion"></TextInput>
                        <InputLabel >Autor</InputLabel>
                        <TextInput style="border:1px solid black" v-model="archivo.autor" required></TextInput>
                        <InputLabel>Tipo de archivo</InputLabel>
                        <select v-model="archivo.tipo_archivo" >
                            <option  v-for="item in tipoArchivos" :key="item.id" :value="item.id">{{item.nombreTipoArchivo}}</option>
                        </select>
                        
                        <InputLabel required>Archivo</InputLabel>
                        <input type="file" enctype="multipart/form-data"
                         ref="fileUpload"
                         @change="uploadFile">
                        <PrimaryButton style="float:right;" class="mb-3 btn btn-primary" type="submit">Enviar</PrimaryButton>
                    </form>
                    
                     <SecondaryButton  @click="closeModal">
                        Cerrar
                     </SecondaryButton>
                </template>
        </ModalInver>
    </template>
    