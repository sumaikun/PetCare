<template>
    <div class="overflow-x-auto">
      <table class="min-w-full bg-white dark:bg-gray-800">
        <thead>
          <tr>
            <th class="px-6 py-3 border-b-2 border-gray-300 text-left leading-4 text-gray-600 dark:text-gray-200 tracking-wider">Avatar</th>
            <th class="px-6 py-3 border-b-2 border-gray-300 text-left leading-4 text-gray-600 dark:text-gray-200 tracking-wider">Name</th>
            <th class="px-6 py-3 border-b-2 border-gray-300 text-left leading-4 text-gray-600 dark:text-gray-200 tracking-wider">Species</th>
            <th class="px-6 py-3 border-b-2 border-gray-300 text-left leading-4 text-gray-600 dark:text-gray-200 tracking-wider">Breed</th>
            <th class="px-6 py-3 border-b-2 border-gray-300 text-left leading-4 text-gray-600 dark:text-gray-200 tracking-wider">Age</th>
            <th class="px-6 py-3 border-b-2 border-gray-300 text-left leading-4 text-gray-600 dark:text-gray-200 tracking-wider">Gender</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="pet in pets" :key="pet.id">
            <td class="px-6 py-4 border-b border-gray-300">
                <a :href="`/pets/${pet.slug}/edit`">
                    <img :src="pet.photo ? `/${pet.photo}` : '/storage/images/pets/no_photo.png'" alt="Pet Photo" class="w-10 h-10 rounded-full object-cover">
                </a>
            </td>
            <td class="px-6 py-4 border-b border-gray-300">{{ pet.name }}</td>
            <td class="px-6 py-4 border-b border-gray-300">{{ pet.species.name }}</td>
            <td class="px-6 py-4 border-b border-gray-300">{{ pet.breed.name }}</td>
            <td class="px-6 py-4 border-b border-gray-300">{{ pet.age }}</td>
            <td class="px-6 py-4 border-b border-gray-300">{{ pet.gender }}</td>
          </tr>
        </tbody>
      </table>
    </div>
  </template>
  
  <script setup>
  import { defineProps } from 'vue'
  
  const props = defineProps({
    pets: {
      type: Array,
      required: true
    }
  })
  </script>
  
  <style scoped>
  .table-auto {
    width: 100%;
  }
  </style>
  