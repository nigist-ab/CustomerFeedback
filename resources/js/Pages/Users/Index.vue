<template>
  <MainLayout>
    <div class="p-6">
      <h1 class="text-2xl font-bold mb-4">Manage Users</h1>

      <!-- Add User Button -->
      <div class="mb-4 flex justify-end">
        <button
          @click="openAddUserModal"
          class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600"
        >
          Add User
        </button>
      </div>

      <!-- Search and Filter Section -->
      <div class="flex justify-between items-center mb-4">
        <div>
          <label class="font-semibold mr-2">Filter by Role:</label>
          <select v-model="filters.role" @change="applyFilter" class="border px-2 py-1 rounded">
            <option value="">All</option>
            <option v-for="role in roles" :key="role" :value="role">{{ role }}</option>
          </select>
        </div>
        <div>
          <input
            v-model="filters.search"
            @input="applyFilter"
            type="text"
            placeholder="Search by name or email"
            class="border px-2 py-1 rounded w-64"
          />
        </div>
      </div>

      <!-- User Table -->
      <div class="bg-white shadow rounded-lg overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200 text-sm">
          <thead class="bg-gray-50">
            <tr>
              <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Name</th>
              <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Email</th>
              <th class="px-2 py-2 text-left text-xs font-medium text-gray-500 uppercase">Roles</th> <!-- Reduced width -->
              <th class="px-6 py-2 text-left text-xs font-medium text-gray-500 uppercase">Actions</th> <!-- Increased width -->
            </tr>
          </thead>
          <tbody class="bg-white divide-y divide-gray-200">
            <tr
              v-for="user in filteredUsers"
              :key="user.id"
              class="hover:bg-gray-100 transition-colors"
            >
              <td class="px-4 py-2">{{ user.name }}</td>
              <td class="px-4 py-2">{{ user.email }}</td>
              <td class="px-2 py-2">
                <span
                  v-for="role in user.roles"
                  :key="role.name"
                  class="inline-block bg-blue-100 text-blue-800 px-2 py-0.5 rounded text-xs mr-1"
                >
                  {{ role.name }}
                </span>
              </td>
              <td class="px-2 py-2 ">
                <div class="flex space-x-4">
                <!-- Edit User -->
                <button
                  @click="openEditUserModal(user)"
                  class="text-yellow-500 hover:text-yellow-700 flex items-center space-x-1 text-xs"
                  title="Edit User"
                >
                  <span>Edit</span>
                  <i class="fas fa-edit "></i>
                </button>

                <!-- Assign Role -->
                <button
                  @click="openAssignRoleModal(user)"
                  class="text-green-500 hover:text-green-700 flex items-center space-x-1 text-xs"
                  title="Assign Role"
                >
                  <span>Assign Role</span>
                  <i class="fas fa-user-plus"></i>
                </button>

                <!-- Revoke Role -->
                <button
                  @click="openRevokeRoleModal(user)"
                  class="text-red-500 hover:text-red-700 flex items-center space-x-1 text-xs"
                  title="Revoke Role"
                >
                  <span>Revoke Role</span>
                  <i class="fas fa-user-minus"></i>
                </button>

                <!-- View User -->
                <button
                  @click="viewUserDetails(user)"
                  class="text-gray-500 hover:text-gray-700 flex items-center space-x-1 text-xs"
                  title="View User"
                >
                  <span>View</span>
                  <i class="fas fa-eye "></i>
                </button>

                <!-- Delete User -->
                <button
                  @click="deleteUser(user.id)"
                  class="text-red-500 hover:text-red-700 flex items-center space-x-1 text-xs"
                  title="Delete User"
                >
                  <span>Delete</span>
                  <i class="fas fa-trash" ></i>
                </button>
                </div>
              </td>
            </tr>
          </tbody>
        </table>
      </div>

      <!-- Pagination -->
      <div class="flex justify-between items-center mt-4">
        <button
          @click="prevPage"
          :disabled="currentPage === 1"
          class="px-4 py-2 bg-gray-200 rounded hover:bg-gray-300 disabled:opacity-50"
        >
          Previous
        </button>
        <span>Page {{ currentPage }} of {{ totalPages }}</span>
        <button
          @click="nextPage"
          :disabled="currentPage === totalPages"
          class="px-4 py-2 bg-gray-200 rounded hover:bg-gray-300 disabled:opacity-50"
        >
          Next
        </button>
      </div>

      <!-- Add/Edit User Modal -->
      <div v-if="showUserModal" class="fixed inset-0 bg-gray-800 bg-opacity-50 flex items-center justify-center">
        <div class="bg-white p-6 rounded shadow-lg w-96">
          <h2 class="text-xl font-bold mb-4">{{ isEditing ? 'Edit User' : 'Add User' }}</h2>
          <div class="mb-4">
            <label class="block font-semibold mb-1">Name</label>
            <input v-model="userForm.name" type="text" class="border px-2 py-1 rounded w-full" />
          </div>
          <div class="mb-4">
            <label class="block font-semibold mb-1">Email</label>
            <input v-model="userForm.email" type="email" class="border px-2 py-1 rounded w-full" />
          </div>
          <div class="mb-4">
            <label class="block font-semibold mb-1">Roles</label>
            <select v-model="userForm.role" class="border px-2 py-1 rounded w-full">
              <option value="">Select Role</option>
              <option v-for="role in roles" :key="role" :value="role">{{ role }}</option>
            </select>
          </div>
          <div class="flex justify-end space-x-2">
            <button @click="closeUserModal" class="px-4 py-2 bg-gray-300 rounded hover:bg-gray-400">
              Cancel
            </button>
            <button @click="saveUser" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">
              Save
            </button>
          </div>
        </div>
      </div>

      <!-- User Details Modal -->
      <div v-if="showDetailsModal" class="fixed inset-0 bg-gray-800 bg-opacity-50 flex items-center justify-center">
        <div class="bg-white p-6 rounded shadow-lg w-96">
          <h2 class="text-xl font-bold mb-4">User Details</h2>
          <p><strong>Name:</strong> {{ selectedUser.name }}</p>
          <p><strong>Email:</strong> {{ selectedUser.email }}</p>
          <p><strong>Roles:</strong></p>
          <ul>
            <li v-for="role in selectedUser.roles" :key="role.name">{{ role.name }}</li>
          </ul>
          <div class="flex justify-end mt-4">
            <button @click="closeDetailsModal" class="px-4 py-2 bg-gray-300 rounded hover:bg-gray-400">
              Close
            </button>
          </div>
        </div>
      </div>

      <!-- Assign Role Modal -->
      <div v-if="showAssignRoleModal" class="fixed inset-0 bg-gray-800 bg-opacity-50 flex items-center justify-center">
        <div class="bg-white p-6 rounded shadow-lg w-96">
          <h2 class="text-xl font-bold mb-4">Assign Role</h2>
          <div class="mb-4">
            <label class="block font-semibold mb-1">Role</label>
            <select v-model="selectedRoleData" class="border px-2 py-1 rounded w-full">
              <option value="">Select Role</option>
              <option v-for="role in roles" :key="role" :value="role">{{ role }}</option>
            </select>
          </div>
          <div class="flex justify-end space-x-2">
            <button @click="closeAssignRoleModal" class="px-4 py-2 bg-gray-300 rounded hover:bg-gray-400">
              Cancel
            </button>
            <button
              @click="assignRole"
              :disabled="!selectedRoleData"
              class="px-4 py-2 bg-green-500 text-white rounded hover:bg-green-600 disabled:opacity-50"
            >
              Assign
            </button>
          </div>
        </div>
      </div>

      <!-- Revoke Role Modal -->
      <div v-if="showRevokeRoleModal" class="fixed inset-0 bg-gray-800 bg-opacity-50 flex items-center justify-center">
        <div class="bg-white p-6 rounded shadow-lg w-96">
          <h2 class="text-xl font-bold mb-4">Revoke Role</h2>
          <div class="mb-4">
            <label class="block font-semibold mb-1">Role</label>
            <select v-model="selectedRoleData" class="border px-2 py-1 rounded w-full">
              <option value="">Select Role</option>
              <option v-for="role in currentUser.roles" :key="role.name" :value="role.name">{{ role.name }}</option>
            </select>
          </div>
          <div class="flex justify-end space-x-2">
            <button @click="closeRevokeRoleModal" class="px-4 py-2 bg-gray-300 rounded hover:bg-gray-400">
              Cancel
            </button>
            <button @click="revokeRole" class="px-4 py-2 bg-red-500 text-white rounded hover:bg-red-600">
              Revoke
            </button>
          </div>
        </div>
      </div>
    </div>
  </MainLayout>
</template>

<script>
import { router } from '@inertiajs/vue3'
import MainLayout from '@/Layouts/MainLayout.vue'

export default {
  props: {
    users: Array,
    roles: Array,
    selectedRole: String, // Prop from the parent
  },
  components: {
    MainLayout,
  },
  data() {
    return {
      filters: {
        role: this.selectedRole || '',
        search: '',
      },
      selectedRoles: {},
      revokeRoles: {},
      currentPage: 1,
      itemsPerPage: 10,
      showUserModal: false,
      showDetailsModal: false,
      showAssignRoleModal: false,
      showRevokeRoleModal: false,
      isEditing: false,
      userForm: {
        name: '',
        email: '',
        role: '',
      },
      selectedRoleData: '', // Renamed from `selectedRole` to avoid conflict
      currentUser: null,
      selectedUser: null,
    }
  },
  computed: {
    filteredUsers() {
      let filtered = this.users

      if (this.filters.role) {
        filtered = filtered.filter(user =>
          user.roles.some(role => role.name === this.filters.role)
        )
      }

      if (this.filters.search) {
        const searchTerm = this.filters.search.toLowerCase()
        filtered = filtered.filter(
          user =>
            user.name.toLowerCase().includes(searchTerm) ||
            user.email.toLowerCase().includes(searchTerm)
        )
      }

      const start = (this.currentPage - 1) * this.itemsPerPage
      const end = start + this.itemsPerPage
      return filtered.slice(start, end)
    },
    totalPages() {
      return Math.ceil(this.users.length / this.itemsPerPage)
    },
  },
  methods: {
    applyFilter() {
      this.currentPage = 1
    },
    openAssignRoleModal(user) {
      this.currentUser = user
      this.selectedRoleData = '' // Use renamed property
      this.showAssignRoleModal = true
    },
    closeAssignRoleModal() {
      this.showAssignRoleModal = false
    },
    assignRole() {
      if (this.selectedRoleData) {
        this.$inertia.post(`/users/${this.currentUser.id}/assign-role`, { role: this.selectedRoleData })
          .then(() => {
            // Reload the page to reflect the changes in the table
            this.$inertia.reload({ only: ['users'] });
            this.closeAssignRoleModal();
            this.selectedRoleData = ''; // Reset the selected role
          })
          .catch(error => {
            console.error('Error assigning role:', error);
          });
      } else {
        console.error('No role selected for assignment.');
      }
    },
    openRevokeRoleModal(user) {
      this.currentUser = user
      this.selectedRoleData = '' // Use renamed property
      this.showRevokeRoleModal = true
    },
    closeRevokeRoleModal() {
      this.showRevokeRoleModal = false
    },
    revokeRole() {
      if (this.selectedRoleData) {
        this.$inertia.post(`/users/${this.currentUser.id}/revoke-role`, { role: this.selectedRoleData })
          .then(() => {
            // Reload the page to reflect the changes in the table
            this.$inertia.reload({ only: ['users'] });
            this.closeRevokeRoleModal();
            this.selectedRoleData = ''; // Reset the selected role
          })
          .catch(error => {
            console.error('Error revoking role:', error);
          });
      } else {
        console.error('No role selected for revocation.');
      }
    },
    deleteUser(id) {
      if (confirm('Are you sure you want to delete this user?')) {
        Inertia.delete(route('users.destroy', id))
      }
    },
    prevPage() {
      if (this.currentPage > 1) this.currentPage--
    },
    nextPage() {
      if (this.currentPage < this.totalPages) this.currentPage++
    },
    openAddUserModal() {
      this.isEditing = false
      this.userForm = { name: '', email: '', role: '' }
      this.showUserModal = true
    },
    openEditUserModal(user) {
      this.isEditing = true
      this.userForm = { name: user.name, email: user.email, role: user.roles[0]?.name || '' }
      this.showUserModal = true
    },
    saveUser() {
      if (this.isEditing) {
        // Logic to update user
        alert('User updated successfully!')
      } else {
        // Logic to add user
        alert('User added successfully!')
      }
      this.closeUserModal()
    },
    closeUserModal() {
      this.showUserModal = false
    },
    viewUserDetails(user) {
      this.selectedUser = user
      this.showDetailsModal = true
    },
    closeDetailsModal() {
      this.showDetailsModal = false
    },
  },
}
</script>
