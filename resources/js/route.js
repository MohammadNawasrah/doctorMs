class UrlData {
    static host = window.location.hostname;
    static port = window.location.port || 80;
    static protocol = window.location.protocol;
    static baseUrl = UrlData.protocol + "//" + UrlData.host + ":" + UrlData.port;
}

class Login {
    static login = UrlData.baseUrl + "/login"
}
class Dashboard {
    static dashboard = UrlData.baseUrl + "/dashboard";
    static users = UrlData.baseUrl + "/dashboard/users";
}