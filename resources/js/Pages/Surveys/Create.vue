<template>
    <MainLayout>
      <template #header>
        <h1 class="text-2xl font-bold">Create Survey</h1>
      </template>
  
      <form @submit.prevent="submit" class="space-y-4 mt-4">
        <div>
          <label class="block font-medium">Title</label>
          <input v-model="form.title" type="text" class="input" />
        </div>
  
        <div>
          <label class="block font-medium">Description</label>
          <textarea v-model="form.description" class="input"></textarea>
        </div>
  
        <div>
          <label class="block font-medium">Status</label>
          <select v-model="form.status" class="input">
            <option value="draft">Draft</option>
            <option value="active">Active</option>
            <option value="closed">Closed</option>
          </select>
        </div>
  
        <div>
          <label class="block font-medium">Start Date</label>
          <input v-model="form.start_date" type="date" class="input" />
        </div>
  
        <div>
          <label class="block font-medium">End Date</label>
          <input v-model="form.end_date" type="date" class="input" />
        </div>
  
        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
          Create
        </button>
      </form>
    </MainLayout>
  </template>
  
  <script setup>
  import { useForm } from '@inertiajs/vue3'
  import MainLayout from '@/Layouts/MainLayout.vue';
  
  const form = useForm({
    title: '',
    description: '',
    status: 'draft',
    start_date: '',
    end_date: ''
  })
  
  function submit() {
    form.post('/surveys')
  }
  </script>
  
  <style scoped>
  .input {
    width: 100%;
    padding: 8px;
    border: 1px solid #ccc;
    border-radius: 6px;
  }
  </style>
  