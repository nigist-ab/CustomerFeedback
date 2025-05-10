<script setup>
import { Head, Link } from '@inertiajs/vue3';

const { canLogin, canRegister } = defineProps({
  canLogin: Boolean,
  canRegister: Boolean,
});
</script>

<template>
  <Head title="Welcome" />

  <div class="min-h-screen flex items-center justify-center bg-gradient-to-r from-blue-50 to-gray-100">
    <!-- Left Section: Logo and Text -->
    <div class="flex-1 flex flex-col items-center justify-center text-center p-8">
      <img src="/images/Omishtu.L.jpg" alt="Company Logo" class="w-56 h-56 mx-auto mb-6 shadow-lg rounded-full" />
      <h1 class="text-5xl font-extrabold text-gray-800 tracking-tight">
        Welcome to Our Company
      </h1>
      <p class="text-lg text-gray-600 mt-4">
        Your trusted platform for managing enquiries, feedback, and support.
      </p>
    </div>

    <!-- Right Section: Login and Register -->
    <div class="flex-1 bg-gradient-to-r from-blue-50 to-gray-100 shadow-lg rounded-lg p-10 max-w-md w-full border border-gray-200">
      <h2 class="text-2xl font-bold text-gray-800 mb-6">Get Started</h2>
      <p class="text-gray-600 mb-8">
        Access enquiries, feedback, surveys, and support tickets in one place.
      </p>

      <div class="flex flex-col space-y-4">
  <Link
    v-if="canLogin"
    href="/login"
    class="px-6 py-3 bg-blue-400 hover:bg-blue-500 text-white text-center rounded-lg text-lg font-semibold transition shadow-md"
  >
    Login
  </Link>
  <Link
    v-if="canRegister"
    href="/register"
    class="px-6 py-3 bg-green-400 hover:bg-green-500 text-white text-center rounded-lg text-lg font-semibold transition shadow-md"
  >
    Register
  </Link>
</div>

      <p class="text-sm text-gray-500 mt-6">
        Need help? <a href="/contact" class="text-blue-600 hover:underline">Contact Support</a>
      </p>
    </div>
  </div>
</template>