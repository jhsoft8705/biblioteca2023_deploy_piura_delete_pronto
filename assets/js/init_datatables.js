$.extend($.fn.dataTable.defaults, {
    // Configuración de la estructura de la tabla
    dom: "<'row'<'col-md-6'l><'col-md-6'f>><'row'<'col-md-12'B>>" +
    "<'row'<'col-md-12't>><'row'<'col-md-5'i><'col-md-7'p>>",
    // Habilitar botones de exportación
    buttons: [
      {
        extend: 'copyHtml5',
        text: 'Copiar',
        exportOptions: {
          columns: ':visible'
        }
      },
      {
        extend: 'excelHtml5',
        text: 'Exportar a Excel',
        exportOptions: {
          columns: ':visible'
        }
      },
      {
        extend: 'csvHtml5',
        text: 'Exportar a CSV',
        exportOptions: {
          columns: ':visible'
        }
      },
      {
        extend: 'pdfHtml5',
        text: 'Exportar a PDF', // Texto personalizado para el botón de PDF
        exportOptions: {
          columns: ':visible'
        }
      }
    ],
  
    // Destruir la tabla si ya existe
    bDestroy: true,
  
    // Hacer la tabla responsive
    responsive: true,
  
    // Mostrar información sobre la tabla (número de registros, filtrados, etc.)
    bInfo: true,
    lengthMenu: [5, 10, 20], // Personaliza las opciones del filtro de registros por página.
    pageLength: 5,
    // Número de registros a mostrar por página
   
    // Configuración del idioma
    language: {
      processing: 'Procesando...',
      lengthMenu: 'Mostrar_MENU_Registros por página',
      zeroRecords: 'No se encontraron resultados',
      emptyTable: 'Ningún dato disponible en esta tabla',
      info: 'Mostrando    _TOTAL_ registros',
      infoEmpty: 'Mostrando 0 al 0 de 0 registros',
      infoFiltered: '(filtrado de _MAX_ registros en total)',
      infoPostFix: '',
      search: 'Buscar:',
      url: '',
      infoThousands: ',',
      loadingRecords: 'Cargando...',
      paginate: {
        first: 'Primero',
        last: 'Último',
        next: 'Siguiente',
        previous: 'Anterior'
      },
      aria: {
        sortAscending: ': Activar para ordenar la columna de manera ascendente',
        sortDescending: ': Activar para ordenar la columna de manera descendente'
      }
    }
  });