<script setup>
import { ref, computed } from 'vue';
import { Inertia } from '@inertiajs/inertia';
import MainLayout from '@/Layouts/MainLayout.vue';
import { Head, Link, usePage } from '@inertiajs/vue3';

const props = defineProps({
  enquiry: Object,
});

const page = usePage();
const user = page.props.auth.user;
const response = ref(props.enquiry.response || '');

const canRespond = computed(() =>
  props.enquiry.assigned_to === user.id && props.enquiry.status !== 'resolved'
);

function submitResponse() {
  Inertia.post(`/enquiries/${props.enquiry.id}/respond`, {
    response: response.value,
  }, {
    onSuccess: () => {
      Inertia.visit('/enquiries'); // Redirect to index after successful response
    }
  });
}
</script>

<template>
  <MainLayout>
    <Head title="Enquiry Details" />

    <div class="p-6">
      <h1 class="text-3xl font-extrabold text-gray-800 mb-6">Enquiry Details</h1>

      <div class="bg-white rounded-lg shadow-md p-6">
        <p class="text-lg font-semibold text-gray-700 mb-4">
          <strong>Subject:</strong> {{ props.enquiry.subject }}
        </p>
        <p class="text-sm text-gray-500 mb-4">
          <strong>Message:</strong> {{ props.enquiry.message }}
        </p>
        <p class="text-sm text-gray-500 mb-4">
          <strong>Status:</strong>
          <span :class="[props.enquiry.status === 'open' ? 'bg-green-200 text-green-700' : props.enquiry.status === 'pending' ? 'bg-yellow-200 text-yellow-700' : 'bg-red-200 text-red-700', 'px-2 py-1 rounded-full text-xs font-semibold']">
            {{ props.enquiry.status }}
          </span>
        </p>
        <p class="text-sm text-gray-500 mb-4">
          <strong>Assigned Agent:</strong>
          <span v-if="props.enquiry.assignedAgent">{{ props.enquiry.assignedAgent.name }}</span>
          <span v-else class="text-gray-400 italic">Unassigned</span>
        </p>
        <p class="text-sm text-gray-500 mb-4">
          <strong>Created By:</strong> {{ props.enquiry.user?.name || 'Unknown' }}
        </p>
      </div>

      <div v-if="canRespond" class="mt-8">
        <h2 class="text-xl font-bold mb-2">Respond to Enquiry</h2>
        <form @submit.prevent="submitResponse">
          <textarea v-model="response" class="w-full border rounded p-2 mb-2" rows="4" placeholder="Write your response..."></textarea>
          <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Submit Response</button>
        </form>
      </div>

      <div v-else-if="props.enquiry.response" class="mt-8">
        <h2 class="text-xl font-bold mb-2">Agent Response</h2>
        <div class="bg-gray-100 p-4 rounded">{{ props.enquiry.response }}</div>
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
