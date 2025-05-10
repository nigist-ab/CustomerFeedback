<script setup>
import { Head, useForm, Link } from '@inertiajs/vue3';
import { reactive } from 'vue';

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
  <Head title="Edit Feedback" />

  <div class="p-6">
    <h1 class="text-2xl font-bold mb-4">Edit Feedback</h1>

    <form @submit.prevent="submitForm" class="space-y-4">
      <div>
        <label>Product</label>
        <select v-model="form.product_id" class="w-full border p-2">
          <option disabled value="">Select product</option>
          <option v-for="p in products" :key="p.id" :value="p.id">{{ p.name }}</option>
        </select>
      </div>

      <div>
        <label>Survey</label>
        <select v-model="form.survey_id" class="w-full border p-2">
          <option disabled value="">Optional</option>
          <option v-for="s in surveys" :key="s.id" :value="s.id">{{ s.title }}</option>
        </select>
      </div>

      <div>
        <label>Message</label>
        <textarea v-model="form.message" class="w-full border p-2" rows="4"></textarea>
      </div>

      <div>
        <label>Rating (1-5)</label>
        <input type="number" v-model="form.rating" min="1" max="5" class="w-full border p-2" />
      </div>

      <div class="flex gap-4">
        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Update</button>
        <Link href="/feedback" class="bg-gray-300 text-black px-4 py-2 rounded">Cancel</Link>
      </div>
    </form>
  </div>
</template>
