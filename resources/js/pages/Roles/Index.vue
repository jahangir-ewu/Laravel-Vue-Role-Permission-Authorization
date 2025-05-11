<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head, Link, useForm } from '@inertiajs/vue3';
import { toast } from 'vue3-toastify';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Roles',
        href: '/roles',
    },
];
const form = useForm({
});
   

const props = defineProps({
    roles: {
        type: Array,
        required: true,
    },
});

function deleteItem(id) {
    if (confirm('Are you sure you want to delete this role?')) {
        form.delete(route('roles.destroy', id), {
            onSuccess: () => {
                //Inertia.reload();
                toast.success('Role deleted successfully!');

            },
            onError: (errors) => {
                console.error('Error deleting role:', errors);
            },
        });
        //console.log(`role with ID ${roleId} deleted`);
        //Inertia.reload();
        // or use a toast notification to inform the role   
    }
}

</script>

<template>
    <Head title="Roles" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex flex-col gap-6 p-6">
            <!-- Header Section -->
            <div class="flex justify-between items-center">
                <h1 class="text-2xl font-semibold text-gray-800">Role List</h1>
                <div class="flex gap-3">
                    <button class="inline-flex items-center px-4 py-2 bg-gray-100 text-gray-700 text-sm font-medium rounded-md hover:bg-gray-200 transition">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h3.28a1 1 0 01.948.684l.618 1.848a1 1 0 00.948.684h6.292a1 1 0 01.948.684l.618 1.848a1 1 0 01-.948 1.316H4a1 1 0 01-1-1V4z" />
                        </svg>
                        Filter
                    </button>
                    <Link href="/roles/create" class="inline-flex items-center px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-md hover:bg-blue-700 transition">
                        + Create Role
                    </Link>
                </div>
            </div>

            <!-- Table Section -->
            <div class="overflow-x-auto bg-white shadow rounded-lg">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No. Users</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Permissions</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        <tr v-for="role in roles" :key="role.id">
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ role.name }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">07</td>
                           <td class="px-6 py-4 text-sm text-gray-900 w-1/3 align-top">
                                <div class="flex flex-wrap gap-1">
                                    <span
                                        v-for="permission in role.permissions"
                                        :key="permission.id"
                                        class="bg-blue-100 text-blue-800 text-xs font-semibold px-2.5 py-0.5 rounded-full break-all"
                                    >
                                        {{ permission.name }}
                                    </span>
                                </div>
                            </td>

                            <td class ="px-6 py-4 whitespace-nowrap text-sm text-gray-900"> Status </td>
                            <!-- <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                <span :class="role.status ? 'text-green-600' : 'text-red-600'">
                                    {{ role.status ? 'Active' : 'Inactive' }}
                                </span>
                            </td> -->
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                <Link :href="`/roles/${role.id}/edit`" class="text-blue-600 hover:text-blue-900">Edit</Link>
                                <button @click="deleteItem(role.id)" class="text-red-600 hover:text-red-900 ml-4">Delete</button>
                            </td>
                        </tr>
                        <tr v-if="roles.length === 0">
                            <td colspan="3" class="text-center py-6 text-gray-500">No roles found.</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </AppLayout>
</template>
