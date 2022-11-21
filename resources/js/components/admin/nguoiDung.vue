<template>
    <div v-loading.fullscreen.lock="loading.status" :element-loading-text="loading.text"
         element-loading-spinner="el-icon-loading" element-loading-background="rgba(0, 0, 0, 0.8)">

        <el-row :gutter="24">
            <el-col :span="12" class="">
                Danh sách người dùng
            </el-col>
            <el-col :span="24" class="mt-2">
                <div class="table-responsive">
                    <table class="datatable table-bordered table hover-table">
                        <thead class="thead-light">
                        <tr>
                            <th>STT</th>
                            <th>Họ tên</th>
                            <th>Email</th>
                            <th>Vai trò</th>
                            <th>Ngày đăng ký</th>
                        </tr>
                        </thead>
                        <tbody v-if="list_data&&list_data.length">
                        <tr v-for="(item,index) in list_data" :key="index">
                            <td class="text-center">
                                <p>{{ (paging.currentPage - 1) * paging.limit + index + 1 }}</p>
                            </td>
                            <td>{{ item.name }}</td>
                            <td>{{ item.email }}</td>
                            <td>{{ item.role==1?'Admin':'Người dùng' }}</td>
                            <td class="text-center">{{ item.created_at }}</td>
                        </tr>
                        </tbody>
                        <tbody v-else>
                        <tr>
                            <td colspan="9" class="text-center">
                                <p>Không có dữ liệu</p>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </el-col>

            <PhanTrang v-show="paging.total>0" :tongbanghi="paging.total"
                       :batdau="trangbatdau"
                       @pageChange="layLai($event)">
            </PhanTrang>
        </el-row>
    </div>
</template>
<script>
import rest_api from "../../api/rest_api";
import Vue from 'vue';
import ElementUI from 'element-ui';
import PhanTrang from '../Ui/paginate'
import ESelectVue from '../Ui/select'
import {Icon} from 'element-ui';
import 'element-ui/lib/theme-chalk/index.css';

Vue.use(ElementUI);
Vue.use(Icon);
export default {
    props: [],
    components: {
        'eselect': ESelectVue,
        PhanTrang
    },
    data() {
        return {
            loading: {
                status: false,
                text: 'Loading...'
            },
            list_data: [],
            trangbatdau: false,
            paging: {
                total: 0,
                start: 0,
                limit: 10,
                currentPage: 1
            },
        }
    },
    mounted() {
        this.getData();
    },
    methods: {
        layLai(e) {
            console.log('onPagingClick')
            this.paging.start = e.start;
            this.paging.limit = e.limit;
            this.paging.currentPage = e.currentPage;
            this.getData()
        },
        getData(){

            let params = {
                start: this.paging.start,
                limit: this.paging.limit,
            }
            rest_api.post('/admin/list-user', params).then(
                response => {
                    if (response && response.data.rc == 0) {
                        this.thongBao('success', response.data.rd)
                        this.list_data = response.data.list_data;
                        this.paging.total = response.data.total
                    } else {
                        this.thongBao('error', response.data.rd)
                    }
                    this.loading.status = false;
                }
            ).catch((e) => {
            })
        },
        getListCate() {
            let params = {
                start: 0,
                limit: 999999,
            }
            rest_api.post('/admin/list-cate', params).then(
                response => {
                    if (response && response.data.rc == 0) {
                        this.list_cate = response.data.list_data;
                    } else {
                    }
                    this.loading.status = false;
                }
            ).catch((e) => {
            })
        },
        thongBao(typeNoty, msgNoty) {
            let msg = "";
            let cl = "";
            if (msgNoty) {
                msg = msgNoty;
            }
            let type = "success";
            if (typeNoty) {
                type = typeNoty
            }
            if (type == "success") {
                cl = "dts-noty-success"
            }
            if (type == "warning") {
                cl = "dts-noty-warning"
            }
            if (type == "error") {
                cl = "dts-noty-error"
            }
            if (type == "info") {
                cl = "dts-noty-info"
            }
            this.$message({
                customClass: cl,
                showClose: true,
                message: msg,
                type: type,
                duration: 3000
            });
        },
    }
}
</script>
<style scoped="scoped">

.table > :not(:first-child) {
    border-top: none !important;
}

th {
    text-align: center;
}
</style>
