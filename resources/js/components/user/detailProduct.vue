<template>
    <el-row :gutter="24" style="padding-top:100px;margin:0">
        <el-col :span="16" :offset="4" class="mt-3">
            <b>Chi tiết sản phẩm</b>
        </el-col>
        <el-col :span="16" :offset="4">
            <div class="card">
                <div class="card-body">
                    <div class="doctor-widget">
                        <div class="doc-info-left">
                            <div class="doctor-img1">
                                <a href="pharmacy-details.html">
                                    <img :src="productDetail.images" style="width:300px; height:200px" class="img-fluid" alt="User Image">
                                </a>
                            </div>
                            <div class="doc-info-cont">
                                <h4 class="doc-name mb-2"><a href="pharmacy-details.html">{{productDetail.name}}</a></h4>
                                <div class="clinic-details">
                                    <div class="clini-infos pt-3">
                                        <p class="doc-location mb-2"> <span style="color: black">Giá: </span>{{productDetail.price}} vnđ</p>
                                        <p class="doc-location mb-2"> <span style="color: black">Mô tả: </span>{{productDetail.description}}</p>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="doc-info-right d-flex align-items-center justify-content-center">
                            <div class="clinic-booking">
                                <el-button type="success" @click.prevent="bookingProduct" size="mini">Mua ngay</el-button>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </el-col>
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
            productDetail: {},
        }
    },
    mounted() {
        var queryString = window.location.search;
        let urlParams  = new URLSearchParams(queryString);
        let idProduct = urlParams.get('id')
        console.error('idProduct: ' + idProduct)
        this.getDetailProduct(idProduct)
    },
    methods: {
        bookingProduct(){
            let url = 'booking-product?id='+this.productDetail.id
            window.open(url,"_self")
        },
        getDetailProduct(id) {
            let params = {
                id: id,
            }
            rest_api.post('/detail-by-id', params).then(
                response => {
                    if (response && response.data.rc == 0) {
                        this.productDetail = response.data.data;
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
            // this.$message({
            //     customClass: cl,
            //     showClose: true,
            //     message: msg,
            //     type: type,
            //     duration: 3000
            // });
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
