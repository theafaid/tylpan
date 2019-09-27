export default class authorization {
    constructor (user) {
        this.user = user;
    }

    isAdmin() {
        return this.user.type == 'admin' || this.user.type == 'super_admin';
    }

    isUser() {
        return this.user.type == 'user';
    }

    isDelegate() {
        return this.user.type == 'delegate';
    }
}
