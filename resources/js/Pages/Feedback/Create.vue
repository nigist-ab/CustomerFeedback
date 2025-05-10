<script setup>
import { Head, useForm, Link } from '@inertiajs/vue3';
import { ref } from 'vue';
import MainLayout from '@/Layouts/MainLayout.vue';

const props = defineProps({ products: Array, surveys: Array });

const form = useForm({
  product_id: '',
  survey_id: '',
  message: '',
  rating: '',
});

const submitForm = () => {
  form.post('/feedback');
};
</script>

<template>
  <MainLayout>
  <Head title="Create Feedback" />

  <div class="p-6">
    <h1 class="text-2xl font-bold mb-4">Create Feedback</h1>

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
        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Submit</button>
        <Link href="/feedback" class="bg-gray-300 text-black px-4 py-2 rounded">Cancel</Link>
      </div>
    </form>
  </div>
</MainLayout>
</template>
