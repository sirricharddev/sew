<template>
    <div class="row">
        <div class="col-12">
            <BreadcrumbComponent />
        </div>
        <LoadingComponent :props="loading" />
        <div class="col-12">
            <div class="db-card">
                <div class="db-card-header border-none">
                    <h3 class="db-card-title">{{ $t('menu.transactions') }}</h3>
                    <div class="db-card-filter">
                        <TableLimitComponent :method="list" :search="props.search" :page="paginationPage" />
                        <FilterComponent @click.prevent="handleSlide('transaction-filter')" />
                        <div class="dropdown-group">
                            <ExportComponent />
                            <div class="dropdown-list db-card-filter-dropdown-list">
                                <PrintComponent :props="printObj" />
                                <ExcelComponent :method="xls" />
                            </div>
                        </div>
                    </div>
                </div>

                <div class="table-filter-div" id="transaction-filter">
                    <form class="p-4 sm:p-5 mb-5 w-full d-block" @submit.prevent="search">
                        <div class="row">
                            <div class="col-12 sm:col-6 md:col-4 xl:col-3">
                                <label for="transaction_id" class="db-field-title after:hidden">{{
                                    $t('label.transaction_id')
                                    }}</label>
                                <input id="transaction_id" v-model="props.search.transaction_no" type="text"
                                    class="db-field-control">
                            </div>

                            <div class="col-12 sm:col-6 md:col-4 xl:col-3">
                                <label for="order_serial_no" class="db-field-title after:hidden">{{
                                    $t('label.order_serial_no')
                                    }}</label>
                                <input id="order_serial_no" v-model="props.search.order_serial_no" type="text"
                                    class="db-field-control">
                            </div>

                            <div class="col-12 sm:col-6 md:col-4 xl:col-3">
                                <label for="payment_method" class="db-field-title after:hidden">{{
                                    $t('label.payment_method')
                                    }}</label>
                                <vue-select class="db-field-control f-b-custom-select" id="payment_method"
                                    v-model="props.search.payment_method" :options="paymentGateways" label-by="name"
                                    value-by="slug" :closeOnSelect="true" :searchable="true" :clearOnClose="true"
                                    placeholder="--" search-placeholder="--" />
                            </div>

                            <div class="col-12 sm:col-6 md:col-4 xl:col-3">
                                <label for="searchStartDate" class="db-field-title after:hidden">{{
                                    $t('label.date')
                                    }}</label>
                                <Datepicker hideInputIcon autoApply :enableTimePicker="false" utc="false"
                                    @update:modelValue="handleDate" v-model="modelValue" :range="true">
                                </Datepicker>
                            </div>

                            <div class="col-12">
                                <div class="flex flex-wrap gap-3 mt-4">
                                    <button class="db-btn py-2 text-white bg-primary">
                                        <i class="lab lab-line-search lab-font-size-16"></i>
                                        <span>{{ $t('button.search') }}</span>
                                    </button>
                                    <button class="db-btn py-2 text-white bg-gray-600" @click="clear">
                                        <i class="lab lab-line-cross lab-font-size-22"></i>
                                        <span>{{ $t('button.clear') }}</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="db-table-responsive">
                    <table class="db-table stripe" id="print">
                        <thead class="db-table-head">
                            <tr class="db-table-head-tr">
                                <th class="db-table-head-th">{{ $t('label.transaction_id') }}</th>
                                <th class="db-table-head-th">{{ $t('label.date') }}</th>
                                <th class="db-table-head-th">{{ $t('label.payment_method') }}</th>
                                <th class="db-table-head-th">{{ $t('label.order_serial_no') }}</th>
                                <th class="db-table-head-th">{{ $t('label.amount') }}</th>
                            </tr>
                        </thead>
                        <tbody class="db-table-body" v-if="transactions.length > 0">
                            <tr class="db-table-body-tr" v-for="transaction in transactions" :key="transaction">
                                <td class="db-table-body-td">
                                    {{ transaction.transaction_no }}
                                </td>
                                <td class="db-table-body-td">
                                    {{ transaction.date }}
                                </td>
                                <td class="db-table-body-td">
                                    {{ transaction.payment_method }}
                                </td>
                                <td class="db-table-body-td">
                                    {{ transaction.order_serial_no }}
                                </td>
                                <td class="db-table-body-td">
                                    <span class="text-[#2AC769]" v-if="transaction.sign == '+'">
                                        {{ transaction.sign }} {{ transaction.amount }}
                                    </span>
                                    <span class="text-[#FB4E4E]" v-else>
                                        {{ transaction.sign }} {{ transaction.amount }}
                                    </span>
                                </td>

                            </tr>
                        </tbody>
                        <tbody class="db-table-body" v-else>
                        <tr class="db-table-body-tr">
                            <td class="db-table-body-td text-center" colspan="5">
                                <div class="p-4">
                                    <div class="max-w-[300px] mx-auto mt-2">
                                        <img class="w-full h-full" :src="ENV.API_URL+'/images/default/not-found/not_found.png'" alt="Not Found">
                                    </div>
                                    <span class="d-block mt-3 text-lg">{{ $t('message.no_data_found') }}</span>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                    </table>
                </div>

                <div class="flex items-center justify-between border-t border-gray-200 bg-white px-4 py-6" v-if="transactions.length > 0">
                    <PaginationSMBox :pagination="pagination" :method="list" />
                    <div class="hidden sm:flex sm:flex-1 sm:items-center sm:justify-between">
                        <PaginationTextComponent :props="{ page: paginationPage }" />
                        <PaginationBox :pagination="pagination" :method="list" />
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import LoadingComponent from "../components/LoadingComponent";
import alertService from "../../../services/alertService";
import PaginationTextComponent from "../components/pagination/PaginationTextComponent";
import PaginationBox from "../components/pagination/PaginationBox";
import PaginationSMBox from "../components/pagination/PaginationSMBox";
import appService from "../../../services/appService";
import TableLimitComponent from "../components/TableLimitComponent";
import FilterComponent from "../components/buttons/collapse/FilterComponent";
import ExportComponent from "../components/buttons/export/ExportComponent";
import PrintComponent from "../components/buttons/export/PrintComponent";
import ExcelComponent from "../components/buttons/export/ExcelComponent";
import Datepicker from "@vuepic/vue-datepicker";
import "@vuepic/vue-datepicker/dist/main.css";
import BreadcrumbComponent from "../components/BreadcrumbComponent";
import statusEnum from "../../../enums/modules/statusEnum";
import ENV from "../../../config/env";

export default {
    name: "TransactionListComponent",
    components: {
        TableLimitComponent,
        PaginationSMBox,
        PaginationBox,
        PaginationTextComponent,
        LoadingComponent,
        FilterComponent,
        ExportComponent,
        PrintComponent,
        ExcelComponent,
        Datepicker,
        BreadcrumbComponent
    },
    data() {
        return {
            loading: {
                isActive: false
            },
            enums: {},
            printLoading: true,
            printObj: {
                id: "print",
                popTitle: this.$t("menu.transactions"),
            },
            props: {
                search: {
                    paginate: 1,
                    page: 1,
                    per_page: 10,
                    order_column: 'id',
                    order_type: "desc",
                    order_serial_no: "",
                    transaction_no: "",
                    payment_method: null,
                    from_date: "",
                    to_date: ""
                }
            },
            modelValue: null,
            ENV:ENV
        }
    },
    mounted() {
        this.list();
        this.$store.dispatch('paymentGateway/lists', {
            order_column: 'id',
            order_type: 'asc',
            status: statusEnum.ACTIVE,
            excepts: 1,
        });
    },
    computed: {
        transactions: function () {
            return this.$store.getters['transaction/lists'];
        },
        paymentGateways: function () {
            return this.$store.getters['paymentGateway/lists'];
        },
        pagination: function () {
            return this.$store.getters['transaction/pagination'];
        },
        paginationPage: function () {
            return this.$store.getters['transaction/page'];
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
        handleSlide: function (id) {
            return appService.handleSlide(id);
        },
        search: function () {
            this.list();
        },
        handleDate: function (e) {
            if (e) {
                this.props.search.from_date = e[0];
                this.props.search.to_date = e[1];
            } else {
                this.props.search.from_date = null;
                this.props.search.to_date = null;

            }
        },
        clear: function () {
            this.props.search.paginate = 1;
            this.props.search.page = 1;
            this.props.search.order_type = "desc";
            this.props.search.order_serial_no = "";
            this.props.search.transaction_no = "";
            this.props.search.payment_method = null;
            this.props.search.from_date = "";
            this.props.search.to_date = "";
            this.modelValue = null;
            this.list();
        },
        list: function (page = 1) {
            this.loading.isActive = true;
            this.props.search.page = page;
            this.$store.dispatch('transaction/lists', this.props.search).then(res => {
                this.loading.isActive = false;
            }).catch((err) => {
                this.loading.isActive = false;
            });
        },
        xls: function () {
            this.loading.isActive = true;
            this.$store.dispatch("transaction/export", this.props.search).then((res) => {
                this.loading.isActive = false;
                const blob = new Blob([res.data], {
                    type: "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet",
                });
                const link = document.createElement("a");
                link.href = URL.createObjectURL(blob);
                link.download = this.$t("menu.transactions");
                link.click();
                URL.revokeObjectURL(link.href);
            }).catch((err) => {
                this.loading.isActive = false;
                alertService.error(err.response.data.message);
            });
        },
    }
}
</script>

<style scoped>
@media print {
    .hidden-print {
        display: none !important;
    }
}
</style>
