$.ajax({
  type: "POST",
  url: "../../controllers/DashboardController.php?enpoint=dona",
  data: {},
  success: function (data) {
    data = JSON.parse(data); 
    var nombres = [];
    var total = [];
    

    var Mydata = data.map(item => {
      nombres.push(item.Nombres);
      total.push(item.Total); 
      return {
        value: item.Total,
        name: item.Nombres
      };
    });
  
   /*TODO:Grafico Dona JS*/
    echarts.init(document.querySelector("#grafico_dona")).setOption({
      tooltip: {
        trigger: "item",
      },
      legend: {
        top: "5%",
        left: "center",
      },
      series: [
        {
          name: "Total de Libros",
          type: "pie",
          radius: ["40%", "70%"],
          avoidLabelOverlap: false,
          label: {
            show: true, // Mostrar etiquetas
            position: "inside", // Posición de las etiquetas (puede ser "inside" o "outside")
            formatter:  '{c}', 
          },
          emphasis: {
            label: {
              show: true,
              fontSize: "18",
              fontWeight: "bold",
            },
          },
          labelLine: {
            show: false,
          },
          data:Mydata, //data a mostrar
        },
      ],
    });
    /*TODO:Grafico Dona JS
    document.addEventListener("DOMContentLoaded", () => {
   
      });*/
  },
});


$.post("../../controllers/DashboardController.php?enpoint=get_op_recientes",{},function(data){
  $("#tabla_op_recientes").html(data);
});

 