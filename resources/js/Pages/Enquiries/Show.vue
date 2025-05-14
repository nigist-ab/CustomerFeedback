<script setup>
import MainLayout from '@/Layouts/MainLayout.vue';
import { Head, Link } from '@inertiajs/vue3';

defineProps({ enquiry: Object });
</script>

<template>
  <MainLayout>
    <Head title="Enquiry Details" />

    <div class="p-6">
      <h1 class="text-3xl font-extrabold text-gray-800 mb-6">Enquiry Details</h1>

      <div class="bg-white rounded-lg shadow-md p-6">
        <p class="text-lg font-semibold text-gray-700 mb-4">
          <strong>Subject:</strong> {{ enquiry.subject }}
        </p>
        <p class="text-sm text-gray-500 mb-4">
          <strong>Message:</strong> {{ enquiry.message }}
        </p>
        <p class="text-sm text-gray-500 mb-4">
          <strong>Status:</strong>
          <span :class="[enquiry.status === 'open' ? 'bg-green-200 text-green-700' : enquiry.status === 'pending' ? 'bg-yellow-200 text-yellow-700' : 'bg-red-200 text-red-700', 'px-2 py-1 rounded-full text-xs font-semibold']">
            {{ enquiry.status }}
          </span>
        </p>
        <p class="text-sm text-gray-500 mb-4">
          <strong>Assigned Agent:</strong>
          <span v-if="enquiry.assignedAgent">{{ enquiry.assignedAgent.name }}</span>
          <span v-else class="text-gray-400 italic">Unassigned</span>
        </p>
        <p class="text-sm text-gray-500 mb-4">
          <strong>Created By:</strong> {{ enquiry.user?.name || 'Unknown' }}
        </p>
      </div>

      <Link
        href="/enquiries"
        class="mt-4 inline-block bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600"
      >
        Back to Enquiries
      </Link>
    </div>
  </MainLayout>
</template>
