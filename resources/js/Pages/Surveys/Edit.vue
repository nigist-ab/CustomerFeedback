<template>
  <MainLayout>
    <template #header>
      <h1 class="text-2xl font-bold">Edit Survey</h1>
    </template>
    
    <!-- 🔹 Add Question Button -->
    <div class="mb-4">
      <Link
        :href="route('survey-questions.create', survey.id)"
        class="bg-green-600 hover:bg-green-700 text-white font-semibold py-2 px-4 rounded"
      >
        ➕ Add Question
      </Link>
    </div>

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
          Update
        </button>
      </form>
    </MainLayout>
  </template>
  
  <script setup>
  import { useForm } from '@inertiajs/vue3'
  import MainLayout from '@/Layouts/MainLayout.vue'
  
  const props = defineProps({
    survey: Object
  })
  
  const form = useForm({
    title: props.survey.title,
    description: props.survey.description,
    status: props.survey.status,
    start_date: props.survey.start_date,
    end_date: props.survey.end_date,
  })
  
  function submit() {
    form.put(`/surveys/${props.survey.id}`)
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
  