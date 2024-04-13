/**
 * Expected output is string that starts and ends with "/".
 * e.g: "/whatever/"
 *
 * @returns string
 */
export const resolveRouterBasePath = () => {
    let result = window.Ngeblog.path;
    if (result === "" || result === "/") {
        return "/ngeblog/";
    }

    if (!result.endsWith("/")) {
        result = result + "/";
    }
    if (!result.startsWith("/")) {
        result = "/" + result;
    }

    return result;
};

export const apiBasePath = (path) => {
    if (!path.startsWith("/")) {
        path = "/" + path;
    }
    return resolveRouterBasePath() + "api" + path;
};

export const formatDate = (
    theDate,
    config = {
        timeZone: null,
        withTime: false,
        withDayName: false,
        locale: "en-US",
    },
) => {
    const options = {
        year: "numeric",
        month: "long",
        day: "2-digit",
    };

    if (config.timeZone) {
        options.timeZone = config.timeZone;
    }

    if (config.withTime) {
        options.hour = "numeric";
        options.minute = "numeric";
        options.hour12 = false;
    }

    // * in case we need to display Day Name (Monday)
    if (config.withDayName) {
        options.weekday = "long";
    }

    if (theDate instanceof Date) {
        return theDate.toLocaleString(config.locale, options);
    }

    if (typeof theDate === "string") {
        return new Date(theDate).toLocaleString(config.locale, options);
    }
};

export const slugify = (str, divider = "-") => {
    return str
        .toLowerCase()
        .trim()
        .replace(/[^\w\s-]/g, "")
        .replace(/[\s_-]+/g, divider)
        .replace(/^-+|-+$/g, "");
};
