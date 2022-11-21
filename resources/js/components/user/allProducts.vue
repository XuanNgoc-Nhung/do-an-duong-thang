<template>
    <el-row :gutter="24" style="padding-top:100px;padding-bottom:100px;margin:0">
        <el-col :span="6">
            <span>Danh mục</span>
            <eselect
                style="width: 100%"
                v-model="dataSearch.cate"
                collapse-tags
                :placeholder="'Chọn'"
                filterable
                :data="list_cate"
                :fields="['name','id']"
            />
        </el-col>
        <el-col :span="6">
            <span>Từ khoá</span>
            <el-input placeholder="Nhập tên sản phẩm..." v-model="dataSearch.key"></el-input>
        </el-col>
        <el-col :span="6">
            <el-button @click.prevent="trangbatdau = !trangbatdau" style="margin-top:22px" type="primary">Tìm kiếm</el-button>
        </el-col>
        <el-col :span="24" class="mb-2 mt-3">
            <b>Danh sách sản phẩm</b>
        </el-col>
        <template v-for="item in list_products_sale_off">
            <el-col :span="4">
                <div class="profile-widget">
                    <div class="doc-img">
                        <a>
                            <img class="img-fluid" alt="Hình ảnh sản phẩm" style="width:260px;height:174px"
                                 :src="item.images">
                        </a>
                    </div>
                    <div class="pro-content">
                        <h3 class="title">
                            <a  >{{ item.name }}</a>
                            <i class="fas fa-check-circle verified"></i>
                        </h3>
                        <p class="speciality">{{ item.description }}</p>
                        <ul class="available-info">
                            <li>
                                <i class="far fa-money-bill-alt" style="color:black"></i> {{ item.price }} vnđ
                            </li>
                        </ul>
                        <div class="row row-sm">
                            <div class="col-6">
                                <a :href="'product-detail?id='+item.id" class="btn view-btn">Chi tiết</a>
                            </div>
                            <div class="col-6">
                                <a :href="'booking-product?id='+item.id" class="btn book-btn">Mua ngay</a>
                            </div>
                        </div>
                    </div>
                </div>
            </el-col>
        </template>
        <el-col :span="24" v-if="list_products_sale_off.length==0" class="text-center">
            <p>
                Không tìm thấy dữ liệu
            </p>
        </el-col>
        <el-col :span="24">
            <PhanTrang v-show="paging.total>0" :tongbanghi="paging.total"
                       :batdau="trangbatdau"
                       @pageChange="layLai($event)">
            </PhanTrang>
        </el-col>
    </el-row>
</template>

<script>
import rest_api from "../../api/rest_api";
import ElementUI from 'element-ui';
import 'element-ui/lib/theme-chalk/index.css';
import ESelectVue from "../Ui/select";
import PhanTrang from "../Ui/paginate";

Vue.use(ElementUI);
export default {

    components: {
        'eselect': ESelectVue,
        PhanTrang
    },
    data() {
        return {
            trangbatdau: false,
            dataSearch: {
                cate: '',
                key: ''
            },
            paging: {
                total: 0,
                start: 0,
                limit: 12,
                currentPage: 1
            },
            list_products_sale_off: [],
            list_cate: [],
        }
    },
    mounted() {
        this.getListCate();
        this.getListProduct();
    },
    methods: {
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
        layLai(e) {
            console.log('onPagingClick')
            this.paging.start = e.start;
            this.paging.limit = e.limit;
            this.paging.currentPage = e.currentPage;
            this.getListProduct()
        },
        getListProduct() {
            let params = {
                start: this.paging.start,
                limit: this.paging.limit,
                cate:this.dataSearch.cate,
                key:this.dataSearch.key
            }
            rest_api.post('/admin/list-products', params).then(
                response => {
                    if (response && response.data.rc == 0) {
                        this.list_products_sale_off = response.data.list_data;
                        this.paging.total = response.data.total;
                        this.thongBao('success','lấy dữ liệu thành công.')
                    } else {
                        this.thongBao('error', response.data.rd)
                    }
                    this.loading.status = false;
                }
            ).catch((e) => {
            })
        },
        thongBao(typeNoty, msgNoty) {
            console.log('thongBao')
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
.profile-widget p.speciality {
    overflow: hidden;
    text-overflow: ellipsis;
    -webkit-line-clamp: 2;
    display: -webkit-box;
    -webkit-box-orient: vertical;
}

.add-to-cart {
    vertical-align: middle;
    align-self: center;
}
</style>
