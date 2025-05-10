<script setup>
import MainLayout from '@/Layouts/MainLayout.vue';
import { Head, Link } from '@inertiajs/vue3';
defineProps({ feedbacks: Array });
</script>

<template>
   <MainLayout>
  <Head title="Feedback List" />

  <div class="p-6">
    <h1 class="text-2xl font-bold mb-4">Feedback List</h1>
    <Link href="/feedback/create" class="bg-blue-500 text-white px-4 py-2 rounded mb-4 inline-block">
      Add Feedback
    </Link>

    <table class="w-full border mt-4">
      <thead>
        <tr class="bg-gray-100">
          <th class="p-2 border">User</th>
          <th class="p-2 border">Product</th>
          <th class="p-2 border">Survey</th>
          <th class="p-2 border">Message</th>
          <th class="p-2 border">Rating</th>
          <th class="p-2 border">Actions</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="item in feedbacks" :key="item.id">
          <td class="p-2 border">{{ item.user?.name }}</td>
          <td class="p-2 border">{{ item.product?.name }}</td>
          <td class="p-2 border">{{ item.survey?.title || 'N/A' }}</td>
          <td class="p-2 border">{{ item.message }}</td>
          <td class="p-2 border">{{ item.rating }}</td>
          <td class="p-2 border">
            <Link :href="`/feedback/${item.id}/edit`" class="text-blue-600 mr-2">Edit</Link>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</MainLayout>
</template>
