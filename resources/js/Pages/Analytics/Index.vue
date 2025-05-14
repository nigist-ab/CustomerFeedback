<template>
  <MainLayout>
    <div class="p-6">
      <h1 class="text-3xl font-bold mb-6 text-gray-800">Analytics Dashboard</h1>

      <!-- KPI Section -->
      <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <div class="bg-white shadow rounded-lg p-4">
          <h2 class="text-lg font-semibold text-gray-700">Total Users</h2>
          <p class="text-3xl font-bold text-blue-500">{{ metrics.totalUsers }}</p>
        </div>
        <div class="bg-white shadow rounded-lg p-4">
          <h2 class="text-lg font-semibold text-gray-700">Active Sessions</h2>
          <p class="text-3xl font-bold text-green-500">{{ metrics.activeSessions }}</p>
        </div>
        <div class="bg-white shadow rounded-lg p-4">
          <h2 class="text-lg font-semibold text-gray-700">Feedback Received</h2>
          <p class="text-3xl font-bold text-pink-500">{{ metrics.feedbackReceived }}</p>
        </div>
      </div>

      <!-- Charts Section -->
      <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- User Growth Chart -->
        <div class="bg-white shadow rounded-lg p-6">
          <h2 class="text-lg font-semibold text-gray-700 mb-4">User Growth</h2>
          <apexchart
            type="line"
            :options="userGrowthChartOptions"
            :series="userGrowthChartData"
            class="h-64"
          ></apexchart>
        </div>

        <!-- Feedback Trends Chart -->
        <div class="bg-white shadow rounded-lg p-6">
          <h2 class="text-lg font-semibold text-gray-700 mb-4">Feedback Trends</h2>
          <apexchart
            type="bar"
            :options="feedbackTrendsChartOptions"
            :series="feedbackTrendsChartData"
            class="h-64"
          ></apexchart>
        </div>
      </div>
    </div>
  </MainLayout>
</template>

<script>
import MainLayout from '@/Layouts/MainLayout.vue';
import VueApexCharts from 'vue3-apexcharts';
import axios from 'axios';

export default {
  components: {
    MainLayout,
    apexchart: VueApexCharts,
  },
  data() {
    return {
      metrics: {
        totalUsers: 0,
        activeSessions: 0,
        feedbackReceived: 0,
      },
      userGrowthChartOptions: {
        chart: {
          id: 'user-growth',
        },
        xaxis: {
          categories: [],
        },
      },
      userGrowthChartData: [
        {
          name: 'Users',
          data: [],
        },
      ],
      feedbackTrendsChartOptions: {
        chart: {
          id: 'feedback-trends',
        },
        xaxis: {
          categories: [],
        },
      },
      feedbackTrendsChartData: [
        {
          name: 'Feedback',
          data: [],
        },
      ],
    };
  },
  mounted() {
    this.fetchMetrics();
    this.fetchUserGrowthData();
    this.fetchFeedbackTrendsData();
  },
  methods: {
    async fetchMetrics() {
      try {
        const response = await axios.get('/api/analytics/metrics');
        this.metrics = response.data;
      } catch (error) {
        console.error('Error fetching metrics:', error);
      }
    },
    async fetchUserGrowthData() {
      try {
        const response = await axios.get('/api/analytics/user-growth');
        this.userGrowthChartOptions.xaxis.categories = response.data.categories;
        this.userGrowthChartData[0].data = response.data.data;
      } catch (error) {
        console.error('Error fetching user growth data:', error);
      }
    },
    async fetchFeedbackTrendsData() {
      try {
        const response = await axios.get('/api/analytics/feedback-trends');
        this.feedbackTrendsChartOptions.xaxis.categories = response.data.categories;
        this.feedbackTrendsChartData[0].data = response.data.data;
      } catch (error) {
        console.error('Error fetching feedback trends data:', error);
      }
    },
  },
};
</script>
