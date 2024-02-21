<template>
    <div className="tw-h-screen tw-w-full tw-flex tw-items-center tw-justify-center">
        <div className="tw-fixed tw-inset-0">
            <img src="/storage/static/images/logo.png" className="tw-w-full tw-h-full tw-object-cover" alt="" />
        </div>
        <div
            className="tw-fixed tw-inset-0 tw-flex tw-items-center tw-justify-center tw-backdrop-blur-md tw-bg-blue-700/30">
            <div className="tw-z-10 tw-bg-white tw-border tw-shadow-lg tw-rounded-lg tw-p-6 tw-max-w-md">
                <h2 className="tw-text-2xl tw-font-bold tw-mb-4">Login</h2>
                <div className="tw-mb-4">
                    <label htmlFor="email" className="tw-block tw-font-medium"> E-mail </label>
                    <input type="email" id="email" v-model="email"
                        className="tw-mt-1 tw-py-1 tw-px-2 tw-border tw-rounded tw-w-full" />
                </div>
                <div className="tw-mb-4">
                    <label htmlFor="password" className="tw-block tw-font-medium"> Senha </label>
                    <input type="password" id="password" v-model="password"
                        className="tw-mt-1 tw-py-1 tw-px-2 tw-border tw-rounded tw-w-full" />
                </div>

                <button @click="login"
                    class="tw-bg-blue-500 tw-w-full tw-text-white tw-py-2 tw-px-4 tw-rounded tw-font-medium tw-transition tw-duration-300 tw-ease-in-out hover:tw-bg-blue-600">
                    Entrar
                </button>
            </div>
        </div>
    </div>
</template>
<script>
import axios from "axios";

export default {
    data() {
        return {
            email: "",
            password: "",
        };
    },
    methods: {
        async login() {
            try {
                const response = await axios.post("/api/login", {
                    email: this.email,
                    password: this.password,
                });

                if (response.data.token) {
                    localStorage.setItem("token", response.data.token);

                    this.$router.push("/main");
                } else {
                    console.log("Token de autenticação não encontrado na resposta");
                }
            } catch (error) {
                console.error("Erro ao fazer login:", error);
            }
        },
    },
};
</script>
