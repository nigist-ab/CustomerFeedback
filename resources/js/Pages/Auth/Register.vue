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
  <Head title="Register" />

  <div class="min-h-screen flex items-center justify-center bg-gradient-to-tr from-blue-50 via-white to-cyan-100">
    <!-- Card Container -->
    <div class="flex flex-col md:flex-row bg-white/90 rounded-3xl shadow-2xl border border-gray-100 overflow-hidden max-w-4xl w-full">
      <!-- Left: Logo -->
      <div class="hidden md:flex flex-col items-center justify-center bg-gradient-to-br from-blue-100 to-cyan-100 p-10">
        <img src="/images/Omishtu.L.jpg" alt="Company Logo" class="w-40 h-40 rounded-2xl shadow-lg border-4 border-white/40" />
      </div>
      <!-- Right: Registration Form -->
      <div class="flex-1 flex items-center justify-center p-8 md:p-12">
        <div class="w-full max-w-md">
          <h2 class="text-3xl font-extrabold text-gray-800 mb-2 text-center">Create an Account</h2>
          <p class="text-gray-500 mb-8 text-center">Join Omishtu and manage your enquiries with ease</p>
          <form @submit.prevent="submit">
            <div class="mb-5">
              <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Name</label>
              <input
                id="name"
                v-model="form.name"
                type="text"
                class="block w-full border-gray-300 rounded-lg shadow-sm focus:ring-cyan-500 focus:border-cyan-500 px-4 py-2"
                required
                autofocus
                autocomplete="name"
              />
              <p v-if="form.errors.name" class="text-sm text-red-600 mt-1">{{ form.errors.name }}</p>
            </div>
            <div class="mb-5">
              <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
              <input
                id="email"
                v-model="form.email"
                type="email"
                class="block w-full border-gray-300 rounded-lg shadow-sm focus:ring-cyan-500 focus:border-cyan-500 px-4 py-2"
                required
                autocomplete="username"
              />
              <p v-if="form.errors.email" class="text-sm text-red-600 mt-1">{{ form.errors.email }}</p>
            </div>
            <div class="mb-5">
              <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
              <input
                id="password"
                v-model="form.password"
                type="password"
                class="block w-full border-gray-300 rounded-lg shadow-sm focus:ring-cyan-500 focus:border-cyan-500 px-4 py-2"
                required
                autocomplete="new-password"
              />
              <p v-if="form.errors.password" class="text-sm text-red-600 mt-1">{{ form.errors.password }}</p>
            </div>
            <div class="mb-5">
              <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-1">Confirm Password</label>
              <input
                id="password_confirmation"
                v-model="form.password_confirmation"
                type="password"
                class="block w-full border-gray-300 rounded-lg shadow-sm focus:ring-cyan-500 focus:border-cyan-500 px-4 py-2"
                required
                autocomplete="new-password"
              />
              <p v-if="form.errors.password_confirmation" class="text-sm text-red-600 mt-1">{{ form.errors.password_confirmation }}</p>
            </div>
            <div class="flex items-center justify-between mb-6">
              <Link
                href="/login"
                class="text-sm text-cyan-600 hover:underline"
              >
                Already registered?
              </Link>
            </div>
            <button
              type="submit"
              class="w-full bg-gradient-to-r from-blue-500 to-cyan-500 hover:from-blue-600 hover:to-cyan-600 text-white font-semibold py-2 px-4 rounded-lg shadow-md transition-all duration-300"
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