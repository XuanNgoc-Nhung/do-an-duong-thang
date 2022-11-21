<template>
    <el-row :gutter="24" class="pb-5" style="padding-top:100px;margin:0">
        <el-col :span="16" :offset="4" class="mt-3">
            <b>Đặt sản phẩm</b>
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
                                <el-button type="success" @click.prevent="detailProduct" size="mini">Chi tiết</el-button>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </el-col>
        <el-col :span="16" :offset="4">
            <el-row :gutter="24">
                <el-col :span="12" class="mt-3">
                    <span>Họ & tên</span>
                    <el-input placeholder="Nhập..." v-model="infoOder.userName"></el-input>
                </el-col>
                <el-col :span="12" class="mt-3">
                    <span>Số điện thoại</span>
                    <el-input placeholder="Nhập..." v-model="infoOder.phone"></el-input>
                </el-col>
                <el-col :span="12" class="mt-3">
                    <span>Địa chỉ</span>
                    <el-input placeholder="Nhập..." v-model="infoOder.address"></el-input>
                </el-col>
                <el-col :span="12" class="mt-3">
                    <span>Số lượng</span>
                    <el-input placeholder="Nhập..." @input="nhapSoLuong" min="1" type="number" v-model="infoOder.amount"></el-input>
                </el-col>
                <el-col :span="12" class="mt-3">
                    <span>Thành tiền</span>
                    <el-input placeholder="Nhập..." disabled v-model="infoOder.payment">
                        <template slot="append">VNĐ</template>
                    </el-input>
                </el-col>
                <el-col :span="12" class="mt-3">
                    <span>Ghi chú</span>
                    <el-input placeholder="Nhập..." v-model="infoOder.note"></el-input>
                </el-col>
                <el-col :span="24" class="text-center mt-4">
                    <el-button type="primary" @click.prevent="datHang()" size="mini">Đặt hàng</el-button>
                </el-col>
            </el-row>
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
            infoOder:{
                userName:'',
                phone:'',
                address:'',
                amount:1,
                payment:'',
                note:'',
                idProduct:''
            }
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
        datHang(){
            let params = {
                userName:this.infoOder.userName,
                phone:this.infoOder.phone,
                address:this.infoOder.address,
                amount:this.infoOder.amount,
                payment:this.infoOder.payment,
                note:this.infoOder.note,
                idProduct:this.productDetail.id,
            }
            rest_api.post('/booking-product-by-id', params).then(
                response => {
                    if (response && response.data.rc == 0) {
                        this.$confirm('Đặt hàng thành công. Bạn có thể theo dõi đơn hàng của mình trong mục quản lý đơn hàng?', 'Thông báo', {
                            confirmButtonText: 'Xem danh sách đơn hàng',
                            cancelButtonText: 'Hủy',
                        })
                            .then(_ => {
                                let url = 'user/list-booking'
                                window.open(url,"_self")
                            })
                            .catch(_ => {});
                    } else {
                        this.thongBao('error', response.data.rd)
                    }
                    this.loading.status = false;
                }
            ).catch((e) => {
            })
        },
        nhapSoLuong(){
            this.infoOder.payment = this.productDetail.price * this.infoOder.amount;
        },
        detailProduct(){
            let url = 'product-detail?id='+this.productDetail.id
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
                        this.infoOder.idProduct = this.productDetail.id;
                        this.infoOder.payment = this.productDetail.price;
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
