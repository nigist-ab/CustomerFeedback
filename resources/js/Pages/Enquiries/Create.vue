<template>
  <MainLayout>
   <div class="w-full max-w-[900px] mx-auto mt-10 bg-white rounded-2xl shadow-xl border border-gray-100 p-8">
      <h1 class="text-3xl font-extrabold text-blue-800 mb-8 text-center">Create Enquiry</h1>
      <form @submit.prevent="submitForm" class="space-y-6">
        <div>
          <label for="subject" class="block font-semibold mb-2 text-gray-700">Subject</label>
          <input
            id="subject"
            v-model="form.subject"
            type="text"
            required
            class="border border-gray-300 rounded-lg px-4 py-2 w-full focus:ring-2 focus:ring-blue-200 focus:outline-none"
            placeholder="Enter subject"
          />
        </div>
        <div>
          <label for="message" class="block font-semibold mb-2 text-gray-700">Message</label>
          <textarea
            id="message"
            v-model="form.message"
            required
            class="border border-gray-300 rounded-lg px-4 py-2 w-full focus:ring-2 focus:ring-blue-200 focus:outline-none min-h-[120px]"
            placeholder="Type your message here..."
          ></textarea>
        </div>
        <div class="flex justify-between items-center mt-8">
          <Link href="/enquiries" class="bg-gray-300 text-gray-800 px-6 py-2 rounded-lg hover:bg-gray-400 transition-colors">
            ← Back
          </Link>
          <button
            type="submit"
            class="bg-blue-600 text-white px-8 py-2 rounded-lg hover:bg-blue-700 transition-colors font-semibold shadow"
          >
            Submit
          </button>
        </div>
      </form>
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
      Inertia.post(route('enquiries/store'), this.form);
    },
  },
};
</script>