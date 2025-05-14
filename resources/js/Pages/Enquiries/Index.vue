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
        <Link v-if="!isAgent" href="/enquiries/create" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
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
            <tr
              v-for="enquiry in enquiries"
              :key="enquiry.id"
              class="hover:bg-gray-100 transition-colors cursor-pointer"
            >
              <Link :href="`/enquiries/${enquiry.id}`" class="contents">
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
                    <span v-if="enquiry.assignedAgent" class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-indigo-100 text-indigo-800">
                      Assigned
                    </span>
                    <span v-else class="text-gray-400 italic">Unassigned</span>
                  </div>
                </td>
              </Link>
              <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium flex justify-end gap-2">
                <div v-if="isAgent">
                  <!-- Show Respond action for agents -->
                  <button
                    @click="respondToEnquiry(enquiry.id)"
                    class="text-blue-500 hover:text-blue-700 hover:underline transition-colors flex items-center gap-1"
                  >
                    Respond
                  </button>
                </div>
                <div v-else>
                  <!-- Show other actions for non-agents -->
                  <button
                    @click="openAssignModal(enquiry)"
                    class="text-green-500 hover:text-green-700 hover:underline transition-colors flex items-center gap-1"
                  >
                    Assign
                  </button>
                  <Link :href="`/enquiries/${enquiry.id}/edit`" class="text-blue-500 mr-4">Edit</Link>
                  <button @click="deleteEnquiry(enquiry.id)" class="text-red-500 hover:text-red-700 hover:underline transition-colors flex items-center gap-1">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4">
                      <polyline points="3 6 5 6 21 6"></polyline>
                      <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                      <line x1="10" x2="10" y1="11" y2="17"></line>
                      <line x1="14" x2="14" y1="11" y2="17"></line>
                    </svg>
                    Delete
                  </button>
                </div>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>

    <!-- Assign Modal -->
    <div v-if="showAssignModal" class="fixed inset-0 bg-gray-800 bg-opacity-50 flex items-center justify-center">
      <div class="bg-white p-6 rounded shadow-lg w-96">
        <h2 class="text-xl font-bold mb-4">Assign Enquiry</h2>
        <div class="mb-4">
          <label class="block font-semibold mb-1">Select Agent</label>
          <select v-model="selectedAgentId" class="border px-2 py-1 rounded w-full">
            <option value="" disabled>Select an agent</option>
            <option v-for="agent in agents" :key="agent.id" :value="agent.id">{{ agent.name }}</option>
          </select>
        </div>
        <div class="flex justify-end space-x-2">
          <button @click="closeAssignModal" class="px-4 py-2 bg-gray-300 rounded hover:bg-gray-400">
            Cancel
          </button>
          <button
            @click="assignEnquiry"
            :disabled="!selectedAgentId"
            class="px-4 py-2 bg-green-500 text-white rounded hover:bg-green-600 disabled:opacity-50"
          >
            Assign
          </button>
        </div>
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
    agents: Array, // Pass agents from the backend
    isAgent: Boolean, // Pass whether the logged-in user is an agent
  },
  data() {
    return {
      showAssignModal: false,
      selectedEnquiry: null,
      selectedAgentId: null,
    };
  },
  methods: {
    openAssignModal(enquiry) {
      this.selectedEnquiry = enquiry;
      this.selectedAgentId = null;
      this.showAssignModal = true;
    },
    closeAssignModal() {
      this.showAssignModal = false;
    },
    assignEnquiry() {
      if (this.selectedAgentId) {
        Inertia.post(`/enquiries/${this.selectedEnquiry.id}/assign`, {
          assigned_to: this.selectedAgentId,
        }).then(() => {
          this.closeAssignModal();
        });
      }
    },
    deleteEnquiry(id) {
      if (confirm('Are you sure you want to delete this enquiry?')) {
        Inertia.delete(route('enquiries.destroy', id));
      }
    },
    respondToEnquiry(id) {
      // Redirect to the enquiry detail page for responding
      Inertia.get(`/enquiries/${id}`);
    },
  },
};
</script>
