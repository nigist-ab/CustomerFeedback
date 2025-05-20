<template>
  <MainLayout>
    <div class="p-6">
      <h1 class="text-3xl font-extrabold text-gray-800 mb-6 ">Surveys</h1>

      <div class="grid gap-6 md:grid-cols-2">
        <div
          v-for="survey in surveys"
          :key="survey.id"
          class="bg-white border border-gray-100 rounded-2xl shadow-xl p-6 flex flex-col"
        >
          <h2 class="text-xl font-bold text-blue-700 mb-2">{{ survey.title }}</h2>
          <p class="mb-4 text-gray-700">{{ survey.description }}</p>
          <div class="flex flex-wrap gap-3 mt-auto">
            <Link
              :href="route('surveys.questions.index', survey.id)"
              class="bg-blue-100 text-blue-700 px-4 py-2 rounded-lg hover:bg-blue-200 transition-colors font-semibold flex items-center gap-1"
            >
              <span>Questions</span>
              <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round">
                <circle cx="12" cy="12" r="10"></circle>
                <path d="M8 15h.01M12 9v2a2 2 0 1 1-2 2"></path>
              </svg>
            </Link>

            <Link
              v-if="user && survey.creator_id !== user.id"
              :href="route('surveys/fill', { survey: survey.id })"
              class="text-green-600 hover:text-green-800 underline px-2 py-2 font-semibold flex items-center gap-1"
            >
              <span>Fill Survey</span>
              <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round">
                <path d="M12 20h9"></path>
                <path d="M12 4v16"></path>
                <path d="M4 12h16"></path>
              </svg>
            </Link>

            <button
              @click="editSurvey(survey.id)"
              class="text-yellow-500 hover:text-yellow-700 flex items-center space-x-1 text-xs font-semibold"
              title="Edit"
            >
              <span>Edit</span>
              <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round">
                <path d="M15.232 5.232l3.536 3.536M9 13l6-6 3 3-6 6H9v-3z"/>
                <path d="M16 7l1.5-1.5a2.121 2.121 0 1 1 3 3L19 10"/>
              </svg>
            </button>

            <button
              @click="deleteSurvey(survey.id)"
              class="text-red-500 hover:text-red-700 flex items-center space-x-1 text-xs font-semibold"
              title="Delete"
            >
              <span>Delete</span>
              <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round">
                <polyline points="3 6 5 6 21 6"></polyline>
                <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                <line x1="10" x2="10" y1="11" y2="17"></line>
                <line x1="14" x2="14" y1="11" y2="17"></line>
              </svg>
            </button>
          </div>
        </div>
      </div>
    </div>

    <!-- Floating Action Button for Create New Survey -->
    <button
      @click="goToCreate"
      class="fixed bottom-8 right-8 z-50 bg-gradient-to-r from-blue-600 to-blue-400 text-white rounded-full w-16 h-16 flex items-center justify-center text-3xl shadow-lg hover:from-green-700 hover:to-green-500 transition-transform duration-200 hover:scale-110"
      title="Create New Survey"
    >
      <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
      </svg>
    </button>
  </MainLayout>
</template>

<script setup>
import { Link, router } from '@inertiajs/vue3'
import MainLayout from '@/Layouts/MainLayout.vue'

const props = defineProps({
  surveys: Array,
  user: Object, // Add user prop
})

function goToCreate() {
  router.get(route('surveys.create'))
}

function editSurvey(id) {
  router.get(route('surveys.edit', id))
}

function deleteSurvey(id) {
  if (confirm('Are you sure you want to delete this survey?')) {
    router.delete(route('surveys.destroy', id), {
      onSuccess: () => router.reload(),
    })
  }
}
</script>