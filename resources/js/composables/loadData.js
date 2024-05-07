import axios from "axios";
import { reactive } from "vue";

export function useLoadData(defaultUrl = null) {
    return reactive({
        loading: false,
        data: null,
        fetchData(overrideUrl = null, cb = null) {
            const self = this;
            self.loading = true;
            const url = overrideUrl ? overrideUrl : defaultUrl;

            axios
                .get(url)
                .then((response) => {
                    self.data = response.data;

                    if (typeof cb === "function") {
                        cb(self.data);
                    }
                })
                .finally(() => {
                    self.loading = false;
                });
        },

        promise(overrideUrl = null) {
            const url = overrideUrl ? overrideUrl : defaultUrl;
            return axios.get(url);
        },
    });
}
