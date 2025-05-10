<template>
    <MainLayout>
      <template #header>
        <h1 class="text-2xl font-bold">Create Ticket</h1>
      </template>
  
      <form @submit.prevent="submit" class="mt-4 space-y-4">
        <div>
          <label class="block font-medium">Subject</label>
          <input v-model="form.subject" type="text" class="input" />
          <div v-if="form.errors.subject" class="text-red-600 text-sm">{{ form.errors.subject }}</div>
        </div>
  
        <div>
          <label class="block font-medium">Description</label>
          <textarea v-model="form.description" class="input"></textarea>
          <div v-if="form.errors.description" class="text-red-600 text-sm">{{ form.errors.description }}</div>
        </div>
  
        <div>
          <label class="block font-medium">Priority</label>
          <select v-model="form.priority" class="input">
            <option value="low">Low</option>
            <option value="medium">Medium</option>
            <option value="high">High</option>
          </select>
          <div v-if="form.errors.priority" class="text-red-600 text-sm">{{ form.errors.priority }}</div>
        </div>
  
        <button class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700" type="submit">
          Submit
        </button>
      </form>
    </MainLayout>
  </template>
  
  <script setup>
  import { useForm } from '@inertiajs/vue3'
  import MainLayout from '@/Layouts/MainLayout.vue'
  
  const form = useForm({
    subject: '',
    description: '',
    priority: 'medium',
  })
  
  function submit() {
    form.post('/tickets')
  }
  </script>
  