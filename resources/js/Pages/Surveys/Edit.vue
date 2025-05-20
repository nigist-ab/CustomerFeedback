<template>
  <MainLayout>
    <div class="w-full max-w-[900px] mx-auto mt-10 bg-white rounded-2xl shadow-xl border border-gray-100 p-8">
      <h1 class="text-3xl font-extrabold text-blue-800 mb-8 text-center">Edit Survey</h1>
      <form @submit.prevent="submit" class="space-y-6">
        <div>
          <label class="block font-semibold mb-2 text-gray-700" for="title">Title</label>
          <input
            id="title"
            v-model="form.title"
            type="text"
            required
            class="border border-gray-300 rounded-lg px-4 py-2 w-full focus:ring-2 focus:ring-blue-200 focus:outline-none"
            placeholder="Enter survey title"
          />
        </div>
        <div>
          <label class="block font-semibold mb-2 text-gray-700" for="description">Description</label>
          <textarea
            id="description"
            v-model="form.description"
            class="border border-gray-300 rounded-lg px-4 py-2 w-full focus:ring-2 focus:ring-blue-200 focus:outline-none min-h-[100px]"
            rows="4"
            placeholder="Describe your survey..."
          ></textarea>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
          <div>
            <label class="block font-semibold mb-2 text-gray-700" for="start_date">Start Date</label>
            <input
              id="start_date"
              v-model="form.start_date"
              type="date"
              class="border border-gray-300 rounded-lg px-4 py-2 w-full focus:ring-2 focus:ring-blue-200 focus:outline-none"
            />
          </div>
          <div>
            <label class="block font-semibold mb-2 text-gray-700" for="end_date">End Date</label>
            <input
              id="end_date"
              v-model="form.end_date"
              type="date"
              class="border border-gray-300 rounded-lg px-4 py-2 w-full focus:ring-2 focus:ring-blue-200 focus:outline-none"
            />
          </div>
        </div>
        <div>
          <label class="block font-semibold mb-2 text-gray-700" for="status">Status</label>
          <select
            id="status"
            v-model="form.status"
            required
            class="border border-gray-300 rounded-lg px-4 py-2 w-full focus:ring-2 focus:ring-blue-200 focus:outline-none"
          >
            <option value="draft">Draft</option>
            <option value="active">Active</option>
            <option value="closed">Closed</option>
          </select>
        </div>
        <div class="flex justify-between items-center mt-8">
          <Link href="/surveys" class="bg-gray-300 text-gray-800 px-6 py-2 rounded-lg hover:bg-gray-400 transition-colors">
            ← Back
          </Link>
          <button
            type="submit"
            class="bg-blue-600 text-white px-8 py-2 rounded-lg hover:bg-blue-700 transition-colors font-semibold shadow"
          >
            Update Survey
          </button>
        </div>
      </form>
    </div>
  </MainLayout>
</template>

<script setup>
import { ref, onMounted } from 'vue'
import { Link, router } from '@inertiajs/vue3'
import MainLayout from '@/Layouts/MainLayout.vue'

const props = defineProps({
  survey: Object,
})

const form = ref({
  title: '',
  description: '',
  start_date: '',
  end_date: '',
  status: 'draft',
})

onMounted(() => {
  form.value = {
    title: props.survey.title,
    description: props.survey.description,
    start_date: props.survey.start_date,
    end_date: props.survey.end_date,
    status: props.survey.status,
  }
})

function submit() {
  router.put(route('surveys.update', props.survey.id), form.value)
}
</script>
