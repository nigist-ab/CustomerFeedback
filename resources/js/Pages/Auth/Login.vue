<script setup>
import { Head, Link, useForm } from '@inertiajs/vue3';
import { ref } from 'vue';

const form = useForm({
  email: '',
  password: '',
  remember: false,
});

const submit = () => {
  form.post(route('login'));
};
</script>

<template>
  <Head title="Login" />

  <div class="min-h-screen flex items-center justify-center bg-gradient-to-tr from-blue-50 via-white to-cyan-100">
    <!-- Card Container -->
    <div class="flex flex-col md:flex-row bg-white/90 rounded-3xl shadow-2xl border border-gray-100 overflow-hidden max-w-4xl w-full">
      <!-- Left: Logo -->
      <div class="hidden md:flex flex-col items-center justify-center bg-gradient-to-br from-blue-100 to-cyan-100 p-10">
        <img src="/images/Omishtu.L.jpg" alt="Company Logo" class="w-40 h-40 rounded-2xl shadow-lg border-4 border-white/40" />
      </div>
      <!-- Right: Login Form -->
      <div class="flex-1 flex items-center justify-center p-8 md:p-12">
        <div class="w-full max-w-md">
          <h2 class="text-3xl font-extrabold text-gray-800 mb-2 text-center">Welcome Back</h2>
          <p class="text-gray-500 mb-8 text-center">Login to your Omishtu account</p>
          <form @submit.prevent="submit">
            <div class="mb-5">
              <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
              <input
                id="email"
                v-model="form.email"
                type="email"
                class="block w-full border-gray-300 rounded-lg shadow-sm focus:ring-cyan-500 focus:border-cyan-500 px-4 py-2"
                required
              />
            </div>
            <div class="mb-5">
              <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
              <input
                id="password"
                v-model="form.password"
                type="password"
                class="block w-full border-gray-300 rounded-lg shadow-sm focus:ring-cyan-500 focus:border-cyan-500 px-4 py-2"
                required
              />
            </div>
            <div class="flex items-center justify-between mb-6">
              <label class="flex items-center">
                <input
                  type="checkbox"
                  v-model="form.remember"
                  class="h-4 w-4 text-cyan-600 border-gray-300 rounded"
                />
                <span class="ml-2 text-sm text-gray-600">Remember me</span>
              </label>
              <Link href="/forgot-password" class="text-sm text-cyan-600 hover:underline">Forgot Password?</Link>
            </div>
            <button
              type="submit"
              class="w-full bg-gradient-to-r from-blue-500 to-cyan-500 hover:from-blue-600 hover:to-cyan-600 text-white font-semibold py-2 px-4 rounded-lg shadow-md transition-all duration-300"
            >
              Login
            </button>
          </form>
          <p class="text-sm text-gray-500 mt-8 text-center">
            Don't have an account?
            <Link href="/register" class="text-cyan-600 hover:underline">Register</Link>
          </p>
        </div>
      </div>
    </div>
  </div>
</template>