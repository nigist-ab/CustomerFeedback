<template>
  <MainLayout>
    <div class="w-full max-w-[900px] mx-auto mt-10 bg-white rounded-2xl shadow-xl border border-gray-100 p-8">
      <h1 class="text-3xl font-extrabold text-blue-800 mb-8 text-center">Create New Survey</h1>
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
        <div class="flex justify-end mt-8">
          <button
            type="submit"
            class="bg-blue-600 text-white px-8 py-2 rounded-lg hover:bg-blue-700 transition-colors font-semibold shadow"
          >
            Create Survey
          </button>
        </div>
      </form>
    </div>
  </MainLayout>
</template>

<script setup>
import { useForm } from '@inertiajs/vue3'
import MainLayout from '@/Layouts/MainLayout.vue'

const form = useForm({
  title: '',
  description: '',
  start_date: '',
  end_date: '',
  status: 'draft',
})

function submit() {
  form.post(route('surveys.store'))
}
</script>

