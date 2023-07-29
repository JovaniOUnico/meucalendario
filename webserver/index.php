<?php

  function days_in_month($month, $year){
    // calculate number of days in a month
    return $month == 2 ? ($year % 4 ? 28 : ($year % 100 ? 29 : ($year % 400 ? 28 : 29))) : (($month - 1) % 7 % 2 ? 30 : 31);
  } 

  function dia_da_semana($dia,$mes,$ano){//0-domigo/6-sabado
    $data = date($ano."-".$mes."-".$dia);

    $diasemana_numero = date('w', strtotime($data));

    return $diasemana_numero;
  }

  function semana_do_ano($dia,$mes,$ano){

    $var = intval( date('z', mktime(0,0,0,$mes,$dia,$ano) ) / 7 ) + 1;

    return $var;
  }

  $diasemana = [
    'Domingo',
    'Segunda',
    'Terça',
    'Quarta',
    'Quinta',
    'Sexta',
    'Sabado',
  ];

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Meu Calendário</title>
  <link rel="stylesheet" type="text/css" href="bower_components/bootstrap/dist/css/bootstrap.css">
  <script type="text/javascript" src="bower_components/bootstrap/dist/js/bootstrap.js"></script>
  <style>
    .tabela-tarefas-mes{
      padding: 10px;
    }
    *{
      font-size: 11px;
    }
    textarea:focus{
      background-color: #eee;
    }
  </style>
</head>
<body>
  <div class="container-fluid">
    <div class="row tabela-tarefas-mes">

      <?php 
        $ano_selecionado = 2023;
        $mes_selecionado = 7;

        $dia_inicio_mes_selecionado = dia_da_semana(1,$mes_selecionado,$ano_selecionado);

        $numero_dias_mes_selecionado = days_in_month($mes_selecionado, $ano_selecionado);

        $dia_hoje = date('d');
        $mes_hoje = date('m');
        $ano_hoje = date('Y');

        $num_dias_semana = 7;

        $contador_semana = 1;

        $numero_semana_ano = semana_do_ano(1,$mes_selecionado,$ano_selecionado);

        if(dia_da_semana(1,$mes_selecionado,$ano_selecionado) != 1){
          $numero_semana_ano--;
        }

      ?>

      <h1>Mês - <?=$mes_selecionado?></h1>
      <table class="table">
        <thead>
          <tr>
            <th scope="col">Num Semana</th>
            <th scope="col">Domingo</th>
            <th scope="col">Segunda</th>
            <th scope="col">Terça</th>
            <th scope="col">Quarta</th>
            <th scope="col">Quinta</th>
            <th scope="col">Sexta</th>
            <th scope="col">Sábado</th>
          </tr>
        </thead>
        <tbody>
          <form>
          <?

            echo "<tr><th scope=\"row\">Numero semana: ".$numero_semana_ano."<br>Numero semana mês: $contador_semana</th>";

            for($dia_contador = 0; $dia_contador < $numero_dias_mes_selecionado; $dia_contador++){

              if(($dia_contador+1) == 1 && (dia_da_semana(($dia_contador+1),$mes_selecionado,$ano_selecionado)+1) != $contador_semana) {
                echo "<td> </td>";
                $dia_contador--;
              }else{
                $dia_valor = str_pad(($dia_contador+1), 2, "0", STR_PAD_LEFT);
                echo "<td style='padding: 0px; height: 200px;'><textarea style='width: 100%; height: 100%; margin: 0px; border: none; resize: none;' name='dia_.$dia_valor.'>".$dia_valor."</textarea></td>";
              }

              if((dia_da_semana(($dia_contador+1),$mes_selecionado,$ano_selecionado)+1) % 7 == 0){
                echo "</tr>";
                echo "<tr><th scope=\"row\">Numero semana: ".(++$numero_semana_ano)."<br>Numero semana mês: $contador_semana</th>";
                $contador_semana = 1;
              }

              $contador_semana++;
            }

          ?>
          </form>
        </tbody>
      </table>
    </div>
    <a class="btn btn-lg btn-outline-success">Salvar</a>
    <hr>
  </div>
</body>
</html>