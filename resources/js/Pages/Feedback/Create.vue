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

    <div class="w-full max-w-[700px] mx-auto mt-10 bg-white rounded-2xl shadow-xl border border-gray-100 p-8">
      <h1 class="text-3xl font-extrabold text-blue-800 mb-8 text-center">Create Feedback</h1>

      <form @submit.prevent="submitForm" class="space-y-6">
        <!-- Product Dropdown -->
        <div>
          <label class="block font-semibold mb-2 text-gray-700">Product</label>
          <select
            v-model="form.product_id"
            class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-200 focus:outline-none"
          >
            <option disabled value="">Select product</option>
            <option v-for="p in products" :key="p.id" :value="p.id">{{ p.PRODUCTNAME }}</option>
          </select>
        </div>

        <!-- Survey Dropdown -->
        <div>
          <label class="block font-semibold mb-2 text-gray-700">Survey</label>
          <select
            v-model="form.survey_id"
            class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-200 focus:outline-none"
          >
            <option disabled value="">Optional</option>
            <option v-for="s in surveys" :key="s.id" :value="s.id">{{ s.title }}</option>
          </select>
        </div>

        <!-- Message Field -->
        <div>
          <label class="block font-semibold mb-2 text-gray-700">Message</label>
          <textarea
            v-model="form.message"
            class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-200 focus:outline-none min-h-[100px]"
            rows="4"
            placeholder="Type your feedback here..."
          ></textarea>
        </div>

        <!-- Rating Field (Star) -->
        <div>
          <label class="block font-semibold mb-2 text-gray-700">Rating (1-5)</label>
          <div class="flex items-center space-x-1">
            <span
              v-for="star in 5"
              :key="star"
              class="cursor-pointer text-2xl transition-colors"
              :class="{'text-yellow-400': form.rating >= star, 'text-gray-300': form.rating < star}"
              @click="form.rating = star"
            >★</span>
            <span v-if="form.rating" class="ml-2 text-sm text-gray-600">{{ form.rating }}/5</span>
          </div>
        </div>

        <!-- Submit & Cancel Buttons -->
        <div class="flex justify-between items-center mt-8">
          <Link
            href="/feedback"
            class="bg-gray-300 text-gray-800 px-6 py-2 rounded-lg hover:bg-gray-400 transition-colors"
          >
            ← Cancel
          </Link>
          <button
            type="submit"
            class="bg-gradient-to-r from-blue-600 to-purple-500 text-white px-8 py-2 rounded-lg hover:from-blue-700 hover:to-purple-600 transition-colors font-semibold shadow"
          >
            Submit
          </button>
        </div>
      </form>
    </div>
  </MainLayout>
</template>
