class OKMR_newKpiForm{
    constructor() {
        this.createForm();
        this.hideNewElement();
        this.appendForm();
    }

    createForm(){
        this.form = new OKMR_kpiForm('new');
    }

    hideNewElement(){
        const newElement = document.getElementById('okmr-add-new-kpi');

        newElement.classList.add('okmr-hide');
    }

    appendForm(){
        const newKpiButton = document.getElementById('okmr-add-new-wrap');

        newKpiButton.append(this.form);
    }
}