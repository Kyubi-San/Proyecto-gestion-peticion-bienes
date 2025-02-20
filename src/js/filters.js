const filterMenu = document.getElementById("filter-menu")
const filterMenuButton = document.getElementById("filter-menu-button")
const filterCancelButton = document.getElementById("filter-cancel-button")

const filterInput = document.querySelectorAll(".filters__input")
const tableDates = document.querySelectorAll(".table-dates")

// Funcion para filtrar segun los rangos de fecha

const dateRange = document.getElementById("dateRange")
const dateRangeInput = document.querySelectorAll(".dateRange__input")

function filterDateRange(range) {
    let currentDate = new Date()
    let currentDay = currentDate.getDate()
    let currentMonth = currentDate.getMonth() + 1
    let currentYear = currentDate.getFullYear()
    let currentWeekDay = currentDate.getDay()

    currentDate.setDate(currentDate.getDate() - currentWeekDay)
    let diaSemanaActual = currentDate.getDate();
    let mesSemanaActual = currentDate.getMonth() + 1;

    for (let i = 0; i < tableDates.length; i++) {
        let requestDateCell = tableDates[i].getElementsByTagName('td')[5].innerText.toLowerCase();
        requestDateCell = requestDateCell.split("-")
        
        switch (range) {
            case 0:
                if(requestDateCell[2] == currentDay && requestDateCell[1] == currentMonth && requestDateCell[0] == currentYear) {
                    tableDates[i].style.display = '';
                } else {
                    tableDates[i].style.display = 'none';
                }
                break;
            
            case 1: 
                console.log(mesSemanaActual)
                if(requestDateCell[2] >= diaSemanaActual && requestDateCell[1] >= mesSemanaActual) {
                    tableDates[i].style.display = '';
                } else {
                    tableDates[i].style.display = 'none';
                }
                break;

            case 2:
                if(requestDateCell[0].includes(currentYear) && requestDateCell[1] == currentMonth) {
                    tableDates[i].style.display = '';
                } else {
                    tableDates[i].style.display = 'none';
                }
                break;
            
            case 3:
                    tableDates[i].style.display = '';
                break;
        
            default:
                break;
        }
    }
}

filterMenu.addEventListener("submit", (e) => {
    e.preventDefault()
    aplicarFiltros()
    console.log(dateRange.value)
})

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

// Función para aplicar los filtros

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

