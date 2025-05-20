<script setup>
import { Head, useForm } from '@inertiajs/vue3';

defineProps({
    status: {
        type: String,
    },
});

const form = useForm({
    email: '',
});

const submit = () => {
    form.post(route('password.email'));
};
</script>

<template>
  <Head title="Forgot Password" />

  <div class="min-h-screen flex items-center justify-center bg-gradient-to-tr from-blue-50 via-white to-cyan-100">
    <!-- Card Container -->
    <div class="flex flex-col md:flex-row bg-white/90 rounded-3xl shadow-2xl border border-gray-100 overflow-hidden max-w-4xl w-full">
      <!-- Left: Logo -->
      <div class="hidden md:flex flex-col items-center justify-center bg-gradient-to-br from-blue-100 to-cyan-100 p-10">
        <img src="/images/Omishtu.L.jpg" alt="Company Logo" class="w-40 h-40 rounded-2xl shadow-lg border-4 border-white/40" />
      </div>
      <!-- Right: Forgot Password Form -->
      <div class="flex-1 flex items-center justify-center p-8 md:p-12">
        <div class="w-full max-w-md">
          <h2 class="text-3xl font-extrabold text-gray-800 mb-2 text-center">Forgot Your Password?</h2>
          <p class="mb-6 text-gray-500 text-center">
            No problem. Just let us know your email address, and we’ll send you a password reset link.
          </p>
          <div v-if="status" class="mb-4 text-sm font-medium text-green-600 text-center">
            {{ status }}
          </div>
          <form @submit.prevent="submit">
            <div class="mb-5">
              <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
              <input
                id="email"
                v-model="form.email"
                type="email"
                class="block w-full border-gray-300 rounded-lg shadow-sm focus:ring-cyan-500 focus:border-cyan-500 px-4 py-2"
                required
                autofocus
                autocomplete="username"
              />
              <p v-if="form.errors.email" class="text-sm text-red-600 mt-1">{{ form.errors.email }}</p>
            </div>
            <button
              type="submit"
              class="w-full bg-gradient-to-r from-blue-500 to-cyan-500 hover:from-blue-600 hover:to-cyan-600 text-white font-semibold py-2 px-4 rounded-lg shadow-md transition-all duration-300"
              :disabled="form.processing"
            >
              Email Password Reset Link
            </button>
          </form>
        </div>
      </div>
    </div>
  </div>
</template>