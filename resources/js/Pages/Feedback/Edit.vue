<script setup>
import { Head, useForm, Link } from '@inertiajs/vue3';
import MainLayout from '@/Layouts/MainLayout.vue';

const props = defineProps({ feedback: Object, products: Array, surveys: Array });

const form = useForm({
  product_id: props.feedback.product_id,
  survey_id: props.feedback.survey_id,
  message: props.feedback.message,
  rating: props.feedback.rating,
});

const submitForm = () => {
  form.put(`/feedback/${props.feedback.id}`);
};
</script>

<template>
  <MainLayout>
    <Head title="Edit Feedback" />
    <div class="w-full max-w-[700px] mx-auto mt-10 bg-white rounded-2xl shadow-xl border border-gray-100 p-8">
      <h1 class="text-3xl font-extrabold text-blue-800 mb-8 text-center">Edit Feedback</h1>
      <form @submit.prevent="submitForm" class="space-y-6">
        <div>
          <label class="block font-semibold mb-2 text-gray-700">Product</label>
          <select v-model="form.product_id" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-200 focus:outline-none">
            <option disabled value="">Select product</option>
            <option v-for="p in products" :key="p.id" :value="p.id">{{ p.PRODUCTNAME || p.name }}</option>
          </select>
        </div>
        <div>
          <label class="block font-semibold mb-2 text-gray-700">Survey</label>
          <select v-model="form.survey_id" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-200 focus:outline-none">
            <option disabled value="">Optional</option>
            <option v-for="s in surveys" :key="s.id" :value="s.id">{{ s.title }}</option>
          </select>
        </div>
        <div>
          <label class="block font-semibold mb-2 text-gray-700">Message</label>
          <textarea v-model="form.message" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-200 focus:outline-none min-h-[100px]" rows="4"></textarea>
        </div>
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
        <div class="flex justify-between items-center mt-8">
          <Link href="/feedback" class="bg-gray-300 text-gray-800 px-6 py-2 rounded-lg hover:bg-gray-400 transition-colors">
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
