<template>
  <div class="tw-w-full tw-h-screen tw-bg-gray-100">
    <Header />
    <div class="tw-w-full tw-py-10 tw-items-center tw-justify-center tw-flex tw-flex-col">
      <div class="tw-w-3/4 tw-flex tw-items-center tw-justify-between">
        <span class="tw-text-gym-red200 tw-font-bold tw-text-4xl">Clientes</span>
        <button
          @click="showModalview = true"
          class="tw-bg-gym-red100 tw-text-white tw-py-2 tw-px-4 tw-rounded tw-font-medium tw-transition tw-duration-300 tw-ease-in-out hover:tw-bg-gym-red200"
        >
          Cadastrar clientes
        </button>
        <Modal
          :showModal="showModalview"
          :titleModal="'Adicionar Clientes'"
          :maxWSize="'tw-max-w-[30%]'"
          @close="
            () => {
              showModalview = false;
            }
          "
        >
          <div class="tw-flex tw-items-center tw-w-full tw-flex-col">
            <div class="tw-w-full">
              <h6
                style="margin-bottom: 0"
                class="tw-font-medium tw-text-sm tw-whitespace-normal tw-text-secondary-700 dark:text-secondary-400"
              >
                Nome
              </h6>
              <input
                rows="1"
                v-model="cliente.name"
                placeholder="Digite o nome do cliente"
                class="tw-border tw-border-gray-400 tw-w-full tw-p-2 tw-mt-2 tw-outline-none"
              />
              <h6
                style="margin-bottom: 0"
                class="tw-font-medium tw-text-sm tw-whitespace-normal tw-text-secondary-700 dark:text-secondary-400 tw-mt-3"
              >
                Contato
              </h6>
              <input
                rows="1"
                v-model="cliente.contato"
                placeholder="Digite o contato do cliente"
                class="tw-border tw-border-gray-400 tw-w-full tw-p-2 tw-mt-2 tw-outline-none"
              />
              <div class="tw-grid tw-grid-cols-3 tw-gap-2 tw-items-center">
                <div class="tw-col-span-2">
                  <h6
                    style="margin-bottom: 0"
                    class="tw-font-medium tw-text-sm tw-whitespace-normal tw-text-secondary-700 dark:text-secondary-400 tw-mt-3"
                  >
                    Vencimento
                  </h6>
                  <input
                    v-model="cliente.vencimento"
                    rows="1"
                    type="date"
                    placeholder="Adicionar recado"
                    class="tw-border tw-border-gray-400 tw-w-full tw-p-2 tw-mt-2 tw-outline-none"
                  />
                </div>
                <div>
                  <h6
                    style="margin-bottom: 0"
                    class="tw-font-medium tw-text-sm tw-whitespace-normal tw-text-secondary-700 dark:text-secondary-400 tw-mt-3"
                  >
                    Status
                  </h6>
                  <select
                    v-model="cliente.status"
                    class="tw-border tw-border-gray-400 tw-w-full tw-p-3 tw-rounded-sm tw-bg-transparent tw-mt-2 tw-outline-none"
                  >
                    <option v-for="option in options" :key="option" :value="option">
                      {{ option }}
                    </option>
                  </select>
                </div>
              </div>
            </div>
            <button
              @click="submitForm()"
              class="tw-mt-3 tw-bg-gym-red100 tw-text-white tw-py-2 tw-px-4 tw-rounded tw-font-medium tw-transition tw-duration-300 tw-ease-in-out hover:tw-bg-gym-red200"
            >
              Adicionar
            </button>
          </div>
        </Modal>
      </div>
      <div class="tw-w-3/4 tw-p-5 tw-rounded-lg tw-bg-white tw-shadow-md tw-mt-5">
        <div class="tw-w-full tw-flex tw-flex-col tw-p-3">
          <div class="tw-grid tw-grid-cols-4 tw-gap-3">
            <span class="tw-font-semibold tw-text-gym-red100 tw-text-base">Nome</span>
            <span class="tw-font-semibold tw-text-gym-red100 tw-text-base">Contato</span>
            <span class="tw-font-semibold tw-text-gym-red100 tw-text-base"
              >Vencimento</span
            >
          </div>
          <div class="tw-full tw-h-[1px] tw-bg-gym-red100/30 tw-my-4"></div>
          <div v-for="item in dataResults">
            <div class="tw-grid tw-grid-cols-4 tw-gap-3">
              <span
                class="tw-font-normal tw-text-gym-red100/80 tw-text-base tw-flex tw-items-center"
              >
                <svg
                  xmlns="http://www.w3.org/2000/svg"
                  viewBox="0 0 24 24"
                  fill="currentColor"
                  class="tw-w-5 tw-h-5 tw-mr-2"
                >
                  <path
                    fill-rule="evenodd"
                    d="M7.5 6a4.5 4.5 0 119 0 4.5 4.5 0 01-9 0zM3.751 20.105a8.25 8.25 0 0116.498 0 .75.75 0 01-.437.695A18.683 18.683 0 0112 22.5c-2.786 0-5.433-.608-7.812-1.7a.75.75 0 01-.437-.695z"
                    clip-rule="evenodd"
                  />
                </svg>
                {{ item.name }}
              </span>
              <span
                class="tw-font-normal tw-text-gym-red100/80 tw-text-base tw-flex tw-items-center"
              >
                <svg
                  xmlns="http://www.w3.org/2000/svg"
                  viewBox="0 0 24 24"
                  fill="currentColor"
                  class="tw-w-5 tw-h-5 tw-mr-2"
                >
                  <path
                    fill-rule="evenodd"
                    d="M1.5 4.5a3 3 0 013-3h1.372c.86 0 1.61.586 1.819 1.42l1.105 4.423a1.875 1.875 0 01-.694 1.955l-1.293.97c-.135.101-.164.249-.126.352a11.285 11.285 0 006.697 6.697c.103.038.25.009.352-.126l.97-1.293a1.875 1.875 0 011.955-.694l4.423 1.105c.834.209 1.42.959 1.42 1.82V19.5a3 3 0 01-3 3h-2.25C8.552 22.5 1.5 15.448 1.5 6.75V4.5z"
                    clip-rule="evenodd"
                  />
                </svg>

                {{ item.contato }}
              </span>
              <span
                class="tw-font-normal tw-text-gym-red100/80 tw-text-base tw-flex tw-items-center"
              >
                <svg
                  xmlns="http://www.w3.org/2000/svg"
                  viewBox="0 0 24 24"
                  fill="currentColor"
                  class="tw-w-5 tw-h-5 tw-mr-2"
                >
                  <path
                    d="M12.75 12.75a.75.75 0 11-1.5 0 .75.75 0 011.5 0zM7.5 15.75a.75.75 0 100-1.5.75.75 0 000 1.5zM8.25 17.25a.75.75 0 11-1.5 0 .75.75 0 011.5 0zM9.75 15.75a.75.75 0 100-1.5.75.75 0 000 1.5zM10.5 17.25a.75.75 0 11-1.5 0 .75.75 0 011.5 0zM12 15.75a.75.75 0 100-1.5.75.75 0 000 1.5zM12.75 17.25a.75.75 0 11-1.5 0 .75.75 0 011.5 0zM14.25 15.75a.75.75 0 100-1.5.75.75 0 000 1.5zM15 17.25a.75.75 0 11-1.5 0 .75.75 0 011.5 0zM16.5 15.75a.75.75 0 100-1.5.75.75 0 000 1.5zM15 12.75a.75.75 0 11-1.5 0 .75.75 0 011.5 0zM16.5 13.5a.75.75 0 100-1.5.75.75 0 000 1.5z"
                  />
                  <path
                    fill-rule="evenodd"
                    d="M6.75 2.25A.75.75 0 017.5 3v1.5h9V3A.75.75 0 0118 3v1.5h.75a3 3 0 013 3v11.25a3 3 0 01-3 3H5.25a3 3 0 01-3-3V7.5a3 3 0 013-3H6V3a.75.75 0 01.75-.75zm13.5 9a1.5 1.5 0 00-1.5-1.5H5.25a1.5 1.5 0 00-1.5 1.5v7.5a1.5 1.5 0 001.5 1.5h13.5a1.5 1.5 0 001.5-1.5v-7.5z"
                    clip-rule="evenodd"
                  />
                </svg>
                {{ item.vencimento }}

                <div
                  :class="item.status == 'pago' ? 'tw-bg-green-500' : 'tw-hidden'"
                  class="tw-ml-2 tw-h-full tw-w-2 tw-rounded-full"
                ></div>
                <div
                  :class="item.status == 'vencido' ? 'tw-bg-red-500' : 'tw-hidden'"
                  class="tw-ml-2 tw-h-full tw-w-2 tw-rounded-full"
                ></div>
                <div
                  :class="item.status == 'pendente' ? 'tw-bg-yellow-500' : 'tw-hidden'"
                  class="tw-ml-2 tw-h-full tw-w-2 tw-rounded-full"
                ></div>
              </span>
              <div class="tw-w-full tw-flex tw-justify-end">
                <button
                  @click="toggleViewEdit(item.id)"
                  class="tw-bg-gym-red100 tw-text-white tw-py-2 tw-px-2 tw-rounded-full tw-font-medium tw-transition tw-duration-300 tw-ease-in-out hover:tw-bg-gym-red200"
                >
                  <svg
                    xmlns="http://www.w3.org/2000/svg"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke-width="1.5"
                    stroke="currentColor"
                    class="tw-w-6 tw-h-6"
                  >
                    <path
                      stroke-linecap="round"
                      stroke-linejoin="round"
                      d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10"
                    />
                  </svg>
                </button>
                <Modal
                  :showModal="shouldShowEditModal(item.id)"
                  :titleModal="'Adicionar Clientes'"
                  :maxWSize="'tw-max-w-[30%]'"
                  @close="
                    () => {
                      showModalviewEdit[item.id] = false;
                    }
                  "
                >
                  <div class="tw-flex tw-items-center tw-w-full tw-flex-col">
                    <div class="tw-w-full">
                      <h6
                        style="margin-bottom: 0"
                        class="tw-font-medium tw-text-sm tw-whitespace-normal tw-text-secondary-700 dark:text-secondary-400"
                      >
                        Nome
                      </h6>
                      <input
                        rows="1"
                        v-model="selectedClient.name"
                        placeholder="Digite o nome do cliente"
                        class="tw-border tw-border-gray-400 tw-w-full tw-p-2 tw-mt-2 tw-outline-none"
                      />
                      <h6
                        style="margin-bottom: 0"
                        class="tw-font-medium tw-text-sm tw-whitespace-normal tw-text-secondary-700 dark:text-secondary-400 tw-mt-3"
                      >
                        Contato
                      </h6>
                      <input
                        rows="1"
                        v-model="selectedClient.contato"
                        placeholder="Digite o contato do cliente"
                        class="tw-border tw-border-gray-400 tw-w-full tw-p-2 tw-mt-2 tw-outline-none"
                      />
                      <div class="tw-grid tw-grid-cols-3 tw-gap-2 tw-items-center">
                        <div class="tw-col-span-2">
                          <h6
                            style="margin-bottom: 0"
                            class="tw-font-medium tw-text-sm tw-whitespace-normal tw-text-secondary-700 dark:text-secondary-400 tw-mt-3"
                          >
                            Vencimento
                          </h6>
                          <input
                            v-model="selectedClient.vencimento"
                            rows="1"
                            type="date"
                            placeholder="Adicionar recado"
                            class="tw-border tw-border-gray-400 tw-w-full tw-p-2 tw-mt-2 tw-outline-none"
                          />
                        </div>
                        <div>
                          <h6
                            style="margin-bottom: 0"
                            class="tw-font-medium tw-text-sm tw-whitespace-normal tw-text-secondary-700 dark:text-secondary-400 tw-mt-3"
                          >
                            Status
                          </h6>
                          <select
                            v-model="selectedClient.status"
                            class="tw-border tw-border-gray-400 tw-w-full tw-p-3 tw-rounded-sm tw-bg-transparent tw-mt-2 tw-outline-none"
                          >
                            <option
                              v-for="option in options"
                              :key="option"
                              :value="option"
                            >
                              {{ option }}
                            </option>
                          </select>
                        </div>
                      </div>
                    </div>
                    <button
                      @click="updateCliente(item.id)"
                      class="tw-mt-3 tw-bg-gym-red100 tw-text-white tw-py-2 tw-px-4 tw-rounded tw-font-medium tw-transition tw-duration-300 tw-ease-in-out hover:tw-bg-gym-red200"
                    >
                      Editar
                    </button>
                  </div>
                </Modal>
              </div>
            </div>
            <div class="tw-full tw-h-[1px] tw-bg-gym-red100/30 tw-my-4"></div>
          </div>
        </div>
        <div
          class="tw-w-full tw-py-1 tw-flex tw-justify-end tw-px-14 tw-font-bold tw-text-gym-red200/80"
        >
          Total: {{ dataResults.length }}
        </div>
      </div>
      <div
        class="tw-w-3/4 tw-p-2 tw-rounded-lg tw-flex tw-justify-end tw-bg-white tw-shadow-md tw-mt-5"
      >
        <div class="tw-w-1/4 tw-grid tw-grid-cols-3 tw-gap-1 tw-p-3">
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
    </div>
  </div>
</template>
<script>
import Header from "../HeaderComponent/Header.vue";
import Modal from "../ModalComponent/Modal.vue";
import axios from "axios";
export default {
  components: {
    Header,
    Modal,
  },
  data() {
    return {
      showModalview: false,
      showModalviewEdit: {},
      options: ["pago", "pendente", "vencido"],
      cliente: {
        name: "",
        contato: "",
        vencimento: "",
      },
      dataResults: [],
      selectedClient: [],
    };
  },

  mounted() {
    this.listClientes();
  },

  methods: {
    submitForm() {
      axios
        .post("/api/clientes", this.cliente)
        .then((response) => {
          console.log("criou");
          this.listClientes();
          this.$emit("close");
        })
        .catch((error) => {
          console.log("criou não");
        });
    },

    listClientes() {
      axios
        .get("/api/clientes")
        .then((response) => {
          // Dados dos clientes estão em response.data
          this.dataResults = response.data;
        })
        .catch((error) => {
          console.error(error);
        });
    },

    updateCliente(clientId) {
      axios
        .put(`/api/clientes/${clientId}`, this.selectedClient)
        .then((response) => {
          this.listClientes(); // Atualiza a lista de clientes após a atualização
          this.toggleViewEdit(clientId); // Fecha o modal de edição
        })
        .catch((error) => {
          console.error("Erro ao atualizar o cliente:", error);
        });
    },

    toggleViewEdit(camp) {
      if (this.showModalviewEdit[camp] === undefined) {
        const clientId = camp;
        axios
          .get(`/api/clientes/${clientId}/edit`)
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
