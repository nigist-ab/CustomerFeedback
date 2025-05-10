<!-- resources/js/Pages/Enquiries/Edit.vue -->
<script setup>
import { useForm } from '@inertiajs/vue3';
import { Link } from '@inertiajs/vue3';

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
  <div class="p-6 max-w-xl mx-auto">
    <h1 class="text-2xl font-bold mb-4">Edit Enquiry</h1>

    <form @submit.prevent="submit">
      <div class="mb-4">
        <label class="block mb-1">Subject</label>
        <input v-model="form.subject" class="w-full border rounded p-2" required />
      </div>

      <div class="mb-4">
        <label class="block mb-1">Message</label>
        <textarea v-model="form.message" class="w-full border rounded p-2" rows="4" required></textarea>
      </div>

      <div class="mb-4">
        <label class="block mb-1">Status</label>
        <select v-model="form.status" class="w-full border rounded p-2">
          <option value="open">Open</option>
          <option value="in-progress">In Progress</option>
          <option value="resolved">Resolved</option>
        </select>
      </div>

      <div class="mb-4">
        <label class="block mb-1">Assign to (User ID)</label>
        <input v-model="form.assigned_to" type="number" class="w-full border rounded p-2" />
      </div>

      <div class="flex gap-4">
        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Update</button>
        <Link href="/enquiries" class="bg-gray-400 text-white px-4 py-2 rounded">Cancel</Link>
      </div>
    </form>
  </div>
</template>
