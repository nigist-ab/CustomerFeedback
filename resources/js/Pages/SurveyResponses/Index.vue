<template>
    <MainLayout>
  <div>
    <h1>Survey Responses</h1>
    <ul>
      <li v-for="response in responses" :key="response.id">
        <inertia-link :href="route('survey-responses.show', response.id)">
          {{ response.id }} - {{ response.survey?.title ?? 'No Survey Title' }}
        </inertia-link>
      </li>
    </ul>
  </div>
  </MainLayout>
</template>

<script setup>
import MainLayout from '@/Layouts/MainLayout.vue'
defineProps({ responses: Array })
</script>
