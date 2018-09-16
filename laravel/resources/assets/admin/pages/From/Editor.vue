<template>
    <el-card>
        <tinymce v-model="form.content"></tinymce>
        <div class="mt-4">
            截图上传
        </div>
        <cropper v-model="form.src">
            <img :src="form.src" alt="" class="missing" style="max-width: 128px">
        </cropper>
    </el-card>
</template>

<script>
export default {
    components: {
        Tinymce: () => import('admin/components/base/Tinymce'),
        Cropper: () => import('admin/components/base/cropper'),
    },
    props: [],
    data() {
        return {
            form: {
                content: '',
                src: '',
            },
        };
    },
    computed: {},
    watch: {},
    methods: {},
    mounted() {
    },
    beforeDestroy() {
    },
};
</script>

<style lang="scss">
</style>
