<!-- resources/js/Pages/Enquiries/Edit.vue -->
<script setup>
import { useForm } from '@inertiajs/vue3';
import { Link } from '@inertiajs/vue3';
import MainLayout from '@/Layouts/MainLayout.vue';

const props = defineProps({ enquiry: Object });

const form = useForm({
  subject: props.enquiry.subject,
  message: props.enquiry.message,
  status: props.enquiry.status,
  assigned_to: props.enquiry.assigned_to,
});

function submit() {
  form.put(`/enquiries/${props.enquiry.id}`);
}
</script>

<template>
  <MainLayout>
    <div class="w-full max-w-[900px] mx-auto mt-10 bg-white rounded-2xl shadow-xl border border-gray-100 p-8">
      <h1 class="text-3xl font-extrabold text-blue-800 mb-8 text-center">Edit Enquiry</h1>
      <form @submit.prevent="submit" class="space-y-6">
        <div>
          <label class="block font-semibold mb-2 text-gray-700">Subject</label>
          <input v-model="form.subject" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-200 focus:outline-none" required />
        </div>
        <div>
          <label class="block font-semibold mb-2 text-gray-700">Message</label>
          <textarea v-model="form.message" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-200 focus:outline-none min-h-[120px]" rows="4" required></textarea>
        </div>
        <div>
          <label class="block font-semibold mb-2 text-gray-700">Status</label>
          <select v-model="form.status" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-200 focus:outline-none">
            <option value="open">Open</option>
            <option value="in-progress">In Progress</option>
            <option value="resolved">Resolved</option>
          </select>
        </div>
        <div class="flex justify-between items-center mt-8">
          <Link href="/enquiries" class="bg-gray-300 text-gray-800 px-6 py-2 rounded-lg hover:bg-gray-400 transition-colors">
            ← Cancel
          </Link>
          <button type="submit" class="bg-blue-600 text-white px-8 py-2 rounded-lg hover:bg-blue-700 transition-colors font-semibold shadow">
            Update
          </button>
        </div>
      </form>
    </div>
  </MainLayout>
</template>
