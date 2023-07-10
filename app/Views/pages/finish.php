<div class="info">

    <script>
        $(document).ready(function() {
            <?php if (isset($mensagem) && $mensagem !== "") { ?>
                <?php if (!empty($mensagem2)) { ?>
                    Swal.fire(
                        '<?= $mensagem ?>',
                        '<?= $mensagem2 ?>',
                        '<?php echo $status ?>'
                    );
                <?php } else { ?>
                    Swal.fire(
                        '<?= $mensagem ?>',
                        '<?= implode(", ", $errors) ?>',
                        '<?php echo $status ?>'
                    );
                <?php } ?>
            <?php } ?>
        });
    </script>

    <style>
        .info {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-align: center;
            height: 100vh;
            color: #008080;
            width: 100%;
            background-color: #ecfeeb;

        }

        .mensagem {
            border-radius: 5px;
            padding: 10px;
            width: 100%;

            color: #ecfeeb;
            background-color: #008080;
            text-align: center;
            font-size: 1rem;
            line-height: 40px;
        }

        .mensagem i {
            font-size: 1.5rem;
        }
        .botao{
            margin-top: 10px;
        }
        .link{
            font-weight: 800;
        }
    </style>
  
    <div class="">
        <p class="mensagem"><?= isset($mensagem2) ?
                                '<i class="ri-alarm-warning-fill"></i>' :
                                '<i class="ri-alarm-warning-fill"></i> <br>Info: errors:' . implode(", ", $errors)  ?></p>


    </div>
    <p class="botao">
        <button onclick="history.back()"><i class="ri-arrow-go-back-line"></i></button>
    </p>
</div>