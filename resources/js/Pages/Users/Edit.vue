<template>
  <MainLayout>
    <h1 class="text-2xl font-bold mb-4">Edit User</h1>
    <form @submit.prevent="submit" class="space-y-4">
      <div>
        <label class="block font-semibold mb-1">Name</label>
        <input v-model="form.name" type="text" class="border px-2 py-1 rounded w-full" />
      </div>
      <div>
        <label class="block font-semibold mb-1">Email</label>
        <input v-model="form.email" type="email" class="border px-2 py-1 rounded w-full" />
      </div>
      <div>
        <label class="block font-semibold mb-1">Role</label>
        <select v-model="form.role" class="border px-2 py-1 rounded w-full">
          <option value="">Select Role</option>
          <option v-for="role in roles" :key="role" :value="role">{{ role }}</option>
        </select>
      </div>
      <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
        Update
      </button>
    </form>
  </MainLayout>
</template>

<script setup>
import MainLayout from '@/Layouts/MainLayout.vue';
import { useForm } from '@inertiajs/vue3';

const props = defineProps({ user: Object, roles: Array });

const form = useForm({
  name: props.user.name,
  email: props.user.email,
  role: props.user.roles[0]?.name || '', // Pre-fill the current role
});

function submit() {
  form.put(`/users/${props.user.id}`);
}
</script>
