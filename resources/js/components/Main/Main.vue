<template>
    <div class="tw-w-full tw-h-screen tw-bg-gray-100 ">
        <Header />
        <div class="tw-w-full tw-bg-gray-100 tw-py-10 tw-items-center tw-justify-center tw-flex tw-flex-col">
            <div class="tw-w-3/4 tw-flex tw-items-center tw-justify-between">
                <span class="tw-text-gym-blue200 tw-font-bold tw-text-4xl">{{ dataAnalyticsTableType.total }}
                    Clientes</span>
                <button @click="showModalview = true"
                    class="tw-bg-gym-blue100 tw-text-white tw-py-2 tw-px-4 tw-rounded tw-font-medium tw-transition tw-duration-300 tw-ease-in-out hover:tw-bg-gym-blue200">
                    Cadastrar clientes
                </button>
                <Modal :showModal="showModalview" :titleModal="'Adicionar Clientes'"
                    :maxWSize="'tw-max-w-full lg:tw-max-w-[30%]'" @close="() => {
                        showModalview = false;
                    }
                        ">
                    <div class="tw-flex tw-items-center tw-w-full tw-flex-col">
                        <div class="tw-w-full">
                            <h6 style="margin-bottom: 0"
                                class="tw-font-medium tw-text-sm tw-whitespace-normal tw-text-secondary-700 dark:text-secondary-400">
                                Nome
                            </h6>
                            <input rows="1" v-model="cliente.name" placeholder="ex: Pablo Kauê"
                                class="tw-border tw-border-gray-400 tw-w-full tw-p-2 tw-mt-2 tw-outline-none" />
                            <h6 style="margin-bottom: 0"
                                class="tw-font-medium tw-text-sm tw-whitespace-normal tw-text-secondary-700 dark:text-secondary-400">
                                CPF
                            </h6>
                            <input rows="1" v-model="cliente.cpf" placeholder="ex: 000.000.000-00"
                                class="tw-border tw-border-gray-400 tw-w-full tw-p-2 tw-mt-2 tw-outline-none" />
                            <h6 style="margin-bottom: 0"
                                class="tw-font-medium tw-text-sm tw-whitespace-normal tw-text-secondary-700 dark:text-secondary-400 tw-mt-3">
                                Contato <span class="tw-text-gym-blue200 tw-text-xs">(por favor, por o "9" depois do
                                    ddd)</span>
                            </h6>
                            <input rows="1" @input="formatPhoneNumber" v-model="cliente.contato"
                                placeholder="(00) 0 0000-0000"
                                class="tw-border tw-border-gray-400 tw-w-full tw-p-2 tw-mt-2 tw-outline-none" />
                            <h6 style="margin-bottom: 0"
                                class="tw-font-medium tw-text-sm tw-whitespace-normal tw-text-secondary-700 dark:text-secondary-400 tw-mt-3">
                                Numero de pessoas na casa
                            </h6>
                            <input rows="1" v-model="cliente.numeropessoas" placeholder="Digite o contato do cliente"
                                class="tw-border tw-border-gray-400 tw-w-full tw-p-2 tw-mt-2 tw-outline-none" />
                            <h6 style="margin-bottom: 0"
                                class="tw-font-medium tw-text-sm tw-whitespace-normal tw-text-secondary-700 dark:text-secondary-400 tw-mt-3">
                                Endereço
                            </h6>
                            <input rows="1" v-model="cliente.endereco" placeholder="ex: Rua Conego Ísmar Fernandes"
                                class="tw-border tw-border-gray-400 tw-w-full tw-p-2 tw-mt-2 tw-outline-none" />
                            <div class="tw-grid tw-grid-cols-3 tw-gap-2 tw-items-center">
                                <div class="tw-col-span-2">
                                    <h6 style="margin-bottom: 0"
                                        class="tw-font-medium tw-text-sm tw-whitespace-normal tw-text-secondary-700 dark:text-secondary-400 tw-mt-3">
                                        Serviço
                                    </h6>
                                    <input v-model="cliente.servico" rows="1" type="text" placeholder="Vinheta"
                                        class="tw-border tw-border-gray-400 tw-w-full tw-p-2 tw-mt-2 tw-outline-none" />
                                </div>
                                <div>
                                    <h6 style="margin-bottom: 0"
                                        class="tw-font-medium tw-text-sm tw-whitespace-normal tw-text-secondary-700 dark:text-secondary-400 tw-mt-3">
                                        Valor
                                    </h6>
                                    <input @input="formatCurrency" ref="currencyInput" v-model="cliente.valor" rows="1"
                                        type="text" placeholder="R$5,00"
                                        class="tw-border tw-border-gray-400 tw-w-full tw-p-2 tw-mt-2 tw-outline-none" />
                                </div>
                            </div>
                            <div class="tw-grid tw-grid-cols-3 tw-gap-2 tw-items-center">
                                <div class="tw-col-span-2">
                                    <h6 style="margin-bottom: 0"
                                        class="tw-font-medium tw-text-sm tw-whitespace-normal tw-text-secondary-700 dark:text-secondary-400 tw-mt-3">
                                        Vencimento
                                    </h6>
                                    <input v-model="cliente.vencimento" rows="1" type="date" placeholder="ex: 12/03/2004"
                                        class="tw-border tw-border-gray-400 tw-w-full tw-p-2 tw-mt-2 tw-outline-none" />
                                </div>
                                <div>
                                    <h6 style="margin-bottom: 0"
                                        class="tw-font-medium tw-text-sm tw-whitespace-normal tw-text-secondary-700 dark:text-secondary-400 tw-mt-3">
                                        Status
                                    </h6>
                                    <select v-model="cliente.status"
                                        class="tw-border tw-border-gray-400 tw-w-full tw-p-3 tw-rounded-sm tw-bg-transparent tw-mt-2 tw-outline-none">
                                        <option v-for="option in options" :key="option" :value="option">
                                            {{ option }}
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <div>
                                <h6 style="margin-bottom: 0"
                                    class="tw-font-medium tw-text-sm tw-whitespace-normal tw-text-secondary-700 dark:text-secondary-400">
                                    Observação
                                </h6>
                                <input rows="1" v-model="cliente.observacao" placeholder="Digite uma observação"
                                    class="tw-w-full tw-border tw-border-gray-400 tw-p-2 tw-mt-2 tw-outline-none" />
                            </div>
                        </div>
                        <button @click="submitForm()"
                            class="tw-mt-3 tw-bg-gym-blue100 tw-text-white tw-py-2 tw-px-4 tw-rounded tw-font-medium tw-transition tw-duration-300 tw-ease-in-out hover:tw-bg-gym-blue200">
                            Adicionar
                        </button>
                    </div>
                </Modal>
            </div>
            <div class="tw-flex tw-flex-col tw-w-3/4 tw-mt-2 lg:tw-gap-2 lg:tw-flex-row">
                <div>
                    <h6>Pesquisar</h6>
                    <div class="tw-grid tw-w-full tw-grid-cols-1 tw-gap-1 ">
                        <div class="tw-mb-3 tw-w-full tw-flex tw-items-center">
                            <input v-model="filters.search" placeholder="Pesquisar" required type="text"
                                class=" tw-p-2 tw-w-full tw-border tw-rounded" />
                        </div>
                    </div>
                </div>
                <div>
                    <h6>Somente por</h6>
                    <div class="tw-mb-3 tw-w-full tw-flex tw-items-center">
                        <select v-model="filters.searchType"
                            class="tw-form-select tw-p-2 tw-w-full tw-mt-1 tw-block tw-pl-3 tw-pr-10 tw-py-2 tw-text-base tw-border-gray-300 focus:tw-outline-none focus:tw-ring-indigo-500 focus:tw-border-indigo-500 sm:tw-text-sm tw-rounded-md">
                            <option value="autor">Autor</option>
                            <option value="idUser">Id do user</option>
                            <option value="cpfUser">Cpf do user</option>
                        </select>
                    </div>
                </div>
                <div>
                    <h6>Status</h6>
                    <div class="tw-mb-3 tw-w-full tw-flex tw-items-center">
                        <select v-model="filters.status"
                            class="tw-form-select tw-p-2 tw-w-full tw-mt-1 tw-block tw-pl-3 tw-pr-10 tw-py-2 tw-text-base tw-border-gray-300 focus:tw-outline-none focus:tw-ring-indigo-500 focus:tw-border-indigo-500 sm:tw-text-sm tw-rounded-md">
                            <option value="">Todos</option>
                            <option value="pago">Pago</option>
                            <option value="vencido">Vencido</option>
                            <option value="pendente">Á vencer</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="tw-w-11/12 tw-overflow-x-auto tw-flex tw-py-4">
                <div v-if="dataResults.length == 0"
                    class="tw-w-full tw-p-3 tw-rounded-lg tw-flex tw-justify-center tw-bg-white tw-shadow-md tw-mt-1">
                    <span class="tw-font-bold">Não existe dados na tabela :/</span>
                </div>

                <table v-else class="tw-w-full tw-table-auto">

                    <thead
                        class="tw-text-xs tw-font-semibold tw-uppercase tw-border-t tw-border-b tw-text-gray-500 tw-bg-gray-50 tw-border-gray-200">
                        <tr>
                            <th class="tw-px-2 tw-py-3 first:tw-pl-5 last:tw-pr-5 tw-whitespace-nowrap">
                                <div class="tw-font-semibold tw-text-left">Id</div>
                            </th>
                            <th class="tw-px-2 tw-py-3 first:tw-pl-5 last:tw-pr-5 tw-whitespace-nowrap">
                                <div class="tw-font-semibold tw-text-left">Nome</div>
                            </th>
                            <th class="tw-px-2 tw-py-3 first:tw-pl-5 last:tw-pr-5 tw-whitespace-nowrap">
                                <div class="tw-font-semibold tw-text-left">CPF</div>
                            </th>
                            <th class="tw-px-2 tw-py-3 first:tw-pl-5 last:tw-pr-5 tw-whitespace-nowrap">
                                <div class="tw-font-semibold tw-text-left">Contato</div>
                            </th>
                            <th class="tw-px-2 tw-py-3 first:tw-pl-5 last:tw-pr-5 tw-whitespace-nowrap">
                                <div class="tw-font-semibold tw-text-left">Vencimento</div>
                            </th>
                            <th class="tw-px-2 tw-py-3 first:tw-pl-5 last:tw-pr-5 tw-whitespace-nowrap">
                                <div class="tw-font-semibold tw-text-left">Serviço</div>
                            </th>
                            <th class="tw-px-2 tw-py-3 first:tw-pl-5 last:tw-pr-5 tw-whitespace-nowrap">
                                <div class="tw-font-semibold tw-text-left">Valor</div>
                            </th>
                            <th class="tw-px-2 tw-py-3 first:tw-pl-5 last:tw-pr-5 tw-whitespace-nowrap">
                                <div class="tw-font-semibold tw-text-left">Endereço</div>
                            </th>
                            <th class="tw-px-2 tw-py-3 first:tw-pl-5 last:tw-pr-5 tw-whitespace-nowrap">
                                <div class="tw-font-semibold tw-text-left">Nº Pessoas</div>
                            </th>
                            <th class="tw-px-2 tw-py-3 first:tw-pl-5 last:tw-pr-5 tw-whitespace-nowrap">
                                <div class="tw-font-semibold tw-text-left">Criado em</div>
                            </th>
                            <th class="tw-px-2 tw-py-3 first:tw-pl-5 last:tw-pr-5 tw-whitespace-nowrap">
                            </th>
                        </tr>
                    </thead>
                    <!-- Table body -->
                    <tbody class="divide-gray-200 tw-text-sm tw-divide-y tw-bg-gray-50 tw-border-gray-200">

                        <!-- Row -->
                        <tr v-for=" item in dataResults">
                            <td class="tw-px-2 tw-py-3 first:tw-pl-5 last:tw-pr-5 tw-whitespace-nowrap">
                                <div class="tw-font-normal tw-text-gym-blue100/80 tw-text-base tw-flex tw-items-center">
                                    <span class="tw-max-w-[150px] tw-truncate">
                                        {{ item.id }}
                                    </span>
                                </div>
                            </td>
                            <td class="tw-px-2 tw-py-3 first:tw-pl-5 last:tw-pr-5 tw-whitespace-nowrap">
                                <div :title="item.name"
                                    class="tw-font-normal tw-text-gym-blue100/80 tw-text-base tw-flex tw-items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                        class="tw-w-5 tw-h-5 tw-mr-2">
                                        <path fill-rule="evenodd"
                                            d="M7.5 6a4.5 4.5 0 119 0 4.5 4.5 0 01-9 0zM3.751 20.105a8.25 8.25 0 0116.498 0 .75.75 0 01-.437.695A18.683 18.683 0 0112 22.5c-2.786 0-5.433-.608-7.812-1.7a.75.75 0 01-.437-.695z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    <span class="tw-max-w-[150px] tw-truncate">
                                        {{ item.name }}
                                    </span>
                                </div>
                            </td>
                            <td class="tw-px-2 tw-py-3 first:tw-pl-5 last:tw-pr-5 tw-whitespace-nowrap">
                                <div class="tw-font-normal tw-text-gym-blue100/80 tw-text-base tw-flex tw-items-center">
                                    <span class="tw-max-w-[150px] tw-truncate">
                                        {{ item.cpf }}
                                    </span>
                                </div>
                            </td>
                            <td class="tw-px-2 tw-py-3 first:tw-pl-5 last:tw-pr-5 tw-max-w-[250px] tw-whitespace-nowrap">
                                <div :title="item.contato"
                                    class="tw-font-normal tw-text-gym-blue100/80 tw-text-base tw-flex tw-items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                        class="tw-w-5 tw-h-5 tw-mr-2">
                                        <path fill-rule="evenodd"
                                            d="M1.5 4.5a3 3 0 013-3h1.372c.86 0 1.61.586 1.819 1.42l1.105 4.423a1.875 1.875 0 01-.694 1.955l-1.293.97c-.135.101-.164.249-.126.352a11.285 11.285 0 006.697 6.697c.103.038.25.009.352-.126l.97-1.293a1.875 1.875 0 011.955-.694l4.423 1.105c.834.209 1.42.959 1.42 1.82V19.5a3 3 0 01-3 3h-2.25C8.552 22.5 1.5 15.448 1.5 6.75V4.5z"
                                            clip-rule="evenodd" />
                                    </svg>

                                    <span class="tw-max-w-[150px] tw-truncate">
                                        {{ item.contato }}
                                    </span>
                                </div>
                            </td>

                            <td class="tw-px-2 tw-py-3 first:tw-pl-5 last:tw-pr-5 tw-whitespace-nowrap">
                                <span :title="item.vencimento"
                                    class="tw-font-normal tw-truncate tw-text-gym-blue100/80 tw-text-base tw-flex tw-items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                        class="tw-w-5 tw-h-5 tw-mr-2">
                                        <path
                                            d="M12.75 12.75a.75.75 0 11-1.5 0 .75.75 0 011.5 0zM7.5 15.75a.75.75 0 100-1.5.75.75 0 000 1.5zM8.25 17.25a.75.75 0 11-1.5 0 .75.75 0 011.5 0zM9.75 15.75a.75.75 0 100-1.5.75.75 0 000 1.5zM10.5 17.25a.75.75 0 11-1.5 0 .75.75 0 011.5 0zM12 15.75a.75.75 0 100-1.5.75.75 0 000 1.5zM12.75 17.25a.75.75 0 11-1.5 0 .75.75 0 011.5 0zM14.25 15.75a.75.75 0 100-1.5.75.75 0 000 1.5zM15 17.25a.75.75 0 11-1.5 0 .75.75 0 011.5 0zM16.5 15.75a.75.75 0 100-1.5.75.75 0 000 1.5zM15 12.75a.75.75 0 11-1.5 0 .75.75 0 011.5 0zM16.5 13.5a.75.75 0 100-1.5.75.75 0 000 1.5z" />
                                        <path fill-rule="evenodd"
                                            d="M6.75 2.25A.75.75 0 017.5 3v1.5h9V3A.75.75 0 0118 3v1.5h.75a3 3 0 013 3v11.25a3 3 0 01-3 3H5.25a3 3 0 01-3-3V7.5a3 3 0 013-3H6V3a.75.75 0 01.75-.75zm13.5 9a1.5 1.5 0 00-1.5-1.5H5.25a1.5 1.5 0 00-1.5 1.5v7.5a1.5 1.5 0 001.5 1.5h13.5a1.5 1.5 0 001.5-1.5v-7.5z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    {{ item.vencimento }}
                                    <div :class="item.status == 'pago' ? 'tw-bg-green-500 tw-text-green-500' : 'tw-hidden'"
                                        class="tw-ml-2 tw-h-full tw-w-2 tw-rounded-full">.</div>
                                    <div :class="item.status == 'vencido' ? 'tw-bg-red-500 tw-text-red-500' : 'tw-hidden'"
                                        class="tw-ml-2 tw-h-full tw-w-2 tw-rounded-full">.</div>
                                    <div :class="item.status == 'pendente' ? 'tw-bg-yellow-500 tw-text-yellow-500' : 'tw-hidden'"
                                        class="tw-ml-2 tw-h-full tw-w-2 tw-rounded-full">.</div>

                                </span>
                            </td>
                            <td class="tw-px-2 tw-py-3 first:tw-pl-5 last:tw-pr-5 tw-whitespace-nowrap">
                                <div :title="item.servico"
                                    class="tw-font-normal tw-truncate tw-text-gym-blue100/80 tw-text-base tw-flex tw-items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 256 256"
                                        class="tw-w-5 tw-h-5 tw-mr-2">
                                        <path
                                            d="M223.68,66.15,135.68,18a15.88,15.88,0,0,0-15.36,0l-88,48.17a16,16,0,0,0-8.32,14v95.64a16,16,0,0,0,8.32,14l88,48.17a15.88,15.88,0,0,0,15.36,0l88-48.17a16,16,0,0,0,8.32-14V80.18A16,16,0,0,0,223.68,66.15ZM128,32l80.34,44-29.77,16.3-80.35-44ZM128,120,47.66,76l33.9-18.56,80.34,44ZM40,90l80,43.78v85.79L40,175.82Zm176,85.78h0l-80,43.79V133.82l32-17.51V152a8,8,0,0,0,16,0V107.55L216,90v85.77Z">
                                        </path>
                                    </svg>
                                    <span class="tw-max-w-[150px] tw-truncate">
                                        {{ item.servico }}
                                    </span>
                                </div>
                            </td>
                            <td class="tw-px-2 tw-py-3 first:tw-pl-5 last:tw-pr-5 tw-whitespace-nowrap">
                                <div :title="item.valor"
                                    class="tw-font-normal tw-truncate tw-text-gym-blue100/80 tw-text-base tw-flex tw-items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 256 256"
                                        class="tw-w-5 tw-h-5 tw-mr-2">
                                        <path
                                            d="M192,116a12,12,0,1,1-12-12A12,12,0,0,1,192,116ZM152,64H112a8,8,0,0,0,0,16h40a8,8,0,0,0,0-16Zm96,48v32a24,24,0,0,1-24,24h-2.36l-16.21,45.38A16,16,0,0,1,190.36,224H177.64a16,16,0,0,1-15.07-10.62L160.65,208h-57.3l-1.92,5.38A16,16,0,0,1,86.36,224H73.64a16,16,0,0,1-15.07-10.62L46,178.22a87.69,87.69,0,0,1-21.44-48.38A16,16,0,0,0,16,144a8,8,0,0,1-16,0,32,32,0,0,1,24.28-31A88.12,88.12,0,0,1,112,32H216a8,8,0,0,1,0,16H194.61a87.93,87.93,0,0,1,30.17,37c.43,1,.85,2,1.25,3A24,24,0,0,1,248,112Zm-16,0a8,8,0,0,0-8-8h-3.66a8,8,0,0,1-7.64-5.6A71.9,71.9,0,0,0,144,48H112A72,72,0,0,0,58.91,168.64a8,8,0,0,1,1.64,2.71L73.64,208H86.36l3.82-10.69A8,8,0,0,1,97.71,192h68.58a8,8,0,0,1,7.53,5.31L177.64,208h12.72l18.11-50.69A8,8,0,0,1,216,152h8a8,8,0,0,0,8-8Z">
                                        </path>
                                    </svg>
                                    <span class="tw-max-w-[150px] tw-truncate">
                                        {{ item.valor }}
                                    </span>
                                </div>
                            </td>
                            <td class="tw-px-2 tw-py-3 first:tw-pl-5 last:tw-pr-5 tw-whitespace-nowrap">
                                <div :title="item.endereco"
                                    class="tw-font-normal tw-truncate tw-text-gym-blue100/80 tw-text-base tw-flex tw-items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 256 256"
                                        class="tw-w-5 tw-h-5 tw-mr-2">
                                        <path
                                            d="M128,64a40,40,0,1,0,40,40A40,40,0,0,0,128,64Zm0,64a24,24,0,1,1,24-24A24,24,0,0,1,128,128Zm0-112a88.1,88.1,0,0,0-88,88c0,31.4,14.51,64.68,42,96.25a254.19,254.19,0,0,0,41.45,38.3,8,8,0,0,0,9.18,0A254.19,254.19,0,0,0,174,200.25c27.45-31.57,42-64.85,42-96.25A88.1,88.1,0,0,0,128,16Zm0,206c-16.53-13-72-60.75-72-118a72,72,0,0,1,144,0C200,161.23,144.53,209,128,222Z">
                                        </path>
                                    </svg>
                                    <span class="tw-max-w-[150px] tw-truncate">
                                        {{ item.endereco }}
                                    </span>
                                </div>
                            </td>
                            <td class="tw-px-2 tw-py-3 first:tw-pl-5 last:tw-pr-5 tw-max-w-[250px] tw-whitespace-nowrap">
                                <div :title="item.numeropessoas"
                                    class="tw-font-normal tw-text-gym-blue100/80 tw-text-base tw-flex tw-items-center">
                                    <span class="tw-max-w-[150px] tw-truncate">
                                        {{ item.numeropessoas }}
                                    </span>
                                </div>
                            </td>
                            <td class="tw-px-2 tw-py-3 first:tw-pl-5 last:tw-pr-5 tw-max-w-[250px] tw-whitespace-nowrap">
                                <div :title="item.created_at"
                                    class="tw-font-normal tw-text-gym-blue100/80 tw-text-base tw-flex tw-items-center">
                                    <span class="tw-max-w-[150px] tw-truncate">
                                        {{ item.created_at }}
                                    </span>
                                </div>
                            </td>
                            <td class="tw-px-2 tw-py-3 first:tw-pl-5 last:tw-pr-5 tw-whitespace-nowrap">
                                <button @click="toggleViewEdit(item.id)"
                                    class="tw-bg-gym-blue100 tw-text-white tw-py-2 tw-px-2 tw-rounded-full tw-font-medium tw-transition tw-duration-300 tw-ease-in-out hover:tw-bg-gym-blue200">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="tw-w-6 tw-h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                                    </svg>
                                </button>
                                <button @click="deleteCliente(item.id)"
                                    class="tw-ml-2 tw-bg-red-600 tw-text-white tw-py-2 tw-px-2 tw-rounded-full tw-font-medium tw-transition tw-duration-300 tw-ease-in-out hover:tw-bg-red-700">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="#f8f7f7"
                                        viewBox="0 0 256 256">
                                        <path
                                            d="M216,48H176V40a24,24,0,0,0-24-24H104A24,24,0,0,0,80,40v8H40a8,8,0,0,0,0,16h8V208a16,16,0,0,0,16,16H192a16,16,0,0,0,16-16V64h8a8,8,0,0,0,0-16ZM96,40a8,8,0,0,1,8-8h48a8,8,0,0,1,8,8v8H96Zm96,168H64V64H192ZM112,104v64a8,8,0,0,1-16,0V104a8,8,0,0,1,16,0Zm48,0v64a8,8,0,0,1-16,0V104a8,8,0,0,1,16,0Z">
                                        </path>
                                    </svg>
                                </button>
                                <button @click="observacaoModal(item.observacao)"
                                    class="tw-ml-2 tw-bg-green-600 tw-text-white tw-py-2 tw-px-2 tw-rounded-full tw-font-medium tw-transition tw-duration-300 tw-ease-in-out hover:tw-bg-blue-700">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="#f8f7f7"
                                        viewBox="0 0 256 256">
                                        <path
                                            d="M128,24A104,104,0,1,0,232,128,104.11,104.11,0,0,0,128,24Zm0,192a88,88,0,1,1,88-88A88.1,88.1,0,0,1,128,216Zm16-40a8,8,0,0,1-8,8,16,16,0,0,1-16-16V128a8,8,0,0,1,0-16,16,16,0,0,1,16,16v40A8,8,0,0,1,144,176ZM112,84a12,12,0,1,1,12,12A12,12,0,0,1,112,84Z">
                                        </path>
                                    </svg>
                                </button>
                                <Modal :showModal="shouldShowEditModal(item.id)"
                                    :titleModal="`Editar cliente: ${item.name}`"
                                    :maxWSize="'tw-max-w-full lg:tw-max-w-[30%]'" @close="() => {
                                        showModalviewEdit[item.id] = false;
                                    }
                                        ">
                                    <div class="tw-flex tw-items-center tw-w-full tw-flex-col">
                                        <div class="tw-w-full">
                                            <h6 style="margin-bottom: 0"
                                                class="tw-font-medium tw-text-sm tw-whitespace-normal tw-text-secondary-700 dark:text-secondary-400">
                                                Nome
                                            </h6>
                                            <input rows="1" v-model="selectedClient.name"
                                                placeholder="Digite o nome do cliente"
                                                class="tw-border tw-border-gray-400 tw-w-full tw-p-2 tw-mt-2 tw-outline-none" />
                                            <h6 style="margin-bottom: 0"
                                                class="tw-font-medium tw-text-sm tw-whitespace-normal tw-text-secondary-700 dark:text-secondary-400">
                                                CPF
                                            </h6>
                                            <input rows="1" v-model="selectedClient.cpf"
                                                placeholder="Digite o cpf do cliente"
                                                class="tw-border tw-border-gray-400 tw-w-full tw-p-2 tw-mt-2 tw-outline-none" />
                                            <h6 style="margin-bottom: 0"
                                                class="tw-font-medium tw-text-sm tw-whitespace-normal tw-text-secondary-700 dark:text-secondary-400 tw-mt-3">
                                                Contato
                                            </h6>
                                            <input @input="formatPhoneNumberEdit" rows="1" v-model="selectedClient.contato"
                                                placeholder="Digite o contato do cliente"
                                                class="tw-border tw-border-gray-400 tw-w-full tw-p-2 tw-mt-2 tw-outline-none" />
                                            <h6 style="margin-bottom: 0"
                                                class="tw-font-medium tw-text-sm tw-whitespace-normal tw-text-secondary-700 dark:text-secondary-400 tw-mt-3">
                                                Numero de pessoas na casa
                                            </h6>
                                            <input @input="formatPhoneNumberEdit" rows="1"
                                                v-model="selectedClient.numeropessoas"
                                                placeholder="Digite o contato do cliente"
                                                class="tw-border tw-border-gray-400 tw-w-full tw-p-2 tw-mt-2 tw-outline-none" />
                                            <h6 style="margin-bottom: 0"
                                                class="tw-font-medium tw-text-sm tw-whitespace-normal tw-text-secondary-700 dark:text-secondary-400 tw-mt-3">
                                                Endereço
                                            </h6>
                                            <input rows="1" v-model="selectedClient.endereco"
                                                placeholder="Digite o contato do cliente"
                                                class="tw-border tw-border-gray-400 tw-w-full tw-p-2 tw-mt-2 tw-outline-none" />
                                            <div class="tw-grid tw-grid-cols-3 tw-gap-2 tw-items-center">
                                                <div class="tw-col-span-2">
                                                    <h6 style="margin-bottom: 0"
                                                        class="tw-font-medium tw-text-sm tw-whitespace-normal tw-text-secondary-700 dark:text-secondary-400 tw-mt-3">
                                                        Serviço
                                                    </h6>
                                                    <input v-model="selectedClient.servico" rows="1" type="text"
                                                        placeholder="Vinheta"
                                                        class="tw-border tw-border-gray-400 tw-w-full tw-p-2 tw-mt-2 tw-outline-none" />
                                                </div>
                                                <div>
                                                    <h6 style="margin-bottom: 0"
                                                        class="tw-font-medium tw-text-sm tw-whitespace-normal tw-text-secondary-700 dark:text-secondary-400 tw-mt-3">
                                                        Valor
                                                    </h6>
                                                    <input v-model="selectedClient.valor" rows="1" type="text"
                                                        placeholder="R$ 5,00"
                                                        class="tw-border tw-border-gray-400 tw-w-full tw-p-2 tw-mt-2 tw-outline-none" />
                                                </div>
                                            </div>
                                            <div class="tw-grid tw-grid-cols-3 tw-gap-2 tw-items-center">
                                                <div class="tw-col-span-2">
                                                    <h6 style="margin-bottom: 0"
                                                        class="tw-font-medium tw-text-sm tw-whitespace-normal tw-text-secondary-700 dark:text-secondary-400 tw-mt-3">
                                                        Vencimento
                                                    </h6>
                                                    <input v-model="selectedClient.vencimento" rows="1" type="date"
                                                        placeholder="Adicionar recado"
                                                        class="tw-border tw-border-gray-400 tw-w-full tw-p-2 tw-mt-2 tw-outline-none" />
                                                </div>
                                                <div>
                                                    <h6 style="margin-bottom: 0"
                                                        class="tw-font-medium tw-text-sm tw-whitespace-normal tw-text-secondary-700 dark:text-secondary-400 tw-mt-3">
                                                        Status
                                                    </h6>
                                                    <select v-model="selectedClient.status"
                                                        class="tw-border tw-border-gray-400 tw-w-full tw-p-3 tw-rounded-sm tw-bg-transparent tw-mt-2 tw-outline-none">
                                                        <option v-for="option in options" :key="option" :value="option">
                                                            {{ option }}
                                                        </option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <h6 style="margin-bottom: 0"
                                            class="tw-font-medium tw-text-sm tw-whitespace-normal tw-text-secondary-700 dark:text-secondary-400">
                                            Observação
                                        </h6>
                                        <input rows="1" v-model="selectedClient.observacao"
                                            placeholder="Digite o cpf do cliente"
                                            class="tw-border tw-border-gray-400 tw-w-full tw-p-2 tw-mt-2 tw-outline-none" />
                                        <button @click="updateCliente(item.id)"
                                            class="tw-mt-3 tw-bg-gym-blue100 tw-text-white tw-py-2 tw-px-4 tw-rounded tw-font-medium tw-transition tw-duration-300 tw-ease-in-out hover:tw-bg-gym-blue200">
                                            Editar
                                        </button>
                                    </div>
                                </Modal>
                            </td>

                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="tw-w-3/4 tw-p-1 tw-rounded-lg tw-flex tw-justify-end tw-bg-white tw-shadow-md tw-mt-1">
                <div class="tw-w-full lg:tw-w-1/4 xl:tw-w-1/4 tw-grid tw-grid-cols-3 tw-gap-1 tw-p-1">
                    <div class="tw-flex">
                        <span>Pago</span>
                        <div class="tw-ml-2 tw-h-full tw-w-2 tw-rounded-full tw-bg-green-500"></div>
                    </div>
                    <div class="tw-flex">
                        <span>Vencido</span>
                        <div class="tw-ml-2 tw-h-full tw-w-2 tw-rounded-full tw-bg-red-500"></div>
                    </div>
                    <div class="tw-flex">
                        <span>A vencer</span>
                        <div class="tw-ml-2 tw-h-full tw-w-2 tw-rounded-full tw-bg-yellow-500"></div>
                    </div>
                </div>
            </div>
            <div class="tw-mt-1 tw-w-3/4">
                <Pagination @changePage="handleChangePage" :pagination="dataAnalyticsTableType" />
            </div>
        </div>
    </div>
</template>
<script>
import Header from "../HeaderComponent/Header.vue";
import Modal from "../ModalComponent/Modal.vue";
import Pagination from "./Pagination.vue";
import Swal from 'sweetalert2'

import axios from "axios";
export default {
    components: {
        Header,
        Modal,
        Pagination,
    },


    data() {
        return {
            showModalview: false,
            showModalviewEdit: {},
            options: ["pago", "pendente", "vencido"],
            cliente: {
                name: "",
                cpf: "",
                contato: "",
                endereco: "",
                servico: "",
                valor: "",
                vencimento: "",
                datadenascimento: "",
                numeropessoas: "",
                observacao: "",
            },
            filters: {
                search: '',
                searchType: 'autor',
                status: '',
            },
            dataResults: [],
            selectedClient: {},
            isValidPhoneNumber: true,
            currentPage: 1,
            dataAnalyticsTableType: {},
        };
    },

    watch: {
        filters: {
            deep: true,
            handler(newValue) {
                this.currentPage = 1;
                this.listClientes(newValue);
            }
        },
    },

    mounted() {
        this.listClientes();
    },




    methods: {
        formatPhoneNumber() {
            let phoneNumber = this.cliente.contato.replace(/\D/g, ''); // Remove todos os caracteres não numéricos
            let formattedNumber = '';

            if (phoneNumber.length > 2) {
                formattedNumber = `(${phoneNumber.substring(0, 2)}) `;
            }

            if (phoneNumber.length > 2) {
                formattedNumber += `${phoneNumber.substring(2, 7)}-${phoneNumber.substring(7, 11)}`;
            } else {
                formattedNumber = phoneNumber;
            }

            this.cliente.contato = formattedNumber;
        },
        observacaoModal(obs) {
            if (obs != null) {
                Swal.fire({
                    title: "Essa observação foi salva",
                    text: `- ${obs}`,
                    icon: "info"
                });
            } else {
                Swal.fire({
                    title: "Sem Observações",
                    icon: "info"
                });
            }
        },
        formatPhoneNumberEdit() {
            let phoneNumber = this.selectedClient.contato.replace(/\D/g, ''); // Remove todos os caracteres não numéricos
            let formattedNumber = '';

            if (phoneNumber.length > 2) {
                formattedNumber = `(${phoneNumber.substring(0, 2)}) `;
            }

            if (phoneNumber.length > 2) {
                formattedNumber += `${phoneNumber.substring(2, 7)}-${phoneNumber.substring(7, 11)}`;
            } else {
                formattedNumber = phoneNumber;
            }

            this.selectedClient.contato = formattedNumber;
        },
        formatCurrency() {
            // Salvar a posição do cursor
            let cursorPosition = this.$refs.currencyInput.selectionStart;

            // Remove todos os caracteres não numéricos, exceto o ponto e a vírgula
            let currencyValue = this.cliente.valor.replace(/[^\d.,]/g, '');

            // Separar a parte inteira da parte decimal
            let parts = currencyValue.split(/[.,]/);
            let integerPart = parts[0];
            let decimalPart = parts.length > 1 ? parts[1] : '';

            // Formatar a parte inteira
            let formattedIntegerPart = integerPart.replace(/\B(?=(\d{3})+(?!\d))/g, '.');

            // Formatar a parte decimal
            let formattedDecimalPart = decimalPart.padEnd(2, '0').substring(0, 2);

            // Atualizar o valor com a formatação, mantendo o cursor na posição correta
            this.$nextTick(() => {
                this.cliente.valor = 'R$ ' + formattedIntegerPart + (decimalPart ? ',' + formattedDecimalPart : '');

                // Restaurar a posição do cursor
                this.$refs.currencyInput.setSelectionRange(cursorPosition + 3, cursorPosition + 3);
            });
        },
        handleChangePage(page) {
            this.currentPage = page;
            this.listClientes();
        },
        async submitForm() {
            try {
                const response = await axios.post("/clientes", this.cliente);
                console.log("Cliente criado com sucesso!");
                this.listClientes();
                this.$emit("close");

                console.log(response);

                if (response.data.status == 'pago') {
                    this.downloadUserData(response.data.id);
                }
                Swal.fire({
                    position: "top-end",
                    icon: "success",
                    title: "Cliente cadastrado",
                    showConfirmButton: false,
                    timer: 1500
                });
            } catch (error) {
                Swal.fire({
                    position: "top-end",
                    icon: "error",
                    title: "Erro ao criar cliente",
                    showConfirmButton: false,
                    timer: 1500
                });
                console.error("Erro ao criar cliente:", error);
            }
        },

        downloadUserData(userId) {
            // Enviar uma solicitação GET para baixar o arquivo com os dados do usuário
            window.location.href = `/clientes/${userId}/download`;
        },
        listClientes(newValue) {
            axios
                .get(`/clientes?page=${this.currentPage}`, {
                    params: newValue,
                })
                .then((response) => {
                    // Dados dos clientes estão em response.data
                    this.dataResults = response.data.data;
                    delete response.data.data;
                    this.dataAnalyticsTableType = response.data;
                })
                .catch((error) => {
                    console.error(error);
                });
        },

        updateCliente(clientId) {
            axios
                .put(`/clientes/${clientId}`, this.selectedClient)
                .then((response) => {
                    this.listClientes();
                    Swal.fire({
                        position: "top-end",
                        icon: "success",
                        title: "Cliente editado",
                        showConfirmButton: false,
                        timer: 1500
                    });
                    this.toggleViewEdit(clientId);

                    console.log(response);

                    if (response.data.status == 'pago') {
                        this.downloadUserData(clientId);
                    }
                })
                .catch((error) => {
                    Swal.fire({
                        position: "top-end",
                        icon: "error",
                        title: "Erro ao atualizar o cliente",
                        showConfirmButton: false,
                        timer: 1500
                    });
                    console.error("Erro ao atualizar o cliente:", error);
                });
        },

        async deleteCliente(id) {
            try {
                Swal.fire({
                    title: "Deseja mesmo apagar esse usuário?",
                    showCancelButton: true,
                    confirmButtonText: "Sim",
                    cancelButtonText: "Não",
                    icon: 'warning',
                }).then(async (result) => {
                    if (result.isConfirmed) {
                        const response = await axios.delete(`/clientes/${id}/delete`);
                        Swal.fire("Deletado", response.data.message, "success");
                        this.listClientes();
                    } else {
                        Swal.fire("Cancelado", "", "info");
                    }
                });
            } catch (error) {
                Swal.fire({
                    title: "Error!",
                    text: error.response.data.message ?? "An error occurred",
                    icon: 'error',
                    position: 'center',
                    showConfirmButton: false,
                    timer: 2000,
                });
            }
        },

        toggleViewEdit(camp) {
            if (this.showModalviewEdit[camp] === undefined) {
                const clientId = camp;
                axios
                    .get(`/clientes/${clientId}/edit`)
                    .then((response) => {
                        this.selectedClient = response.data;
                        this.showModalviewEdit[camp] = true;
                    })
                    .catch((error) => {
                        console.error("Erro ao carregar os detalhes do cliente:", error);
                    });
            } else {
                this.showModalviewEdit[camp] = !this.showModalviewEdit[camp];
            }
        },
    },
    computed: {
        shouldShowEditModal() {
            return (camp) => this.showModalviewEdit[camp] || false;
        },
    },
};
</script>
