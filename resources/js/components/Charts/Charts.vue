<template>
    <div class="tw-w-full tw-h-screen tw-bg-gray-100 ">
        <Header />
        <div class="tw-w-full tw-bg-gray-100 tw-py-10 tw-items-center tw-justify-center tw-flex tw-flex-col">
            <h1 class="tw-font-bold tw-mb-9 tw-text-3xl">Gráficos Explicativos</h1>
            <div class="tw-grid tw-grid-cols-1 lg:tw-grid-cols-2 tw-gap-8 tw-w-2/4"
                v-if="seriesEnderecos.length && seriesStatus.length && seriesNumerosPessoas.length">
                <div>
                    <span class="tw-font-bold">Clientes por endereço</span>
                    <apexchart id="graficoEnderecos" type="bar" :options="chartOptionsEnderecos" :series="seriesEnderecos">
                    </apexchart>
                </div>
                <div>
                    <span class="tw-font-bold">Clientes por Status</span>
                    <apexchart id="graficoStatus" type="bar" :options="chartOptionsStatus" :series="seriesStatus">
                    </apexchart>
                </div>
                <div>
                    <span class="tw-font-bold">Clientes por Nº na casa</span>
                    <apexchart id="graficoNumerosPessoas" type="bar" :options="chartOptionsNumerosPessoas"
                        :series="seriesNumerosPessoas"></apexchart>
                </div>
            </div>
            <div v-else>
                Carregando dados...
            </div>
        </div>
    </div>
</template>

<script>
import { ref, onMounted } from 'vue';
import axios from 'axios';
import Header from '../HeaderComponent/Header.vue';

export default {
    components: {
        Header
    },
    setup() {
        const chartOptionsEnderecos = ref({});
        const chartOptionsStatus = ref({});
        const chartOptionsNumerosPessoas = ref({});
        const seriesEnderecos = ref([]);
        const seriesStatus = ref([]);
        const seriesNumerosPessoas = ref([]);

        const fetchData = () => {
            axios.get('/clientes/graphs')
                .then(response => {
                    const { clientesPorEndereco, clientesPorStatus, clientesNumerosPessoas } = response.data;
                    chartOptionsEnderecos.value = {
                        chart: {
                            type: 'bar',
                            height: 350,
                        },
                        series: [{
                            name: 'Total de Usuários',
                            data: Object.values(clientesPorEndereco)
                        }],
                        xaxis: {
                            categories: Object.keys(clientesPorEndereco)
                        }
                    };

                    chartOptionsStatus.value = {
                        chart: {
                            type: 'bar',
                            height: 350,
                        },
                        series: [{
                            name: 'Total de Usuários',
                            data: Object.values(clientesPorStatus)
                        }],
                        xaxis: {
                            categories: Object.keys(clientesPorStatus)
                        }

                    };

                    chartOptionsNumerosPessoas.value = {
                        chart: {
                            type: 'bar',
                            height: 350,
                        },
                        series: [{
                            name: 'Número de Pessoas',
                            data: Object.entries(clientesNumerosPessoas || {}).map(([key, value]) => ({ x: key, y: value }))
                        }],
                        xaxis: {
                            categories: Object.keys(clientesNumerosPessoas)
                        }
                    };

                    seriesEnderecos.value = chartOptionsEnderecos.value.series;
                    seriesStatus.value = chartOptionsStatus.value.series;
                    seriesNumerosPessoas.value = chartOptionsNumerosPessoas.value.series;
                })
                .catch(error => {
                    console.error('Erro ao buscar dados dos gráficos:', error);
                });
        };

        onMounted(() => {
            fetchData();
        });

        return {
            chartOptionsEnderecos,
            chartOptionsStatus,
            chartOptionsNumerosPessoas,
            seriesEnderecos,
            seriesStatus,
            seriesNumerosPessoas
        };
    }
};
</script>
