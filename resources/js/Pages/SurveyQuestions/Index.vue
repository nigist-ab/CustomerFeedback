<script setup>
import { Head, Link, router } from '@inertiajs/vue3'
import MainLayout from '@/Layouts/MainLayout.vue'

const props = defineProps({ survey: Object, questions: Array })

function deleteQuestion(id) {
  if (confirm('Are you sure you want to delete this question?')) {
    router.delete(route('surveys.questions.destroy', [props.survey.id, id]))
  }
}
</script>

<template>
  <MainLayout>
    <div class="p-6">
      <Head :title="`Questions for ${survey.title}`" />
      <h1 class="text-2xl font-bold mb-6 text-blue-800">Survey Questions for "{{ survey.title }}"</h1>
      <!-- Removed the original Add Question button -->

      <div class="overflow-x-auto rounded-2xl shadow-xl border border-gray-100 bg-white">
        <table class="w-full min-w-[320px] text-sm divide-y divide-gray-100">
          <thead class="bg-gray-50">
            <tr>
              <th class="px-3 py-2 text-left text-xs font-bold text-gray-600 uppercase tracking-wider">Order</th>
              <th class="px-3 py-2 text-left text-xs font-bold text-gray-600 uppercase tracking-wider">Question</th>
              <th class="px-3 py-2 text-left text-xs font-bold text-gray-600 uppercase tracking-wider">Type</th>
              <th class="px-3 py-2 text-left text-xs font-bold text-gray-600 uppercase tracking-wider">Required</th>
              <th class="px-3 py-2 text-left text-xs font-bold text-gray-600 uppercase tracking-wider">Actions</th>
            </tr>
          </thead>
          <tbody class="bg-white divide-y divide-gray-100">
            <tr v-for="question in questions" :key="question.id" class="hover:bg-blue-50 transition-colors">
              <td class="px-3 py-2 font-semibold text-gray-900">{{ question.order }}</td>
              <td class="px-3 py-2 text-gray-700">{{ question.question_text }}</td>
              <td class="px-3 py-2 text-gray-700">{{ question.question_type }}</td>
              <td class="px-3 py-2">
                <span :class="[question.is_required ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-400', 'px-2 py-0.5 rounded-full text-xs font-semibold border border-gray-200']">
                  {{ question.is_required ? 'Yes' : 'No' }}
                </span>
              </td>
              <td class="px-3 py-2 flex gap-2">
                <Link
                  :href="route('surveys.questions.edit', [survey.id, question.id])"
                  class="text-yellow-500 hover:text-yellow-700 flex items-center space-x-1 text-xs font-semibold"
                  title="Edit"
                >
                  <span>Edit</span>
                  <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M15.232 5.232l3.536 3.536M9 13l6-6 3 3-6 6H9v-3z"/>
                    <path d="M16 7l1.5-1.5a2.121 2.121 0 1 1 3 3L19 10"/>
                  </svg>
                </Link>
                <button
                  @click="deleteQuestion(question.id)"
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
              </td>
            </tr>
          </tbody>
        </table>
      </div>

      <!-- Floating Action Button for Add Question -->
      <Link
        :href="route('surveys.questions.create', { survey: survey.id })"
        class="fixed bottom-8 right-8 z-50 bg-blue-600 hover:bg-blue-700 text-white rounded-full w-16 h-16 flex items-center justify-center text-3xl shadow-lg transition-transform duration-200 hover:scale-110"
        title="Add Question"
      >
        <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
        </svg>
      </Link>

      <div class="flex justify-end mt-8">
        <Link :href="route('surveys.index')" class="bg-gray-300 text-black px-4 py-2 rounded hover:bg-gray-400">
          ← Back to Surveys
        </Link>
      </div>
    </div>
  </MainLayout>
</template>

<style scoped>
/* Optional: subtle fade-in for table */
table {
  animation: fadeIn 0.3s ease;
}
@keyframes fadeIn {
  from { opacity: 0; transform: translateY(40px); }
  to { opacity: 1; transform: translateY(0); }
}
</style>
