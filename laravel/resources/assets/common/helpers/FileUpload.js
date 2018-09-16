import imgHandle from './imgHandle';

export default class {
    constructor(uploadBasePath = '', drive = 'cos') {
        this.uploadBasePath = uploadBasePath;
        this.drive = drive;
    }

    /**
     * 设置图片压缩选项
     * @param imgOptions
     */
    imgOptions(imgOptions) {
        this.imgOptions = imgOptions;
        return this;
    }

    /**
     * 设置ajax请求选项
     * @param ajaxOptions
     */
    setAjaxOptions(ajaxOptions = {}) {
        this.ajaxOptions = ajaxOptions;
        return this;
    }

    /**
     * 把单个文件转成文件数组
     * @param files
     */
    fileToFiles(files) {
        if (typeof files.length === 'undefined') files = [files];
        return files;
    }

    /**
     * 获取上传进度获取
     * @param callback
     */
    onUploadProgress(callback) {
        if (!this.ajaxOptions) this.ajaxOptions = {};
        this.ajaxOptions.onUploadProgress = callback;
        return this;
    }

    /**
     * 获取上传参数
     * @param drive
     * @returns {Promise<*>}
     */
    uploadParameter(drive = null) {
        // if (drive) this.drive = drive;
        // return uploadToken(this.drive);
        throw Error('缺失获取上传参数配置');
    }

    /**
     * 开始批量上传
     * @param files
     * @returns {Promise<Array>}
     */
    async uploadStart(files) {
        if (files) files = this.fileToFiles(files);

        let filesUrl = [];
        for (let i = 0; i < files.length; i++) {
            filesUrl.push(await this.uploadFile(files[i]));
        }
        return filesUrl;
    }

    /**
     * 上传单个文件
     * @param file
     * @returns {Promise<*>}
     */
    async uploadFile(file) {
        let uploadPath = this.uploadBasePath;
        const uploadParameter = await this.uploadParameter();
        const uploadForm = uploadParameter.form;
        const uploadHeaders = uploadParameter.headers;

        if (!this.ajaxOptions) this.ajaxOptions = {};

        if (uploadParameter.access_url.substr(uploadParameter.access_url.length - 1, 1) !== '/') {
            uploadParameter.access_url += '/';
        }

        if (this.imgOptions) {
            file = await imgHandle(file, this.imgOptions);
        }

        const filename = this.genFileName(file);
        uploadPath += filename;

        let headers = {};
        for (const key in uploadHeaders) {
            if (!{}.hasOwnProperty.call(uploadHeaders, key)) continue;
            headers[key] = uploadHeaders[key];
        }
        if (!this.ajaxOptions.headers) this.ajaxOptions.headers = {};
        Object.assign(this.ajaxOptions.headers, headers);

        let formData = new FormData();
        formData.append('key', uploadPath);
        for (const key in uploadForm) {
            if (!{}.hasOwnProperty.call(uploadForm, key)) continue;
            formData.append(key, uploadForm[key]);
        }
        formData.append('file', file, filename);

        await axios.post(uploadParameter.upload_url, formData, this.ajaxOptions);

        return uploadParameter.access_url + uploadPath;
    }

    /**
     * 生成文件名
     * @param file
     * @return {string}
     */
    genFileName(file) {
        if (!file.name) {
            return (new Date()).getTime() + '.jpg';
        }
        const ext = file.name.split('.').pop();
        return 'temp/' + (new Date()).getTime() + '.' + ext;
    }
}
