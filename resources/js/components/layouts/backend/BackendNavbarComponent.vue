<template>
    <div class="backdrop"></div>
    <header class="db-header">
        <router-link class="w-32 flex-shrink-0" :to="{ name: 'frontend.home' }">
            <img class="w-full" :src="setting.theme_logo" alt="logo">
        </router-link>
        <div class="flex items-center justify-end w-full gap-4">
            <div
                class="sub-header flex items-center gap-4 transition xh:justify-between xh:fixed xh:left-0 xh:w-full xh:p-4 xh:border-y xh:border-[#EFF0F6] xh:bg-white">
                <div class="flex items-center justify-between md:justify-center gap-4">
                    <div v-if="setting.site_language_switch === enums.activityEnum.ENABLE"
                        class="dropdown-group relative">
                        <button class="dropdown-btn dropdown-custom-btn flex items-center gap-2 h-9 px-3 rounded-lg bg-[#FFEDF4]">
                            <img :src="language.image" alt="flag" class="w-4 h-4 rounded-full">
                            <span class="hidden md:block whitespace-nowrap text-xs font-medium capitalize text-heading">
                                {{ language.name }}
                            </span>
                        </button>
                        <ul v-if="languages.length > 0"
                            class="p-2 min-w-[180px] rounded-lg shadow-xl absolute top-14 z-10 border border-gray-200 bg-white transition-all duration-300 dropdown-list dropdown-custom-list">
                            <li v-for="(language, index) in languages" :key="index"
                                @click.prevent="changeLanguage(language.id, language.code, language.display_mode)"
                                class="flex items-center gap-2 py-1.5 px-2.5 rounded-md cursor-pointer hover:bg-gray-100">
                                <img :src="language.image" alt="flag" class="w-4 h-4 rounded-full">
                                <span class="text-heading capitalize text-sm">{{ language.name }}</span>
                            </li>
                        </ul>
                    </div>

                    <router-link v-if="pos.permission"
                        class="w-9 h-9 rounded-lg flex items-center justify-center text-primary bg-[#FFEBD8]"
                        :to="{ path: '/admin/' + pos.url }">
                        <i class="lab lab-fill-pos lab-font-size-16 font-fill-pos"></i>
                    </router-link>
                </div>
            </div>
            <button @click="toggleSidebar" class="fa-solid fa-align-left db-header-nav w-9 h-9 rounded-lg text-primary bg-primary/5"></button>

            <div class="dropdown-group">
                <button class="dropdown-btn dropdown-custom-btn flex items-center gap-2">
                    <img class="flex-shrink-0 w-9 h-9 object-cover rounded-lg" :src="authInfo.image" alt="avatar">
                    <h3 class="whitespace-nowrap text-sm capitalize text-left leading-[17px]">{{ $t('label.hello') }} <b
                            class="block font-semibold">{{ textShortener(authInfo.name, 15) }}</b></h3>
                    <i class="lab lab-arrow-down text-xs ml-1.5 lab-font-size-14"></i>
                </button>
                <div class="dropdown-list dropdown-custom-list fixed sm:absolute top-[75px] sm:top-12 ltr:right-0 rtl:left-0 z-[60] rounded-xl w-full h-[calc(100vh_-_75px)]
                    overflow-y-auto sm:h-auto sm:w-[360px] p-4 shadow-paper bg-white">
                    <div class="w-fit mx-auto text-center mb-5">
                        <figure
                            class="relative z-10 w-[98px] h-[98px] border-2 border-dashed rounded-full inline-flex items-center justify-center border-white bg-gradient-to-t from-[#FF7A00] to-[#FF016C] before:absolute before:top-1/2 before:left-1/2 before:-translate-x-1/2 before:-translate-y-1/2 before:w-24 before:h-24 before:rounded-full before:-z-10 before:bg-white">
                            <img class="w-[90px] h-[90px] rounded-full shadow-avatar" :src="authInfo.image"
                                alt="avatar">
                        </figure>

                        <label for="imageProperty"
                            class="block w-11 h-11 mx-auto -mt-7 mb-3 relative z-10 rounded-full border-2 cursor-pointer bg-heading border-white">
                            <input @change="saveImage" accept="image/png, image/jpeg, image/jpg" ref="imageProperty"
                                type="file" id="imageProperty"
                                class="w-full h-full rounded-full opacity-0 cursor-pointer">
                            <i
                                class="lab lab-fill-edit absolute top-1/2 left-1/2 -translate-y-1/2 -translate-x-1/2 -z-10 lab-font-size-24 lab-font-color-1 cursor-pointer"></i>
                        </label>

                        <h3 class="font-medium text-sm leading-6 capitalize mb-0.5">
                            {{ textShortener(authInfo.name, 20) }}
                        </h3>
                        <p class="text-xs mb-0.5">{{ authInfo.email }}</p>
                        <p v-if="authInfo.phone" class="text-xs" dir="ltr">{{ authInfo.country_code }}{{ authInfo.phone
                            }}</p>
                        <h3 class="font-medium text-sm leading-6 capitalize mb-0.5">{{ authInfo.currency_balance }}</h3>
                    </div>
                    <nav>
                        <router-link :to="{ name: 'admin.profile.editProfile' }"
                            class="paper-link transition w-full flex items-center gap-3.5 py-3 border-b last:border-none border-[#EFF0F6]">
                            <i class="lab lab-line-edit lab-font-size-17"></i>
                            <span class="text-sm leading-6 capitalize">{{ $t('button.edit_profile') }}</span>
                        </router-link>

                        <router-link :to="{ name: 'admin.profile.changePassword' }"
                            class="paper-link transition w-full flex items-center gap-3.5 py-3 border-b last:border-none border-[#EFF0F6]">
                            <i class="lab lab-line-key lab-font-size-17"></i>
                            <span class="text-sm leading-6 capitalize">{{ $t('button.change_password') }}</span>
                        </router-link>

                        <button @click="logout()"
                            class="paper-link transition w-full flex items-center gap-3.5 py-3 border-b last:border-none border-[#EFF0F6]">
                            <i class="lab lab-line-logout lab-font-size-17"></i>
                            <span class="text-sm leading-6 capitalize">{{ $t('button.logout') }}</span>
                        </button>
                    </nav>
                </div>
            </div>
        </div>
    </header>

    <!-- Notification Start -->
    <div id="order-modal" v-if="orderNotificationStatus" ref="orderNotificationModal" class="modal active ff-modal">
        <div class="modal-dialog max-w-[360px] p-6 text-center relative">
            <button @click.prevent="closeOrderNotificationModal('order-modal', 'modal-active')"
                class="modal-close absolute top-4 right-4">
                <i class="fa-regular fa-circle-xmark"></i>
            </button>
            <h3 class="text-[18px] font-semibold leading-8 mb-6">
                {{ orderNotificationMessage }}
                <span class="block">{{ $t('message.please_check_your_order_list') }}</span>
            </h3>
            <router-link :to="{ path: '/admin/' + orderNotification.url }"
                @click.prevent="closeOrderNotificationModal('order-modal', 'modal-active')"
                class="db-btn h-[38px] shadow-[0px_6px_10px_rgba(255,_0,_107,_0.24)] bg-primary text-white">
                {{ $t('button.let_me_check') }}
            </router-link>
        </div>
    </div>
    <!-- Notification End -->
</template>

<script>

import activityEnum from "../../../enums/modules/activityEnum";
import _ from "lodash";
import alertService from "../../../services/alertService";
import targetService from "../../../services/targetService";
import appService from "../../../services/appService";
import { initializeApp } from "firebase/app";
import { getMessaging, getToken, onMessage } from "firebase/messaging";
import axios from 'axios';

export default {
    name: "BackendNavbarComponent",
    data() {
        return {
            loading: {
                isActive: false,
            },
            enums: {
                activityEnum: activityEnum
            },
            defaultBranch: null,
            pos: {
                permission: false,
                url: '',
            },
            orderNotificationStatus: false,
            orderNotificationMessage: "",
            orderNotification: {
                permission: false,
                url: ""
            },
        }
    },
    computed: {
        setting: function () {
            return this.$store.getters['frontendSetting/lists'];
        },
        authInfo: function () {
            return this.$store.getters.authInfo;
        },
        languages: function () {
            return this.$store.getters['frontendLanguage/lists'];
        },
        language: function () {
            return this.$store.getters['frontendLanguage/show'];
        },
        permissions: function () {
            return this.$store.getters.authPermission;
        }
    },
    mounted() {
        appService.responsiveLoad();
        this.posPermissionCheck();
        this.orderPermissionCheck();

        window.setTimeout(() => {
            if (this.$store.getters.authStatus && this.setting.notification_fcm_api_key && this.setting.notification_fcm_auth_domain && this.setting.notification_fcm_project_id && this.setting.notification_fcm_storage_bucket && this.setting.notification_fcm_messaging_sender_id && this.setting.notification_fcm_app_id && this.setting.notification_fcm_measurement_id) {
                initializeApp({
                    apiKey: this.setting.notification_fcm_api_key,
                    authDomain: this.setting.notification_fcm_auth_domain,
                    projectId: this.setting.notification_fcm_project_id,
                    storageBucket: this.setting.notification_fcm_storage_bucket,
                    messagingSenderId: this.setting.notification_fcm_messaging_sender_id,
                    appId: this.setting.notification_fcm_app_id,
                    measurementId: this.setting.notification_fcm_measurement_id
                });
                const messaging = getMessaging();

                Notification.requestPermission().then((permission) => {
                    if (permission === 'granted') {
                        getToken(messaging, { vapidKey: this.setting.notification_fcm_public_vapid_key }).then((currentToken) => {
                            if (currentToken) {
                                axios.post('/frontend/device-token/web', { token: currentToken }).then().catch((error) => {
                                    if (error.response.data.message === 'Unauthenticated.') {
                                        this.$store.dispatch('loginDataReset');
                                    }
                                });
                            }
                        }).catch();
                    }
                });

                onMessage(messaging, (payload) => {
                    const notificationTitle = payload.notification.title;
                    const notificationOptions = {
                        body: payload.notification.body,
                        icon: '/images/required/firebase-logo.png'
                    };
                    new Notification(notificationTitle, notificationOptions);

                    if (payload.data.topicName === 'new-order-found' && this.orderNotification.permission) {
                        this.orderNotificationStatus = true;
                        this.orderNotificationMessage = payload.notification.body;
                        const audio = new Audio(this.setting.notification_audio);
                        audio.play();
                    }
                });
            }
        }, 5000);
    },
    methods: {
        textShortener: function (text, number = 30) {
            return appService.textShortener(text, number);
        },
        logout: function () {
            this.$store.dispatch("logout").then(res => {
                this.$router.push({ name: "frontend.home" });
            }).catch();
        },
        changeLanguage: function (id, code, mode) {
            this.defaultLanguage = id;
            this.$store.dispatch("globalState/set", {
                language_id: id,
                language_code: code,
                display_mode: mode
            }).then(res => {
                this.$store.dispatch('frontendLanguage/show', id).then(res => {
                    this.$i18n.locale = res.data.data.code;
                }).catch();
            }).catch();
        },
        posPermissionCheck: function () {
            const permissions = this.$store.getters.authPermission;
            if (permissions.length > 0) {
                _.forEach(permissions, (permission) => {
                    if (permission.name === 'pos') {
                        if (permission.access === true) {
                            this.pos.permission = true;
                            this.pos.url = permission.url;
                        }
                    }
                });
            }
        },
        orderPermissionCheck: function () {
            const permissions = this.$store.getters.authPermission;
            if (permissions.length > 0) {
                _.forEach(permissions, (permission) => {
                    if (permission.name === 'online-orders') {
                        if (permission.access === true) {
                            this.orderNotification.permission = true;
                            this.orderNotification.url = permission.url;
                        }
                    }
                });
            }
        },
        closeOrderNotificationModal: function (id, cClass) {
            targetService.hideTarget(id, cClass);
            this.orderNotificationStatus = false;
        },
        saveImage: function () {
            if (this.$refs.imageProperty.files[0]) {
                try {
                    this.loading.isActive = true;
                    const formData = new FormData();
                    formData.append("image", this.$refs.imageProperty.files[0]);
                    this.$store.dispatch("frontendEditProfile/changeImage", { form: formData }).then((res) => {
                        this.$store.dispatch('updateAuthInfo', res.data.data).then(res => {
                            this.loading.isActive = false;
                            alertService.success(this.$t("message.photo_update"));
                            this.$refs.imageProperty.value = null;
                        }).catch((err) => {
                            this.loading.isActive = false;
                            alertService.error(err);
                        });
                    }).catch((err) => {
                        this.loading.isActive = false;
                        this.imageErrors = err.response.data.errors;
                        if(this.imageErrors?.image && this.imageErrors?.image[0]){
                                alertService.error(this.imageErrors.image[0]);
                            }
                    });
                } catch (err) {
                    this.loading.isActive = false;
                    alertService.error(err.response.data.message);
                }
            }
        },
        toggleSidebar : function(){
            return appService.toggleSidebar()
        },
        
    }
}
</script>
