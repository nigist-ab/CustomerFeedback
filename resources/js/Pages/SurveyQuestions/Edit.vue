<script setup>
import { Head, useForm, Link } from '@inertiajs/vue3'
import { ref, watch, onMounted } from 'vue'
import MainLayout from '@/Layouts/MainLayout.vue'

const props = defineProps({ survey: Object, question: Object })

const form = useForm({
  question_text: props.question.question_text,
  question_type: props.question.question_type,
  options: [],
  is_required: !!props.question.is_required,
  order: props.question.order,
})

const optionsInput = ref('')

onMounted(() => {
  if (props.question.options) {
    try {
      const opts = typeof props.question.options === 'string'
        ? JSON.parse(props.question.options)
        : props.question.options
      optionsInput.value = Array.isArray(opts) ? opts.join(',') : ''
      form.options = Array.isArray(opts) ? opts : []
    } catch {
      optionsInput.value = ''
      form.options = []
    }
  }
})

watch(optionsInput, (val) => {
  form.options = val.split(',').map(o => o.trim()).filter(Boolean)
})

function submitForm() {
  form.put(route('surveys.questions.update', [props.survey.id, props.question.id]))
}
</script>

<template>
  <MainLayout>
    <div class="w-full max-w-[700px] mx-auto mt-10 bg-white rounded-2xl shadow-xl border border-gray-100 p-8">
      <Head title="Edit Question" />
      <h1 class="text-3xl font-extrabold text-blue-800 mb-8 text-center">Edit Question</h1>
      <form @submit.prevent="submitForm" class="space-y-6">
        <div>
          <label class="block font-semibold mb-2 text-gray-700">Question Text</label>
          <input v-model="form.question_text" required class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-200 focus:outline-none" placeholder="Enter question text" />
        </div>
        <div>
          <label class="block font-semibold mb-2 text-gray-700">Type</label>
          <select v-model="form.question_type" required class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-200 focus:outline-none">
            <option value="text">Text</option>
            <option value="textarea">Textarea</option>
            <option value="radio">Radio</option>
            <option value="checkbox">Checkbox</option>
            <option value="select">Select</option>
          </select>
        </div>
        <div v-if="['radio','checkbox','select'].includes(form.question_type)">
          <label class="block font-semibold mb-2 text-gray-700">Options (comma separated)</label>
          <input v-model="optionsInput" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-200 focus:outline-none" placeholder="Option1,Option2,Option3" />
        </div>
        <div class="flex items-center gap-2">
          <input type="checkbox" v-model="form.is_required" id="is_required" class="rounded border-gray-300 focus:ring-blue-200" />
          <label for="is_required" class="font-semibold text-gray-700">Required</label>
        </div>
        <div>
          <label class="block font-semibold mb-2 text-gray-700">Order</label>
          <input type="number" v-model="form.order" min="1" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-200 focus:outline-none" />
        </div>
        <div class="flex justify-between items-center mt-8">
          <Link :href="route('surveys.questions.index', props.survey.id)" class="bg-gray-300 text-gray-800 px-6 py-2 rounded-lg hover:bg-gray-400 transition-colors">
            ← Cancel
          </Link>
          <button type="submit" class="bg-blue-600 text-white px-8 py-2 rounded-lg hover:bg-blue-700 transition-colors font-semibold shadow">
            Update
          </button>
        </div>
      </form>
    </div>
  </MainLayout>
</template>
