<template>
  <MainLayout>
    <div class="p-6 bg-gradient-to-br from-blue-50 via-white to-cyan-50 min-h-screen">
      <h1 class="text-4xl font-extrabold mb-10 text-blue-800 tracking-tight drop-shadow">Analytics Dashboard</h1>

      <!-- KPI Section -->
      <div class="grid grid-cols-1 md:grid-cols-4 gap-8 mb-10">
        <div class="bg-white/90 shadow-xl rounded-2xl p-6 flex flex-col items-center border-t-4 border-blue-400 hover:scale-105 transition-transform duration-200">
          <h2 class="text-lg font-semibold text-gray-700 mb-2">Total Users</h2>
          <p class="text-4xl font-extrabold text-blue-500">{{ metrics.totalUsers }}</p>
        </div>
        <div class="bg-white/90 shadow-xl rounded-2xl p-6 flex flex-col items-center border-t-4 border-green-400 hover:scale-105 transition-transform duration-200">
          <h2 class="text-lg font-semibold text-gray-700 mb-2">Enquiries Received</h2>
          <p class="text-4xl font-extrabold text-green-500">{{ metrics.enquiriesReceived }}</p>
        </div>
        <div class="bg-white/90 shadow-xl rounded-2xl p-6 flex flex-col items-center border-t-4 border-purple-400 hover:scale-105 transition-transform duration-200">
          <h2 class="text-lg font-semibold text-gray-700 mb-2">Survey Responses</h2>
          <p class="text-4xl font-extrabold text-purple-500">{{ metrics.surveyResponses }}</p>
        </div>
        <div class="bg-white/90 shadow-xl rounded-2xl p-6 flex flex-col items-center border-t-4 border-pink-400 hover:scale-105 transition-transform duration-200">
          <h2 class="text-lg font-semibold text-gray-700 mb-2">Feedback Received</h2>
          <p class="text-4xl font-extrabold text-pink-500">{{ metrics.feedbackReceived }}</p>
        </div>
      </div>

      <!-- Charts Section -->
      <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        <!-- User Growth Chart -->
        <div class="bg-white/90 shadow-xl rounded-2xl p-8 border border-blue-100">
          <h2 class="text-lg font-bold text-blue-700 mb-4">User Growth</h2>
          <apexchart
            type="line"
            :options="userGrowthChartOptions"
            :series="userGrowthChartData"
            class="h-64"
          ></apexchart>
        </div>

        <!-- Feedback Trends Chart -->
        <div class="bg-white/90 shadow-xl rounded-2xl p-8 border border-green-100">
          <h2 class="text-lg font-bold text-green-700 mb-4">Feedback Trends</h2>
          <apexchart
            type="bar"
            :options="feedbackTrendsChartOptions"
            :series="feedbackTrendsChartData"
            class="h-64"
          ></apexchart>
        </div>

        <!-- Enquiries Trends Chart -->
        <div class="bg-white/90 shadow-xl rounded-2xl p-8 border border-indigo-100">
          <h2 class="text-lg font-bold text-indigo-700 mb-4">Enquiries Trends</h2>
          <apexchart
            type="bar"
            :options="enquiriesChartOptions"
            :series="enquiriesChartData"
            class="h-64"
          ></apexchart>
        </div>

        <!-- Survey Responses Trends Chart -->
        <div class="bg-white/90 shadow-xl rounded-2xl p-8 border border-yellow-100">
          <h2 class="text-lg font-bold text-yellow-700 mb-4">Survey Responses Trends</h2>
          <apexchart
            type="line"
            :options="surveyResponsesChartOptions"
            :series="surveyResponsesChartData"
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

export default {
  components: {
    MainLayout,
    apexchart: VueApexCharts,
  },
  props: {
    metrics: Object,
    enquiriesTrends: Object,
    surveyResponsesTrends: Object,
    userGrowthTrends: Object,
    feedbackTrends: Object,
  },
  data() {
    return {
      userGrowthChartOptions: {
        chart: { id: 'user-growth' },
        xaxis: { categories: this.userGrowthTrends.categories },
        colors: ['#2563eb'],
        stroke: { width: 3 },
      },
      userGrowthChartData: [
        {
          name: 'Users',
          data: this.userGrowthTrends.data,
        },
      ],
      feedbackTrendsChartOptions: {
        chart: { id: 'feedback-trends' },
        xaxis: { categories: this.feedbackTrends.categories },
        colors: ['#22c55e'],
      },
      feedbackTrendsChartData: [
        {
          name: 'Feedback',
          data: this.feedbackTrends.data,
        },
      ],
      enquiriesChartOptions: {
        chart: { id: 'enquiries-trends' },
        xaxis: { categories: this.enquiriesTrends.categories },
        colors: ['#6366f1'],
      },
      enquiriesChartData: [
        {
          name: 'Enquiries',
          data: this.enquiriesTrends.data,
        },
      ],
      surveyResponsesChartOptions: {
        chart: { id: 'survey-responses-trends' },
        xaxis: { categories: this.surveyResponsesTrends.categories },
        colors: ['#eab308'],
        stroke: { width: 3 },
      },
      surveyResponsesChartData: [
        {
          name: 'Survey Responses',
          data: this.surveyResponsesTrends.data,
        },
      ],
    };
  },
};
</script>
