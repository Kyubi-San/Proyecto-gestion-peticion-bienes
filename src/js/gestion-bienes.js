function filterById() {
    const filterId = parseInt(document.getElementById("filterId").value);
    const filteredGoods = bienes.filter((g) => g.id === filterId);
    mostrarBienes(filteredGoods);
}