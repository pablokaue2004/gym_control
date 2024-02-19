<template>
    <div class="mt-4">
        <nav class="tw-flex tw-items-center tw-justify-between">
            <div class="tw--mt-px tw-flex tw-w-0 tw-flex-1">
                <div v-if="pagination.current_page === getPage(pagination.first_page_url)">
                    <span
                        class="tw-cursor-not-allowed tw-inline-flex tw-items-center tw-border-t-2 tw-border-transparent tw-pt-4 tw-pr-1 tw-text-sm tw-font-medium tw-text-blue-100/80">
                        <svg class="tw-mr-3 tw-h-5 tw-w-5 tw-text-blue-100/80" fill="currentColor" aria-hidden="true">
                            <path fill-rule="evenodd"
                                d="M18 10a.75.75 0 01-.75.75H4.66l2.1 1.95a.75.75 0 11-1.02 1.1l-3.5-3.25a.75.75 0 010-1.1l3.5-3.25a.75.75 0 111.02 1.1l-2.1 1.95h12.59A.75.75 0 0118 10z"
                                clip-rule="evenodd" />
                        </svg>
                        Anterior
                    </span>
                </div>
                <div v-else>
                    <span @click="changePage(pagination.prev_page_url)"
                        class="tw-cursor-pointer tw-inline-flex tw-items-center tw-border-t-2 tw-border-transparent tw-pt-4 tw-pr-1 tw-text-sm tw-font-medium tw-text-blue-700 hover:tw-border-blue-300 tw-transition-all tw-duration-200">
                        <svg class="tw-mr-3 tw-h-5 tw-w-5 tw-text-blue-700" xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                            <path fill-rule="evenodd"
                                d="M18 10a.75.75 0 01-.75.75H4.66l2.1 1.95a.75.75 0 11-1.02 1.1l-3.5-3.25a.75.75 0 010-1.1l3.5-3.25a.75.75 0 111.02 1.1l-2.1 1.95h12.59A.75.75 0 0118 10z"
                                clip-rule="evenodd" />
                        </svg>
                        Anterior
                    </span>
                </div>
            </div>
            <div class="tw-hidden md:tw--mt-px md:tw-flex">
                <div v-for="(item, index) in this.getPagination()" :key="index">
                    <span v-if="item.url == null"
                        class="tw-cursor-pointer tw-inline-flex tw-items-center tw-border-t-2 tw-border-transparent tw-px-4 tw-pt-4 tw-text-sm tw-font-medium tw-text-blue-500 ">
                        {{ item.label }}</span>

                    <span v-else-if="item.label == pagination.current_page"
                        class="tw-cursor-pointer tw-inline-flex tw-items-center tw-border-t-2 tw-border-primary-500 tw-px-4 tw-pt-4 tw-text-sm tw-font-medium tw-text-primary-600 dark:tw-text-primary-400">
                        {{ item.label }}</span>

                    <span v-else @click="changePage(item.url)"
                        class="tw-cursor-pointer tw-inline-flex tw-items-center tw-border-t-2 tw-border-transparent tw-px-4 tw-pt-4 tw-text-sm tw-font-medium tw-text-blue-500 hover:tw-border-blue-300 hover:tw-text-blue-700 dark:hover:tw-text-blue-400 tw-transition-all tw-duration-200">
                        {{ item.label }}</span>
                </div>

            </div>
            <div class="tw--mt-px tw-flex tw-w-0 tw-flex-1 tw-justify-end">
                <div v-if="pagination.current_page === getPage(pagination.last_page_url)">
                    <span
                        class="tw-cursor-not-allowed tw-inline-flex tw-items-center tw-border-t-2 tw-border-transparent tw-pt-4 tw-pl-1 tw-text-sm tw-font-medium tw-text-blue-100/80 ">
                        Próxima
                        <svg class="tw-ml-3 tw-h-5 tw-w-5 tw-text-blue-100/80 " xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                            <path fill-rule="evenodd"
                                d="M2 10a.75.75 0 01.75-.75h12.59l-2.1-1.95a.75.75 0 111.02-1.1l3.5 3.25a.75.75 0 010 1.1l-3.5 3.25a.75.75 0 11-1.02-1.1l2.1-1.95H2.75A.75.75 0 012 10z"
                                clip-rule="evenodd" />
                        </svg>
                    </span>
                </div>
                <div v-else>
                    <span @click="changePage(pagination.next_page_url)"
                        class="tw-cursor-pointer tw-inline-flex tw-items-center tw-border-t-2 tw-border-transparent tw-pt-4 tw-pl-1 tw-text-sm tw-font-medium tw-text-blue-700 hover:tw-border-blue-300 tw-transition-all tw-duration-200">
                        Próxima
                        <svg class="tw-text-blue-700 tw-ml-3 tw-h-5 tw-w-5" xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                            <path fill-rule="evenodd"
                                d="M2 10a.75.75 0 01.75-.75h12.59l-2.1-1.95a.75.75 0 111.02-1.1l3.5 3.25a.75.75 0 010 1.1l-3.5 3.25a.75.75 0 11-1.02-1.1l2.1-1.95H2.75A.75.75 0 012 10z"
                                clip-rule="evenodd" />
                        </svg>
                    </span>
                </div>
            </div>
        </nav>

        <div class="tw-flex tw-justify-center tw-items-center tw-mt-2">
            <div class="sm:tw-block">
                <p class="tw-text-sm tw-text-blue-700 ">
                    Mostrando de
                    <b>{{ pagination.from }}</b>
                    a
                    <b>{{ pagination.to }}</b>
                    de
                    <b>{{ pagination.total }}</b>
                    clientes
                </p>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: 'pagination',
    props: {
        pagination: {
            type: Object,
            required: true
        },
    },
    methods: {
        getPagination() {
            return this.pagination?.links?.filter(link => link.url !== null && !link.label.includes("Previous") && !link.label.includes("Next")) || [];
        },
        changePage(url) {
            const page = this.getPage(url);
            this.$emit('changePage', page);
        },

        getPage(url) {
            return (url) ? parseInt(url.split('page=')[1]) : null;
        }
    }
};
</script>
