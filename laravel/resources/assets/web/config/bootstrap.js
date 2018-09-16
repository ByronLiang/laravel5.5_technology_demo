import './vendors';

/* ============
 * Vue
 * ============
 *
 * Vue.js is a library for building interactive web interfaces.
 * It provides data-reactive components with a simple and flexible API.
 *
 * http://vuejs.org/guide/
 */
import Vue from 'vue';

/* ============
 * element-ui
 * ============
 *
 * A Vue.js 2.0 UI Toolkit for Web.
 *
 * https://github.com/ElemeFE/element
 */

import {Loading, MessageBox, Message} from 'element-ui';

Vue.use(Loading.directive);

window.$ele = {
    $loading: Loading.service,
    $msgbox: MessageBox,
    $alert: MessageBox.alert,
    $confirm: MessageBox.confirm,
    $prompt: MessageBox.prompt,
    $message: Message,
};

// 全局api接口请求处理
import Api from '../api';

/**
 * @type {AxiosInstance}
 */
window.API = new Api();

// 微信签名，进入页面是签一次
// import {wxConfig} from '../api/Wechat';
// wxConfig();
