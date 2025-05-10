<script setup>
import MainLayout from '@/Layouts/MainLayout.vue';
import { Link } from '@inertiajs/vue3';
</script>

<template>
  <MainLayout>
    <h1 class="text-3xl font-bold mb-6 text-gray-800">Welcome to Your Dashboard</h1>
    <p class="mb-8 text-gray-600">
      Explore the features below to manage your customer communication and services effectively.
    </p>

    <!-- Feature Cards -->
    <div class="grid grid-cols-4 gap-8">
      <!-- Enquiries Card -->
      <div
        class="bg-white text-gray-800 shadow-lg rounded-lg p-6 flex flex-col items-center text-center transform hover:scale-105 hover:shadow-2xl transition duration-300"
      >
        <div class="bg-blue-100 text-blue-600 rounded-full p-4 mb-4 shadow-md">
          <span class="material-icons text-4xl">question_answer</span>
        </div>
        <h2 class="text-xl font-semibold mb-2">Enquiries</h2>
        <p class="text-sm mb-4">
          Submit and manage general questions or information requests from customers.
        </p>
        <Link
          href="/enquiries"
          class="px-4 py-2 bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-700 transition"
        >
          View Enquiries
        </Link>
      </div>

      <!-- Feedback Card -->
      <div
        class="bg-white text-gray-800 shadow-lg rounded-lg p-6 flex flex-col items-center text-center transform hover:scale-105 hover:shadow-2xl transition duration-300"
      >
        <div class="bg-green-100 text-green-600 rounded-full p-4 mb-4 shadow-md">
          <span class="material-icons text-4xl">feedback</span>
        </div>
        <h2 class="text-xl font-semibold mb-2">Feedback</h2>
        <p class="text-sm mb-4">
          Gather customer opinions and ratings to improve your service quality.
        </p>
        <Link
          href="/feedback"
          class="px-4 py-2 bg-green-600 text-white font-semibold rounded-lg hover:bg-green-700 transition"
        >
          View Feedback
        </Link>
      </div>

      <!-- Surveys Card -->
      <div
        class="bg-white text-gray-800 shadow-lg rounded-lg p-6 flex flex-col items-center text-center transform hover:scale-105 hover:shadow-2xl transition duration-300"
      >
        <div class="bg-yellow-100 text-yellow-600 rounded-full p-4 mb-4 shadow-md">
          <span class="material-icons text-4xl">poll</span>
        </div>
        <h2 class="text-xl font-semibold mb-2">Surveys</h2>
        <p class="text-sm mb-4">
          Create surveys and collect structured responses to gain business insights.
        </p>
        <Link
          href="/surveys"
          class="px-4 py-2 bg-yellow-600 text-white font-semibold rounded-lg hover:bg-yellow-700 transition"
        >
          View Surveys
        </Link>
      </div>

      <!-- Tickets Card -->
      <div
        class="bg-white text-gray-800 shadow-lg rounded-lg p-6 flex flex-col items-center text-center transform hover:scale-105 hover:shadow-2xl transition duration-300"
      >
        <div class="bg-red-100 text-red-600 rounded-full p-4 mb-4 shadow-md">
          <span class="material-icons text-4xl">support_agent</span>
        </div>
        <h2 class="text-xl font-semibold mb-2">Tickets</h2>
        <p class="text-sm mb-4">
          Handle customer issues and support requests with proper assignment and tracking.
        </p>
        <Link
          href="/tickets"
          class="px-4 py-2 bg-red-600 text-white font-semibold rounded-lg hover:bg-red-700 transition"
        >
          View Tickets
        </Link>
      </div>
    </div>
  </MainLayout>
</template>