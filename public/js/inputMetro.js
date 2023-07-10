$(document).ready(
    (StatusChange = function () {
      if ($("#tipo").val() == "espaco de metro") {
        $("#quantidadeLabel").text('Qual a Quantidade de metros?');
      } else {
        $("#quantidadeLabel").text('Qual a Quantidade?');
      }
    })
  );
  