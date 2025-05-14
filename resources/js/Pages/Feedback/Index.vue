<script setup>
import MainLayout from '@/Layouts/MainLayout.vue';
import { Head, Link, router } from '@inertiajs/vue3';

defineProps({ feedbacks: Array });

function deleteFeedback(id) {
  if (confirm('Are you sure you want to delete this feedback?')) {
    router.delete(`/feedback/${id}`);
  }
}
</script>

<template>
  <MainLayout>
    <Head title="Feedback List" />

    <div class="p-6">
      <h1 class="text-3xl font-extrabold text-gray-800 mb-6">Feedback List</h1>
      <Link
        href="/feedback/create"
        class="bg-gradient-to-r from-blue-500 to-purple-500 text-white px-6 py-3 rounded-lg shadow-md hover:shadow-lg transition-all duration-300 inline-block mb-6"
      >
        ➕ Add Feedback
      </Link>

      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <div
          v-for="item in feedbacks"
          :key="item.id"
          class="bg-white rounded-lg shadow-md p-4 hover:shadow-lg transition-all duration-300"
        >
          <h2 class="text-lg font-semibold text-gray-700 mb-2">
            {{ item.user?.name || 'Anonymous' }}
          </h2>
          <p class="text-sm text-gray-500 mb-1">
            <strong>Product:</strong> {{ item.product?.PRODUCTNAME || 'N/A' }}
          </p>
          <p class="text-sm text-gray-500 mb-1">
            <strong>Survey:</strong> {{ item.survey?.title || 'N/A' }}
          </p>
          <p class="text-sm text-gray-500 mb-3">
            <strong>Message:</strong> {{ item.message }}
          </p>
          <p class="text-sm text-yellow-500 font-bold mb-4">
            ⭐ Rating: {{ item.rating }}
          </p>
          <div class="flex justify-between items-center">
            <Link
              :href="`/feedback/${item.id}/edit`"
              class="text-blue-500 hover:underline text-sm"
            >
              ✏️ Edit Feedback
            </Link>
            <button
              @click="deleteFeedback(item.id)"
              class="text-red-500 hover:underline text-sm"
            >
              🗑️ Delete Feedback
            </button>
          </div>
        </div>
      </div>
    </div>
  </MainLayout>
</template>
