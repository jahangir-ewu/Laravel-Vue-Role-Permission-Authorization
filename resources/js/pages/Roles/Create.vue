<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head, Link, useForm, usePage } from '@inertiajs/vue3';
import { toast } from 'vue3-toastify';
import { computed } from 'vue';

const page = usePage();

const breadcrumbs: BreadcrumbItem[] = [
    { title: 'Dashboard', href: '/' },
    { title: 'Roles', href: '/roles' },
    { title: 'Create', current: true },
];

const props = defineProps<{
    permissions: Record<string, Array<{ id: number; name: string }>>;
}>();


// Permissions grouped by module (from backend)
const groupedPermissions = computed(() => props.permissions);

const form = useForm({
    name: '',
    guard_name: 'web',
    status: 'active',
    permissions: [] as number[],
});

function submit() {
    form.post(route('roles.store'), {
        onSuccess: () => {
            form.reset();
            toast.success('Role created successfully!');
        },
        onError: (errors) => {
            console.error('Form submission error:', errors);
        },
    });
}
</script>

<template>
    <Head title="Create Role" />
    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex flex-col gap-6 p-6">
            <!-- Header Section -->
            <div class="flex justify-between items-center">
                <h1 class="text-2xl font-semibold text-gray-800">Create Role</h1>
                <Link href="/roles" class="text-sm text-blue-600 hover:underline">← Back to Roles</Link>
            </div>

            <!-- Form Card -->
            <div class="bg-white shadow-md rounded-2xl p-8 max-w-4xl w-full mx-auto">
                <h2 class="text-lg font-semibold text-gray-800 mb-4">Role Information</h2>
                <form @submit.prevent="submit" class="space-y-6">

                    <!-- Role Name -->
                    <div class="relative">
                        <input v-model="form.name" type="text" id="name" placeholder=" "
                               class="peer w-full px-4 pt-5 pb-2 text-sm border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" />
                        <label for="name"
                               class="absolute left-3 top-2 text-xs text-gray-500 transition-all peer-placeholder-shown:top-3.5 peer-placeholder-shown:text-sm peer-placeholder-shown:text-gray-400 peer-focus:top-2 peer-focus:text-xs peer-focus:text-blue-500">
                            Role Name
                        </label>
                        <div v-if="form.errors.name" class="text-sm text-red-600 mt-1">{{ form.errors.name }}</div>
                    </div>

                    <!-- Guard Name -->
                    <div class="relative">
                        <input v-model="form.guard_name" type="text" id="guard_name" placeholder=" "
                               class="peer w-full px-4 pt-5 pb-2 text-sm border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" />
                        <label for="guard_name"
                               class="absolute left-3 top-2 text-xs text-gray-500 transition-all peer-placeholder-shown:top-3.5 peer-placeholder-shown:text-sm peer-placeholder-shown:text-gray-400 peer-focus:top-2 peer-focus:text-xs peer-focus:text-blue-500">
                            Guard Name
                        </label>
                        <div v-if="form.errors.guard_name" class="text-sm text-red-600 mt-1">{{ form.errors.guard_name }}</div>
                    </div>

                    <!-- Status -->
                    <div class="relative">
                        <select v-model="form.status"
                                class="w-full px-4 py-2 text-sm border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option value="active">Active</option>
                            <option value="inactive">Inactive</option>
                        </select>
                        <div v-if="form.errors.status" class="text-sm text-red-600 mt-1">{{ form.errors.status }}</div>
                    </div>

                    <!-- Permissions -->
                    <div v-for="(permissions, group) in groupedPermissions" :key="group" class="mb-4">
                        <h4 class="text-xs font-semibold text-gray-600 uppercase mb-1">{{ group }}</h4>
                        <div class="flex flex-wrap gap-2">
                            <label v-for="permission in permissions" :key="permission.id" class="flex items-center gap-2 text-sm">
                                <input
                                    type="checkbox"
                                    :value="permission.id"
                                    v-model="form.permissions"
                                    class="rounded border-gray-300 focus:ring-blue-500"
                                />
                                {{ permission.name }}
                            </label>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="flex justify-end">
                        <button
                            type="submit"
                            class="px-6 py-2 bg-blue-600 text-white text-sm font-medium rounded-lg hover:bg-blue-700 transition disabled:opacity-50"
                            :disabled="form.processing"
                        >
                            Save Role
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </AppLayout>
</template>
