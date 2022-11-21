<template>
    <el-row :gutter="24" class="pb-5" style="padding-top:100px;margin:0">
        <el-col :span="16" :offset="4" class="mt-3">
            <b>Danh sách đơn hàng</b>
        </el-col>
        <el-col :span="16" :offset="4">
            <div class="card">
                <div class="card-body">

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
                                </tr>
                                </thead>
                                <tbody v-if="list_order&&list_order.length">
                                <tr v-for="(item,index) in list_order" :key="index">
                                    <td class="text-center">
                                        <p>{{ (paging.currentPage - 1) * paging.limit + index + 1 }}</p>
                                    </td>
                                    <td>
                                        <div style="display:flex" class="cursor-pointer" @click.prevent="detailProduct(item.product_id)">
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
                </div>
            </div>
        </el-col>
    </el-row>
</template>

<script>
import rest_api from "../../api/rest_api";
import ElementUI from 'element-ui';
import 'element-ui/lib/theme-chalk/index.css';
import PhanTrang from "../Ui/paginate";

Vue.use(ElementUI);
export default {
    components: {
        PhanTrang
    },
    data() {
        return {
            list_order:[],
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
        this.getListOrder()
    },
    methods: {
        detailProduct(id){
            let url = 'product-detail?id='+id
            window.open(url,"_self")
        },
        getListOrder() {
            let params = {
                start: this.paging.start,
                limit: this.paging.limit,
            }
            rest_api.post('/user/list-orders-by-user', params).then(
                response => {
                    if (response && response.data.rc == 0) {
                        this.thongBao('success', response.data.rd)
                        this.list_order = response.data.list_data
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
.info-order p{
    margin:0;
    padding:0
}
th{
    text-align:center
}
</style>
