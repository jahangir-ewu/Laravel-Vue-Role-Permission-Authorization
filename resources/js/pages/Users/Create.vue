
<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head, Link, useForm } from '@inertiajs/vue3';
import {toast} from 'vue3-toastify';


const breadcrumbs: BreadcrumbItem[] = [
    { title: 'Dashboard', href: '/' },
    { title: 'Users', href: '/users' },
    { title: 'Create', current: true },
];

const form = useForm({
    name: '',
    email: '',
    password: '',
});

function submit(){
    form.post('/users', {
        onSuccess: () => {
            form.reset();
            toast.success('User created successfully!');
        },
        onError: (errors) => {
            console.error('Form submission error:', errors);
        },
    });

}

</script>

<template>
    <Head title="Create User" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex flex-col gap-6 p-6">
            <!-- Header Section -->
            <div class="flex justify-between items-center">
                <h1 class="text-2xl font-semibold text-gray-800">Create User</h1>
                <Link href="/users" class="text-sm text-blue-600 hover:underline">← Back to Users</Link>
            </div>

           <!-- Form Card -->
            <div class="bg-white shadow-md rounded-2xl p-8 max-w-2xl w-full mx-auto">
                <h2 class="text-lg font-semibold text-gray-800 mb-4">User Information</h2>
                <form @submit.prevent="submit" class="space-y-6">
                    <!-- Name -->
                    <div class="relative">
                        <input
                            v-model="form.name"
                            type="text"
                            id="name"
                            placeholder=" "
                            class="peer w-full px-4 pt-5 pb-2 text-sm border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                        />
                        <label for="name" class="absolute left-3 top-2 text-xs text-gray-500 transition-all peer-placeholder-shown:top-3.5 peer-placeholder-shown:text-sm peer-placeholder-shown:text-gray-400 peer-focus:top-2 peer-focus:text-xs peer-focus:text-blue-500">
                            Name
                        </label>
                        <div v-if="form.errors.name" class="text-sm text-red-600 mt-1">{{ form.errors.name }}</div>
                    </div>

                    <!-- Email -->
                    <div class="relative">
                        <input
                            v-model="form.email"
                            type="email"
                            id="email"
                            placeholder=" "
                            class="peer w-full px-4 pt-5 pb-2 text-sm border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                        />
                        <label for="email" class="absolute left-3 top-2 text-xs text-gray-500 transition-all peer-placeholder-shown:top-3.5 peer-placeholder-shown:text-sm peer-placeholder-shown:text-gray-400 peer-focus:top-2 peer-focus:text-xs peer-focus:text-blue-500">
                            Email
                        </label>
                        <div v-if="form.errors.email" class="text-sm text-red-600 mt-1">{{ form.errors.email }}</div>
                    </div>

                    <!-- Password -->
                    <div class="relative">
                        <input
                            v-model="form.password"
                            type="password"
                            id="password"
                            placeholder=" "
                            class="peer w-full px-4 pt-5 pb-2 text-sm border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                        />
                        <label for="password" class="absolute left-3 top-2 text-xs text-gray-500 transition-all peer-placeholder-shown:top-3.5 peer-placeholder-shown:text-sm peer-placeholder-shown:text-gray-400 peer-focus:top-2 peer-focus:text-xs peer-focus:text-blue-500">
                            Password
                        </label>
                        <div v-if="form.errors.password" class="text-sm text-red-600 mt-1">{{ form.errors.password }}</div>

                    </div>

                    <!-- Submit Button -->
                    <div class="flex justify-end">
                        <button
                            type="submit"
                            class="px-6 py-2 bg-blue-600 text-white text-sm font-medium rounded-lg hover:bg-blue-700 transition disabled:opacity-50"
                            :disabled="form.processing"
                        >
                            Save User
                        </button>
                    </div>
                </form>
            </div>

        </div>
    </AppLayout>
</template>