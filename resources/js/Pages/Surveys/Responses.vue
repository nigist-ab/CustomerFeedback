<template>
  <MainLayout>
    <div>
      <h1 class="text-2xl font-bold mb-4">Responses for "{{ survey.title }}"</h1>

      <div v-if="survey.responses.length === 0">No responses yet.</div>

      <div v-for="(response, index) in survey.responses" :key="response.id" class="mb-6 border p-4 rounded">
        <h2 class="font-semibold">Response #{{ index + 1 }}</h2>
        <p class="text-sm text-gray-500">Submitted by: {{ response.respondent.name }}</p>
        <ul class="mt-2">
          <li v-for="answer in response.answers" :key="answer.id" class="mb-2">
            <strong>{{ answer.question.question_text }}:</strong>
            <span>{{ answer.answer }}</span>
          </li>
        </ul>
      </div>
    </div>
  </MainLayout>
</template>

<script setup>
import MainLayout from '@/Layouts/MainLayout.vue'

const props = defineProps({
  survey: Object
})
</script>
