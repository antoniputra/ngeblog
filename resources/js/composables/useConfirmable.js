import { reactive } from "vue";

export function useConfirmable(
    config = {
        setTitle: (data) => null,
        setMessage: (data) => null,
        confirm: (data) => null,
    },
) {
    return reactive({
        ...config,
        props: {
            title: "Are you sure?",
            message: "This action cannot be irreversible.",
        },
        data: null,
        show: false,
        open(data) {
            this.show = true;
            this.data = data;

            if (typeof this.setTitle !== "undefined") {
                this.props.title = this.setTitle(this.data);
            }

            if (typeof this.setMessage !== "undefined") {
                this.props.message = this.setMessage(this.data);
            }
        },
        close() {
            this.show = false;
            this.data = null;
        },
        cancel() {
            this.close();
        },
        triggerConfirm() {
            this.confirm(this.data, this);
        },
    });
}
