<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import Welcome from '@/Components/Welcome.vue';


var props = defineProps({
    users:Object
});

</script>



<template>
    <AppLayout title="Dashboard" :users="users">
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                Documentos
            </h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="overflow-hidden bg-white shadow-xl sm:rounded-lg">
                    Tipo de archivos
                    <div>

                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
