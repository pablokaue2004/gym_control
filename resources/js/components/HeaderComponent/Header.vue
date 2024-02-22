<template>
    <div class="tw-w-full tw-px-8 tw-py-2 tw-bg-white tw-shadow-lg tw-flex tw-items-center tw-justify-between">
        <img class="tw-w-20" :src="require('@/storage/static/images/logo.png')" alt="" />
        <div class="tw-grid tw-grid-cols-2 tw-gap-5">
            <a href="">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                    class="tw-w-6 tw-h-6 tw-text-gym-blue200">
                    <path
                        d="M11.47 3.84a.75.75 0 011.06 0l8.69 8.69a.75.75 0 101.06-1.06l-8.689-8.69a2.25 2.25 0 00-3.182 0l-8.69 8.69a.75.75 0 001.061 1.06l8.69-8.69z" />
                    <path
                        d="M12 5.432l8.159 8.159c.03.03.06.058.091.086v6.198c0 1.035-.84 1.875-1.875 1.875H15a.75.75 0 01-.75-.75v-4.5a.75.75 0 00-.75-.75h-3a.75.75 0 00-.75.75V21a.75.75 0 01-.75.75H5.625a1.875 1.875 0 01-1.875-1.875v-6.198a2.29 2.29 0 00.091-.086L12 5.43z" />
                </svg>
            </a>

            <button @click="logout">
                <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="tw-w-6 tw-h-6 tw-text-gym-blue200"
                    viewBox="0 0 256 256">
                    <path
                        d="M112,216a8,8,0,0,1-8,8H48a16,16,0,0,1-16-16V48A16,16,0,0,1,48,32h56a8,8,0,0,1,0,16H48V208h56A8,8,0,0,1,112,216Zm109.66-93.66-40-40a8,8,0,0,0-11.32,11.32L196.69,120H104a8,8,0,0,0,0,16h92.69l-26.35,26.34a8,8,0,0,0,11.32,11.32l40-40A8,8,0,0,0,221.66,122.34Z">
                    </path>
                </svg>
            </button>
        </div>
        <div class="tw-flex tw-items-center">
            <div
                class="tw-flex tw-text-white tw-items-center tw-text-xl tw-justify-center tw-w-14 tw-h-14 tw-rounded-full tw-bg-gym-blue200">
                K
            </div>
            <div class="tw-flex tw-flex-col tw-ml-3">
                <span class="tw-font-bold">Kauê</span>
                <span class="tw-text-sm">Admin</span>
            </div>
        </div>
    </div>
</template>
<script>
import axios from 'axios';
export default {
    methods: {
        logout() {
            axios.post('/api/logout').then(() => {
                // Limpe o token do localStorage
                localStorage.removeItem('token');

                // Redirecione o usuário para a página de login
                this.$router.push('/');
            }).catch(error => {
                console.error('Erro ao fazer logout:', error);
            });
        }
    }
}
</script>
