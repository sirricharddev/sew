<template>
    <LoadingComponent :props="loading" />
    <div class="col-12">
        <div class="db-card p-4">
            <div class="flex flex-wrap gap-y-5 items-end justify-between">
                <div>
                    <div class="flex flex-wrap items-start gap-y-2 gap-x-6 mb-5">
                        <p class="text-2xl font-medium">
                            {{ $t('label.order_id') }}:
                            <span class="text-heading">
                                #{{ order.order_serial_no }}
                            </span>
                        </p>
                        <div class="flex items-center gap-2 mt-1.5">
                            <span
                                :class="'text-sm capitalize h-5 leading-5 px-2 rounded-3xl text-[#FB4E4E] bg-[#FFDADA]' + statusClass(order.payment_status)">
                                {{ enums.paymentStatusEnumArray[order.payment_status] }}
                            </span>
                            <span
                                :class="'text-xs capitalize h-5 leading-5 px-2 rounded-3xl ' + orderStatusClass(order.status)">
                                {{ enums.orderStatusEnumArray[order.status] }}
                            </span>
                        </div>
                    </div>
                    <ul class="flex flex-col gap-2">
                        <li class="flex items-center gap-2">
                            <i class="lab lab-line-calendar lab-font-size-16"></i>
                            <span class="text-xs">{{ order.order_datetime }}</span>
                        </li>
                        <li class="text-xs">
                            {{ $t('label.payment_type') }}:
                            <span class="text-heading">
                                {{ order.pos_payment_method_name }}
                            </span>
                        </li>
                        <li v-if="order.pos_payment_method == enums.posPaymentMethodEnum.CARD" class="text-xs">
                            {{ $t('label.card_digit') }}:
                            <span class="text-heading">
                                {{ order.pos_payment_note }}
                            </span>
                        </li>
                        <li v-if="order.pos_payment_method == enums.posPaymentMethodEnum.MOBILE_BANKING"
                            class="text-xs">
                            {{ $t('label.transaction_id') }}:
                            <span class="text-heading">
                                {{ order.pos_payment_note }}
                            </span>
                        </li>
                        <li v-if="order.pos_payment_method == enums.posPaymentMethodEnum.OTHER" class="text-xs">
                            {{ $t('label.note') }}:
                            <span class="text-heading">
                                {{ order.pos_payment_note }}
                            </span>
                        </li>
                        <li class="text-xs">
                            {{ $t('label.order_type') }}:
                            <span class="text-heading">
                                {{ $t("label.pos") }}
                            </span>
                        </li>
                    </ul>
                </div>

                <div class="flex flex-wrap gap-3">
                    <div class="relative">
                        <select v-model="payment_status" @change="changePaymentStatus($event)"
                            class="text-sm capitalize appearance-none pl-4 pr-10 h-[38px] rounded border border-primary bg-white text-primary">
                            <option v-for="paymentStatus in enums.paymentStatusObject" :value="paymentStatus.value">
                                {{ paymentStatus.name }}
                            </option>
                        </select>
                        <i
                            class="lab lab-line-chevron-down lab-font-size-16 absolute top-1/2 right-3.5 -translate-y-1/2 text-primary"></i>
                    </div>

                    <div class="relative">
                        <select v-model="order_status" @change="orderStatus($event)"
                            class="text-sm capitalize appearance-none pl-4 pr-10 h-[38px] rounded border border-primary bg-white text-primary">
                            <option v-for="orderStatus in enums.orderStatusObject" :value="orderStatus.value">
                                {{ orderStatus.name }}
                            </option>
                        </select>
                        <i
                            class="lab lab-line-chevron-down lab-font-size-16 absolute top-1/2 right-3.5 -translate-y-1/2 text-primary"></i>
                    </div>

                    <button type="button" v-print="printObj"
                        class="flex items-center justify-center gap-2 px-4 h-[38px] rounded shadow-db-card bg-primary">
                        <i class="lab lab-line-printer lab-font-size-16 text-white"></i>
                        <span class="text-sm capitalize text-white">{{ $t('button.print_invoice') }}</span>
                    </button>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12 sm:col-6">
        <div class="db-card">
            <div class="db-card-header">
                <h3 class="db-card-title">{{ $t('label.order_details') }}</h3>
            </div>
            <div class="db-card-body">
                <div class="pl-3">
                    <div class="mb-3 pb-3 border-b last:mb-0 last:pb-0 last:border-b-0 border-gray-2"
                        v-if="orderProducts.length > 0" v-for="product in orderProducts" :key="product">
                        <div class="flex items-center gap-3 relative">
                            <h3
                                class="absolute top-5 ltr:-left-3 rtl:-right-3  text-sm w-[26px] h-[26px] leading-[26px] text-center rounded-full text-white bg-heading">
                                {{ product.quantity }}
                            </h3>
                            <img class="w-16 h-16 rounded-lg flex-shrink-0" :src="product.product_image"
                                alt="thumbnail">
                            <div class="flex-auto overflow-hidden">
                                <h4 :class="!product.variation_names ? 'mb-4' : ''"
                                    class="text-sm capitalize whitespace-nowrap overflow-hidden text-ellipsis">
                                    {{ product.product_name }}
                                </h4>
                                <p class="text-sm overflow-hidden">{{ product.variation_names }}</p>
                                <div class="flex flex-wrap items-center justify-between gap-4">
                                    <div class="flex items-center gap-8">
                                        <span class="text-sm font-semibold">
                                            {{ product.subtotal_currency_price }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12 sm:col-6">
        <div class="row">
            <div class="col-12">
                <div class="db-card p-1">
                    <ul class="flex flex-col gap-2 p-3 border-b border-dashed border-[#EFF0F6]">
                        <li class="flex items-center justify-between text-heading">
                            <span class="text-sm leading-6 capitalize">{{ $t('label.subtotal') }}</span>
                            <span class="text-sm leading-6 capitalize">{{ order.subtotal_currency_price }}</span>
                        </li>
                        <li class="flex items-center justify-between text-heading">
                            <span class="text-sm leading-6 capitalize">{{ $t('label.tax_fee') }}</span>
                            <span class="text-sm leading-6 capitalize">{{ order.tax_currency_price }}</span>
                        </li>
                        <li class="flex items-center justify-between text-heading">
                            <span class="text-sm leading-6 capitalize">{{ $t('label.discount') }}</span>
                            <span class="text-sm leading-6 capitalize">{{ order.discount_currency_price }}</span>
                        </li>
                    </ul>
                    <div class="flex items-center justify-between p-3">
                        <h4 class="text-sm leading-6 font-bold capitalize">{{ $t('label.total') }}</h4>
                        <h5 class="text-sm leading-6 font-bold capitalize">
                            {{ order.total_currency_price }}
                        </h5>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="db-card">
                    <div class="db-card-header">
                        <h3 class="db-card-title">{{ $t('label.information') }}</h3>
                    </div>
                    <div class="db-card-body">
                        <div class="flex items-center gap-3 mb-4">
                            <img class="w-8 rounded-full" :src="orderUser.image" alt="avatar">
                            <h4 class="font-semibold text-sm capitalize text-[#374151]">
                                {{ textShortener(orderUser.name, 20) }}
                            </h4>
                        </div>
                        <ul class="flex flex-col gap-3 py-4 border-t border-[#EFF0F6]">
                            <li class="flex items-center gap-2.5">
                                <i class="lab lab-line-mail lab-font-size-14"></i>
                                <span class="text-xs">{{ orderUser.email }}</span>
                            </li>
                            <li class="flex items-center gap-2.5">
                                <i class="lab lab-line-call-calling lab-font-size-14"></i>
                                <span class="text-xs" dir="ltr">{{ orderUser.country_code + '' + orderUser.phone
                                    }}</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <PosOrderReceiptComponent :order="order" />
</template>
<script>
import LoadingComponent from "../components/LoadingComponent";
import alertService from "../../../services/alertService";
import PaginationTextComponent from "../components/pagination/PaginationTextComponent";
import PaginationBox from "../components/pagination/PaginationBox";
import PaginationSMBox from "../components/pagination/PaginationSMBox";
import appService from "../../../services/appService";
import orderStatusEnum from "../../../enums/modules/orderStatusEnum";
import TableLimitComponent from "../components/TableLimitComponent";
import paymentStatusEnum from "../../../enums/modules/paymentStatusEnum";
import print from "vue3-print-nb";
import PosOrderReceiptComponent from "./PosOrderReceiptComponent";
import posPaymentMethodEnum from "../../../enums/modules/posPaymentMethodEnum";

export default {
    name: "PosOrderShowComponent",
    components: {
        TableLimitComponent,
        PaginationSMBox,
        PaginationBox,
        PaginationTextComponent,
        LoadingComponent,
        PosOrderReceiptComponent
    },
    directives: {
        print
    },
    data() {
        return {
            loading: {
                isActive: false
            },
            printLoading: true,
            printObj: {
                id: "print",
                popTitle: this.$t("menu.pos_order_receipt"),
            },
            enums: {
                orderStatusEnum: orderStatusEnum,
                paymentStatusEnum: paymentStatusEnum,
                posPaymentMethodEnum: posPaymentMethodEnum,
                orderStatusEnumArray: {
                    [orderStatusEnum.CONFIRMED]: this.$t("label.confirmed"),
                    [orderStatusEnum.DELIVERED]: this.$t("label.delivered"),
                },
                paymentStatusEnumArray: {
                    [paymentStatusEnum.PAID]: this.$t("label.paid"),
                    [paymentStatusEnum.UNPAID]: this.$t("label.unpaid")
                },
                paymentStatusObject: [
                    {
                        name: this.$t("label.paid"),
                        value: paymentStatusEnum.PAID
                    },
                    {
                        name: this.$t("label.unpaid"),
                        value: paymentStatusEnum.UNPAID,
                    },
                ],
                orderStatusObject: [
                    {
                        name: this.$t("label.confirmed"),
                        value: orderStatusEnum.CONFIRMED,
                    },
                    {
                        name: this.$t("label.delivered"),
                        value: orderStatusEnum.DELIVERED,
                    },
                ],
            },
            payment_status: null,
            order_status: null
        }
    },
    mounted() {
        this.loading.isActive = true;
        this.$store.dispatch('posOrder/show', this.$route.params.id).then(res => {
            this.payment_status = res.data.data.payment_status;
            this.order_status = res.data.data.status;
            this.loading.isActive = false;
        }).catch((error) => {
            this.loading.isActive = false;
        });
    },
    computed: {
        order: function () {
            return this.$store.getters['posOrder/show'];
        },
        orderProducts: function () {
            return this.$store.getters['posOrder/orderProducts'];
        },
        orderUser: function () {
            return this.$store.getters['posOrder/orderUser'];
        }
    },
    methods: {
        statusClass: function (status) {
            return appService.statusClass(status);
        },
        orderStatusClass: function (status) {
            return appService.orderStatusClass(status);
        },
        textShortener: function (text, number = 30) {
            return appService.textShortener(text, number);
        },
        orderStatus: function (e) {
            try {
                this.loading.isActive = true;
                this.$store.dispatch("posOrder/changeStatus", {
                    id: this.$route.params.id,
                    status: e.target.value,
                }).then((res) => {
                    this.loading.isActive = false;
                    alertService.successFlip(
                        1,
                        this.$t("label.status")
                    );
                }).catch((err) => {
                    this.loading.isActive = false;
                    alertService.error(err.response.data.message);
                });
            } catch (err) {
                this.loading.isActive = false;
                alertService.error(err.response.data.message);
            }
        },
        changePaymentStatus: function (e) {
            try {
                this.loading.isActive = true;
                this.$store.dispatch("posOrder/changePaymentStatus", {
                    id: this.$route.params.id,
                    payment_status: e.target.value,
                }).then((res) => {
                    this.loading.isActive = false;
                    alertService.successFlip(
                        1,
                        this.$t("label.payment_status")
                    );
                }).catch((err) => {
                    this.loading.isActive = false;
                    alertService.error(err.response.data.message);
                });
            } catch (err) {
                this.loading.isActive = false;
                alertService.error(err.response.data.message);
            }
        },
    },
}
</script>