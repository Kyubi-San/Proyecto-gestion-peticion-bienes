<link rel="stylesheet" href="css/filter.css">
<div class="filters">
  <div class="filter__menu-button" id="filter-menu-button">
    <span class="filters--text">Filtros</span>
    <span id="numFilters">(0)</span>
    <i class="fa-solid fa-chevron-down"></i>
  </div>
  <div class="filters__menu" id="filter-menu">
    <div class="filters__menu-estateInfo">
      <h4>Informacion de bien</h4>
      <div class="estateInfo__filter">
        <label for="">Filtrar por ID:</label>
        <input type="text" class="filters__input" name="id" placeholder="ID" />
      </div>
      <div class="estateInfo__filter">
        <label for="">Filtrar por Nombre:</label>
        <input type="text" class="filters__input" name="name" placeholder="Nombre"/>
      </div>
      <div class="estateInfo__filter">
        <label for="">Filtrar por Tipo:</label>
        <select id="tipo_bien" class="filters__input" name="type" required>
            <option value="" selected disabled>Selecciona una categoria</option>
            <option value="Electronico">Electrónico</option>
            <option value="Mueble">Mueble</option>
            <option value="Herramienta">Herramienta</option>
            <option value="Consumible">Consumible</option>
        </select>
      </div>
    </div>
    <div class="filters__menu-estateInfo">
      <h4>Rango de fecha</h4>
      <fieldset>
        <div>
          <input type="radio" name="date" id="currentWeek">Semana Actual
        </div>
        <div>
          <input type="radio" name="date" id="lastWeek">Semana Pasada
        </div>
        <div>
          <input type="radio" name="date" id="currentMonth">Mes Actual
        </div>
        <div>
          <input type="radio" name="date" id="allDates" checked>Todas las fechas
        </div>
      </fieldset>
      <div class="estateInfo__filter">
        <label for="">Filtrar por fecha de solicitud:</label>
        <input type="date" name="requestDate" class="filters__input" placeholder="Filtrar por fecha"/>
      </div>
      <div class="estateInfo__filter">
        <label for="">Filtrar por Fecha de aprobacion:</label>
        <input type="date" name="approvalDate" class="filters__input" placeholder="Filtrar por fecha"/>
      </div>
    </div>
    <footer class="filters__menu-footer">
      <span onclick="clearFilters()" class="filters__menu-footer-reset">Reiniciar Filtros por defecto</span>
      <span class="filters__menu-footer-button" id="filter-cancel-button">Cancelar</span>
      <button class="filters__menu-footer-button filters__menu-footer-button--apply" onclick="aplicarFiltros()">Aplicar</button>
    </footer>
  </div>
  </div>