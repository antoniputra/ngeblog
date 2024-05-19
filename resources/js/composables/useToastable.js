import { reactive } from "vue";

export const toasts = reactive({
    list: [],
});

export function useToastable() {
    const addToast = (
        message,
        { type = "success", duration = 3000, isHtml = false } = {},
    ) => {
        const id = Date.now();
        toasts.list.push({ id, message, type, isHtml });

        // Automatically remove the toast after the specified duration
        setTimeout(() => {
            removeToast(id);
        }, duration);
    };

    const removeToast = (id) => {
        toasts.list = toasts.list.filter((toast) => toast.id !== id);
    };

    return {
        addToast,
        removeToast,
    };
}
