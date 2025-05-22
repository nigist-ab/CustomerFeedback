<template>
  <MainLayout>
    <div class="p-6 bg-gradient-to-br from-blue-50 via-white to-cyan-50 min-h-screen">
      <h1 class="text-4xl font-extrabold mb-10 text-blue-800 tracking-tight drop-shadow">Enquiries</h1>

      <!-- Enquiries Button for customers only -->
      <div v-if="!isAgent && !isAdmin" class="mb-4">
        <Link
          href="/enquiries"
          class="inline-block bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded shadow transition"
        >
          Enquiries
        </Link>
      </div>

      <div class="bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-100">
        <table class="min-w-full divide-y divide-gray-200">
          <thead class="bg-gray-50">
            <tr>
              <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-gray-600 uppercase tracking-wider">
                Subject
              </th>
              <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-gray-600 uppercase tracking-wider">
                Message
              </th>
              <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-gray-600 uppercase tracking-wider">
                Status
              </th>
              <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-gray-600 uppercase tracking-wider">
                Assigned Agent
              </th>
              <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-gray-600 uppercase tracking-wider">
                Response
              </th>
              <th scope="col" class="px-6 py-4 text-right text-xs font-bold text-gray-600 uppercase tracking-wider">
                Actions
              </th>
            </tr>
          </thead>
          <tbody class="bg-white divide-y divide-gray-100">
            <tr
              v-for="enquiry in enquiries"
              :key="enquiry.id"
              class="hover:bg-blue-50 transition-colors cursor-pointer"
            >
              <Link :href="`/enquiries/${enquiry.id}`" class="contents">
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 font-semibold">
                  <span class="inline-block truncate max-w-[200px]">{{ enquiry.subject }}</span>
                </td>
                <td class="px-6 py-4 text-sm text-gray-600">
                  <span class="inline-block truncate max-w-[150px]">{{ enquiry.message }}</span>
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                  <span :class="[
                    enquiry.status === 'open' ? 'bg-green-100 text-green-700' :
                    enquiry.status === 'pending' ? 'bg-yellow-100 text-yellow-700' :
                    'bg-red-100 text-red-700',
                    'px-3 py-1 rounded-full text-xs font-semibold border border-gray-200 shadow-sm'
                  ]">
                    {{ enquiry.status }}
                  </span>
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                  <div class="flex items-center gap-2">
                    <span v-if="enquiry.assignedAgent" class="inline-flex items-center px-3 py-0.5 rounded-full text-xs font-medium bg-indigo-100 text-indigo-800 border border-indigo-200 shadow">
                      Assign
                    </span>
                    <span v-else class="inline-flex items-center px-3 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-400 border border-gray-200 italic">
                      Unassigned
                    </span>
                  </div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                  <span
                    v-if="enquiry.response"
                    class="inline-block truncate max-w-[150px]"
                  >{{ enquiry.response }}</span>
                  <span v-else class="italic text-gray-400">No response</span>
                </td>
              </Link>
              <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium flex justify-end gap-2">
                <div v-if="isAgent">
                  <!-- Show Respond action for agents -->
                  <button
                    @click="respondToEnquiry(enquiry.id)"
                    class="text-blue-500 hover:text-blue-700 flex items-center space-x-1 text-xs font-semibold"
                    title="Respond"
                  >
                    <span>Respond</span>
                    <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round">
                      <path d="M22 2L11 13"></path>
                      <polygon points="22 2 15 22 11 13 2 9 22 2"></polygon>
                    </svg>
                  </button>
                </div>
                <div v-else-if="isAdmin" class="flex gap-2">
                  <!-- Assign Button for admin only -->
                  <button
                    @click="openAssignModal(enquiry)"
                    class="text-green-500 hover:text-green-700 flex items-center space-x-1 text-xs font-semibold"
                    title="Assign"
                  >
                    <span>Assign</span>
                    <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round">
                      <path d="M12 19v-6M12 13l-4 4m4-4l4 4"></path>
                      <circle cx="12" cy="7" r="4"></circle>
                    </svg>
                  </button>
                </div>
                <div v-else class="flex gap-2">
                  <!-- Edit Button for customer only -->
                  <Link :href="`/enquiries/${enquiry.id}/edit`" class="text-yellow-500 hover:text-yellow-700 flex items-center space-x-1 text-xs font-semibold" title="Edit">
                    <span>Edit</span>
                    <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round">
                      <path d="M15.232 5.232l3.536 3.536M9 13l6-6 3 3-6 6H9v-3z"/>
                      <path d="M16 7l1.5-1.5a2.121 2.121 0 1 1 3 3L19 10"/>
                    </svg>
                  </Link>
                  <!-- Delete Button -->
                  <button @click="deleteEnquiry(enquiry.id)" class="text-red-500 hover:text-red-700 flex items-center space-x-1 text-xs font-semibold" title="Delete">
                    <span>Delete</span>
                    <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round">
                      <polyline points="3 6 5 6 21 6"></polyline>
                      <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                      <line x1="10" x2="10" y1="11" y2="17"></line>
                      <line x1="14" x2="14" y1="11" y2="17"></line>
                    </svg>
                  </button>
                </div>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>

    <!-- Floating Action Button for New Enquiry -->
    <Link
      v-if="!isAgent && !isAdmin"
      href="/enquiries/create"
      class="fixed bottom-8 right-8 z-50 bg-blue-600 hover:bg-blue-700 text-white rounded-full w-16 h-16 flex items-center justify-center text-3xl shadow-lg transition-transform duration-200 hover:scale-110"
      title="New Enquiry"
    >
      <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
      </svg>
    </Link>

    <!-- Assign Modal -->
    <div v-if="showAssignModal" class="fixed inset-0 bg-gray-800 bg-opacity-50 flex items-center justify-center z-50">
      <div class="bg-white p-8 rounded-2xl shadow-2xl w-96 border border-gray-100 animate-fadeIn">
        <h2 class="text-2xl font-bold mb-6 text-blue-800">Assign Enquiry</h2>
        <div class="mb-6">
          <label class="block font-semibold mb-2 text-gray-700">Select Agent</label>
          <select v-model="selectedAgentId" class="border border-gray-200 px-3 py-2 rounded w-full focus:ring-2 focus:ring-blue-200">
            <option value="" disabled>Select an agent</option>
            <option v-for="agent in agents" :key="agent.id" :value="agent.id">{{ agent.name }}</option>
          </select>
        </div>
        <div class="flex justify-end space-x-2">
          <button @click="closeAssignModal" class="px-4 py-2 bg-gray-200 rounded hover:bg-gray-300 transition-colors">
            Cancel
          </button>
          <button
            @click="assignEnquiry"
            :disabled="!selectedAgentId"
            class="px-4 py-2 bg-gradient-to-tr from-green-500 to-green-400 text-white rounded hover:from-green-600 hover:to-green-500 disabled:opacity-50 transition-colors"
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
    isAdmin: Boolean, // <-- Add this prop, pass from backend
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
        Inertia.delete(route('enquiries/destroy', id));
      }
    },
    respondToEnquiry(id) {
      // Redirect to the enquiry detail page for responding
      Inertia.get(`/enquiries/${id}`);
    },
  },
};
</script>

<style scoped>
@keyframes fadeIn {
  from { opacity: 0; transform: translateY(40px); }
  to { opacity: 1; transform: translateY(0); }
}
.animate-fadeIn {
  animation: fadeIn 0.3s ease;
}
</style>
