<template>
    <MainLayout>
  <div>
    <h1>Submit Survey Response</h1>
    <form @submit.prevent="submit">
      <div>
        <label>Survey ID:</label>
        <input v-model="form.survey_id" type="number" required />
      </div>
      <div>
        <label>Respondent ID (optional):</label>
        <input v-model="form.respondent_id" type="number" />
      </div>
      <div>
        <label>IP Address (optional):</label>
        <input v-model="form.ip_address" type="text" />
      </div>
      <!-- Add answer fields if needed -->
      <button type="submit">Submit</button>
    </form>
  </div>
  </MainLayout>
</template>

<script setup>
import { useForm } from '@inertiajs/vue3'
import MainLayout from '@/Layouts/MainLayout.vue'

const form = useForm({
  survey_id: '',
  respondent_id: '',
  ip_address: '',
  // Add answer fields if needed
})

function submit() {
  form.post(route('survey-responses.store'))
}
</script>
