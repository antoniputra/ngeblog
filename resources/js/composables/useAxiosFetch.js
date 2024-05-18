import { reactive } from "vue";
import axios from "axios";

export function useAxiosFetch() {
    const initialState = {
        data: null,
        loading: false,
        error: null,
        requestHeaders: null,
        responseHeaders: null,
    };

    const state = reactive({ ...initialState });

    const fetchData = async (url, method = "GET", config = {}) => {
        state.loading = true;
        state.error = null;
        state.requestHeaders = config.headers || null;
        state.responseHeaders = null;

        try {
            const response = await axios({ url, method, ...config });
            state.data = response.data;
            state.responseHeaders = response.headers;
        } catch (err) {
            console.error("Something went wrong: ", err);
            state.error = err;
        } finally {
            state.loading = false;
        }

        return state.data;
    };

    const reset = () => {
        Object.assign(state, initialState);
    };

    return {
        state,
        fetchData,
        reset,
    };
}
