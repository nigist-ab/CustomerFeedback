<template>
  <MainLayout>
    <h1 class="text-2xl font-bold mb-4">Edit User</h1>
    <form @submit.prevent="submit">
      <input v-model="form.name" type="text" />
      <input v-model="form.email" type="email" />
      <button type="submit">Update</button>
    </form>
  </MainLayout>
</template>

<script setup>
import MainLayout from '@/Layouts/MainLayout.vue'
import { useForm } from '@inertiajs/vue3'

const props = defineProps({ user: Object })

const form = useForm({
  name: props.user.name,
  email: props.user.email,
})

function submit() {
  form.put(`/users/${props.user.id}`)
}
</script>
