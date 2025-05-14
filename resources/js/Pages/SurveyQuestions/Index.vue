<!-- resources/js/Pages/SurveyQuestions/Index.vue -->
<template>
    <MainLayout>
      <div class="p-4">
        <h1 class="text-2xl font-bold mb-4">Survey Questions</h1>
        <Link :href="route('survey-questions.create', { survey: survey.id })" class="bg-blue-600 text-white px-4 py-2 rounded">Add Question</Link>
  
        <div v-if="questions.length" class="mt-6 space-y-4">
          <div v-for="question in questions" :key="question.id" class="p-4 bg-white shadow rounded">
            <h2 class="font-semibold">{{ question.question_text }}</h2>
            <p class="text-sm text-gray-500">Type: {{ question.question_type }} | Required: {{ question.is_required ? 'Yes' : 'No' }}</p>
            <div class="mt-2 space-x-2">
              <Link :href="route('survey-questions.edit', { question: question.id })" class="text-blue-600">Edit</Link>
              <button @click="deleteQuestion(question.id)" class="text-red-600">Delete</button>
            </div>
          </div>
        </div>
  
        <p v-else class="text-gray-500 mt-4">No questions added yet.</p>
      </div>
    </MainLayout>
  </template>
  
  <script setup>
  import { Link, router } from '@inertiajs/vue3';
  import MainLayout from '@/Layouts/MainLayout.vue';
  import { defineProps } from 'vue';
  
  const props = defineProps({
    survey: Object,
    questions: Array,
  });
  
  function deleteQuestion(id) {
    if (confirm('Are you sure you want to delete this question?')) {
      router.delete(route('survey-questions.destroy', id));
    }
  }
  </script>
  