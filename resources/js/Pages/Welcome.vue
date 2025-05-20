<script setup>
import { Head, Link } from '@inertiajs/vue3';

const { canLogin, canRegister } = defineProps({
  canLogin: Boolean,
  canRegister: Boolean,
});
</script>

<template>
  <Head title="Welcome" />

  <div class="min-h-screen bg-gradient-to-br from-blue-50 via-white to-cyan-50 flex flex-col lg:flex-row items-center justify-center p-6 relative overflow-hidden">
    <!-- Glassmorphism Decorative Blobs -->
    <div class="absolute -left-32 -top-32 w-96 h-96 rounded-full bg-blue-100/40 blur-3xl z-0 animate-pulse"></div>
    <div class="absolute -right-32 -bottom-32 w-[28rem] h-[28rem] rounded-full bg-cyan-100/40 blur-3xl z-0 animate-pulse"></div>
    
    <!-- Left Section -->
    <section class="lg:flex-1 flex flex-col items-center justify-center text-center p-8 max-w-2xl z-10">
      <div class="relative group">
        <img 
          src="/images/Omishtu.L.jpg" 
          alt="Omishtu Logo" 
          class="w-44 h-44 md:w-56 md:h-56 mx-auto mb-6 rounded-3xl shadow-xl border-4 border-white/30 group-hover:scale-105 transition-transform duration-500"
        />
      </div>
      <h1 class="text-4xl md:text-5xl font-extrabold text-gray-800 tracking-tight">
        Welcome to <span class="bg-gradient-to-r from-blue-500 to-cyan-600 bg-clip-text text-transparent">Omishtu</span>
      </h1>
      <p class="text-lg text-gray-600 mt-4 max-w-md leading-relaxed">
        Your efficient platform for streamlined enquiry management and customer support.
      </p>
     
    </section>

    <!-- Right Section -->
    <section class="w-full lg:flex-1 max-w-md z-10">
      <div class="bg-white/80 backdrop-blur-xl rounded-3xl shadow-lg border border-gray-100 p-8 sm:p-10">
        <div class="flex items-center justify-center mb-6">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" />
          </svg>
          <h2 class="ml-3 text-2xl font-bold text-gray-800">Get Started</h2>
        </div>
        <p class="text-gray-600 mb-8 text-center">
        Join our growing community and manage all your customer interactions in one place.
        </p>
        <div class="space-y-4">
          <Link
            v-if="canLogin"
            href="/login"
            class="block px-6 py-3 bg-gradient-to-r from-blue-500 to-cyan-500 hover:from-blue-600 hover:to-cyan-600 text-white text-center rounded-lg font-semibold transition-all duration-300 shadow-md hover:shadow-lg"
          >
            Sign In
          </Link>
          <Link
            v-if="canRegister"
            href="/register"
            class="block px-6 py-3 bg-white border-2 border-blue-500 text-blue-600 hover:bg-blue-50 text-center rounded-lg font-semibold transition-all duration-300 shadow-sm hover:shadow-md"
          >
            Create Account
          </Link>
        </div>
        <div class="mt-8 pt-6 border-t border-gray-100">
          <p class="text-sm text-gray-500 text-center">
            Need help? <a href="/contact" class="text-blue-600 hover:text-blue-800 font-medium transition">Contact Support</a>
          </p>
        </div>
      </div>
    </section>
  </div>
</template>
