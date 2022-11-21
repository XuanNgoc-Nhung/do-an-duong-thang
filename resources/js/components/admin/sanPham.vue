<template>
    <div v-loading.fullscreen.lock="loading.status" :element-loading-text="loading.text"
         element-loading-spinner="el-icon-loading" element-loading-background="rgba(0, 0, 0, 0.8)">

        <el-row :gutter="24">
            <el-col :span="12" class="">
                Danh sách sản phẩm
            </el-col>
            <el-col :span="12" class="text-right">
                <el-button size="mini" @click.prevent="hienThiThemMoi()" type="primary">Thêm sản phẩm
                </el-button>
            </el-col>
            <el-col :span="24" class="mt-2">
                <div class="table-responsive">
                    <table class="datatable table-bordered table hover-table">
                        <thead class="thead-light">
                        <tr>
                            <th>STT</th>
                            <th>Tên sản phẩm</th>
                            <th>Danh mục</th>
                            <th>Mô tả</th>
                            <th>Giá</th>
                            <th>Hình ảnh</th>
                            <th>Hành động</th>
                        </tr>
                        </thead>
                        <tbody v-if="list_data&&list_data.length">
                        <tr v-for="(item,index) in list_data" :key="index">
                            <td class="text-center">
                                <p>{{ (paging.currentPage - 1) * paging.limit + index + 1 }}</p>
                            </td>
                            <td>{{ item.name }}</td>
                            <td>{{ getNameCate(item.cate) }}</td>
                            <td>{{ item.description }}</td>
                            <td>{{ item.price }}</td>
                            <td class="text-center">
                                <img style="width:100px" :src="item.images" alt="Hình ảnh">
                            </td>
                            <td class="text-center">
                                <el-button size="mini"
                                           @click.prevent="hienThiChinhSua(item)"
                                           type="warning"> Chỉnh sửa
                                </el-button>
                                <el-button size="mini"
                                           @click.prevent="xoaSanPham(item)"
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
                            <span>Danh mục</span>
                            <eselect
                                style="width: 100%"
                                v-model="dataAdd.cate"
                                collapse-tags
                                :placeholder="'Chọn'"
                                filterable
                                :data="list_cate"
                                :fields="['name','id']"
                            />
                        </el-col>
                        <el-col :span="12" >
                            <span>Tên sản phẩm</span>
                            <el-input placeholder="Nhập tên" v-model="dataAdd.name"></el-input>
                        </el-col>
                        <el-col :span="12"  class="mt-4">
                            <span>Mô tả</span>
                            <el-input placeholder="Nhập mô tả" v-model="dataAdd.description"></el-input>
                        </el-col>
                        <el-col :span="12" class="mt-4">
                            <span>Giá</span>
                            <el-input placeholder="Nhập giá" type="number" v-model="dataAdd.price"></el-input>
                        </el-col>
                        <el-col :span="24" class="mt-4">
                            <span>Hình ảnh sản phẩm</span>
                            <div class="source d-flex pt-2">
                                <ul class="el-upload-list el-upload-list--picture-card " style="display: contents">
                                    <li v-if="hinhAnhUpload&&hinhAnhUpload!=''" tabindex="0"
                                        class="el-upload-list__item is-ready" style="min-width: 250px">
                                        <img :src="hinhAnhUpload" alt=""
                                             class="el-upload-list__item-thumbnail">
                                    </li>
                                    <li>
                                        <div class="">
                                            <el-upload ref="uploadMatSau" :show-file-list="false"
                                                       :on-change="uploadFileImg"
                                                       accept=".jpg,.png,.jpeg,.jfif" action="/"
                                                       :auto-upload="false">
                                                <div tabindex="0" class="el-upload el-upload--picture-card"><i
                                                    class="el-icon-plus"/>
                                                    <p></p></div>
                                            </el-upload>
                                        </div>
                                    </li>

                                </ul>
                            </div>
                        </el-col>
                    </el-row>
                    <span slot="footer" class="dialog-footer">
                        <el-button type="danger" size="mini" @click="show_add = false">Đóng</el-button>
                        <el-button type="primary" size="mini" @click="themMoiSanPham">Thêm</el-button>
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
                            <span>Danh mục</span>
                            <eselect
                                style="width: 100%"
                                v-model="dataUpdate.cate"
                                collapse-tags
                                :placeholder="'Chọn'"
                                filterable
                                :data="list_cate"
                                :fields="['name','id']"
                            />
                        </el-col>
                        <el-col :span="12" >
                            <span>Tên sản phẩm</span>
                            <el-input placeholder="Nhập tên" v-model="dataUpdate.name"></el-input>
                        </el-col>
                        <el-col :span="12"  class="mt-4">
                            <span>Mô tả</span>
                            <el-input placeholder="Nhập mô tả" v-model="dataUpdate.description"></el-input>
                        </el-col>
                        <el-col :span="12" class="mt-4">
                            <span>Giá</span>
                            <el-input placeholder="Nhập giá" type="number" v-model="dataUpdate.price"></el-input>
                        </el-col>
                        <el-col :span="24" class="mt-4">
                            <span>Hình ảnh sản phẩm</span>
                            <div class="source d-flex pt-2">
                                <ul class="el-upload-list el-upload-list--picture-card " style="display: contents">
                                    <li v-if="hinhAnhUpload&&hinhAnhUpload!=''" tabindex="0"
                                        class="el-upload-list__item is-ready" style="min-width: 250px">
                                        <img :src="hinhAnhUpload" alt=""
                                             class="el-upload-list__item-thumbnail">
                                    </li>
                                    <li>
                                        <div class="">
                                            <el-upload ref="uploadMatSau" :show-file-list="false"
                                                       :on-change="uploadFileImg"
                                                       accept=".jpg,.png,.jpeg,.jfif" action="/"
                                                       :auto-upload="false">
                                                <div tabindex="0" class="el-upload el-upload--picture-card"><i
                                                    class="el-icon-plus"/>
                                                    <p></p></div>
                                            </el-upload>
                                        </div>
                                    </li>

                                </ul>
                            </div>
                        </el-col>
                    </el-row>
                    <span slot="footer" class="dialog-footer">
                        <el-button type="danger" size="mini" @click="show_update = false">Đóng</el-button>
                        <el-button type="warning" size="mini" @click="chinhSuaSanPham">Chỉnh sửa</el-button>
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
            hinhAnhUpload:'',
            list_cate:[],
            dataUpdate: {},
            formDataHinhAnh:null
        }
    },
    mounted() {
        this.getListCate();
        this.getData();
    },
    methods: {
        getNameCate(cate){
            let result = '';
            for (let i = 0; i < this.list_cate.length; i++) {
                if(cate==this.list_cate[i].id){
                    result = this.list_cate[i].name
                }
            }
            return result
        },
        chinhSuaSanPham(){
            console.error('themMoiSanPham')
            this.loading.text = 'Đang xử lý thông tin...'
            this.loading.status = true;
            var dataForm = new FormData()
            dataForm.append('id', this.dataUpdate.id)
            dataForm.append('cate', this.dataUpdate.cate)
            dataForm.append('name', this.dataUpdate.name)
            dataForm.append('description', this.dataUpdate.description)
            dataForm.append('price', this.dataUpdate.price)
            if(this.formDataHinhAnh&&this.formDataHinhAnh.name){
                dataForm.append('hinhAnh', this.formDataHinhAnh, this.formDataHinhAnh.name)
            }
            rest_api.post('/admin/update-product', dataForm).then(
                response => {
                    console.error('Thông tin kết quả đăng ký khoản vay:')
                    console.error(response)
                    if (response && response.data.rc == 0) {
                        this.closeAllModal();
                        this.getData();
                        this.thongBao('success', response.data.rd)
                    } else {
                        this.thongBao('error', response.data.rd)
                    }
                    this.loading.status = false;
                }
            ).catch((e) => {
                console.error('rơi vào catch')
                this.thongBao('error', 'Vui lòng thử lại sau ít phút.')
                this.loading.status = false;
            })
        },
        themMoiSanPham(){
            if(!this.formDataHinhAnh){
                this.thongBao('error','Vui lòng bổ sung hình ảnh sản phẩm')
                return
            }
            console.error('themMoiSanPham')
            this.loading.text = 'Đang xử lý thông tin...'
            this.loading.status = true;
            var dataForm = new FormData()
            dataForm.append('cate', this.dataAdd.cate)
            dataForm.append('name', this.dataAdd.name)
            dataForm.append('description', this.dataAdd.description)
            dataForm.append('price', this.dataAdd.price)
            dataForm.append('hinhAnh', this.formDataHinhAnh, this.formDataHinhAnh.name)
            rest_api.post('/admin/add-product', dataForm).then(
                response => {
                    console.error('Thông tin kết quả đăng ký khoản vay:')
                    console.error(response)
                    if (response && response.data.rc == 0) {
                        this.closeAllModal();
                        this.getData();
                        this.thongBao('success', response.data.rd)
                    } else {
                        this.thongBao('error', response.data.rd)
                    }
                    this.loading.status = false;
                }
            ).catch((e) => {
                console.error('rơi vào catch')
                this.thongBao('error', 'Vui lòng thử lại sau ít phút.')
                this.loading.status = false;
            })
        },
        uploadFileImg(file, fileList){
            this.formDataHinhAnh = '';
            fileList.forEach((item, x) => {
                const typeImage = /(png|jpg|jfif|jpeg)$/i
                if (item.raw) {
                    if (typeImage.exec(item.raw.type)) {
                        this.hinhAnhUpload = URL.createObjectURL(item.raw)
                        this.formDataHinhAnh = item.raw
                    }
                }
            })
            this.$refs.uploadMatSau.clearFiles()
            this.$refs.uploadMatSau.value = null
        },
        xoaSanPham(item){
            this.$confirm('Xác nhận xoá dữ liệu?', 'Thông báo', {
                confirmButtonText: 'Đồng ý',
                cancelButtonText: 'Hủy',
            })
                .then(_ => {
                    let params = {
                        id:item.id
                    }
                    rest_api.post('/admin/delete-product', params).then(
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
        closeAllModal() {
            this.show_add = false;
            this.show_update = false;
        },
        hienThiChinhSua(item) {
            this.dataUpdate = JSON.parse(JSON.stringify(item))
            this.hinhAnhUpload = this.dataUpdate.images;
            this.formDataHinhAnh = null;
            this.show_update = true;
        },
        hienThiThemMoi() {
            console.log('showAdd')
            this.show_add = true;
        },
        getListCatePage() {
            this.trangbatdau = !this.trangbatdau;
        },
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
            rest_api.post('/admin/list-products', params).then(
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
