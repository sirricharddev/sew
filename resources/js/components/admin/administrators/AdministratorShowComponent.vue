<template>
    <LoadingComponent :props="loading" />
    <div class="col-12">
        <div class="p-6 rounded-xl mb-8 shadow-xs bg-white">
            <div class="flex flex-wrap gap-4 sm:gap-6">
                <img class="w-[120px] h-[120px] object-cover rounded-lg" :src="previewImage" alt="avatar" />
                <div>
                    <h3 class="text-[26px] font-semibold font-rubik leading-[40px] capitalize">
                        {{ textShortener(administrator.name, 20) }}
                    </h3>
                    <label
                        class="p-0.5 px-2 rounded text-[10px] leading-4 font-medium font-rubik uppercase mb-[22px] text-[#E89806] bg-[#FFF5DE]">
                        {{ $t("label.admin") }}
                    </label><br>
                    <form @submit.prevent="saveImage">
                        <div class="flex gap-3 md:gap-4">
                            <label for="photo"
                                class="db-btn relative cursor-pointer h-[38px] shadow-[0px_6px_10px_rgba(255,_0,_107,_0.24)] bg-primary text-white">
                                <i class="lab lab-line-upload-image"></i>
                                <span class="hidden sm:inline-block">{{
                                    $t("button.upload_new_photo")
                                    }}</span>
                                <input v-if="uploadButton" @change="changePreviewImage" ref="imageProperty"
                                    accept="image/png, image/jpeg, image/jpg" type="file" id="photo"
                                    class="absolute top-0 left-0 w-full h-full -z-10 opacity-0" />
                            </label>
                            <button v-if="saveButton" type="submit"
                                class="db-btn h-[38px] shadow-[0px_6px_10px_rgba(26,_183,_89,_0.24)] text-white bg-[#1AB759]">
                                <i class="lab lab-line-circle-check"></i>
                                <span class="hidden sm:inline-block">{{ $t("button.save") }}</span>
                            </button>
                            <button v-if="resetButton" @click="resetPreviewImage" type="button"
                                class="db-btn-outline h-[38px] shadow-[0px_6px_10px_rgba(251,_78,_78,_0.24)] !text-[#FB4E4E] !bg-white !border-[#FB4E4E]">
                                <i class="lab lab-line-reset"></i>
                                <span class="hidden sm:inline-block">{{ $t("button.reset") }}</span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="flex flex-col items-start sm:flex-row sm:items-center gap-1.5 mb-6">
            <button type="button" @click="handleTab($event, '#profile', '.profile-tabBtn', '.profile-tabDiv', 'active')"
                class="profile-tabBtn active w-full justify-start sm:w-fit inline-flex items-center sm:justify-center gap-2 h-[38px] py-2 px-4 rounded-md text-[#6E7191] stroke-[#6E7191]">
                <i class="lab lab-line-user"></i>
                <span class="capitalize text-sm">{{ $t("button.profile") }}</span>
            </button>
            <button type="button" @click="handleTab($event, '#security', '.profile-tabBtn', '.profile-tabDiv', 'active')"
                class="profile-tabBtn w-full justify-start sm:w-fit inline-flex items-center sm:justify-center gap-2 h-[38px] py-2 px-4 rounded-md text-[#6E7191] stroke-[#6E7191]">
                <i class="lab lab-line-unlock"></i>
                <span class="capitalize text-sm">{{ $t("button.security") }}</span>
            </button>
            <button type="button" @click="handleTab($event, '#address', '.profile-tabBtn', '.profile-tabDiv', 'active')"
                class="profile-tabBtn w-full justify-start sm:w-fit inline-flex items-center sm:justify-center gap-2 h-[38px] py-2 px-4 rounded-md text-[#6E7191] stroke-[#6E7191]">
                <i class="lab lab-line-location"></i>
                <span class="capitalize text-sm">{{ $t("button.address") }}</span>
            </button>
            <button type="button" @click="handleTab($event, '#orders', '.profile-tabBtn', '.profile-tabDiv', 'active')"
                class="profile-tabBtn w-full justify-start sm:w-fit inline-flex items-center sm:justify-center gap-2 h-[38px] py-2 px-4 rounded-md text-[#6E7191] stroke-[#6E7191]">
                <i class="lab lab-line-reserve"></i>
                <span class="capitalize text-sm">{{ $t("button.my_orders") }}</span>
            </button>
        </div>
        <div id="profile" class="profile-tabDiv active">
            <div class="db-card">
                <div class="db-card-header">
                    <h3 class="db-card-title">{{ $t("label.basic_info") }}</h3>
                </div>
                <div class="db-card-body">
                    <div class="row py-2">
                        <div class="col-12 sm:col-6 !py-1.5">
                            <div class="db-list-item p-0">
                                <span class="db-list-item-title w-full sm:w-1/2">{{
                                    $t("label.email")
                                    }}</span>
                                <span class="db-list-item-text w-full sm:w-1/2">{{
                                    administrator.email
                                    }}</span>
                            </div>
                        </div>
                        <div class="col-12 sm:col-6 !py-1.5">
                            <div class="db-list-item p-0">
                                <span class="db-list-item-title w-full sm:w-1/2">{{
                                    $t("label.phone")
                                    }}</span>
                                <span class="db-list-item-text w-full sm:w-1/2" dir="ltr">{{
                                    administrator.country_code + "" + administrator.phone
                                    }}</span>
                            </div>
                        </div>
                        <div class="col-12 sm:col-6 !py-1.5">
                            <div class="db-list-item p-0">
                                <span class="db-list-item-title w-full sm:w-1/2">{{
                                    $t("label.status")
                                    }}</span>
                                <span class="db-list-item-text w-full sm:w-1/2">
                                    <span :class="statusClass(administrator.status)">{{
                                        enums.statusEnumArray[administrator.status]
                                        }}</span>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div id="security" class="profile-tabDiv">
            <div class="db-card">
                <div class="db-card-header">
                    <h3 class="db-card-title">{{ $t("label.change_password") }}</h3>
                </div>
                <div class="db-card-body">
                    <form @submit.prevent="changePassword" class="w-full d-block">
                        <div class="form-row">
                            <div class="form-col-12 sm:form-col-6">
                                <label for="password" class="db-field-title required">{{
                                    $t("label.password")
                                    }}</label>
                                <input v-model="password.props.form.password"
                                    v-bind:class="password.errors.password ? 'invalid' : ''" type="password"
                                    id="password" class="db-field-control" autocomplete="off" />
                                <small class="db-field-alert" v-if="password.errors.password">{{
                                    password.errors.password[0]
                                    }}</small>
                            </div>

                            <div class="form-col-12 sm:form-col-6">
                                <label for="password" class="db-field-title required">{{
                                    $t("label.confirm_password")
                                    }}</label>
                                <input v-model="password.props.form.password_confirmation"
                                    v-bind:class="password.errors.password_confirmation ? 'invalid' : ''"
                                    type="password" id="confirm_password" class="db-field-control" autocomplete="off" />
                                <small class="db-field-alert" v-if="password.errors.password_confirmation">{{
                                    password.errors.password_confirmation[0]
                                    }}</small>
                            </div>

                            <div class="form-col-12">
                                <div class="flex flex-wrap gap-3">
                                    <button type="submit" class="db-btn py-2 text-white bg-primary">
                                        <i class="lab lab-fill-save"></i>
                                        <span>{{ $t("label.save") }}</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div id="address" class="profile-tabDiv">
            <AdministratorAddressList :props="$route.params.id" />
        </div>

        <div id="orders" class="profile-tabDiv">
            <div class="db-card">
                <div class="db-card-header">
                    <h3 class="db-card-title">{{ $t('label.orders') }}</h3>
                </div>
                <div class="db-card-body">
                    <div class="row">
                        <div class="col-12 md:col-6 lg:col-6 xl:col-4" v-if="myOrders.length > 0"
                            v-for="order in myOrders" :key="order">
                            <div class="w-full rounded-lg py-2 px-3 flex items-center gap-5 border border-[#EFF0F6]">
                                <i class="lab lab-line-reserve lab-font-size-24 lab-font-color-2"></i>
                                <div class="w-full">
                                    <div class="flex items-center gap-4 mb-1">
                                        <p class="text-sm leading-6 font-rubik">{{ $t('label.order_id') }}:
                                            <span class="text-heading">
                                                #{{ order.order_serial_no }}
                                            </span>
                                        </p>
                                        <span
                                            class="py-0.5 px-2 rounded-full text-[10px] leading-4 capitalize bg-[#BDEFFF]"
                                            :class="orderStatusClass(order.status)">
                                            {{ order.status_name }}</span>
                                    </div>
                                    <p class="text-xs font-light font-rubik mb-0.5">{{ order.order_items }} {{
                                        $t("label.products")
                                        }}</p>
                                    <p class="text-xs font-light font-rubik mb-1">{{ order.order_datetime }}</p>
                                    <div class="flex items-center justify-between">
                                        <p class="text-sm leading-6 font-rubik capitalize text-heading">{{
                                            $t("label.total")
                                            }}: <span class="font-medium">{{ order.total_currency_price }}</span></p>
                                        <router-link
                                            :to="{ name: 'admin.administrators.order.details', params: { id: $route.params.id, orderId: order.id } }"
                                            class="text-[10px] leading-4 font-medium font-rubik flex items-center gap-1.5 text-primary">
                                            {{ $t("label.see_order_details") }}
                                            <i class="lab lab-arrow-right lab-font-size-13"></i>
                                        </router-link>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="flex items-center justify-between border-t border-gray-200 bg-white px-4 py-6">
                    <PaginationSMBox :pagination="orderPagination" :method="orderLists" />
                    <div class="hidden sm:flex sm:flex-1 sm:items-center sm:justify-between">
                        <PaginationTextComponent :props="{ page: orderPage }" />
                        <PaginationBox :pagination="orderPagination" :method="orderLists" />
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import LoadingComponent from "../components/LoadingComponent";
import statusEnum from "../../../enums/modules/statusEnum";
import askEnum from "../../../enums/modules/askEnum";
import alertService from "../../../services/alertService";
import appService from "../../../services/appService";
import SmDeleteComponent from "../components/buttons/SmDeleteComponent";
import SmModalEditComponent from "../components/buttons/SmModalEditComponent";
import TableLimitComponent from "../components/TableLimitComponent";
import AdministratorAddressList from "./address/AdministratorAddressList";
import PaginationTextComponent from "../components/pagination/PaginationTextComponent";
import PaginationBox from "../components/pagination/PaginationBox";
import PaginationSMBox from "../components/pagination/PaginationSMBox";

export default {
    name: "AdministratorShowComponent",
    components: {
        LoadingComponent,
        SmDeleteComponent,
        SmModalEditComponent,
        TableLimitComponent,
        AdministratorAddressList,
        PaginationSMBox,
        PaginationBox,
        PaginationTextComponent,
    },
    data() {
        return {
            loading: {
                isActive: false,
            },
            enums: {
                statusEnum: statusEnum,
                statusEnumArray: {
                    [statusEnum.ACTIVE]: this.$t("label.active"),
                    [statusEnum.INACTIVE]: this.$t("label.inactive"),
                },
            },
            password: {
                props: {
                    form: {
                        password: "",
                        password_confirmation: "",
                    },
                },
                errors: {},
            },
            defaultImage: null,
            previewImage: null,
            uploadButton: true,
            resetButton: false,
            saveButton: false,
            search: {
                paginate: 1,
                page: 1,
                per_page: 9,
                order_column: 'id',
                active: askEnum.YES,
            }
        };
    },
    computed: {
        administrator: function () {
            return this.$store.getters["administrator/show"];
        },
        myOrders: function () {
            return this.$store.getters['administrator/myOrders'];
        },
        orderPagination: function () {
            return this.$store.getters["administrator/orderPagination"];
        },
        orderPage: function () {
            return this.$store.getters["administrator/orderPage"];
        },
    },
    mounted() {
        this.loading.isActive = true;
        this.$store.dispatch("administrator/show", this.$route.params.id).then((res) => {
            this.defaultImage = res.data.data.image;
            this.previewImage = res.data.data.image;
            this.loading.isActive = false;
        }).catch((error) => {
            this.loading.isActive = false;
        });
        this.orderLists();
    },
    methods: {
        textShortener: function (text, number = 30) {
            return appService.textShortener(text, number);
        },
        statusClass: function (status) {
            return appService.statusClass(status);
        },
        orderStatusClass: function (status) {
            return appService.orderStatusClass(status);
        },
        handleTab: function (event, targetID, targetButton, targetDiv, activeClass) {
            return appService.handleTab(event, targetID, targetButton, targetDiv, activeClass);
        },
        changePreviewImage: function (e) {
            if (e.target.files[0]) {
                this.previewImage = URL.createObjectURL(e.target.files[0]);
                this.saveButton = true;
                this.resetButton = true;
            }
        },
        resetPreviewImage: function () {
            this.$refs.imageProperty.value = null;
            this.previewImage = this.defaultImage;
            this.saveButton = false;
            this.resetButton = false;
        },
        orderLists: function (page = 1) {
            this.loading.isActive = true;
            this.search.page = page;
            this.$store.dispatch('administrator/myOrders', {
                id: this.$route.params.id,
                search: this.search
            }).then(res => {
                this.loading.isActive = false;
            }).catch((err) => {
                this.loading.isActive = false;
            });
        },
        saveImage: function () {
            if (this.$refs.imageProperty.files[0]) {
                try {
                    this.loading.isActive = true;
                    const formData = new FormData();
                    formData.append("image", this.$refs.imageProperty.files[0]);
                    this.$store
                        .dispatch("administrator/changeImage", {
                            id: this.$route.params.id,
                            form: formData,
                        })
                        .then((res) => {
                            alertService.success(this.$t("message.photo_update"));
                            this.defaultImage = res.data.data.image;
                            this.previewImage = res.data.data.image;
                            this.$refs.imageProperty.value = null;
                            this.saveButton = false;
                            this.resetButton = false;
                            this.loading.isActive = false;
                        })
                        .catch((err) => {
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
        changePassword: function () {
            try {
                const tempId = this.$store.getters["administrator/temp"].temp_id;
                this.loading.isActive = true;
                this.$store
                    .dispatch("administrator/changePassword", {
                        form: this.password.props.form,
                        id: this.$route.params.id,
                    })
                    .then((res) => {
                        this.loading.isActive = false;
                        alertService.successInfo(
                            tempId === null ? 0 : 1,
                            this.$t("message.password_update")
                        );
                        this.password.props.form = {
                            password: "",
                            password_confirmation: "",
                        };
                        this.password.errors = {};
                    })
                    .catch((err) => {
                        this.loading.isActive = false;
                        this.password.errors = err.response.data.errors;
                    });
            } catch (err) {
                this.loading.isActive = false;
                alertService.error(err);
            }
        },
        destroy: function (address) {
            appService
                .destroyConfirmation()
                .then((res) => {
                    try {
                        this.loading.isActive = true;
                        this.$store
                            .dispatch("administratorAddress/destroy", {
                                address_id: address.id,
                                id: this.$route.params.id,
                                search: this.props.search,
                            })
                            .then((res) => {
                                this.loading.isActive = false;
                                alertService.successFlip(null, this.$t("menu.addresses"));
                                this.list();
                            })
                            .catch((err) => {
                                this.loading.isActive = false;
                                alertService.error(err.response.data.message);
                            });
                    } catch (err) {
                        this.loading.isActive = false;
                        alertService.error(err.response.data.message);
                    }
                })
                .catch((err) => {
                    this.loading.isActive = false;
                });
        },
    },
};
</script>