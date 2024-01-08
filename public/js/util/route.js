class UrlData {
    static host = window.location.hostname;
    static port = window.location.port || 80;
    static protocol = window.location.protocol;
    static baseUrl = UrlData.protocol + "//" + UrlData.host + (UrlData.port ? ":" + UrlData.port : "");
}

class Login {
    static login = UrlData.baseUrl + "/login";
}

class Dashboard {
    static dashboard = UrlData.baseUrl + "/dashboard";
    static users = Dashboard.dashboard + "/users";
    static htmlCodePage = Dashboard.dashboard + "/htmlCodePage";
    static userPageToAccess = Dashboard.dashboard + "/userPageToAccess";  // Added
    static userPermission = Dashboard.dashboard + "/userPermission"
    static patients = Dashboard.dashboard + "/patients";
    static patientAppointment = Dashboard.dashboard + "/patientAppointments";
    // Add more routes as needed
}

class HtmlCodePage {
    static getAllHtmlCode = Dashboard.htmlCodePage + "/getAllHtmlCode";  // Added
    static updateHtmlCode = Dashboard.htmlCodePage + "/updateHtmlCode";  // Added
    // Add more routes as needed
}

class Users {
    static register = Dashboard.users + "/register";  // Added
    static getAllAdminUsers = Dashboard.users + "/getAllAdminUsers";  // Added
    static setSocketIdForUserOnline = Dashboard.users + "/user/online";  // Added
    static setSocketIdForUserOffline = Dashboard.users + "/user/offline";  // Added
    static getUserByUserName = Dashboard.users + "/user";  // Added
    static deleteUser = Dashboard.users + "/user/delete";  // Added
    static getUserPermissions = Dashboard.users + "/getUserPermissions";  // Added
    static getHtmlByPermission = Dashboard.users + "/getHtmlByPermission";  // Added
    // Add more routes as needed
}

class UserPermission {

    static setPermissionForUser = Dashboard.userPermission + "/setPermissionForUser";  // Added
    static updatePermissionForUser = Dashboard.userPermission + "/updatePermissionForUser";  // Added
    static getPermissionForUser = Dashboard.userPermission + "/getPermissionForUser";  // Added
    // Add more routes as needed
}

class Permissions {
    static index = Dashboard.dashboard + "/permissions";  // Added
    static addPermission = Permissions.index + "/addPermission";  // Added
    static getAllPermission = Permissions.index + "/getAllPermission";  // Added
    static addNewActionForPagePermission = Permissions.index + "/addNewActionForPagePermission";  // Added
    static getHtmlByPermission = Permissions.index + "/getHtmlByPermission";  // Added
    // Add more routes as needed
}

class Patients {
    static showPatients = Dashboard.patients;  // Added
    static showPatient = Dashboard.patients + "/patient";  // Added
    static addPatient = Dashboard.patients + "/patient/add";  // Added
    static updatePatient = Dashboard.patients + "/patient/update";  // Added
    static deletePatient = Dashboard.patients + "/patient/delete";  // Added
    // Add more routes as needed
}

class PatientRecords {
    static showRecords = Dashboard.dashboard + "/patientRecords";  // Added
    static showRecord = Dashboard.dashboard + "/patientRecords/record";  // Added
    static addRecord = Dashboard.dashboard + "/patientRecords/record/add";  // Added
    static updateRecord = Dashboard.dashboard + "/patientRecords/record/update";  // Added
    static deleteRecord = Dashboard.dashboard + "/patientRecords/record/delete";  // Added
    // Add more routes as needed
}

class PatientAppointments {
    // Added
    static showAppointment = Dashboard.patientAppointment + "/appointment";  // Added
    static addAppointment = Dashboard.patientAppointment + "/appointment/add";  // Added
    static updateAppointment = Dashboard.patientAppointment + "/appointment/update";  // Added
    static deleteAppointment = Dashboard.patientAppointment + "/appointment/delete";  // Added
    static patientsHaveAppoinntment = Dashboard.patientAppointment + "/appointment/haveAppoinntment";  // Added
    // Add more routes as needed
}

class PatientsToDoctor {
    static showtoDoctors = Dashboard.dashboard + "/patientsToDoctor";  // Added
    static showtoDoctor = Dashboard.dashboard + "/patientsToDoctor/toDoctor";  // Added
    static addtoDoctor = Dashboard.dashboard + "/patientsToDoctor/toDoctor/add";  // Added
    static updatetoDoctor = Dashboard.dashboard + "/patientsToDoctor/toDoctor/update";  // Added
    static deletetoDoctor = Dashboard.dashboard + "/patientsToDoctor/toDoctor/delete";  // Added
    // Add more routes as needed
}
// export { UrlData, Login, Dashboard, HtmlCodePage, Users, UserPermission, Permissions, Patients, PatientRecords, PatientAppointments, PatientsToDoctor };