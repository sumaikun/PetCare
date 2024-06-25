<script setup>
import AppLayout from '@/Layouts/AppLayout.vue'
import { onMounted, ref } from 'vue'
import { useToast } from "vue-toastification"
import Spinner from '@/Components/Spinner.vue'
import { validateForm, watchFields, errors } from '@/Validation/Clients/Index';

const toast = useToast();
const isSubmitting = ref(false)
const createForm = ref({
  name: '',
  email: '',
  phone_number: '',
  address: '',
  notes: '',
  photo: {
    file: null,
    url: ''
  },
})
const resetForm = () => {
  createForm.value = {
    name: '',
    email: '',
    phone_number: '',
    address: '',
    notes: '',
    photo: {
      file: null,
      url: ''
    },
  }
}

const handleFileChange = (event) => {
    const file = event.target.files[0];
    if (file) {
      createForm.value.photo.url =  URL.createObjectURL(file);
      createForm.value.photo.file = file;
    }
}

const handleFileDrop = (event) => {
    console.log(event)
    const file = event.dataTransfer.files[0];
    if (file) {
      createForm.value.photo.url =  URL.createObjectURL(file);
      createForm.value.photo.file = file;
    }
}


const submitForm = async () => {
  isSubmitting.value = true;

  const formData = new FormData();
  Object.keys(createForm.value).forEach(key => {
      if (key === 'photo') {
          if (createForm.value.photo.file) {
              formData.append('photo', createForm.value.photo.file);
          }
      } else {
          formData.append(key, createForm.value[key]);
      }
  });

  validateForm(createForm.value);

  // Check if there are any errors
  if (Object.keys(errors.value).length > 0) {
    toast.error("Please correct the errors in the form.");
    isSubmitting.value = false;
    return;
  }

  const response = await axios.post('/clients/store', formData);
  resetForm();
  isSubmitting.value = false;
  toast.success(response.data.message);
};

onMounted(() => {
  watchFields(createForm.value);
});

</script>

<template>
  <AppLayout title="Add Client">
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Add Client
      </h2>
    </template>

    <section class="bg-white dark:bg-gray-900 rounded-xl">
      <div class="px-4 mx-auto py-4">
        <form @submit.prevent="submitForm">
          <div class="grid gap-4 sm:grid-cols-2 sm:gap-6">
            <div class="sm:col-span-2">
              <label for="name" class="block mb-2 text-xs font-medium text-gray-400 dark:text-white">Client Name</label>
              <input v-model="createForm.name" type="text" name="name" id="name"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-indigo-600 focus:border-indigo-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-indigo-500 dark:focus:border-indigo-500"
                :class="errors.name ? 'border-red-500' : ''" placeholder="John Doe">
              <span class="text-red-500 text-xs">{{ errors.name }}</span>
            </div>
            <div class="w-full">
              <label for="email" class="block mb-2 text-xs font-medium text-gray-400 dark:text-white">Email</label>
              <input v-model="createForm.email" type="text" name="email" id="email"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-indigo-600 focus:border-indigo-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-indigo-500 dark:focus:border-indigo-500"
                :class="errors.email ? 'border-red-500' : ''" placeholder="john@email.com">
              <span class="text-red-500 text-xs">{{ errors.email }}</span>
            </div>
            <div class="w-full">
              <label for="phone_number" class="block mb-2 text-xs font-medium text-gray-400 dark:text-white">Phone
                Number</label>
              <input v-model="createForm.phone_number" type="text" name="phone_number" id="phone_number"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-indigo-600 focus:border-indigo-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-indigo-500 dark:focus:border-indigo-500"
                :class="errors.phone_number ? 'border-red-500' : ''" placeholder="71 153 343">
              <span class="text-red-500 text-xs">{{ errors.phone_number }}</span>
            </div>
            <div class="sm:col-span-2">
              <label for="address" class="block mb-2 text-xs font-medium text-gray-400 dark:text-white">Address</label>
              <input v-model="createForm.address" type="text" name="address" id="address"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-indigo-600 focus:border-indigo-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-indigo-500 dark:focus:border-indigo-500"
                :class="errors.address ? 'border-red-500' : ''" placeholder="Downtown, Beirut">
              <span class="text-red-500 text-xs">{{ errors.address }}</span>
            </div>

            <div class="sm:col-span-2">
              <label for="notes" class="block mb-2 text-xs font-medium text-gray-400 dark:text-white">Notes</label>
              <textarea v-model="createForm.notes" name="notes" id="notes" rows="8"
                class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-indigo-500 dark:focus:border-indigo-500"
                :class="errors.notes ? 'border-red-500' : ''" placeholder="Your notes here..."></textarea>
              <span class="text-red-500 text-xs">{{ errors.notes }}</span>
            </div>
          </div>

          <div class="col-span-12">

            <div class="mx-auto max-w-full">
              <label for="photo" class="mb-2 block text-sm font-medium text-gray-700">Client Photo</label>
              <label
                @dragover.prevent @drop.prevent="handleFileDrop"
                class="flex w-full cursor-pointer appearance-none items-center justify-center rounded-md border-2 border-dashed border-gray-200 p-6 transition-all hover:border-indigo-700"
                :class="{ 'border-red-500 focus:border-red-500 focus:ring-red-500': errors.photo }">
                <div class="space-y-1 text-center">
                  <div class="mx-auto inline-flex h-20 w-20 items-center justify-center rounded-full bg-gray-100">
                    <img v-if="createForm.photo.url" :src="createForm.photo.url" alt="Client Photo"
                      class="h-20 w-20 rounded-full" />
                    <div v-else>
                      <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="h-6 w-6 text-gray-500">
                        <path stroke-linecap="round" stroke-linejoin="round"
                          d="M12 16.5V9.75m0 0l3 3m-3-3l-3 3M6.75 19.5a4.5 4.5 0 01-1.41-8.775 5.25 5.25 0 0110.233-2.33 3 3 0 013.758 3.848A3.752 3.752 0 0118 19.5H6.75z" />
                      </svg>
                    </div>
                  </div>
                  <div class="text-gray-600">
                    <a href="#" class="font-medium text-indigo-500 hover:text-indigo-700">Click to upload</a> or drag
                    and
                    drop
                  </div>
                  <p class="text-sm text-gray-500">PNG or JPG (max. 1mb)</p>
                </div>
                <input @change="handleFileChange" id="photo" name="photo" type="file" class="sr-only" />
              </label>
              <div v-if="errors.photo" class="text-sm text-red-500 mt-1">
                {{ errors.photo }}
              </div>
            </div>
          </div>

          <button type="submit"
            class="inline-flex items-center px-5 py-2.5 mt-4 sm:mt-6 text-sm font-medium text-center text-white bg-indigo-700 rounded-lg focus:ring-4 focus:ring-primary-200 dark:focus:ring-indigo-900 hover:bg-indigo-800 disabled:bg-indigo-300 disabled:cursor-not-allowed">
            Add Client
          </button>

        </form>
      </div>
    </section>
  </AppLayout>
</template>