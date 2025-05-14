<template>
    <div class="max-w-2xl mx-auto">
      <h1 class="text-2xl font-bold mb-4">Add Question to: {{ survey.title }}</h1>
  
      <form @submit.prevent="submit">
        <div class="mb-4">
          <label class="block font-semibold">Question Text</label>
          <input v-model="form.question_text" type="text" class="w-full border rounded p-2" required />
        </div>
  
        <div class="mb-4">
          <label class="block font-semibold">Question Type</label>
          <select v-model="form.question_type" class="w-full border rounded p-2" required>
            <option value="text">Text</option>
            <option value="multiple-choice">Multiple Choice</option>
            <option value="rating">Rating</option>
          </select>
        </div>
  
        <div v-if="form.question_type === 'multiple-choice'" class="mb-4">
          <label class="block font-semibold">Options (comma-separated)</label>
          <input v-model="form.options" type="text" class="w-full border rounded p-2" />
        </div>
  
        <div class="mb-4">
          <label>
            <input v-model="form.is_required" type="checkbox" />
            Required?
          </label>
        </div>
  
        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">
          Save Question
        </button>
      </form>
    </div>
  </template>

<script setup>
import { reactive } from 'vue'
import { useForm, router } from '@inertiajs/vue3'
import { defineProps } from 'vue'

const props = defineProps({
  survey: Object
})

const form = useForm({
  survey_id: props.survey.id,
  question_text: '',
  question_type: 'text',
  options: '',
  is_required: false,
  order: 0
})

function submit() {
  // Convert comma-separated options into JSON array
  if (form.question_type === 'multiple-choice' && typeof form.options === 'string') {
    form.options = JSON.stringify(form.options.split(',').map(opt => opt.trim()))
  }

  form.post(route('survey-questions.store'), {
    onSuccess: () => {
      form.reset()
    }
  })
}
</script>
