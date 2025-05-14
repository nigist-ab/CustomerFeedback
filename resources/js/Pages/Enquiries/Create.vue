<template>
  <MainLayout>
  <div>
    <h1>Create Enquiry</h1>
    <form @submit.prevent="submitForm">
      <div>
        <label for="subject">Subject:</label>
        <input
          id="subject"
          v-model="form.subject"
          type="text"
          required
          class="border border-gray-300 rounded px-2 py-1 w-full"
        />
      </div>
      <div class="mt-4">
        <label for="message">Message:</label>
        <textarea
          id="message"
          v-model="form.message"
          required
          class="border border-gray-300 rounded px-2 py-1 w-full"
        ></textarea>
      </div>
      <button
        type="submit"
        class="mt-4 bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600"
      >
        Submit
      </button>
    </form>
   <Link href="/enquiries" class="bg-gray-400 text-white px-4 py-2 rounded">Back to Enquiries</Link>
     
  </div>
</MainLayout>
</template>

<script>
import { Link } from '@inertiajs/vue3';
import { Inertia } from '@inertiajs/inertia';
import MainLayout from '@/Layouts/MainLayout.vue';

export default {
  components: {
    Link,
  MainLayout,
  },
  data() {
    return {
      form: {
        subject: '',
        message: '',
      },
    };
  },
  methods: {
    submitForm() {
      Inertia.post(route('enquiries.store'), this.form);
    },
  },
};
</script>