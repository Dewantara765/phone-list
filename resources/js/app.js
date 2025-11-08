import './bootstrap';
import { createApp, h } from 'vue'
import { createInertiaApp, Head, Link } from '@inertiajs/vue3'
import { ZiggyVue} from '../../vendor/tightenco/ziggy'
import {Ziggy} from './ziggy';
import Layout from './Layouts/Layout.vue';


createInertiaApp({
  title: title => `${title} - Biruphone`,
  resolve: name => {
    const pages = import.meta.glob('./Pages/**/*.vue', { eager: true });
    let page = pages[`./Pages/${name}.vue`];
    page.default.layout = page.default.layout || Layout;
    return page;
  },
  setup({ el, App, props, plugin }) {
    const application =createApp({ render: () => h(App, props) })
      .use(plugin)
      .use(ZiggyVue, Ziggy)
      .component('Head', Head)
      .component('Link', Link)
      .mount(el)
      delete el.dataset.page;

    return application;
  },
  progress: {
    // // The delay after which the progress bar will appear, in milliseconds...
    // delay: 250,

    // The color of the progress bar...
    color: 'red',

    // Whether to include the default NProgress styles...
    includeCSS: true,

    // Whether the NProgress spinner will be shown...
    showSpinner: true,
  },
})