<template>
  <MainLayout>
    <div class="p-6">
      <h1 class="text-3xl font-bold text-gray-800 mb-6 flex items-center gap-2">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-6 h-6 text-blue-500">
          <path d="M4 4h16a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2z"></path>
          <path d="M4 10h16"></path>
          <path d="M10 14h4"></path>
        </svg>
        Enquiries
      </h1>

      <div class="flex justify-end mb-4">
        <Link
          :href="route('enquiries.create')"
          class="bg-gradient-to-r from-blue-500 to-indigo-500 hover:from-blue-600 hover:to-indigo-600 text-white px-6 py-3 rounded-full shadow-md transition-all duration-300 transform hover:scale-105 font-semibold flex items-center gap-2"
        >
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-5 h-5">
            <line x1="12" x2="12" y1="5" y2="19"></line>
            <line x1="5" x2="19" y1="12" y2="12"></line>
          </svg>
          New Enquiry
        </Link>
      </div>

      <div class="bg-white rounded-lg shadow-lg overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200">
          <thead class="bg-gray-50">
            <tr>
              <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                Subject
              </th>
              <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                Message
              </th>
              <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                Status
              </th>
              <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                Assigned Agent
              </th>
              <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                Actions
              </th>
            </tr>
          </thead>
          <tbody class="bg-white divide-y divide-gray-200">
            <tr v-for="enquiry in enquiries" :key="enquiry.id" class="hover:bg-gray-100 transition-colors">
              <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 font-medium">
                <span class="inline-block truncate max-w-[200px]">{{ enquiry.subject }}</span>
              </td>
              <td class="px-6 py-4 text-sm text-gray-500">
                <span class="inline-block truncate max-w-[300px]">{{ enquiry.message }}</span>
              </td>
              <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                <span :class="[
                  enquiry.status === 'open' ? 'bg-green-200 text-green-700' :
                  enquiry.status === 'pending' ? 'bg-yellow-200 text-yellow-700' :
                  'bg-red-200 text-red-700',
                  'px-2 py-1 rounded-full text-xs font-semibold'
                ]">
                  {{ enquiry.status }}
                </span>
              </td>
              <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                <div class="flex items-center gap-2">
                  <span v-if="enquiry.assigned_agent" class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-indigo-100 text-indigo-800">
                    {{ enquiry.assigned_agent.name }}
                  </span>
                  <span v-else class="text-gray-400 italic">Unassigned</span>
                </div>
              </td>
              <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium flex justify-end gap-2">
                <Link :href="route('enquiries.edit', enquiry.id)" class="text-blue-500 hover:text-blue-700 hover:underline transition-colors flex items-center gap-1">
                  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4">
                    <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                    <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                  </svg>
                  Edit
                </Link>
                <button @click="deleteEnquiry(enquiry.id)" class="text-red-500 hover:text-red-700 hover:underline transition-colors flex items-center gap-1">
                  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4">
                    <polyline points="3 6 5 6 21 6"></polyline>
                    <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                    <line x1="10" x2="10" y1="11" y2="17"></line>
                    <line x1="14" x2="14" y1="11" y2="17"></line>
                  </svg>
                  Delete
                </button>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </MainLayout>
</template>

<script>
import { Link } from '@inertiajs/vue3';
import { Inertia } from '@inertiajs/inertia';
import MainLayout from '@/Layouts/MainLayout.vue';

export default {
  components: {
    Link,
    MainLayout,
  },
  props: {
    enquiries: Array,
  },
  methods: {
    deleteEnquiry(id) {
      if (confirm('Are you sure you want to delete this enquiry?')) {
        Inertia.delete(route('enquiries.destroy', id));
      }
    },
  },
};
</script>
