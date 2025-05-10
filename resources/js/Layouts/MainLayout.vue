<script setup>
import { Link } from '@inertiajs/vue3';
</script>

<template>
  <div class="flex min-h-screen">
    <!-- Sidebar -->
    <aside class="w-64 bg-white text-black p-4 shadow-md">
      <h1 class="text-2xl font-bold mb-6">Our System</h1>
      <nav class="flex flex-col space-y-4">
        <Link href="/dashboard" class="hover:bg-gray-200 p-2 rounded">Dashboard</Link>
        <Link href="/surveys" class="hover:bg-gray-200 p-2 rounded">Surveys</Link>
        <Link href="/feedback" class="hover:bg-gray-200 p-2 rounded">Feedback</Link>
        <Link href="/enquiries" class="hover:bg-gray-200 p-2 rounded">Enquiries</Link>
        <Link href="/tickets" class="hover:bg-gray-200 p-2 rounded">Tickets</Link>
        <Link href="/profile/edit" class="hover:bg-gray-200 p-2 rounded">Profile</Link>
        <Link href="/logout" method="post" as="button" class="hover:bg-gray-200 p-2 rounded">Logout</Link>
      </nav>
    </aside>

    <!-- Main Content -->
    <main class="flex-1 p-8 bg-gray-100">
      <slot />
    </main>
  </div>
</template>