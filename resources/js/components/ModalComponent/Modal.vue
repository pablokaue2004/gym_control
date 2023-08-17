<template>
    <transition name="modal-fade">
      <div
        class="tw-fixed tw-inset-0 tw-z-50 tw-overflow-y-auto tw-backdrop-blur-sm tw-bg-black/30"
        v-show="showModal"
      >
        <div
          class="tw-relative tw-flex tw-items-center tw-justify-center tw-w-full tw-h-full"
        >
          <transition name="ease-out-overlay">
            <div
              v-show="showModal"
              class="tw-fixed tw-inset-0 tw-transition-opacity tw-transform bg-secondary-400 dark:bg-secondary-700 tw-bg-opacity-60 dark:tw-bg-opacity-60 backdrop-blur"
            ></div>
          </transition>

          <transition name="ease-out-modal">
            <div
              :class="[
                maxWSize,
                'tw-z-10 tw-w-full tw-h-auto tw-mx-4 tw-bg-white tw-border tw-shadow-lg tw-overflow-hidden tw-rounded-md',
              ]"
              v-show="showModal"
            >
              <div
                class="tw-px-4 tw-py-2.5 tw-flex tw-justify-between tw-items-center tw-border-b dark:tw-border-0"
              >
                <h3
                  style="margin-bottom: 0"
                  class="tw-font-medium tw-whitespace-normal text-md text-secondary-700 dark:text-secondary-400"
                >
                  {{ titleModal || "Modal" }}
                </h3>
                <button
                  class="tw-p-1 tw-rounded-full focus:tw-outline-none focus:tw-ring-2 text-secondary-300"
                  @click="close"
                >
                  <svg
                    class="tw-w-5 tw-h-5"
                    xmlns="http://www.w3.org/2000/svg"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                  >
                    <path
                      stroke-linecap="round"
                      stroke-linejoin="round"
                      stroke-width="2"
                      d="M6 18L18 6M6 6l12 12"
                    ></path>
                  </svg>
                </button>
              </div>

              <div
                class="tw-px-2 tw-py-5 md:tw-px-4 text-secondary-700 dark:text-secondary-400 tw-grow"
                divider="tw-divide-y divide-secondary-200"
              >
                <div class="tw-min-w-full tw-overflow-x-auto tw-bg-white tw-rounded">
                  <slot></slot>
                </div>
              </div>
            </div>
          </transition>
        </div>
      </div>
    </transition>
  </template>

  <script>
  export default {
    props: {
      showModal: {
        type: Boolean,
        default: false,
      },
      titleModal: {
        type: String,
        default: null,
      },
      maxWSize: {
        type: String,
        required: true,
      },
    },

    methods: {
      close() {
        this.$emit("close");
        document.removeEventListener("keydown", this.closeOnEscape);
      },
      closeOnEscape(e) {
        if (e.key === "Escape") {
          this.close();
        }
      },
    },

    watch: {
      showModal(show) {
        if (show) {
          document.addEventListener("keydown", this.closeOnEscape);
        }
      },
    },
  };
  </script>

  <style scoped>
  .modal-fade-enter,
  .modal-fade-leave-to {
    opacity: 0;
  }

  .modal-fade-enter-active,
  .modal-fade-leave-active {
    transition: opacity 0.5s ease;
  }
  </style>
