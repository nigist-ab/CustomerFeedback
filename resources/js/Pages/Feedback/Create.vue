<script setup>
import { Head, useForm, Link } from '@inertiajs/vue3';
import MainLayout from '@/Layouts/MainLayout.vue';

const props = defineProps({ products: Array, surveys: Array });

const form = useForm({
  product_id: '', // Ensure this is bound to the dropdown
  survey_id: '',
  message: '',
  rating: '',
});

const submitForm = () => {
  // Convert empty survey_id to null
  if (form.survey_id === '') {
    form.survey_id = null;
  }

  // Submit the form
  form.post('/feedback/submit');
};
</script>

<template>
  <MainLayout>
    <Head title="Create Feedback" />

    <div class="p-6">
      <h1 class="text-3xl font-extrabold text-gray-800 mb-6">Create Feedback</h1>

      <form @submit.prevent="submitForm" class="space-y-6 bg-white p-6 rounded-lg shadow-md">
        <!-- Product Dropdown -->
        <div>
          <label class="block text-gray-700 font-semibold mb-2">Product</label>
          <select
            v-model="form.product_id"
            class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-blue-500 focus:outline-none"
          >
            <option disabled value="">Select product</option>
            <option v-for="p in products" :key="p.id" :value="p.id">{{ p.PRODUCTNAME }}</option>
          </select>
        </div>

        <!-- Survey Dropdown -->
        <div>
          <label class="block text-gray-700 font-semibold mb-2">Survey</label>
          <select
            v-model="form.survey_id"
            class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-blue-500 focus:outline-none"
          >
            <option disabled value="">Optional</option>
            <option v-for="s in surveys" :key="s.id" :value="s.id">{{ s.title }}</option>
          </select>
        </div>

        <!-- Message Field -->
        <div>
          <label class="block text-gray-700 font-semibold mb-2">Message</label>
          <textarea
            v-model="form.message"
            class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-blue-500 focus:outline-none"
            rows="4"
          ></textarea>
        </div>

        <!-- Rating Field -->
        <div>
          <label class="block text-gray-700 font-semibold mb-2">Rating (1-5)</label>
          <input
            type="number"
            v-model="form.rating"
            min="1"
            max="5"
            class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-blue-500 focus:outline-none"
          />
        </div>

        <!-- Submit Button -->
        <div class="flex gap-4">
          <button
            type="submit"
            class="bg-gradient-to-r from-blue-500 to-purple-500 text-white px-6 py-3 rounded-lg shadow-md hover:shadow-lg transition-all duration-300"
          >
            Submit
          </button>
          <Link
            href="/feedback"
            class="bg-gray-300 text-black px-6 py-3 rounded-lg shadow-md hover:bg-gray-400 transition-all duration-300"
          >
            Cancel
          </Link>
        </div>
      </form>
    </div>
  </MainLayout>
</template>
