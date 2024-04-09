export const resolveBasePathUrl = () => {
    let result = window.Ngeblog.path + "/";
    if (window.Ngeblog.path === "" || window.Ngeblog.path === "/") {
        result = "/";
    }
    return result;
};

export const apiBasePath = (path) => {
    return "/" + resolveBasePathUrl() + "api/" + path;
};
