import {createApp, h} from "vue";
import {createInertiaApp, Head, Link} from "@inertiajs/inertia-vue3";
import {InertiaProgress} from "@inertiajs/progress";
import Layout from "./Shared/Layout"; // noinspection JSIgnoredPromiseFromCall

// noinspection JSIgnoredPromiseFromCall
createInertiaApp({
    resolve: async (name) => {
        // noinspection JSUnresolvedFunction
        let page = (await import(`./Pages/${name}`)).default;

        page.layout ??= Layout;
        return page;
    },
    setup({ el, App, props, plugin }) {
        createApp({ render: () => h(App, props) })
            .use(plugin)
            .component("Link", Link)
            .component("Head", Head)
            .mount(el);
    },
    title: (title) => `${title} - Inertiapp`,
});

InertiaProgress.init();
