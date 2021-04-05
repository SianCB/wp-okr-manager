class OKMR_editForm{
    constructor(id) {
        this.id = id;

        this.removeListItemFromDOM();
        this.createEditForm();
    }

    removeListItemFromDOM(){
        document.getElementById('element-' + this.id).remove();
    }

    createEditForm() {
        const wrap = document.getElementById('okmr-kpi-wrap-'+this.id);
        const form = document.createElement('form');
        const field = document.createElement('input');
        const submit = document.createElement('input');

        form.id = 'okmr-edit-form-' + this.id;

        field.id = 'okmr-edit-form-field';
        field.classList.add('okmr-input-text');

        submit.type = 'submit';
        submit.classList.add('okmr-edit-form-submit');

        form.appendChild(field);
        form.appendChild(submit);
        wrap.appendChild(form);
    }
}