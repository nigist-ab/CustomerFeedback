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

  <div class="min-h-screen flex bg-white">
    <!-- Left Section: Full-Page Logo -->
    <div class="hidden lg:flex flex-1 items-center justify-center bg-white">
      <img src="/images/Omishtu.L.jpg" alt="Company Logo" class="w-auto h-full object-contain" />
    </div>

    <!-- Right Section: Forgot Password Form -->
    <div class="flex-1 flex items-center justify-center p-8">
      <div class="bg-white shadow-lg rounded-lg p-10 max-w-md w-full">
        <h2 class="text-2xl font-bold text-gray-800 mb-6 text-center">Forgot Your Password?</h2>

        <p class="mb-4 text-sm text-gray-600 text-center">
          No problem. Just let us know your email address, and we’ll send you a password reset link.
        </p>

        <div v-if="status" class="mb-4 text-sm font-medium text-green-600 text-center">
          {{ status }}
        </div>

        <form @submit.prevent="submit">
          <div class="mb-4">
            <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
            <input
              id="email"
              v-model="form.email"
              type="email"
              class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500"
              required
              autofocus
              autocomplete="username"
            />
            <p v-if="form.errors.email" class="text-sm text-red-600 mt-1">{{ form.errors.email }}</p>
          </div>

          <div class="mt-6">
            <button
              type="submit"
              class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded-lg shadow-md"
              :disabled="form.processing"
            >
              Email Password Reset Link
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
</template>