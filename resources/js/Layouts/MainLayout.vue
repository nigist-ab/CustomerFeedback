<script setup>
import { Link } from '@inertiajs/vue3';
</script>

<template>
  <div class="flex min-h-screen bg-gray-100">
    <!-- Sidebar -->
    <aside class="w-64 bg-gradient-to-tr from-blue-50 via-white to-cyan-100">
      <div class="flex items-center mb-6">
        <img src="/images/Omishtu.L.jpg" alt="Omishtu Logo" class="w-10 h-10 rounded-xl mr-3 shadow-md" />
        <span class="text-2xl font-bold text-gray-800">Omishtu</span>
      </div>
      <nav class="flex flex-col space-y-4">
        <Link
          href="/dashboard"
          class="block px-4 py-1 rounded-lg text-gray-700 hover:bg-gray-200 flex items-center space-x-2"
        >
          <i class="fas fa-home"></i>
          <span>Dashboard</span>
        </Link>
        <Link
          href="/users"
          class="block px-4 py-1 rounded-lg text-gray-700 hover:bg-gray-200 flex items-center space-x-2"
        >
          <i class="fas fa-users"></i>
          <span>Manage Users</span>
        </Link>
        <Link
          href="/analytics"
          class="block px-4 py-1 rounded-lg text-gray-700 hover:bg-gray-200 flex items-center space-x-2"
        >
          <i class="fas fa-chart-bar"></i>
          <span>Analytics</span>
        </Link>
        <Link
          href="/enquiries"
          class="block px-4 py-1 rounded-lg text-gray-700 hover:bg-gray-200 flex items-center space-x-2"
        >
          <i class="fas fa-question-circle"></i>
          <span>Enquiries</span>
        </Link>
        <Link
          href="/feedback"
          class="block px-4 py-1 rounded-lg text-gray-700 hover:bg-gray-200 flex items-center space-x-2"
        >
          <i class="fas fa-comments"></i>
          <span>Feedback</span>
        </Link>
        <Link
          href="/surveys"
          class="block px-4 py-1 rounded-lg text-gray-700 hover:bg-gray-200 flex items-center space-x-2"
        >
          <i class="fas fa-poll"></i>
          <span>Surveys</span>
        </Link>
        <Link
          href="/products"
          class="block px-4 py-1 rounded-lg text-gray-700 hover:bg-gray-200 flex items-center space-x-2"
        >
          <i class="fas fa-box"></i>
          <span>Products</span>
        </Link>
        <Link
          href="/logout"
          method="post"
          as="button"
          class="block px-4 py-1 rounded-lg text-gray-700 hover:bg-gray-200 flex items-center space-x-2"
        >
          <i class="fas fa-sign-out-alt"></i>
          <span>Logout</span>
        </Link>
      </nav>
    </aside>

    <!-- Main Content -->
    <div class="flex-1 flex flex-col">
      <!-- Header -->
      <header class="bg-white shadow-md p-4 flex items-center justify-between">
        <h2 class="text-xl font-semibold text-gray-800">Dashboard</h2>
        <span class="text-gray-700 font-medium text-base">
          {{ $page.props.auth?.user?.name }}
        </span>
      </header>
      <!-- Main Content -->
      <main class="flex-1 p-6">
        <slot />
      </main>
    </div>
  </div>
</template>