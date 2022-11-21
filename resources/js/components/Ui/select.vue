<template>
    <el-select
        ref="el_select"
        v-model="Content"
        size="large"
        :disabled="disabled"
        :multiple="multiple"
        :collapse-tags="collapseTags"
        :placeholder="placeholder"
        :filterable="filterable"
        :no-data-text="'Không có bản ghi nào'"
        :no-match-text="'Không tìm thấy bản ghi nào'"
        @change="onChange"
        @input="onInput"
    >
        <el-option v-if="!multiple" :key="-1" :label="placeholder" value="" />
        <li v-else class="el-select-dropdown__item"><label style="font-weight:normal;"><input v-model="CheckAll" type="checkbox" @change="onCheckAllChange"> Chọn tất cả</label></li>
        <el-option v-for="(item, index) in data" :key="index" :label="getLabel(item)" :disabled="item.disabled" :value="getValue(item)" />
    </el-select>
</template>
<script>
export default {
    components: {
    },
    props: {
        value: {
            required: true
        },
        disabled: {
            type: Boolean,
            default: false
        },
        data: {
            default: [],
            required: true
        },
        placeholder: {
            default: ''
        },
        size: {
            default: ''
        },
        filterable: {
            type: Boolean,
            default: false
        },
        multiple: {
            type: Boolean,
            default: false
        },
        'collapse-tags': {
            type: Boolean,
            default: false
        },
        fields: {
            type: Array,
            required: true
        }
        // style: {
        //     type: String
        // }
    },
    data() {
        return {
            Content: this.value,
            CheckAll: false
        }
    },
    watch: {
        value() {
            this.Content = this.value
        },
        data() {
            if (this.multiple) {
                if (this.Content.length === this.data.length) {
                    this.CheckAll = true
                } else {
                    this.CheckAll = false
                }
            }
        }
    },
    mounted() {
    },
    methods: {
        onCheckAllChange() {
            if (this.CheckAll) {
                this.Content = []
                if (this.fields[1]) {
                    this.data.map((obj) => {
                        this.Content.push(obj[this.fields[1]])
                        this.$emit('input', this.Content)
                    })
                }
                this.$emit('change', this.Content)
            } else {
                this.Content = []
                this.$emit('input', this.Content)
            }
        },
        focus() {
            this.$refs.el_select.focus()
        },
        onChange(e) {
            if (this.Content.length === this.data.length) {
                this.CheckAll = true
            } else {
                this.CheckAll = false
            }
            this.$emit('change', e)
        },
        onInput(e) {
            this.$emit('input', e)
        },
        getLabel(item) {
            if (!this.fields[0]) {
                return
            }
            return item[this.fields[0]]
        },
        getValue(item) {
            if (!this.fields[1]) {
                return
            }
            return item[this.fields[1]]
        }
    }
}
</script>

<style>

</style>
