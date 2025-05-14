<script setup>
import { Link } from '@inertiajs/vue3';
</script>

<template>
  <div class="flex min-h-screen bg-gray-100">
    <!-- Sidebar -->
    <aside class="w-64 bg-white shadow-md p-4">
      <h1 class="text-2xl font-bold mb-6 text-gray-800">Our System</h1>
      <nav class="flex flex-col space-y-4">
        <Link
          href="/dashboard"
          class="block px-4 py-2 rounded-lg text-gray-700 hover:bg-gray-200"
        >
          Dashboard
        </Link>
        <Link
          href="/users"
          class="block px-4 py-2 rounded-lg text-gray-700 hover:bg-gray-200"
        >
          Manage Users
        </Link>
        <Link
          href="/analytics"
          class="block px-4 py-2 rounded-lg text-gray-700 hover:bg-gray-200"
        >
          Analytics
        </Link>
        <Link
          href="/enquiries"
          class="block px-4 py-2 rounded-lg text-gray-700 hover:bg-gray-200"
        >
          Enquiries
        </Link>
        <Link
          href="/feedback"
          class="block px-4 py-2 rounded-lg text-gray-700 hover:bg-gray-200"
        >
          Feedback
        </Link>
        <Link
          href="/surveys"
          class="block px-4 py-2 rounded-lg text-gray-700 hover:bg-gray-200"
        >
          Surveys
        </Link>
        <Link
          href="/tickets"
          class="block px-4 py-2 rounded-lg text-gray-700 hover:bg-gray-200"
        >
          Tickets
        </Link>
        <Link
          href="/logout"
          method="post"
          as="button"
          class="block px-4 py-2 rounded-lg text-gray-700 hover:bg-gray-200"
        >
          Logout
        </Link>
      </nav>
    </aside>

    <!-- Main Content -->
    <div class="flex-1 flex flex-col">
      <!-- Header -->
      <header class="bg-white shadow p-4">
        <h2 class="text-xl font-semibold text-gray-800">Dashboard</h2>
      </header>

      <!-- Main Content -->
      <main class="flex-1 p-6">
        <slot />
      </main>
    </div>
  </div>
</template>