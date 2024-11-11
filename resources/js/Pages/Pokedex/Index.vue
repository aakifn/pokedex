<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import {Head} from '@inertiajs/vue3';
</script>

<template>
    <AuthenticatedLayout>
        <Head title="Pokedex" />

        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                Pokedex
            </h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                    <div class="p-2 text-gray-900">
                        <div class="flex justify-between border-b border-gray-200 bg-white px-4 py-3 sm:px-6">
                            <form :action="route('pokedex.index')" class="mt-6 sm:flex sm:max-w-md lg:mt-0">
                                <input type="text" name="search" id="search" class="block w-full rounded-md border-0 py-1.5 pr-14 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm/6" :value="$page.props.search">
                                <div class="mt-4 sm:ml-4 sm:mt-0 sm:shrink-0">
                                    <button type="submit" class="flex w-full items-center justify-center rounded-md bg-indigo-500 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-400 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-500">Search</button>
                                </div>
                            </form>
                        </div>
                        <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8 px-4 py-3 sm:px-6" >
                            <div class="inline-block min-w-full align-middle sm:px-6 lg:px-8">
                                <table v-if="$page.props.pokemons.total" class="min-w-full divide-y divide-gray-300">
                                    <thead>
                                    <tr>
                                        <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-0">
                                            Name
                                        </th>
                                        <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-0">
                                            Types
                                        </th>
                                        <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">
                                            HP
                                        </th>
                                        <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">
                                            Attack
                                        </th>
                                        <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">
                                            Defense
                                        </th>
                                        <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">
                                            Speed
                                        </th>
                                        <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">
                                            Special
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody class="divide-y divide-gray-200 bg-white">
                                    <tr v-for="pokemon in $page.props.pokemons.data" :key="pokemon.id">
                                        <td class="whitespace-nowrap py-5 pl-4 pr-3 text-sm sm:pl-0">
                                            <div class="flex items-center">
                                                <div class="h-11 w-11 shrink-0">
                                                    <img class="h-11 w-11 rounded-full" :src="pokemon.gif" alt="" />
                                                </div>
                                                <div class="ml-4">
                                                    <div class="font-medium text-gray-900">{{ pokemon.name }}</div>
                                                    <div class="mt-1 text-gray-500">#{{ pokemon.number }}</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-0">
                                            <span class="type-{{ pokemon.type1 }}">{{ pokemon.type1 }}</span><span class="type-{{ pokemon.type2 }}" v-if="pokemon.type2"> / {{ pokemon.type2 }}</span>
                                        </td>
                                        <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ pokemon.hp }}</td>
                                        <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ pokemon.attack }}</td>
                                        <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ pokemon.defense }}</td>
                                        <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ pokemon.speed }}</td>
                                        <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ pokemon.special }}</td>
                                    </tr>
                                    </tbody>
                                </table >
                                <div v-else class="text-center p-4">
                                    <h3 class="mt-2 text-sm font-medium text-gray-900">No pokemons found</h3>
                                </div>
                            </div>
                        </div>
                        <nav v-if="$page.props.pokemons.total" class="flex items-center justify-between border-t border-gray-200 bg-white px-4 py-3 sm:px-6" aria-label="Pagination">
                            <div class="hidden sm:block">
                                <p class="text-sm text-gray-700">
                                    Showing
                                    {{ ' ' }}
                                    <span class="font-medium">{{ $page.props.pokemons.from }}</span>
                                    {{ ' ' }}
                                    to
                                    {{ ' ' }}
                                    <span class="font-medium">{{ $page.props.pokemons.to }}</span>
                                    {{ ' ' }}
                                    of
                                    {{ ' ' }}
                                    <span class="font-medium">{{ $page.props.pokemons.total }}</span>
                                    {{ ' ' }}
                                    results
                                </p>
                            </div>
                            <div class="flex flex-1 justify-between sm:justify-end" v-if="$page.props.pokemons.total">
                                <a :href="$page.props.pokemons.prev_page_url" v-if="$page.props.pokemons.prev_page_url" class="relative inline-flex items-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 ring-1 ring-inset ring-gray-300 hover:bg-gray-50 focus-visible:outline-offset-0">Previous</a>
                                <a :href="$page.props.pokemons.next_page_url" class="relative ml-3 inline-flex items-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 ring-1 ring-inset ring-gray-300 hover:bg-gray-50 focus-visible:outline-offset-0">Next</a>
                            </div>
                        </nav>
                    </div>
                </div>
            </div>
        </div>

    </AuthenticatedLayout>
</template>
