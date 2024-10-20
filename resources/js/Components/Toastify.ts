import { toast, type ToastOptions } from 'vue3-toastify';

export const notify = (type: string, message: string) => {

    toast(message, {
        autoClose: 3000,
        position: toast.POSITION.TOP_RIGHT,
        type: type,
        dangerouslyHTMLString: false,
        toastStyle: {
            fontSize: '0.875rem',
            fontWeight: 'bold',
            lineHeight: '1.25',
            padding: '0.75rem 1.25rem',
            borderRadius: '0.25rem',
            boxShadow: '0 0 0.5rem rgba(0, 0, 0, 0.1)',
            color: '#fff',
            backgroundColor: '#374152',
            border: '1px solid #333',
        },
        closeButton: false,
    } as ToastOptions);

}

