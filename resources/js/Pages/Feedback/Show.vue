<template>
  <MainLayout>
    <div class="p-6">
      <h1 class="text-3xl font-extrabold text-gray-800 mb-6">Feedback Details</h1>
      <div class="bg-white p-6 rounded-lg shadow-md">
        <p><strong>User:</strong> {{ feedback.user?.name || 'Anonymous' }}</p>
        <p><strong>Product:</strong> {{ feedback.product?.PRODUCTNAME || 'N/A' }}</p>
        <p><strong>Survey:</strong> {{ feedback.survey?.title || 'N/A' }}</p>
        <p><strong>Message:</strong> {{ feedback.message }}</p>
        <p><strong>Rating:</strong> {{ feedback.rating }}</p>
      </div>
      <Link href="/feedback" class="mt-4 inline-block bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
        Back to Feedback List
      </Link>
    </div>
  </MainLayout>
</template>

<script setup>
import MainLayout from '@/Layouts/MainLayout.vue';
import { Link } from '@inertiajs/vue3';

defineProps({ feedback: Object });
</script>
