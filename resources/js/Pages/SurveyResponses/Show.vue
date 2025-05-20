<template>
  <div>
    <h1>Survey Response #{{ response.id }}</h1>
    <p>Survey: {{ response.survey?.title ?? 'No Survey' }}</p>
    <p>Respondent: {{ response.respondent?.name ?? 'Anonymous' }}</p>
    <p>Submitted at: {{ response.submitted_at }}</p>
    <p>IP Address: {{ response.ip_address }}</p>
    <div v-if="response.answers && response.answers.length">
      <h2>Answers</h2>
      <ul>
        <li v-for="answer in response.answers" :key="answer.id">
          <template v-if="answer.question && answer.question.question_type === 'checkbox'">
            {{ answer.question.question_text }}:
            <span v-for="(val, idx) in JSON.parse(answer.value || '[]')" :key="idx">
              {{ val }}<span v-if="idx < JSON.parse(answer.value || '[]').length - 1">, </span>
            </span>
          </template>
          <template v-else>
            {{ answer.question?.question_text ?? 'Question' }}: {{ answer.value }}
          </template>
        </li>
      </ul>
    </div>
</div>
</template>

<script setup>
defineProps({ response: Object })
</script>
