<template>
    <span class="cropper">
        <span @click="click">
            <slot></slot>
        </span>
        <input type="file" ref="file" accept=".jpg,.png,.jpeg" @change="onChange" class="hidden"/>

        <div class="fixed z-50 pin flex flex-col justify-center items-center cropper-dialog" v-if="visible">
            <vue-cropper ref="cropper" :options="cropper.options" :src="cropper.src" :img-style="cropper.imgStyle"/>
            <div class="pt-2">
                <el-button @click="cancel">取消</el-button>
                <el-button @click="upload">确定</el-button>
            </div>
        </div>
    </span>
</template>

<script>
import VueCropper from 'common/components/cropper';
import FileUpload from 'admin/api/fileUpload';

export default {
    components: {
        VueCropper,
    },
    props: {
        value: String,
        // CropperJS options
        // see https://github.com/fengyuanchen/cropperjs#options
        options: Object,
    },
    data() {
        return {
            visible: false,
            cropImg: '',
            cropper: {
                src: '',
                options: {},
                imgStyle: {
                    'max-width': '80vw',
                    'max-height': '80vh',
                },
            },
        };
    },
    methods: {
        onChange(e) {
            this.visible = true;

            const file = e.target.files[0];
            e.target.value = '';

            this.$nextTick(() => {
                if (!this.$refs.cropper) return;

                const reader = new FileReader();
                reader.onload = (event) => {
                    this.$refs.cropper.replace(event.target.result);
                };
                reader.readAsDataURL(file);
            });
        },
        cropImage() {
            this.cropImg = this.$refs.cropper.getCroppedCanvas().toDataURL();
        },
        upload() {
            this.visible = false;
            let loadingInstance = $ele.$loading({target: this.$el});

            this.$refs.cropper.getCroppedCanvas().toBlob(async (blob) => {
                this.$emit('input', await (new FileUpload()).uploadFile(blob));
                loadingInstance.close();
            });
        },
        click() {
            this.$refs.file.click();
        },
        cancel() {
            this.visible = false;
        },
    },
};
</script>

<style lang="scss" scoped>
    .cropper {
        &-dialog {
            background: rgba(0, 0, 0, .4);
        }
    }
</style>
