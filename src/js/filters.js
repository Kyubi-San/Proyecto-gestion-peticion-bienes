const filterMenu = document.getElementById("filter-menu")
const filterMenuButton = document.getElementById("filter-menu-button")
const filterCancelButton = document.getElementById("filter-cancel-button")

const filterInput = document.querySelectorAll(".filters__input")
const tableDates = document.querySelectorAll(".table-dates")

filterMenuButton.addEventListener("click", () => {
    filterMenu.classList.toggle("visible--flex")
})

filterCancelButton.addEventListener("click", () => {
    filterMenu.classList.toggle("visible--flex")
})

numFiltersContainer = document.getElementById("numFilters")

function guardarDatosFiltro() {
    let numFilters = 0
    const filtrosAplicados = []

    filterInput.forEach(filter => {
        if (filter.value != "") {
            filtrosAplicados.push(
                filter.value.toLowerCase()
            )
            numFilters++
        } else {
            filtrosAplicados.push(
                filter.value.toLowerCase()
            )
        }
    });
    numFiltersContainer.innerText = `(${numFilters})`
    return filtrosAplicados;
}

function aplicarFiltros() {
    const filtros = guardarDatosFiltro();

    for (let i = 0; i < tableDates.length; i++) {
        const idCell = tableDates[i].getElementsByTagName('td')[0].innerText.toLowerCase();
        const nameCell = tableDates[i].getElementsByTagName('td')[1].innerText.toLowerCase();
        const typeCell = tableDates[i].getElementsByTagName('td')[3].innerText.toLowerCase();
        const requestDateCell = tableDates[i].getElementsByTagName('td')[4].innerText.toLowerCase();
        const approvalDateCell = tableDates[i].getElementsByTagName('td')[5].innerText.toLowerCase();
        
        if (idCell.includes(filtros[0]) && nameCell.includes(filtros[1]) && typeCell.includes(filtros[2]) && requestDateCell.includes(filtros[3]) && approvalDateCell.includes(filtros[4])) {
           tableDates[i].style.display = '';
        } else {
           tableDates[i].style.display = 'none';
        }
    }
}

function clearFilters() {
    filterInput.forEach(filter => {
        if (filter.value != "") {
            filter.value = ""
        }
    });
}

