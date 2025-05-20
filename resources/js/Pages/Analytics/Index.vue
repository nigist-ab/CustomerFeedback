<template>
  <MainLayout>
    <div class="p-6">
      <h1 class="text-3xl font-bold mb-6 text-gray-800">Analytics Dashboard</h1>

      <!-- KPI Section -->
      <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
        <div class="bg-white shadow rounded-lg p-4">
          <h2 class="text-lg font-semibold text-gray-700">Total Users</h2>
          <p class="text-3xl font-bold text-blue-500">{{ metrics.totalUsers }}</p>
        </div>
        <div class="bg-white shadow rounded-lg p-4">
          <h2 class="text-lg font-semibold text-gray-700">Enquiries Received</h2>
          <p class="text-3xl font-bold text-green-500">{{ metrics.enquiriesReceived }}</p>
        </div>
        <div class="bg-white shadow rounded-lg p-4">
          <h2 class="text-lg font-semibold text-gray-700">Survey Responses</h2>
          <p class="text-3xl font-bold text-purple-500">{{ metrics.surveyResponses }}</p>
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

        <!-- Enquiries Trends Chart -->
        <div class="bg-white shadow rounded-lg p-6">
          <h2 class="text-lg font-semibold text-gray-700 mb-4">Enquiries Trends</h2>
          <apexchart
            type="bar"
            :options="enquiriesChartOptions"
            :series="enquiriesChartData"
            class="h-64"
          ></apexchart>
        </div>

        <!-- Survey Responses Trends Chart -->
        <div class="bg-white shadow rounded-lg p-6">
          <h2 class="text-lg font-semibold text-gray-700 mb-4">Survey Responses Trends</h2>
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
