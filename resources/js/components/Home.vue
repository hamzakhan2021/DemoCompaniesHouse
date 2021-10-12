<!--
  This example requires Tailwind CSS v2.0+ 
  
  This example requires some changes to your config:
  
  ```
  // tailwind.config.js
  module.exports = {
    // ...
    plugins: [
      // ...
      require('@tailwindcss/forms'),
      require('@tailwindcss/aspect-ratio'),
    ],
  }
  ```
-->
<template>
  <div class="bg-white">
    <!-- Mobile menu -->
    <TransitionRoot as="template" :show="mobileMenuOpen">
      <Dialog as="div" class="fixed inset-0 flex z-40 lg:hidden" @close="mobileMenuOpen = false">
        <TransitionChild as="template" enter="transition-opacity ease-linear duration-300" enter-from="opacity-0" enter-to="opacity-100" leave="transition-opacity ease-linear duration-300" leave-from="opacity-100" leave-to="opacity-0">
          <DialogOverlay class="fixed inset-0 bg-black bg-opacity-25" />
        </TransitionChild>

        <TransitionChild as="template" enter="transition ease-in-out duration-300 transform" enter-from="-translate-x-full" enter-to="translate-x-0" leave="transition ease-in-out duration-300 transform" leave-from="translate-x-0" leave-to="-translate-x-full">
          <div class="relative max-w-xs w-full bg-white shadow-xl pb-12 flex flex-col overflow-y-auto">
            <div class="px-4 pt-5 pb-2 flex">
              <button type="button" class="-m-2 p-2 rounded-md inline-flex items-center justify-center text-gray-400" @click="mobileMenuOpen = false">
                <span class="sr-only">Close menu</span>
                <XIcon class="h-6 w-6" aria-hidden="true" />
              </button>
            </div>

            <!-- Links -->
            <TabGroup as="div" class="mt-2">
              <div class="border-b border-gray-200">
                <TabList class="-mb-px flex px-4 space-x-8">
                  <Tab as="template" v-for="category in navigation.categories" :key="category.name" v-slot="{ selected }">
                    <button :class="[selected ? 'text-indigo-600 border-indigo-600' : 'text-gray-900 border-transparent', 'flex-1 whitespace-nowrap py-4 px-1 border-b-2 text-base font-medium']">
                      {{ category.name }}
                    </button>
                  </Tab>
                </TabList>
              </div>
              <TabPanels as="template">
                <TabPanel v-for="category in navigation.categories" :key="category.name" class="px-4 py-6 space-y-12">
                  <div class="grid grid-cols-2 gap-x-4 gap-y-10">
                    <div v-for="item in category.featured" :key="item.name" class="group relative">
                      <div class="aspect-w-1 aspect-h-1 rounded-md bg-gray-100 overflow-hidden group-hover:opacity-75">
                        <img :src="item.imageSrc" :alt="item.imageAlt" class="object-center object-cover" />
                      </div>
                      <a :href="item.href" class="mt-6 block text-sm font-medium text-gray-900">
                        <span class="absolute z-10 inset-0" aria-hidden="true" />
                        {{ item.name }}
                      </a>
                      <p aria-hidden="true" class="mt-1 text-sm text-gray-500">Shop now</p>
                    </div>
                  </div>
                </TabPanel>
              </TabPanels>
            </TabGroup>

            <div class="border-t border-gray-200 py-6 px-4 space-y-6">
              <div v-for="page in navigation.pages" :key="page.name" class="flow-root">
                <a :href="page.href" class="-m-2 p-2 block font-medium text-gray-900">{{ page.name }}</a>
              </div>
            </div>

            <div class="border-t border-gray-200 py-6 px-4 space-y-6">
              <div class="flow-root">
                <a href="#" class="-m-2 p-2 block font-medium text-gray-900">Create an account</a>
              </div>
              <div class="flow-root">
                <a href="#" class="-m-2 p-2 block font-medium text-gray-900">Sign in</a>
              </div>
            </div>

            <div class="border-t border-gray-200 py-6 px-4 space-y-6">
              <!-- Currency selector -->
              <form>
                <div class="inline-block">
                  <label for="mobile-currency" class="sr-only">Currency</label>
                  <div class="-ml-2 group relative border-transparent rounded-md focus-within:ring-2 focus-within:ring-white">
                    <select id="mobile-currency" name="currency" class="bg-none border-transparent rounded-md py-0.5 pl-2 pr-5 flex items-center text-sm font-medium text-gray-700 group-hover:text-gray-800 focus:outline-none focus:ring-0 focus:border-transparent">
                      <option v-for="currency in currencies" :key="currency">{{ currency }}</option>
                    </select>
                    <div class="absolute right-0 inset-y-0 flex items-center pointer-events-none">
                      <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20" class="w-5 h-5 text-gray-500">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M6 8l4 4 4-4" />
                      </svg>
                    </div>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </TransitionChild>
      </Dialog>
    </TransitionRoot>

    <!-- Hero section -->
        <h1 class="text-4xl font-extrabold tracking-tight text-white lg:text-6xl">New arrivals are here</h1>
<!-- 
<div  class="flex flex-col items-center">
     <div class="bg-white flex items-center rounded-full shadow-xl">
        <div class="w-full px-4">
            <div class="form-group">
        <div class="rounded-l-full w-full py-4 px-6 text-gray-700 leading-tight focus:outline-none" id="search" type="text" placeholder="Search">
          <Select2 v-model="optionSelected" :options="myOptions"  :settings="{ placeholder: 'Specifies the placeholder through settings', width: '100%' }" @change="myChangeEvent($event)" @select="mySelectEvent($event)" />
          <p>{{ optionSelected }}</p>
        </div>
      </div>

</div>
     </div>
</div> -->

<div  class="flex flex-col items-center" >
   <div class="bg-white flex items-center shadow-xl" style="width: 557px; border">
        <input class="l-full w-full py-4 px-6 text-gray-700 leading-tight focus:outline-none" type="text" @keyup="searchUnit" placeholder="Search Company" v-model="search" id="search">
        
        <div class="p-4">
          <button class="bg-blue-500 text-white rounded-full p-2 hover:bg-blue-400 focus:outline-none w-12 h-12 flex items-center justify-center">
            icon
          </button>
          </div>
  
    </div>
</div>

<div v-if="units.data">
<div class="searchBox" >
    <div class="w-full md:w-1/2 flex flex-col items-center">
        <div class="w-full px-4">
            <div class="flex flex-col items-center relative">
               
                <div class="absolute shadow bg-white top-100 z-40 w-full lef-0 rounded max-h-select overflow-y-auto svelte-5uyqqj">
                    <div class="flex flex-col w-full">
                        <div class="cursor-pointer w-full border-gray-100 rounded-t border-b hover:bg-teal-100">
                            <div class="flex w-full items-center p-2 pl-2 border-transparent border-l-2 relative hover:border-teal-100">
                                  <ul>
                                <li v-for="unit in units.data" :key="unit.id">
                                <router-link :to="{name: 'product', params: { id: unit.id }}">
                                <span class="w-9 flex flex-col items-center">
                                    <span class="flex relative w-10 h-10 bg-orange-500 justify-center items-center m-1 mr-2 w-5 h-5 mt-1 rounded-full "><img :src="unit.img"> </span>
                                </span>
                                <span></span>
                                <span class="w-full items-center flex" >
                                    <span class="mx-10 -mt-11  ">{{ unit.root_domain }}
                                        <span class="text-xs truncate w-full normal-case font-normal -mt-1 text-gray-500"> &nbsp;&nbsp;Domain Authority &nbsp; {{ unit.domain_authority }}</span>
                                    </span>
                                </span>
                                </router-link>
                              </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> 
</div>  

<div v-if="search !== '' && units.data == '' ">
<div class="searchBox" >
    <div class="w-full md:w-1/2 flex flex-col items-center">
        <div class="w-full px-4">
            <div class="flex flex-col items-center relative">
               
                <div class="absolute shadow bg-white top-100 z-40 w-full lef-0 rounded max-h-select overflow-y-auto svelte-5uyqqj">
                    <div class="flex flex-col w-full">
                        <div class="cursor-pointer w-full border-gray-100 rounded-t border-b hover:bg-teal-100">
                            <div class="flex w-full items-center p-2 pl-2 border-transparent border-l-2 relative hover:border-teal-100">
                                <span class="text-xs truncate w-full normal-case font-normal -mt-1 text-gray-500">Data not found</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> 
</div>    

    <main>
      <!-- <div class="card-body" id="hide_again">
    <table id="" class="table table-bordered table-striped">
      <thead>
      <tr>
         <th>Name</th>
         <th>Status</th>
       </tr>
      </thead>
     <tbody>
        <tr v-for="unit in units.data" :key="unit.root_domain">
          <td>{{ unit.root_domain }}</td>
          <td>{{ unit.domain_authority }}</td>
        </tr>
     </tbody>
     <pagination :data="units" @pagination-change-page="getResults"></pagination>
    </table>

  </div> -->
      <!-- Category section -->
      <!-- <section aria-labelledby="category-heading" class="pt-24 sm:pt-32 xl:max-w-7xl xl:mx-auto xl:px-8">
        <div class="px-4 sm:px-6 sm:flex sm:items-center sm:justify-between lg:px-8 xl:px-0">
          <h2 id="category-heading" class="text-2xl font-extrabold tracking-tight text-gray-900">Shop by Category</h2>
          <a href="#" class="hidden text-sm font-semibold text-indigo-600 hover:text-indigo-500 sm:block">Browse all categories<span aria-hidden="true"> &rarr;</span></a>
        </div>

        <div class="mt-4 flow-root">
          <div class="-my-2">
            <div class="box-content py-2 relative h-80 overflow-x-auto xl:overflow-visible">
              <div class="absolute min-w-screen-xl px-4 flex space-x-8 sm:px-6 lg:px-8 xl:relative xl:px-0 xl:space-x-0 xl:grid xl:grid-cols-5 xl:gap-x-8">
                <a v-for="category in categories" :key="category.name" :href="category.href" class="relative w-56 h-80 rounded-lg p-6 flex flex-col overflow-hidden hover:opacity-75 xl:w-auto">
                  <span aria-hidden="true" class="absolute inset-0">
                    <img :src="category.imageSrc" alt="" class="w-full h-full object-center object-cover" />
                  </span>
                  <span aria-hidden="true" class="absolute inset-x-0 bottom-0 h-2/3 bg-gradient-to-t from-gray-800 opacity-50" />
                  <span class="relative mt-auto text-center text-xl font-bold text-white">{{ category.name }}</span>
                </a>
              </div>
            </div>
          </div>
        </div>

        <div class="mt-6 px-4 sm:hidden">
          <a href="#" class="block text-sm font-semibold text-indigo-600 hover:text-indigo-500">Browse all categories<span aria-hidden="true"> &rarr;</span></a>
        </div>
      </section> -->
<!-- <VueTailwindPagination :current="currentPage" :total="total" :per-page="perPage" @page-changed="getResults"/> -->

      <!-- Featured section -->
      <section aria-labelledby="social-impact-heading" class="max-w-7xl mx-auto pt-24 px-4 sm:pt-32 sm:px-6 lg:px-8">
        <div class="relative rounded-lg overflow-hidden">
          <div class="absolute inset-0">
            <img src="https://tailwindui.com/img/ecommerce-images/home-page-01-feature-section-01.jpg" alt="" class="w-full h-full object-center object-cover" />
          </div>
          <div class="relative bg-gray-900 bg-opacity-75 py-32 px-6 sm:py-40 sm:px-12 lg:px-16">
            <div class="relative max-w-3xl mx-auto flex flex-col items-center text-center">
              <h2 id="social-impact-heading" class="text-3xl font-extrabold tracking-tight text-white sm:text-4xl">
                <span class="block sm:inline">Level up</span>
                <span class="block sm:inline">your desk</span>
              </h2>
              <p class="mt-3 text-xl text-white">Make your desk beautiful and organized. Post a picture to social media and watch it get more likes than life-changing announcements. Reflect on the shallow nature of existence. At least you have a really nice desk setup.</p>
              <a href="#" class="mt-8 w-full block bg-white border border-transparent rounded-md py-3 px-8 text-base font-medium text-gray-900 hover:bg-gray-100 sm:w-auto">Shop Workspace</a>
            </div>
          </div>
        </div>
      </section>

      <!-- Collection section -->
      <section aria-labelledby="collection-heading" class="max-w-xl mx-auto pt-24 px-4 sm:pt-32 sm:px-6 lg:max-w-7xl lg:px-8">
        <h2 id="collection-heading" class="text-2xl font-extrabold tracking-tight text-gray-900">Shop by Collection</h2>
        <p class="mt-4 text-base text-gray-500">Each season, we collaborate with world-class designers to create a collection inspired by the natural world.</p>

        <div class="mt-10 space-y-12 lg:space-y-0 lg:grid lg:grid-cols-3 lg:gap-x-8">
          <a v-for="collection in collections" :key="collection.name" :href="collection.href" class="group block">
            <div aria-hidden="true" class="aspect-w-3 aspect-h-2 rounded-lg overflow-hidden group-hover:opacity-75 lg:aspect-w-5 lg:aspect-h-6">
              <img :src="collection.imageSrc" :alt="collection.imageAlt" class="w-full h-full object-center object-cover" />
            </div>
            <h3 class="mt-4 text-base font-semibold text-gray-900">{{ collection.name }}</h3>
            <p class="mt-2 text-sm text-gray-500">{{ collection.description }}</p>
          </a>
        </div>
      </section>

      <!-- Featured section -->
      <section aria-labelledby="comfort-heading" class="max-w-7xl mx-auto py-24 px-4 sm:py-32 sm:px-6 lg:px-8">
        <div class="relative rounded-lg overflow-hidden">
          <div class="absolute inset-0">
            <img src="https://tailwindui.com/img/ecommerce-images/home-page-01-feature-section-02.jpg" alt="" class="w-full h-full object-center object-cover" />
          </div>
          <div class="relative bg-gray-900 bg-opacity-75 py-32 px-6 sm:py-40 sm:px-12 lg:px-16">
            <div class="relative max-w-3xl mx-auto flex flex-col items-center text-center">
              <h2 id="comfort-heading" class="text-3xl font-extrabold tracking-tight text-white sm:text-4xl">Simple productivity</h2>
              <p class="mt-3 text-xl text-white">Endless tasks, limited hours, a single piece of paper. Not really a haiku, but we're doing our best here. No kanban boards, burndown charts, or tangled flowcharts with our Focus system. Just the undeniable urge to fill empty circles.</p>
              <a href="#" class="mt-8 w-full block bg-white border border-transparent rounded-md py-3 px-8 text-base font-medium text-gray-900 hover:bg-gray-100 sm:w-auto">Shop Focus</a>
            </div>
          </div>
        </div>
      </section>
    </main>

    <footer aria-labelledby="footer-heading" class="bg-gray-900">
      <h2 id="footer-heading" class="sr-only">Footer</h2>
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="py-20 xl:grid xl:grid-cols-3 xl:gap-8">
          <div class="grid grid-cols-2 gap-8 xl:col-span-2">
            <div class="space-y-12 md:space-y-0 md:grid md:grid-cols-2 md:gap-8">
              <div>
                <h3 class="text-sm font-medium text-white">
                  Shop
                </h3>
                <ul role="list" class="mt-6 space-y-6">
                  <li v-for="item in footerNavigation.shop" :key="item.name" class="text-sm">
                    <a :href="item.href" class="text-gray-300 hover:text-white">
                      {{ item.name }}
                    </a>
                  </li>
                </ul>
              </div>
              <div>
                <h3 class="text-sm font-medium text-white">
                  Company
                </h3>
                <ul role="list" class="mt-6 space-y-6">
                  <li v-for="item in footerNavigation.company" :key="item.name" class="text-sm">
                    <a :href="item.href" class="text-gray-300 hover:text-white">
                      {{ item.name }}
                    </a>
                  </li>
                </ul>
              </div>
            </div>
            <div class="space-y-12 md:space-y-0 md:grid md:grid-cols-2 md:gap-8">
              <div>
                <h3 class="text-sm font-medium text-white">
                  Account
                </h3>
                <ul role="list" class="mt-6 space-y-6">
                  <li v-for="item in footerNavigation.account" :key="item.name" class="text-sm">
                    <a :href="item.href" class="text-gray-300 hover:text-white">
                      {{ item.name }}
                    </a>
                  </li>
                </ul>
              </div>
              <div>
                <h3 class="text-sm font-medium text-white">
                  Connect
                </h3>
                <ul role="list" class="mt-6 space-y-6">
                  <li v-for="item in footerNavigation.connect" :key="item.name" class="text-sm">
                    <a :href="item.href" class="text-gray-300 hover:text-white">
                      {{ item.name }}
                    </a>
                  </li>
                </ul>
              </div>
            </div>
          </div>
          <div class="mt-12 md:mt-16 xl:mt-0">
            <h3 class="text-sm font-medium text-white">Sign up for our newsletter</h3>
            <p class="mt-6 text-sm text-gray-300">The latest deals and savings, sent to your inbox weekly.</p>
            <form class="mt-2 flex sm:max-w-md">
              <label for="email-address" class="sr-only">Email address</label>
              <input id="email-address" type="text" autocomplete="email" required="" class="appearance-none min-w-0 w-full bg-white border border-white rounded-md shadow-sm py-2 px-4 text-base text-gray-900 placeholder-gray-500 focus:outline-none focus:border-white focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-900 focus:ring-white" />
              <div class="ml-4 flex-shrink-0">
                <button type="submit" class="w-full bg-indigo-600 border border-transparent rounded-md shadow-sm py-2 px-4 flex items-center justify-center text-base font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-900 focus:ring-indigo-500">
                  Sign up
                </button>
              </div>
            </form>
          </div>
        </div>

        <div class="border-t border-gray-800 py-10">
          <p class="text-sm text-gray-400">Copyright &copy; 2021 Clothing Company Inc.</p>
        </div>
      </div>
    </footer>
    <router-view></router-view>
  </div>
</template>

<script>
import { ref } from 'vue'
  import _ from "lodash";
  import '@ocrv/vue-tailwind-pagination/styles'
  import VueTailwindPagination from '@ocrv/vue-tailwind-pagination'


  //  import pagination from 'laravel-vue-pagination'
import Select2 from 'vue3-select2-component';
import {
  Dialog,
  DialogOverlay,
  Popover,
  PopoverButton,
  PopoverGroup,
  PopoverPanel,
  Tab,
  TabGroup,
  TabList,
  TabPanel,
  TabPanels,
  TransitionChild,
  TransitionRoot,
} from '@headlessui/vue'
import { MenuIcon, QuestionMarkCircleIcon, SearchIcon, ShoppingBagIcon, XIcon } from '@heroicons/vue/outline'

const currencies = ['CAD', 'USD', 'AUD', 'EUR', 'GBP']
const navigation = {
  categories: [
    {
      name: 'Women',
      featured: [
        {
          name: 'New Arrivals',
          href: '#',
          imageSrc: 'https://tailwindui.com/img/ecommerce-images/mega-menu-category-01.jpg',
          imageAlt: 'Models sitting back to back, wearing Basic Tee in black and bone.',
        },
        {
          name: 'Basic Tees',
          href: '#',
          imageSrc: 'https://tailwindui.com/img/ecommerce-images/mega-menu-category-02.jpg',
          imageAlt: 'Close up of Basic Tee fall bundle with off-white, ochre, olive, and black tees.',
        },
        {
          name: 'Accessories',
          href: '#',
          imageSrc: 'https://tailwindui.com/img/ecommerce-images/mega-menu-category-03.jpg',
          imageAlt: 'Model wearing minimalist watch with black wristband and white watch face.',
        },
        {
          name: 'Carry',
          href: '#',
          imageSrc: 'https://tailwindui.com/img/ecommerce-images/mega-menu-category-04.jpg',
          imageAlt: 'Model opening tan leather long wallet with credit card pockets and cash pouch.',
        },
      ],
    },
    {
      name: 'Men',
      featured: [
        {
          name: 'New Arrivals',
          href: '#',
          imageSrc: 'https://tailwindui.com/img/ecommerce-images/mega-menu-01-men-category-01.jpg',
          imageAlt: 'Hats and sweaters on wood shelves next to various colors of t-shirts on hangers.',
        },
        {
          name: 'Basic Tees',
          href: '#',
          imageSrc: 'https://tailwindui.com/img/ecommerce-images/mega-menu-01-men-category-02.jpg',
          imageAlt: 'Model wearing light heather gray t-shirt.',
        },
        {
          name: 'Accessories',
          href: '#',
          imageSrc: 'https://tailwindui.com/img/ecommerce-images/mega-menu-01-men-category-03.jpg',
          imageAlt:
            'Grey 6-panel baseball hat with black brim, black mountain graphic on front, and light heather gray body.',
        },
        {
          name: 'Carry',
          href: '#',
          imageSrc: 'https://tailwindui.com/img/ecommerce-images/mega-menu-01-men-category-04.jpg',
          imageAlt: 'Model putting folded cash into slim card holder olive leather wallet with hand stitching.',
        },
      ],
    },
  ],
  pages: [
    { name: 'Company', href: '#' },
    { name: 'Stores', href: '#' },
  ],
}
const categories = [
  {
    name: 'New Arrivals',
    href: '#',
    imageSrc: 'https://tailwindui.com/img/ecommerce-images/home-page-01-category-01.jpg',
  },
  {
    name: 'Productivity',
    href: '#',
    imageSrc: 'https://tailwindui.com/img/ecommerce-images/home-page-01-category-02.jpg',
  },
  {
    name: 'Workspace',
    href: '#',
    imageSrc: 'https://tailwindui.com/img/ecommerce-images/home-page-01-category-04.jpg',
  },
  {
    name: 'Accessories',
    href: '#',
    imageSrc: 'https://tailwindui.com/img/ecommerce-images/home-page-01-category-05.jpg',
  },
  { name: 'Sale', href: '#', imageSrc: 'https://tailwindui.com/img/ecommerce-images/home-page-01-category-03.jpg' },
]
const collections = [
  {
    name: 'Handcrafted Collection',
    href: '#',
    imageSrc: 'https://tailwindui.com/img/ecommerce-images/home-page-01-collection-01.jpg',
    imageAlt: 'Brown leather key ring with brass metal loops and rivets on wood table.',
    description: 'Keep your phone, keys, and wallet together, so you can lose everything at once.',
  },
  {
    name: 'Organized Desk Collection',
    href: '#',
    imageSrc: 'https://tailwindui.com/img/ecommerce-images/home-page-01-collection-02.jpg',
    imageAlt: 'Natural leather mouse pad on white desk next to porcelain mug and keyboard.',
    description: 'The rest of the house will still be a mess, but your desk will look great.',
  },
  {
    name: 'Focus Collection',
    href: '#',
    imageSrc: 'https://tailwindui.com/img/ecommerce-images/home-page-01-collection-03.jpg',
    imageAlt: 'Person placing task list card into walnut card holder next to felt carrying case on leather desk pad.',
    description: 'Be more productive than enterprise project managers with a single piece of paper.',
  },
]
const footerNavigation = {
  shop: [
    { name: 'Bags', href: '#' },
    { name: 'Tees', href: '#' },
    { name: 'Objects', href: '#' },
    { name: 'Home Goods', href: '#' },
    { name: 'Accessories', href: '#' },
  ],
  company: [
    { name: 'Who we are', href: '#' },
    { name: 'Sustainability', href: '#' },
    { name: 'Press', href: '#' },
    { name: 'Careers', href: '#' },
    { name: 'Terms & Conditions', href: '#' },
    { name: 'Privacy', href: '#' },
  ],
  account: [
    { name: 'Manage Account', href: '#' },
    { name: 'Returns & Exchanges', href: '#' },
    { name: 'Redeem a Gift Card', href: '#' },
  ],
  connect: [
    { name: 'Contact Us', href: '#' },
    { name: 'Twitter', href: '#' },
    { name: 'Instagram', href: '#' },
    { name: 'Pinterest', href: '#' },
  ],
}

export default {
  components: {
    VueTailwindPagination,
      Select2,
    Dialog,
    DialogOverlay,
    Popover,
    PopoverButton,
    PopoverGroup,
    PopoverPanel,
    Tab,
    TabGroup,
    TabList,
    TabPanel,
    TabPanels,
    TransitionChild,
    TransitionRoot,
    MenuIcon,
    QuestionMarkCircleIcon,
    SearchIcon,
    ShoppingBagIcon,
    XIcon,
  },
  setup() {
    const mobileMenuOpen = ref(false)

    return {
      units: {},
      search: '',
      currentPage: 1,
      perPage: 2,
      total: 20,
      currencies,
      navigation,
      categories,
      collections,
      footerNavigation,
      mobileMenuOpen,
       myValue: '',
        myOptions: [] // or [{id: key, text: value}, {id: key, text: value}]
    }
  },
  methods: {
    fetchingAllUnit() {
          axios.get("api/unit").then( data => {
            // this.units = data.data
            }
            );
        },
        getResults(page = 1) {
              axios.get('api/unit?page=' + page + this.search)
                .then(response => {
                  this.units.data = response.data;
                  console.log('paginate Data');
                  console.log(response.data);
              });
        },

        searchUnit:_.debounce(function(){
          axios.get('/search_unit?q='+this.search)
                .then((response)=>{
                this.units.data = response.data.unit
                this.myOptions = response.data.unit
               this.$forceUpdate();
                console.log('search_unit Data');
                  console.log(this.units.data);
          })
        }),
        myChangeEvent(val){
            console.log(val);
        },
        mySelectEvent({id, text}){
            console.log({id, text})
        }
    },
    created(){

        this.fetchingAllUnit();

    },
}
</script>
<style scoped>
 .top-100 {top: 100%}
    .bottom-100 {bottom: 100%}
    .max-h-select {
        max-height: 300px;
    }

    .searchBox{
      margin-left: 461px; 
      width: 1175px; 
      margin-top: 7px;
    }
</style>