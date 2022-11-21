<template>
    <el-row :gutter="24" style="margin:0">
        <el-col :span="24" class="mb-2">
            <b>Danh sách sản phẩm bán chạy</b>
        </el-col>
        <el-col :span="4">
        </el-col>
        <template v-for="item in list_products_sale_off">
            <el-col :span="4">
                <div class="profile-widget">
                    <div class="doc-img">
                        <a >
                            <img class="img-fluid" alt="Hình ảnh sản phẩm" style="width:260px;height:174px" :src="item.images">
                        </a>
                    </div>
                    <div class="pro-content">
                        <h3 class="title">
                            <a >{{item.name}}</a>
                            <i class="fas fa-check-circle verified"></i>
                        </h3>
                        <p class="speciality">{{item.description}}</p>
                        <ul class="available-info">
                            <li>
                                <i class="far fa-money-bill-alt" style="color:black"></i> {{item.price}} vnđ
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
    </el-row>
</template>

<script>
import rest_api from "../../api/rest_api";
import ElementUI from 'element-ui';
import 'element-ui/lib/theme-chalk/index.css';

Vue.use(ElementUI);
export default {
    data() {
        return {
            list_products_sale_off: [],
        }
    },
    mounted() {
        this.getListProduct();
    },
    methods: {
        getListProduct() {
            let params = {
                start: 0,
                limit: 6,
            }
            rest_api.post('/admin/list-products', params).then(
                response => {
                    if (response && response.data.rc == 0) {
                        this.list_products_sale_off = response.data.list_data;
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
