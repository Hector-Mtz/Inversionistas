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

    var props = defineProps({});
    
    const archivo = useForm
    ({
    nombreArchivo: '',
    descripcion: '',
    status: '1',
    archivo:null,
    autor:''
    });

    const fileInput = ref(null);

    const enviarArchivo =   () => 
    {
       if(fileInput.value)
       {
         archivo.archivo = fileInput.value.files[0];
       }
        console.log(archivo.archivo);

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
                        <PrimaryButton @click="verModal1" style="float:right">
                            Nuevo documento
                        </PrimaryButton>
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
                        <InputLabel required>Archivo</InputLabel>
                        <input type="file" enctype="multipart/form-data"
                         @change="previewFiles"
                         @input="archivo.archivo = $event.target.files[0]"
                         ref="fileInput">
                         <br>
                        <button style="float:right;" class="mb-3 btn btn-primary" type="submit">Enviar</button>
                    </form>
                    
                     <JetSecondaryButton  @click="closeModal">
                        Cerrar
                     </JetSecondaryButton>
                </template>
        </ModalInver>
    </template>
    