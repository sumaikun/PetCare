<template>
  <div class="flex items-center bg-white rounded-lg shadow-lg dark:bg-gray-800 p-4">
    <img 
      :src="client.photo || '/storage/images/clients/no_photo.png'" 
      class="w-16 h-16 rounded-full object-cover object-center" 
      alt="Client Photo"
    >
    <div class="ml-4">
      <h2 class="text-lg font-semibold text-gray-800 dark:text-white">{{ client.name }}</h2>
      <p v-if="client.email" class="text-sm text-gray-600 dark:text-gray-300">{{ client.email }}</p>
      <p v-if="client.phone_number" class="text-sm text-gray-600 dark:text-gray-300">{{ client.phone_number }}</p>
      <p v-if="client.address" class="text-sm text-gray-600 dark:text-gray-300">{{ client.address }}</p>
      <p v-if="client.notes" class="text-sm text-gray-600 dark:text-gray-300">{{ client.notes }}</p>
    </div>
  </div>
</template>

<script setup>
import { defineProps } from 'vue'

const props = defineProps({
  client: {
    type: Object,
    required: true
  }
})
</script>
