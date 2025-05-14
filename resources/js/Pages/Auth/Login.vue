<script setup>
import { Head, Link, useForm } from '@inertiajs/vue3';
import { ref } from 'vue';
//import { useForm } from '@inertiajs/vue3';

const form = useForm({
  email: '',
  password: '',
  remember: false,
});

const submit = () => {
  form.post(route('login')); // Ensure this matches the backend login route
};
</script>

<template>
  <Head title="Login" />

  <div>
    <h1>Login</h1>
    <div class="min-h-screen flex bg-white">
      <!-- Left Section: Full-Page Logo -->
      <div class="hidden lg:flex flex-1 items-center justify-center bg-white">
        <img src="/images/Omishtu.L.jpg" alt="Company Logo" class="w-auto h-full object-contain" />
      </div>

      <!-- Right Section: Login Form -->
      <div class="flex-1 flex items-center justify-center p-8">
        <div class="bg-white shadow-lg rounded-lg p-10 max-w-md w-full">
          <h2 class="text-2xl font-bold text-gray-800 mb-6 text-center">Login to Your Account</h2>

          <form @submit.prevent="submit">
            <div class="mb-4">
              <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
              <input
                id="email"
                v-model="form.email"
                type="email"
                class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500"
                required
              />
            </div>

            <div class="mb-4">
              <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
              <input
                id="password"
                v-model="form.password"
                type="password"
                class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500"
                required
              />
            </div>

            <div class="flex items-center justify-between mb-6">
              <label class="flex items-center">
                <input
                  type="checkbox"
                  v-model="form.remember"
                  class="h-4 w-4 text-blue-600 border-gray-300 rounded"
                />
                <span class="ml-2 text-sm text-gray-600">Remember me</span>
              </label>
              <Link href="/forgot-password" class="text-sm text-blue-600 hover:underline">Forgot Password?</Link>
            </div>

            <button
              type="submit"
              class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded-lg shadow-md"
            >
              Login
            </button>
          </form>

          <p class="text-sm text-gray-500 mt-6 text-center">
            Don't have an account? <Link href="/register" class="text-blue-600 hover:underline">Register</Link>
          </p>
        </div>
      </div>
    </div>
  </div>
</template>