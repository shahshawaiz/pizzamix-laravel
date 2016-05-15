
$(document).ready(function(){
  //canvas instance
  var ctx_pie = $("#pieChart").get(0).getContext("2d");
  var ctx_doughtnut = $("#doughtnut").get(0).getContext("2d");

  //data
  var data = [
    {
      value: 270,
      color: "cornflowerblue",
      highlight: "lightskyblue",
      label: "Corn Flower Blue"
    },
    {
      value: 50,
      color: "lightgreen",
      highlight: "yellowgreen",
      label: "Light Green"
    },
    {
      value: 40,
      color: "orange",
      highlight: "darkorange",
      label: "Orange"
    }

  ];

  //draw
  var pieChart = new Chart(ctx_pie).Pie(data);
  var doughnut = new Chart(ctx_doughtnut).Doughnut(data);     
});

