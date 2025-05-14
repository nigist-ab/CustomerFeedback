<script setup>
import MainLayout from '@/Layouts/MainLayout.vue';
import { Head, useForm, Link } from '@inertiajs/vue3';

const form = useForm({
  PRODUCTNAME: '', // Keep only PRODUCTNAME
});

const submitForm = () => {
  form.post('/products');
};
</script>

<template>
  <MainLayout>
    <Head title="Add Product" />

    <div class="p-6">
      <h1 class="text-3xl font-extrabold text-gray-800 mb-6">Add Product</h1>

      <form @submit.prevent="submitForm" class="space-y-6 bg-white p-6 rounded-lg shadow-md">
        <div>
          <label class="block text-gray-700 font-semibold mb-2">Product Name</label>
          <input
            v-model="form.PRODUCTNAME"
            type="text"
            class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-blue-500 focus:outline-none"
          />
        </div>

        <div class="flex gap-4">
          <button
            type="submit"
            class="bg-gradient-to-r from-blue-500 to-purple-500 text-white px-6 py-3 rounded-lg shadow-md hover:shadow-lg transition-all duration-300"
          >
            Submit
          </button>
          <Link
            href="/products"
            class="bg-gray-300 text-black px-6 py-3 rounded-lg shadow-md hover:bg-gray-400 transition-all duration-300"
          >
            Cancel
          </Link>
        </div>
      </form>
    </div>
  </MainLayout>
</template>
