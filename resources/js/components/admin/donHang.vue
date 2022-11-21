<template>
    <div v-loading.fullscreen.lock="loading.status" :element-loading-text="loading.text"
         element-loading-spinner="el-icon-loading" element-loading-background="rgba(0, 0, 0, 0.8)">

        <el-row :gutter="24">
            <el-col :span="12" class="">
                Danh sách đơn hàng
            </el-col>
            <el-col :span="24" class="mt-2">
                <div class="table-responsive">
                    <table class="datatable table-bordered table hover-table">
                        <thead class="thead-light">
                        <tr>
                            <th>STT</th>
                            <th>Sản phẩm</th>
                            <th>Số lượng</th>
                            <th>Thành tiền</th>
                            <th>Người nhận</th>
                            <th>SĐT</th>
                            <th>Địa chỉ</th>
                            <th>Ghi chú</th>
                            <th>Trạng thái</th>
                            <th>Hành động</th>
                        </tr>
                        </thead>
                        <tbody v-if="list_data&&list_data.length">
                        <tr v-for="(item,index) in list_data" :key="index">
                            <td class="text-center">
                                <p>{{ (paging.currentPage - 1) * paging.limit + index + 1 }}</p>
                            </td>
                            <td>
                                <div style="display:flex" class="cursor-pointer"
                                     @click.prevent="detailProduct(item.product_id)">
                                    <img :src="item.images" style="width:100px;padding-right:15px" alt="Hình ảnh sản phẩm">
                                    <div class="info-order">
                                        <p>SP: {{item.name}}</p>
                                        <p>Giá: {{item.price}} vnđ</p>
                                    </div>
                                </div>
                            </td>
                            <td>{{ item.amount }} sản phẩm</td>
                            <td>{{ item.payment }} vnđ</td>
                            <td>{{ item.user_name }}</td>
                            <td class="text-center">{{ item.phone }}</td>
                            <td>{{ item.address }}</td>
                            <td>{{ item.note }}</td>
                            <td class="text-center">
                                <el-button v-if="item.status==1" size="mini" type="success">Đã hoàn thành</el-button>
                                <el-button v-else size="mini" type="warning">Đang xử lý</el-button>
                            </td>
                            <td class="text-center">
                                <el-button :disabled="item.status==1" @click.prevent="duyetDonHang(item.id)" size="mini" type="success">Duyệt</el-button>
                            </td>
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
    props: ['info'],
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
            show_add: false,
            show_update: false,
            dataAdd: {
                cate: '',
                name: '',
                description: '',
                price: ''
            },
            hinhAnhUpload: '',
            list_cate: [],
            dataUpdate: {},
            formDataHinhAnh: null
        }
    },
    mounted() {
        this.getData();
    },
    methods: {
        duyetDonHang(id){
            this.$confirm('Xác nhận duyệt đơn hàng.?', 'Thông báo', {
                confirmButtonText: 'Đồng ý',
                cancelButtonText: 'Hủy',
            })
                .then(_ => {
                    let params = {
                        id: id,
                    }
                    rest_api.post('/admin/duyet-don', params).then(
                        response => {
                            if (response && response.data.rc == 0) {
                                this.thongBao('success', response.data.rd)
                                this.getData();
                            } else {
                                this.thongBao('error', response.data.rd)
                            }
                            this.loading.status = false;
                        }
                    ).catch((e) => {
                    })

                })
                .catch(_ => {});
        },
        layLai(e) {
            console.log('onPagingClick')
            this.paging.start = e.start;
            this.paging.limit = e.limit;
            this.paging.currentPage = e.currentPage;
            this.getData()
        },
        getData() {
            let params = {
                start: this.paging.start,
                limit: this.paging.limit,
            }
            rest_api.post('/admin/list-order', params).then(
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
