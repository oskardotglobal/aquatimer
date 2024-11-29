//@ts-ignore
import { createInertiaApp } from '@inertiajs/svelte'
import { mount } from "svelte";

createInertiaApp({
    //@ts-ignore
    resolve: name => {
        const pages = import.meta.glob('./Pages/**/*.svelte', { eager: true })
        return pages[`./Pages/${name}.svelte`]
    },
    //@ts-ignore
    setup({ el, App, props }) {
        mount(App, { target: el, props });
    },
})
