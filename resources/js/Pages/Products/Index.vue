<script setup>
import MainLayout from '@/Layouts/MainLayout.vue';
import { Head, Link } from '@inertiajs/vue3';

defineProps({ products: Array });
</script>

<template>
  <MainLayout>
    <Head title="Products" />

    <div class="p-6">
      <h1 class="text-3xl font-extrabold text-gray-800 mb-6">Products</h1>
      <Link
        href="/products/create"
        class="bg-gradient-to-r from-blue-500 to-purple-500 text-white px-6 py-3 rounded-lg shadow-md hover:shadow-lg transition-all duration-300 inline-block mb-6"
      >
        ➕ Add Product
      </Link>

      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <div
          v-for="product in products"
          :key="product.id"
          class="bg-white rounded-lg shadow-md p-4 hover:shadow-lg transition-all duration-300"
        >
          <h2 class="text-lg font-semibold text-gray-700 text-center">{{ product.PRODUCTNAME }}</h2>
        </div>
      </div>
    </div>
  </MainLayout>
</template>
