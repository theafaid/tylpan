// ========== Vue Js ============== //
window.Vue = require('vue');
Vue.prototype.$eventBus = new Vue(); // Global event bus

// =========== V-Form ============= //
import { Form, HasError, AlertError } from 'vform'

Vue.component(HasError.name, HasError)
Vue.component(AlertError.name, AlertError)

window.Form = Form;
// ========= Vue-Toasted ======== //
import Toasted from 'vue-toasted';

Vue.use(Toasted, {});

Vue.prototype.toast = function (statue = 'success', text,actionText = '', actionUrl = '') {
    this.$toasted.show(text, {
        theme: `bubble`,
        position: "top-right",
        duration : 8000,
        type: statue,

        action: [
            actionText ? {text: actionText, onClick: (e, toastObject) => {window.location = actionUrl}} : {}
        ]
    });
}
