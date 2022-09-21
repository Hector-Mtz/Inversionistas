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
    import DataTable from 'datatables.net-vue3';

    var props = defineProps({
        usuarios:Object
    });
    
    const usuario = useForm
    ({
     name: '',
     email: '',
     rol: '',
     password:''
    });


    const enviarUsuario =   () => 
    {
        usuario.post(route('user.store'), 
       {
         onSuccess: () => closeModal(),
         onFinish: () => archivo.reset(),
       }); 
   }

   const editarUser = (id) => 
   {
      //console.log(id);
      actualizarUsuario.value = true;
      actualizaUser(id);
   }
   const actualizaUser = (id) =>
   {

     
   }


   //MODALES
    const nuevoUsuario = ref(false);
    const actualizarUsuario = ref(false);
    const  verModal2 =() => 
    {
        nuevoUsuario.value = true;
    };


    const closeModal = () => 
    {
        nuevoUsuario.value = false;
        actualizarUsuario.value=false;
    }
 
 
</script>
    
    <template>
        <AppLayout title="Dashboard">
            <template #header>
                <h2 class="text-xl font-semibold leading-tight text-gray-800">
                    Registro de usuarios
                </h2>
            </template>
    
            <div class="py-12">
                <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                    <div class="overflow-hidden bg-white shadow-xl sm:rounded-lg">
                        <PrimaryButton @click="verModal2" style="float:right; margin:1rem">
                            Nuevo Usuario
                        </PrimaryButton>
                        <DataTable id="table_id" class="display">
                             <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nombre</th>
                                <th>Correo</th>
                                <th>Editar</th>
                            </tr>
                        </thead>
                        <tbody>
                           <tr v-for="item in usuarios" :key="item.id">
                             <td>{{item.id}}</td>
                             <td>{{item.name}}</td>
                             <td>{{item.email}}</td>
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
        <ModalInver :show="nuevoUsuario" @close="closeModal">
                <template #title>
                    Agregar nuevo documento
                </template>

                <template #content>
                    <form @submit.prevent="enviarUsuario">
                        <InputLabel >Nombre de usuario</InputLabel>
                        <TextInput style="border:1px solid black" v-model="usuario.name" required></TextInput>
                        <InputLabel  >Email</InputLabel>
                        <TextInput style="border:1px solid black" required v-model="usuario.email"></TextInput>
                        <InputLabel required>Rol</InputLabel>
                        <select v-model="usuario.rol">
                        <!-- inline object literal -->
                          <option :value=" 1 ">1 Admin</option>
                          <option :value=" 2 ">2 Usuario</option>
                        </select>
                        <InputLabel>Contraseña</InputLabel>
                        <TextInput style="border:1px solid black" required v-model="usuario.password"></TextInput><br>
                        <button style="float:left;" class="mb-3 btn btn-primary" type="submit">Enviar</button>
                    </form>
                    <br>
                     <JetSecondaryButton style="float:right" @click="closeModal">
                        Cerrar
                     </JetSecondaryButton>
                </template>
        </ModalInver>  
        
        <ModalInver :show="actualizarUsuario" @close="closeModal">
                <template #title>
                    Editar Usuario
                </template>

                <template #content>
                    <form @submit.prevent="actualizaUser(id)">
                        <InputLabel >Nombre de usuario</InputLabel>
                        <TextInput style="border:1px solid black" v-model="usuario.name" required></TextInput>
                        <InputLabel  >Email</InputLabel>
                        <TextInput style="border:1px solid black" required v-model="usuario.email"></TextInput>
                        <InputLabel required>Rol</InputLabel>
                        <select v-model="usuario.rol">
                        <!-- inline object literal -->
                          <option :value=" 1 ">1 Admin</option>
                          <option :value=" 2 ">2 Usuario</option>
                        </select>
                        <InputLabel>Contraseña</InputLabel>
                        <TextInput style="border:1px solid black" required v-model="usuario.password"></TextInput><br>
                        <button style="float:left;" class="mb-3 btn btn-primary" type="submit">Enviar</button>
                    </form>
                    <br>
                     <JetSecondaryButton style="float:right" @click="closeModal">
                        Cerrar
                     </JetSecondaryButton>
                </template>
        </ModalInver>  
    </template>
    