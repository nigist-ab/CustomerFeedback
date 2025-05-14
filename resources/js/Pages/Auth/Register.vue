<script setup>
import { Head, Link, useForm } from '@inertiajs/vue3';
import { ref } from 'vue';

const form = useForm({
    name: '',
    email: '',
    password: '',
    password_confirmation: '',
});

const submit = () => {
    form.post(route('register'), {
        onFinish: () => form.reset('password', 'password_confirmation'),
    });
};
</script>

<template>
  <div>
    <h1>Register</h1>
    <Head title="Register" />

    <div class="min-h-screen flex bg-white">
      <!-- Left Section: Full-Page Logo -->
      <div class="hidden lg:flex flex-1 items-center justify-center bg-white">
        <img src="/images/Omishtu.L.jpg" alt="Company Logo" class="w-auto h-full object-contain" />
      </div>

      <!-- Right Section: Registration Form -->
      <div class="flex-1 flex items-center justify-center p-8">
        <div class="bg-white shadow-lg rounded-lg p-10 max-w-md w-full">
          <h2 class="text-2xl font-bold text-gray-800 mb-6 text-center">Create an Account</h2>

          <form @submit.prevent="submit">
            <div class="mb-4">
              <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
              <input
                id="name"
                v-model="form.name"
                type="text"
                class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500"
                required
                autofocus
                autocomplete="name"
              />
              <p v-if="form.errors.name" class="text-sm text-red-600 mt-1">{{ form.errors.name }}</p>
            </div>

            <div class="mb-4">
              <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
              <input
                id="email"
                v-model="form.email"
                type="email"
                class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500"
                required
                autocomplete="username"
              />
              <p v-if="form.errors.email" class="text-sm text-red-600 mt-1">{{ form.errors.email }}</p>
            </div>

            <div class="mb-4">
              <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
              <input
                id="password"
                v-model="form.password"
                type="password"
                class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500"
                required
                autocomplete="new-password"
              />
              <p v-if="form.errors.password" class="text-sm text-red-600 mt-1">{{ form.errors.password }}</p>
            </div>

            <div class="mb-4">
              <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Confirm Password</label>
              <input
                id="password_confirmation"
                v-model="form.password_confirmation"
                type="password"
                class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500"
                required
                autocomplete="new-password"
              />
              <p v-if="form.errors.password_confirmation" class="text-sm text-red-600 mt-1">{{ form.errors.password_confirmation }}</p>
            </div>

            <div class="flex items-center justify-between mb-6">
              <Link
                href="/login"
                class="text-sm text-blue-600 hover:underline"
              >
                Already registered?
              </Link>
            </div>

            <button
              type="submit"
              class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded-lg shadow-md"
              :disabled="form.processing"
            >
              Register
            </button>
          </form>
        </div>
      </div>
    </div>
  </div>
</template>