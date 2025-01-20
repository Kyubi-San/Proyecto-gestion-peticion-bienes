<h2>Lista de Bienes</h2>
      <input type="text" id="filterId" placeholder="Ingrese ID a filtrar" />
      <button class="button" onclick="filterById()">Filtrar</button>
      <table id="goodsTable">
        <thead>
          <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Descripción</th>
            <th>Tipo de Bien</th>
            <th>Fecha Solicitud</th>
            <th>Fecha Aprobación</th>
            <th>Fecha Retiro</th>
            <th>Responsable</th>
            <th>Comentarios</th>
            <th>Acciones</th>
          </tr>
        </thead>
        <tbody>
          <!-- Aquí se llenarán los bienes -->
           <?php
          foreach ($conn->query('SELECT * from bienes') as $row):
          ?>
          <tr>
            <td><?php echo htmlspecialchars($row['id']); ?></td>
            <td><?php echo htmlspecialchars($row['name']); ?></td>
            <td><?php echo htmlspecialchars($row['description']); ?></td>
            <td><?php echo htmlspecialchars($row['type']); ?></td>
            <td><?php echo htmlspecialchars($row['requestDate']); ?></td>
            <td><?php echo htmlspecialchars($row['approvalDate']); ?></td>
            <td><?php echo htmlspecialchars($row['withdrawalDate']); ?></td>
            <td><?php echo htmlspecialchars($row['responsible']); ?></td>
            <td><?php echo htmlspecialchars($row['comments']); ?></td>
            <td>
              <a href="edit.php?id=<?php echo $row['id']; ?>">Editar</a>
              <a href="delete.php?id=<?php echo $row['id']; ?>">Eliminar</a>
            </td>
          </tr>
          <?php
          endforeach;?>
        </tbody>
      </table>