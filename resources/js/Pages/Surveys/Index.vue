
<template>
    <MainLayout>
      <template #header>
        <h1 class="text-2xl font-bold">Surveys</h1>
      </template>
  
      <div class="mt-4 space-y-4">
        <Link href="/surveys/create" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
          Create New Survey
        </Link>
  
        <div v-if="surveys.length">
          <ul class="divide-y">
            <li v-for="survey in surveys" :key="survey.id" class="py-4">
              <h2 class="font-semibold">{{ survey.title }}</h2>
              <p class="text-sm text-gray-600">{{ survey.status }} — {{ survey.start_date }} to {{ survey.end_date }}</p>
              <div class="mt-2">
                <Link :href="`/surveys/${survey.id}/edit`" class="text-blue-500 mr-4">Edit</Link>
                <button @click="deleteSurvey(survey.id)" class="text-red-500">Delete</button>
              </div>
            </li>
          </ul>
        </div>
        <div v-else>
          <p>No surveys found.</p>
        </div>
      </div>
    </MainLayout>
  </template>
  
  <script setup>
  import { Link, router } from '@inertiajs/vue3'
  import MainLayout from '@/Layouts/MainLayout.vue'
  
  const props = defineProps({
    surveys: Array
  })
  
  function deleteSurvey(id) {
    if (confirm('Are you sure you want to delete this survey?')) {
      router.delete(`/surveys/${id}`)
    }
  }
  </script>
  