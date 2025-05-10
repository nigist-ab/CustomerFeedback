<template>
    <MainLayout>
      <template #header>
        <h1 class="text-2xl font-bold">My Tickets</h1>
      </template>
  
      <div class="mt-4">
        <Link
          href="/tickets/create"
          class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700"
        >
          Create New Ticket
        </Link>
  
        <div class="mt-6 space-y-4">
          <div
            v-for="ticket in tickets"
            :key="ticket.id"
            class="p-4 bg-white shadow rounded border"
          >
            <h2 class="text-lg font-semibold">{{ ticket.subject }}</h2>
            <p class="text-sm text-gray-600">{{ ticket.description }}</p>
            <p class="text-sm mt-2">
              <strong>Status:</strong> {{ ticket.status }} |
              <strong>Priority:</strong> {{ ticket.priority }}
            </p>
          </div>
        </div>
      </div>
    </MainLayout>
  </template>
  
  <script setup>
  import { Link } from '@inertiajs/vue3'
  import MainLayout from '@/Layouts/MainLayout.vue'
  defineProps({ tickets: Array })
  </script>
  