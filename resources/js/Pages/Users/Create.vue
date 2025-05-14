<template>
  <MainLayout>
    <h1 class="text-2xl font-bold mb-4">Add User</h1>
    <form @submit.prevent="submit">
      <input v-model="form.name" type="text" placeholder="Name" />
      <input v-model="form.email" type="email" placeholder="Email" />
      <input v-model="form.password" type="password" placeholder="Password" />
      <input v-model="form.password_confirmation" type="password" placeholder="Confirm Password" />
      <button type="submit">Save</button>
    </form>
  </MainLayout>
</template>

<script setup>
import MainLayout from '@/Layouts/MainLayout.vue'
import { useForm } from '@inertiajs/vue3'

const form = useForm({
  name: '',
  email: '',
  password: '',
  password_confirmation: '',
})

function submit() {
  form.post('/users')
}
</script>
