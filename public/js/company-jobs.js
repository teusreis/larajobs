function data() {
    return {
        modalOpen: false,
        jobId: '',
        openModal(id) {
            this.jobId = id;
            this.modalOpen = true;
        },
        closeModal() {
            this.modalOpen = false;
        },
    };
}
