<template>
  <MainLayout>
    <div>
      <h1 class="text-2xl font-bold mb-4">Fill Survey: {{ survey.title }}</h1>
      <form @submit.prevent="submit">
        <div v-for="question in questions" :key="question.id" class="mb-4">
          <label class="block font-semibold mb-1">{{ question.question_text }}</label>
          <div v-if="question.question_type === 'text'">
            <input v-model="answers[question.id]" type="text" class="border p-2 rounded w-full" />
          </div>
          <div v-else-if="question.question_type === 'textarea'">
            <textarea v-model="answers[question.id]" class="border p-2 rounded w-full"></textarea>
          </div>
          <div v-else-if="question.question_type === 'rating'">
            <div class="flex items-center space-x-1">
              <span
                v-for="star in 5"
                :key="star"
                class="cursor-pointer text-2xl"
                :class="{'text-yellow-400': answers[question.id] >= star, 'text-gray-300': answers[question.id] < star}"
                @click="answers[question.id] = star"
              >★</span>
              <span v-if="answers[question.id]" class="ml-2 text-sm text-gray-600">{{ answers[question.id] }}/5</span>
            </div>
          </div>
          <div v-else-if="question.question_type === 'radio'">
            <div v-for="opt in question.options" :key="opt" class="mr-4 inline-block">
              <label>
                <input type="radio" :value="opt" v-model="answers[question.id]" /> {{ opt }}
              </label>
            </div>
          </div>
          <div v-else-if="question.question_type === 'checkbox'">
            <div v-for="opt in question.options" :key="opt" class="mr-4 inline-block">
              <label>
                <input
                  type="checkbox"
                  :value="opt"
                  :checked="(answers[question.id] || []).includes(opt)"
                  @change="toggleCheckbox(question.id, opt)"
                /> {{ opt }}
              </label>
            </div>
          </div>
          <div v-else-if="question.question_type === 'select'">
            <select v-model="answers[question.id]" class="border p-2 rounded w-full">
              <option disabled value="">-- Select --</option>
              <option v-for="opt in question.options" :key="opt" :value="opt">{{ opt }}</option>
            </select>
          </div>
        </div>
        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Submit</button>
      </form>
      <div class="flex justify-end mt-8">
        <Link :href="route('surveys.index')" class="bg-gray-300 text-black px-4 py-2 rounded hover:bg-gray-400">
          ← Back to Surveys
        </Link>
      </div>
    </div>
  </MainLayout>
</template>

<script setup>
import { ref } from 'vue'
import { useForm, Link } from '@inertiajs/vue3'
import MainLayout from '@/Layouts/MainLayout.vue'

const props = defineProps({
  survey: Object,
  questions: Array,
})

const answers = ref({})

function toggleCheckbox(qid, opt) {
  if (!Array.isArray(answers.value[qid])) answers.value[qid] = []
  const idx = answers.value[qid].indexOf(opt)
  if (idx > -1) {
    answers.value[qid].splice(idx, 1)
  } else {
    answers.value[qid].push(opt)
  }
}

const form = useForm({
  survey_id: props.survey.id,
  respondent_id: props.auth?.user?.id ?? null, // Pass if logged in
  ip_address: null, // Optional – you can skip or get via backend
  answers: [],
})

function submit() {
  form.answers = props.questions.map(q => ({
    question_id: q.id,
    value: q.question_type === 'checkbox'
      ? answers.value[q.id] || []
      : answers.value[q.id] || ''
  }))
  form.post(route('survey-responses.store'))
}
</script>
