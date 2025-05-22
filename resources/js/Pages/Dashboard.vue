<script setup>
import MainLayout from '@/Layouts/MainLayout.vue';
import { Link } from '@inertiajs/vue3';
</script>

<template>
  <MainLayout>
    <!-- Hero Section without card/box styling -->
    <section class="mb-12 flex flex-col items-center justify-center py-12">
      <h1 class="text-5xl font-extrabold text-black drop-shadow-lg mb-4 text-center">
        Your Communication Hub
      </h1>
      <p class="text-xl text-black/90 mb-8 max-w-2xl text-center">
        Manage and track all your activities in one place.
      </p>
      <div class="flex gap-4">
        <Link href="/enquiries" class="bg-white/80 hover:bg-white text-blue-700 font-bold px-6 py-2 rounded-full shadow transition">
          Quick Enquiry
        </Link>
        <Link href="/feedback" class="bg-white/80 hover:bg-white text-green-700 font-bold px-6 py-2 rounded-full shadow transition">
          Give Feedback
        </Link>
      </div>
    </section>

    <!-- Feature Cards Grid -->
    <section class="max-w-6xl mx-auto grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-10">
      <!-- Enquiries Card -->
      <div class="bg-white/70 backdrop-blur-lg rounded-3xl shadow-xl p-8 flex flex-col items-center hover:scale-105 hover:shadow-2xl transition-all duration-300 border-t-4 border-blue-400">
        <div class="bg-blue-100 text-blue-600 rounded-xl p-4 mb-4 shadow">
          <span class="material-icons text-4xl">question_answer</span>
        </div>
        <h2 class="text-2xl font-bold mb-2">Enquiries</h2>
        <p class="text-gray-700 mb-6 text-center">
          Submit and manage general questions or information requests from customers.
        </p>
        <Link href="/enquiries" class="mt-auto px-5 py-2 bg-blue-600 text-white rounded-full font-semibold shadow hover:bg-blue-700 transition">
          View Enquiries
        </Link>
      </div>

      <!-- Feedback Card -->
      <div class="bg-white/70 backdrop-blur-lg rounded-3xl shadow-xl p-8 flex flex-col items-center hover:scale-105 hover:shadow-2xl transition-all duration-300 border-t-4 border-green-400">
        <div class="bg-green-100 text-green-600 rounded-xl p-4 mb-4 shadow">
          <span class="material-icons text-4xl">feedback</span>
        </div>
        <h2 class="text-2xl font-bold mb-2">Feedback</h2>
        <p class="text-gray-700 mb-6 text-center">
          Gather customer opinions and ratings to improve your service quality.
        </p>
        <Link href="/feedback" class="mt-auto px-5 py-2 bg-green-600 text-white rounded-full font-semibold shadow hover:bg-green-700 transition">
          View Feedback
        </Link>
      </div>

      <!-- Surveys Card -->
      <div class="bg-white/70 backdrop-blur-lg rounded-3xl shadow-xl p-8 flex flex-col items-center hover:scale-105 hover:shadow-2xl transition-all duration-300 border-t-4 border-yellow-400">
        <div class="bg-yellow-100 text-yellow-600 rounded-xl p-4 mb-4 shadow">
          <span class="material-icons text-4xl">poll</span>
        </div>
        <h2 class="text-2xl font-bold mb-2">Surveys</h2>
        <p class="text-gray-700 mb-6 text-center">
          Create surveys and collect structured responses to gain business insights.
        </p>
        <Link href="/surveys" class="mt-auto px-5 py-2 bg-yellow-600 text-white rounded-full font-semibold shadow hover:bg-yellow-700 transition">
          View Surveys
        </Link>
      </div>
    </section>
  </MainLayout>
</template>