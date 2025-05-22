<template>
  <div class="p-8 bg-gradient-to-br from-blue-50 via-white to-cyan-50 min-h-screen">
    <div class="max-w-3xl mx-auto bg-white rounded-2xl shadow-xl border border-gray-100 p-8">
      <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold text-blue-800">Survey Response #{{ response.id }}</h1>
        <a
          href="/survey-responses"
          class="bg-gray-200 text-gray-700 px-4 py-2 rounded hover:bg-gray-300 transition-colors text-sm font-semibold"
        >
          ← Back
        </a>
      </div>
      <div class="mb-4">
        <p><span class="font-semibold text-gray-700">Survey:</span> {{ response.survey?.title ?? 'No Survey' }}</p>
        <p><span class="font-semibold text-gray-700">Respondent:</span> {{ response.respondent?.name ?? 'Anonymous' }}</p>
        <p><span class="font-semibold text-gray-700">Submitted at:</span> {{ response.submitted_at }}</p>
        <p><span class="font-semibold text-gray-700">IP Address:</span> {{ response.ip_address }}</p>
      </div>
      <div v-if="response.answers && response.answers.length" class="mt-8">
        <h2 class="text-xl font-bold mb-4 text-blue-700">Answers</h2>
        <div class="space-y-4">
          <div
            v-for="answer in response.answers"
            :key="answer.id"
            class="bg-blue-50 border border-blue-100 rounded-lg p-4"
          >
            <template v-if="answer.question && answer.question.question_type === 'checkbox'">
              <div class="font-semibold text-gray-800 mb-1">{{ answer.question.question_text }}</div>
              <div class="text-gray-700">
                <span v-for="(val, idx) in JSON.parse(answer.value || '[]')" :key="idx">
                  {{ val }}<span v-if="idx < JSON.parse(answer.value || '[]').length - 1">, </span>
                </span>
              </div>
            </template>
            <template v-else>
              <div class="font-semibold text-gray-800 mb-1">{{ answer.question?.question_text ?? 'Question' }}</div>
              <div class="text-gray-700">{{ answer.value }}</div>
            </template>
          </div>
        </div>
      </div>
      <div v-else class="mt-8 text-gray-500 italic">No answers submitted.</div>
    </div>
  </div>
</template>

<script setup>
defineProps({ response: Object })
</script>
