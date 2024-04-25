<template>
  <div class="flex items-center justify-between mb-3">
    <h1 class="text-3xl font-semibold">Produse</h1>
    <button type="submit"
            class="flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-gray-800 bg-yellow-300 hover:bg-yellow-400 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-yellow-500"
    >
      Adaugă un produs nou
    </button>
  </div>
  <div class="bg-white p-4 rounded-lg shadow">
    {{ search }}

    <div class="flex justify-between border-b-2 pb-3">
      <div class="flex items-center">
        <span class="whitespace-nowrap mr-3">Afișează</span>
        <select @change="getProducts(null)" v-model="perPage"
                class="appearance-none relative block w-24 px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-md focus:outline-none focus:ring-yellow-400 focus:border-yellow-400 focus:z-10 sm:text-sm">
          <option value="5">5</option>
          <option value="10">10</option>
          <option value="20">20</option>
          <option value="50">50</option>
          <option value="100">100</option>
        </select>
      </div>
      <div>
        <input v-model="search" @change="getProducts(null)"
               class="appearance-none relative block w-48 px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-md focus:outline-none focus:ring-yellow-400 focus:border-yellow-400 focus:z-10 sm:text-sm"
               placeholder="Caută produse">
      </div>
    </div>
    <Spinner v-if="products.loading"/>
    <template v-else>

      <table class="table-auto w-full">
        <thead>
        <tr>
          <TableHeaderCell click="sortProducts" class="border-b-2 p-2 text-left" field="id" :sort-field="sortField" :sort-direction="sortDirection">ID</TableHeaderCell>
          <TableHeaderCell click="sortProducts" class="border-b-2 p-2 text-left" field="" :sort-field="sortField" :sort-direction="sortDirection">Imagine</TableHeaderCell>
          <TableHeaderCell click="sortProducts" class="border-b-2 p-2 text-left" field="title" :sort-field="sortField" :sort-direction="sortDirection">Titlu</TableHeaderCell>
          <TableHeaderCell click="sortProducts" class="border-b-2 p-2 text-left" field="price" :sort-field="sortField" :sort-direction="sortDirection">Preț</TableHeaderCell>
          <TableHeaderCell click="sortProducts" class="border-b-2 p-2 text-left" field="updated_at" :sort-field="sortField" :sort-direction="sortDirection">Actualizat la</TableHeaderCell>
        </tr>
        </thead>
        <tbody>
        <tr v-for="product of products.data">
          <td class="border-b p-2 ">{{ product.id }}</td>
          <td class="border-b p-2 ">
            <img class="w-16" :src="product.image" :alt="product.title">
          </td>
          <td class="border-b p-2 max-w-[200px] whitespace-nowrap overflow-hidden text-ellipsis">{{
              product.title
            }}
          </td>
          <td class="border-b p-2">
            {{ product.price }}
          </td>
          <td class="border-b p-2 ">
            {{ product.updated_at }}
          </td>
        </tr>
        </tbody>
      </table>

      <div class="flex justify-between items-center mt-5">
        <span>
          De la {{ products.from }} la {{ products.to }}
        </span>
        <nav
            v-if="products.total > products.limit"
            class="relative z-0 inline-flex justify-center rounded-md shadow-sm -space-x-px"
            aria-label="Pagination"
        >
          <!-- Current: "z-10 bg-indigo-50 border-indigo-500 text-indigo-600", Default: "bg-white border-gray-300 text-gray-500 hover:bg-gray-50" -->
          <a
              v-for="(link, i) of products.links"
              :key="i"
              :disabled="!link.url"
              href="#"
              @click="getForPage($event, link)"
              aria-current="page"
              class="relative inline-flex items-center px-4 py-2 border text-sm font-medium whitespace-nowrap"
              :class="[
              link.active
                ? 'z-10 bg-indigo-50 border-indigo-500 text-indigo-600'
                : 'bg-white border-gray-300 text-gray-500 hover:bg-gray-50',
              i === 0 ? 'rounded-l-md' : '',
              i === products.links.length - 1 ? 'rounded-r-md' : '',
              !link.url ? ' bg-gray-100 text-gray-700': ''
            ]"
              v-html="link.label"
          >
          </a>
        </nav>
      </div>
    </template>
  </div>
</template>

<script setup>
import {computed, onMounted, ref} from "vue";
import store from "../store";
import Spinner from "../components/core/Spinner.vue";
import {PRODUCTS_PER_PAGE} from "@/constants.js";

const perPage = ref(PRODUCTS_PER_PAGE);
const search = ref('');
const products = computed(() => store.state.products);
const sortField = ref('updated_at')
const sortDirection = ref('desc')

onMounted(() => {
  getProducts();
})

function getForPage(ev, link) {
  ev.preventDefault();
  if (!link.url || link.active) {
    return;
  }

  getProducts(link.url)
}

function getProducts(url=null) {
  store.dispatch('getProducts',
  {
      url,
      sort_field: sortField.value,
      sort_direction: sortDirection.value,
      search: search.value,
      perPage: perPage.value,
  });
}

function sortProducts(field) {
  if (field === sortField.value) {
    if (sortDirection.value === 'desc') {
      sortDirection.value = 'asc'
    } else {
      sortDirection.value = 'desc'
    }
  } else {
    sortField.value = field;
    sortDirection.value = 'asc'
  }
  getProducts();
}


</script>

<style scoped>

</style>
