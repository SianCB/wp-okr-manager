class OKMR_kpiForm{
    constructor (type, id = null, element = null) {
        this.type = type;

        if (id != null || element != null){
            this.id = id;
            this.element = element;
            this.secondID = id;
            this.kpiElement = document.querySelector('#element-' + this.id + ' .okmr-element');
            this.kpiValue = this.kpiElement.innerText;
        }

        this.validateFormType();
        this.createElements();
        this.operateElements();
        this.appendToWrap();

        return this.form;
    }

    validateFormType(){
        if(this.type != 'edit' || this.type != 'new'){
            new Error('The form class requires the type to be either edit or new');
        }
    }

    createElements (){
        this.form = document.createElement('form');
        this.field = document.createElement('input');
        this.submit = document.createElement('input');
        this.close = document.createElement('input');
    }

    operateElements(){
        this.assignFormID();
        this.assignFieldProperties();
        this.assignFieldValue();
        this.assignSubmitProperties();
        this.appendInnerElements();
        this.configureCloser();
    }

    assignFormID (){
        if(this.type == 'edit'){
            this.form.id = 'okmr-edit-form-' + this.id;
        }else if(this.type == 'new'){
            this.form.id = 'okmr-add-new-kpi-form';
        }
    }

    assignFieldProperties(){
        this.field.id = 'okmr-'+ this.type +'-form-field';
        this.field.classList.add('okmr-input-text');
    }

    assignSubmitProperties(){
        this.submit.type = 'submit';
        this.submit.classList.add('okmr-'+ this.type +'-form-submit');
    }

    assignFieldValue(){
        if(this.type == 'edit'){
            this.field.value = this.kpiValue.trim();
        }
    }

    appendInnerElements(){
        this.form.appendChild(this.field);
        this.form.appendChild(this.submit);
        this.form.appendChild(this.close);
    }

    configureCloser(){
        this.close.innerText = 'X';
        this.close.classList.add('okmr-closer');
        this.close.id = 'closer-' + this.secondID;
        this.close.type = 'button';
        this.close.value = 'Discard'
        this.close.onclick = () =>{
            this.form.remove();

            if (this.type === 'edit'){
                document.getElementById('element-' + this.id).classList.remove('okmr-hide');
            }
        }
    }

    appendToWrap(){
        if (this.element != null){
            this.element.append(this.form);
        }
    }

    closeForm(){
        this.form.remove();
    }
}