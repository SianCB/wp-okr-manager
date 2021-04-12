class OKMR_editForm{
    constructor(id) {
        this.id = id;

        this.retrieveForm();
        this.removeListItemFromDOM();
        this.createEditForm();
    }

    retrieveForm(){
        this.elementID = document.getElementById('element-' + this.id);
    }

    removeListItemFromDOM(){
        this.elementID.classList.add('okmr-hide');
    }

    createEditForm() {
        const wrap = document.getElementById('okmr-kpi-wrap-'+this.id);
        new OKMR_kpiForm('edit', this.elementID, wrap);
    }
}