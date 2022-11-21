<template>
    <div v-loading.fullscreen.lock="loading.status" :element-loading-text="loading.text"
         element-loading-spinner="el-icon-loading" element-loading-background="rgba(0, 0, 0, 0.8)">

        <el-row :gutter="24">
            <el-col :span="12" class="">
                Danh sách danh mục
            </el-col>
            <el-col :span="12" class="text-right">
                <el-button size="mini" @click.prevent="hienThiThemMoi()" type="primary">Thêm danh mục
                </el-button>
            </el-col>
            <el-col :span="24" class="mt-2">
                <div class="table-responsive">
                    <table class="datatable table-bordered table hover-table">
                        <thead class="thead-light">
                        <tr>
                            <th>STT</th>
                            <th>Tên danh mục</th>
                            <th>Mô tả</th>
                            <th>Hành động</th>
                        </tr>
                        </thead>
                        <tbody v-if="list_data&&list_data.length">
                        <tr v-for="(item,index) in list_data" :key="index">
                            <td class="text-center">
                                <p>{{ (paging.currentPage - 1) * paging.limit + index + 1 }}</p>
                            </td>
                            <td>{{ item.name }}</td>
                            <td>{{ item.description }}</td>
                            <td class="text-center">
                                <el-button size="mini"
                                           @click.prevent="hienThiChinhSua(item)"
                                           type="warning"> Chỉnh sửa
                                </el-button>
                                <el-button size="mini"
                                           @click.prevent="xoaDanhMuc(item)"
                                           type="danger"> Xoá
                                </el-button>
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
        <el-row :gutter="24">
            <el-col :span="24">
                <el-dialog
                    append-to-body
                    top="10vh"
                    title="Thêm mới danh mục sản phẩm"
                    :visible.sync="show_add"
                    width="40%"
                    :before-close="closeAllModal">
                    <el-row :gutter="24">
                        <el-col :span="12">
                            <span>Tên danh mục</span>
                            <el-input placeholder="Nhập tên danh mục" v-model="dataAdd.name"></el-input>
                        </el-col>
                        <el-col :span="12">
                            <span>Mô tả</span>
                            <el-input placeholder="Nhập mô tả danh mục" v-model="dataAdd.description"></el-input>
                        </el-col>
                    </el-row>
                    <span slot="footer" class="dialog-footer">
                        <el-button type="danger" size="mini" @click="show_add = false">Đóng</el-button>
                        <el-button type="primary" size="mini" @click="themDanhMuc">Thêm</el-button>
                    </span>
                </el-dialog>

                <el-dialog
                    append-to-body
                    top="10vh"
                    title="Chỉnh sửa danh mục sản phẩm"
                    :visible.sync="show_update"
                    width="40%"
                    :before-close="closeAllModal">
                    <el-row :gutter="24">
                        <el-col :span="12">
                            <span>Tên danh mục</span>
                            <el-input placeholder="Nhập tên danh mục" v-model="dataUpdate.name"></el-input>
                        </el-col>
                        <el-col :span="12">
                            <span>Mô tả</span>
                            <el-input placeholder="Nhập mô tả danh mục" v-model="dataUpdate.description"></el-input>
                        </el-col>
                    </el-row>
                    <span slot="footer" class="dialog-footer">
                        <el-button type="danger" size="mini" @click="show_update = false">Đóng</el-button>
                        <el-button type="warning" size="mini" @click="suaDanhMuc">Chỉnh sửa</el-button>
                    </span>
                </el-dialog>
            </el-col>
        </el-row>
    </div>
</template>
<script>
import rest_api from "../../api/rest_api";
import Vue from 'vue';
import ElementUI from 'element-ui';
import PhanTrang from '../Ui/paginate'
import {Icon} from 'element-ui';
import 'element-ui/lib/theme-chalk/index.css';

Vue.use(ElementUI);
Vue.use(Icon);
export default {
    props: ['info'],
    components: {
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
                name: '',
                description: ''
            },
            dataUpdate: {},

        }
    },
    mounted() {
        this.getData();
    },
    methods: {
        xoaDanhMuc(item){
            this.$confirm('Xác nhận xoá dữ liệu?', 'Thông báo', {
                confirmButtonText: 'Đồng ý',
                cancelButtonText: 'Hủy',
            })
                .then(_ => {
                    let params = {
                        id:item.id
                    }
                    rest_api.post('/admin/delete-cate', params).then(
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
        themDanhMuc() {
            rest_api.post('/admin/add-cate', this.dataAdd).then(
                response => {
                    if (response && response.data.rc == 0) {
                        this.thongBao('success', response.data.rd)
                        this.getData();
                        this.closeAllModal()
                    } else {
                        this.thongBao('error', response.data.rd)
                    }
                    this.loading.status = false;
                }
            ).catch((e) => {
            })
        },
        suaDanhMuc() {
            console.log(this.dataUpdate)
            rest_api.post('/admin/update-cate', this.dataUpdate).then(
                response => {
                    if (response && response.data.rc == 0) {
                        this.thongBao('success', response.data.rd)
                        this.getData();
                        this.closeAllModal()
                    } else {
                        this.thongBao('error', response.data.rd)
                    }
                    this.loading.status = false;
                }
            ).catch((e) => {
            })
        },
        closeAllModal() {
            this.show_add = false;
            this.show_update = false;
        },
        hienThiChinhSua(item) {
            this.dataUpdate = JSON.parse(JSON.stringify(item))
            this.show_update = true;
        },
        hienThiThemMoi() {
            console.log('showAdd')
            this.show_add = true;
        },
        getDataPage() {
            this.trangbatdau = !this.trangbatdau;
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
            rest_api.post('/admin/list-cate', params).then(
                response => {
                    if (response && response.data.rc == 0) {
                        this.thongBao('success', response.data.rd)
                        this.list_data = response.data.list_data;
                        this.paging.total = response.data.total;
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
